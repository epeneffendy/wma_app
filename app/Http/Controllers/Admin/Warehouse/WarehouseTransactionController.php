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
}

