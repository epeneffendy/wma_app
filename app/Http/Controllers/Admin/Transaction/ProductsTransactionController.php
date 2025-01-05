<?php

namespace App\Http\Controllers\Admin\Transaction;

use App\Http\Controllers\Controller;
use App\Services\ProductsTransactionService;
use Illuminate\Http\Request;

class ProductsTransactionController extends Controller
{
    public function index(ProductsTransactionService $productsTransactionService)
    {
        $data = $productsTransactionService->get();
        return view('admin.transaction.products_transaction.index', ['data' => $data]);
    }

    public function add(Request $request)
    {
        $editable = false;
        return view('admin.transaction.products_transaction.add', compact('editable'));
    }
}
