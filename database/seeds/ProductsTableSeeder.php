<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $p1 = [
            'name' => 'Running Seeders',
            'image' => 'products/book.png',
            'price' => '25000',
            'description' => 'tandard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries'
        ];

        $p2 = [
            'name' => 'Running Seeders',
            'image' => 'products/book.png',
            'price' => '25000',
            'description' => 'tandard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries'
        ];


        Product::create($p1);
        Product::create($p2);

    }
}
