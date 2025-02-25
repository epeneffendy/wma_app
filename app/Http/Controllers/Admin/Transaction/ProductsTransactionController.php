<?php

namespace App\Http\Controllers\Admin\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsTransactionRequest;
use App\Models\WarehouseTransaction;
use App\Services\CategoryService;
use App\Services\ProductsService;
use App\Services\ProductsTransactionService;
use App\Services\UnitsService;
use App\Services\WarehouseTransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsTransactionController extends Controller
{
    public function acceptance(ProductsTransactionService $productsTransactionService)
    {
        $data = $productsTransactionService->get('in');
        return view('admin.transaction.products_transaction.index_acceptance', ['data' => $data]);
    }

    public function transaction(ProductsTransactionService $productsTransactionService)
    {
        $data = $productsTransactionService->get('out');
        return view('admin.transaction.products_transaction.index_transaction', ['data' => $data]);
    }

    public function add_acceptance(Request $request, ProductsService $productsService, UnitsService $unitsService, CategoryService $categoryService)
    {
        $editable = false;
        $transaction_type = 'in';
        $list_products = $productsService->get();

        return view('admin.transaction.products_transaction.add', compact('editable', 'transaction_type', 'list_products'));
    }

    public function add_transaction(Request $request, ProductsService $productsService, UnitsService $unitsService, CategoryService $categoryService)
    {
        $editable = false;
        $transaction_type = 'out';
        $list_products = $productsService->get();

        return view('admin.transaction.products_transaction.add', compact('editable', 'transaction_type', 'list_products'));
        return view('admin.transaction.products_transaction.add', compact('editable', 'transaction_type'));
    }

    public function store(Request $request, ProductsTransactionRequest $productsTransactionRequest, ProductsTransactionService $productsTransactionService, ProductsService $productsService, WarehouseTransactionService $warehouseTransactionService)
    {
        DB::beginTransaction();
        try {
            $message = '';
            $route = '';
            $input = $productsTransactionRequest->validated();
            $product = $productsService->findById($input['product_code']);
            if (isset($product)) {
                $input['unit_code'] = $product->unit_code;
                $input['category_code'] = $product->category_code;
                $input['price'] = $product->price;
                $input['total_price'] = $product->price * $input['qty'];
            }
            $transaction_id = $productsTransactionService->insert($input);
            if ($transaction_id) {
                $data_transaction = $productsTransactionService->findById($transaction_id);
                $calculate = $warehouseTransactionService->recalculate($data_transaction->getAttribute('product_code'), $data_transaction->getAttribute('transaction_type'), $data_transaction->getAttribute('qty'));

                $warehouse_product = new WarehouseTransaction();
                $warehouse_product->product_code = $data_transaction->getAttribute('product_code');
                $warehouse_product->unit_code = $data_transaction->getAttribute('unit_code');
                $warehouse_product->category_code = $data_transaction->getAttribute('category_code');
                $warehouse_product->product_transaction_id = $data_transaction->getAttribute('id');
                $warehouse_product->transaction_type = $data_transaction->getAttribute('transaction_type');
                $warehouse_product->transaction_date = $data_transaction->getAttribute('transaction_date');
                $warehouse_product->qty_in = $calculate['qty_in'];
                $warehouse_product->qty_out = $calculate['qty_out'];
                $warehouse_product->qty_on_hand = $calculate['qty_on_hand'];
                $warehouse_product->description = $data_transaction->getAttribute('description');
                $warehouse_product->created_at = date('Y-m-d H:i:s');
                $warehouse_product->updated_at = date('Y-m-d H:i:s');
                if ($warehouse_product->save()) {
                    DB::commit();
                    $message = 'Transaction successfully saved!';
                    if ($input['transaction_type'] == 'in') {
                        $route = 'admin.transaction.products_transaction.acceptance';
                    } else {
                        $route = 'admin.transaction.products_transaction.transaction';
                    }
                } else {
                    $message = 'Transaction failed to save!';
                    DB::rollBack();
                }
            }
            return redirect()->route($route)->with('message', $message);
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('errors', $th->getMessage());
        } catch (\Exception  $e) {
            DB::rollBack();
            return back()->with('errors', $e->getMessage());
        }
    }
}
