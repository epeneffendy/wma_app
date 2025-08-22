<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\ProductsService;
use App\Services\ProductsTransactionService;
use App\Services\WeightedMovingAverageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(ProductsService $productsService, ProductsTransactionService $productsTransactionService, WeightedMovingAverageService $weightedMovingAverageService)
    {
        $month_now = date('Y-m');
//        $month_now = '2025-01';
        //total_product
        $data_product = $productsService->get();

        //total_sales_price
        $data_sales_transaction = $productsTransactionService->salesTransaction($month_now);
        $arr_sales_transaction = explode(",", number_format($data_sales_transaction));
        $sales_transaction = 0;
        if (count($arr_sales_transaction) > 0) {
            if ($arr_sales_transaction[0] > 0) {
                $sales_transaction = $arr_sales_transaction[0] . 'K';
            }
        }
        //Item Transaction
        $data_item_transaction = $productsTransactionService->itemTransaction($month_now);

        //Item Per Transaction
        $data_item_per_transaction = $productsTransactionService->itemPerTransaction($month_now);

        //Stok Per Item
        $data_stock_per_item = $productsTransactionService->stockPerItem();

        //WMA
        $data_wma = $weightedMovingAverageService->getByMonth($month_now);

        return view('admin.dashboard.index', [
            'user' => Auth::user(),
            'data_product' => count($data_product),
            'data_sales_transaction' => $sales_transaction,
            'data_item_transaction' => count($data_item_transaction),
            'data_item_per_transaction' => $data_item_per_transaction,
            'data_stock_per_item' => $data_stock_per_item,
            'data_wma' => $data_wma
        ]);
    }
}
