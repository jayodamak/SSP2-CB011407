<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Carbon\Carbon;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\product::factory(10)->create();

        $productRecords = [
            [
                'id' => 1,
                'category_id' => 4,
                'product_name' => 'Elegant lapel tweed high waist button set',
                'url' => 'Elegant lapel tweed high waist button set',
                'product_code' => 'BT001',
                'product_color' => 'Dark Blue',
                'family_color' => 'Blue',
                'product_price' => 1500.00,
                'product_discount' => 10.00,
                'discount_type' => 'Product',
                'final_price' => 1350.00,
                // 'product_weight' => 200.00,
                'product_image' => null,
                'search_keywords' => null,
                'description' => 'Test Product',
                // 'fabric' => null,
                // 'occassion' => 'Party',
                'is_featured' => 'Yes',
                'status' => 1,
                'meta_title' => 'Product',
                'meta_description' => 'Product',
                'meta_keywords' => 'Product',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
            // ,
            // [
            //     'id' => 2,
            //     'category_id' => 2,
            //     'product_name' => 'Floral Print High Waist Skirt, Casual Skirt',
            //     'url' => 'Floral Print High Waist Skirt, Casual Skirt',
            //     'product_code' => 'BT001',
            //     'product_color' => 'Light Red',
            //     'product_price' => 1500.00,
            //     'product_discount' => null,
            //     'final_price' => 1500.00,
            //     'product_image' => null,
            //     'keywords' => null,
            //     'product_weight' => 200.00,
            //     'description' => 'Test Product',
            //     'fabric' => null,
            //     'occassion' => null,
            //     'is_featured' => 'Yes',
            //     'status' => 1,
            //     'meta_title' => 'Product',
            //     'meta_description' => 'Product',
            //     'meta_keywords' => 'Product',
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ]
            // ,
            // [
            //     'id' => 3,
            //     'category_id' => 2,
            //     'product_name' => 'Paisley Print Maxi Dress',
            //     'url' => 'Paisley-Print-Maxi-Dress',
            //     'product_code' => 'GT001',
            //     'product_color' => 'Yellow Green',
            //     'product_price' => 1500.00,
            //     'product_discount' => 10.00,
            //     'discount_type' => null,
            //     'final_price' => 1350.00,
            //     'product_weight' => 200.00,
            //     'product_image' => null,
            //     'keywords' => null,
            //     'description' => 'Test Product',
            //     'fabric' => null,
            //     'occassion' => null,
            //     'is_featured' => 'No',
            //     'status' => 1,
            //     'meta_title' => 'Product',
            //     'meta_description' => 'Product',
            //     'meta_keywords' => 'Product',
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
        ];
        Product::insert($productRecords);
    }
}
