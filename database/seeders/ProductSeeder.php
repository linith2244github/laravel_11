<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                "name" => "I Phone 13 Pro",
                "price" => 400.50,
                "qty" => 10,
                "created_at" => now(),
                "updated_at"=> now(),
            ],
            [
                "name" => "I Phone 12 Pro",
                "price" => 300.50,
                "qty" => 20,
                "created_at" => now(),
                "updated_at"=> now(),
            ],
            [
                "name" => "I Phone 11 Pro",
                "price" => 200.50,
                "qty" => 30,
                "created_at" => now(),
                "updated_at"=> now(),
            ],
            [
                "name" => "I Phone 15 Pro",
                "price" => 500.50,
                "qty" => 6,
                "created_at" => now(),
                "updated_at"=> now(),
            ],
            [
                "name" => "I Phone 16 Pro",
                "price" => 600.50,
                "qty" => 5,
                "created_at" => now(),
                "updated_at"=> now(),
            ],
            [
                "name" => "Sumsung Galaxy S21 Ultra",
                "price" => 200.50,
                "qty" => 20,
                "created_at" => now(),
                "updated_at"=> now(),
            ]
        ];
        DB::table('products')->insert($products);
    }
}
