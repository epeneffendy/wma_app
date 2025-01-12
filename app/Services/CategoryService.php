<?php
namespace App\Services;

use App\Models\Category;

class CategoryService{
    public function get($request = null)
    {
        $data = Category::where(['status' => 1])->get();
        return $data;
    }
}
