<?php

namespace App\Http\Controllers\Admin\Warehouse;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use App\Services\ProductsService;
use App\Services\UnitsService;
use App\Services\WarehouseTransactionService;
use Illuminate\Http\Request;

class WarehouseTransactionController extends Controller
{
    public function index(WarehouseTransactionService $warehouseTransactionService, UnitsService $unitsService, CategoryService $categoryService)
    {
        $data = '';
        $units = $unitsService->get();
        $category = $categoryService->get();
        return view('admin.warehouse.warehouse_transaction.index', ['units' => $units, 'category' => $category]);
    }

    public function getProductByCategory($code, ProductsService $productsService)
    {
        $products = $productsService->findByCategory($code);
        return $products;
    }

    public function findStockProduct(Request $request, WarehouseTransactionService $warehouseTransactionService)
    {
        $params = [
            'category' => $request->category,
            'product' => $request->product,
            'transaction_date_start' => $request->transaction_date_start,
            'transaction_date_end' => $request->transaction_date_end
        ];

        $find_stock_product = $warehouseTransactionService->findStockProduct($params);

        $success = false;
        $message = 'Transaction Not Found!';
        $data = '';
        if (count($find_stock_product) > 0) {
            $success = true;
            $message = 'Transaction Found!';
            $data = $find_stock_product;
        }

        return ['success' => $success, 'message' => $message, 'data' => $data];
    }

    public function showTransactionStock(Request $request)
    {
        return view('admin.warehouse.warehouse_transaction.partial.show_transaction_stock', ['data' => $request['data']]);
    }

    public function getDetailTransactionProduct(Request $request, WarehouseTransactionService $warehouseTransactionService)
    {
        $success = false;
        $message = 'Transaction Product Not Found';
        $data = '';
        $find_transaction_product = $warehouseTransactionService->findTransactionProduct($request->product_code);
        if (count($find_transaction_product) > 0) {
            $success = true;
            $message = 'Transaction Product Found!';
            $data = $find_transaction_product;
        }
        return ['success' => $success, 'message' => $message, 'data' => $data];
    }

    public function showDetailTransactionProduct(Request $request){
        return view('admin.warehouse.warehouse_transaction.partial.show_detail_transaction_stock', ['data' => $request['data']]);
    }
}

