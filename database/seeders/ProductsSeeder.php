<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'code'=>'101001',
                'name'=>'Soes Cake Vanilla Cream',
                'unit_code'=>'PCS',
                'category_code'=>'001',
                'price'=>'50000',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'code'=>'101002',
                'name'=>'Soes Cake Vanilla',
                'unit_code'=>'PCS',
                'category_code'=>'001',
                'price'=>'20000',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'code'=>'111001',
                'name'=>'Pisang Molen Mix (Coklat dan Keju)',
                'unit_code'=>'PCS',
                'category_code'=>'002',
                'price'=>'25000',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'code'=>'111002',
                'name'=>'Amandel',
                'unit_code'=>'PCS',
                'category_code'=>'002',
                'price'=>'30000',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];

        DB::table('products')->insert($products);
    }
}
