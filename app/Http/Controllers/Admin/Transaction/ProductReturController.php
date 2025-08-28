<?php

namespace App\Http\Controllers\Admin\Transaction;

use App\Http\Controllers\Controller;
use App\Services\ProductReturService;
use App\Services\ProductsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductReturController extends Controller
{
    public function index(ProductReturService $productReturService){
        $data = $productReturService->get();
        return view('admin.transaction.product_retur.index',['data'=>$data]);
    }

    public function add(ProductReturService $productReturService, ProductsService $productsService){
        $editable = false;
        $list_products = $productsService->get();
        return view('admin.transaction.product_retur.add',compact('editable',  'list_products'));
    }

    public function store(Request $request, ProductReturService $productReturService, ProductsService $productsService){
        DB::beginTransaction();
        try {
            $product = $productsService->findById($request->product_code);

            $store = $productReturService->insert($request->all(), $product);
            if ($store) {
                DB::commit();
                $message = 'Retur successfully saved!';
                $route = 'admin.transaction.product_retur.index';
            } else {
                $message = 'Retur failed to save!';
                DB::rollBack();
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

    public function approve(Request $request, ProductReturService $productReturService){
        DB::beginTransaction();
        try {
            $approve = $productReturService->approve($request->id);
            if($approve){
                DB::commit();
                $message = 'Retur successfully approved!';
            }else{
                $message = 'Retur failed to approved!';
                DB::rollBack();
            }
            return redirect()->route('admin.transaction.product_retur.index')->with('message', $message);
        }catch (\Exception $e){
            DB::rollBack();
            return back()->with('errors', $e->getMessage());
        }

    }
}
