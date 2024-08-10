<?php

namespace Database\Seeders;

use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Menambahkan data produk
        $electronics = CategoryProduct::firstOrCreate(['name' => 'Electronics']);
        $furniture = CategoryProduct::firstOrCreate(['name' => 'Furniture']);
        $pakaian = CategoryProduct::firstOrCreate(['name' => 'Pakaian']);

        //Menambahkan produk kategori elektonik
        Product::create([
            'category_product_id' => $electronics->id,
            'name' => 'iPhone 14',
            'price' => 10000000.00,
            'image' => 'iphone14.png',
        ]);

        Product::create([
            'category_product_id' => $electronics->id,
            'name' => 'Samsung Galaxy S22',
            'price' => 8000000.00,
            'image' => 'galaxyS22.png',
        ]);

        Product::create([
            'category_product_id' => $electronics->id,
            'name' => 'LG Aquos 50 inch',
            'price' => 5000000.00,
            'image' => 'lgAquos.png',
        ]);

        //Menambahkan produk kategori furniture
        Product::create([
            'category_product_id' => $furniture->id,
            'name' => 'Kursi gaming',
            'price' => 500000.00,
            'image' => 'kursiGaming.png',
        ]);

        Product::create([
            'category_product_id' => $furniture->id,
            'name' => 'Kursi gaming 2',
            'price' => 500000.00,
            'image' => 'kursiGaming2.png',
        ]);

        Product::create([
            'category_product_id' => $furniture->id,
            'name' => 'Kursi gaming 3',
            'price' => 500000.00,
            'image' => 'kursiGaming3.png',
        ]);

        //Menambahkan produk kategori pakaian
        Product::create([
            'category_product_id' => $pakaian->id,
            'name' => 'Celana jeans',
            'price' => 500000.00,
            'image' => 'celanaJeans.png',
        ]);

        Product::create([
            'category_product_id' => $pakaian->id,
            'name' => 'Celana jeans 2',
            'price' => 500000.00,
            'image' => 'celanaJeans2.png',
        ]);

        Product::create([
            'category_product_id' => $pakaian->id,
            'name' => 'Baju',
            'price' => 500000.00,
            'image' => 'baju.png',
        ]);


    }
}
