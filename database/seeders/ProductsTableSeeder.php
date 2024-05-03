<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('products')->delete();
        
        \DB::table('products')->insert(array (
            0 => 
            array (
                'id' => 1,
                'brand_id' => 1,
                'sku' => NULL,
                'name' => 'iPhone 11 Pro Max 64GB Quốc Tế',
                'slug' => 'iphone-11-pro-max-64gb-quoc-te',
                'image' => 'https://example.sudospaces.com/core/2021/07/iphone-11-pro-max-tra-ng-5ece24ff5f135-27-05-2020-15-29-51-5ef715ada36f8-27-06-2020-16-47-25-2.png',
                'slide' => NULL,
                'price' => 18000000,
                'price_old' => 22000000,
                'detail' => NULL,
                'related_products' => NULL,
                'quantity' => 0,
                'length' => 0,
                'wide' => 0,
                'height' => 0,
                'weight' => 0,
                'tax_id' => NULL,
                'status' => 1,
                'created_at' => '2021-07-05 14:29:54',
                'updated_at' => '2021-07-05 14:31:48',
            ),
            1 => 
            array (
                'id' => 2,
                'brand_id' => 1,
                'sku' => NULL,
            'name' => 'iPhone Xs 256GB Quốc Tế (Đẹp 99%)',
                'slug' => 'iphone-xs-256gb-quoc-te-dep-99',
                'image' => 'https://example.sudospaces.com/core/2021/07/iphone-xs-01-5edf42e0b1e1e-09-06-2020-15-05-52.png',
                'slide' => NULL,
                'price' => 10000000,
                'price_old' => 12000000,
                'detail' => NULL,
                'related_products' => NULL,
                'quantity' => 0,
                'length' => 0,
                'wide' => 0,
                'height' => 0,
                'weight' => 0,
                'tax_id' => NULL,
                'status' => 1,
                'created_at' => '2021-07-05 14:33:21',
                'updated_at' => '2021-07-05 14:33:50',
            ),
            2 => 
            array (
                'id' => 3,
                'brand_id' => 1,
                'sku' => NULL,
            'name' => 'iPhone 11 Pro Max 256GB Quốc Tế (Đẹp 99%)',
                'slug' => 'iphone-11-pro-max-256gb-quoc-te-dep-99',
                'image' => 'https://example.sudospaces.com/core/2021/07/iphone-11-pro-max-den-5edde7f180a10-08-06-2020-14-25-37.png',
                'slide' => NULL,
                'price' => 22000000,
                'price_old' => 25000000,
                'detail' => NULL,
                'related_products' => NULL,
                'quantity' => 0,
                'length' => 0,
                'wide' => 0,
                'height' => 0,
                'weight' => 0,
                'tax_id' => NULL,
                'status' => 1,
                'created_at' => '2021-07-05 14:35:04',
                'updated_at' => '2021-07-05 14:35:39',
            ),
            3 => 
            array (
                'id' => 4,
                'brand_id' => 0,
                'sku' => NULL,
                'name' => 'Áo sơ mi nam',
                'slug' => 'ao-so-mi-nam',
                'image' => 'https://example.sudospaces.com/core/2021/07/ao-so-mi-nam-aristino-als13001-01x500x500x4.jpeg',
                'slide' => NULL,
                'price' => 300000,
                'price_old' => 500000,
                'detail' => NULL,
                'related_products' => NULL,
                'quantity' => 0,
                'length' => 0,
                'wide' => 0,
                'height' => 0,
                'weight' => 0,
                'tax_id' => NULL,
                'status' => 1,
                'created_at' => '2021-07-05 14:36:44',
                'updated_at' => '2021-07-05 14:39:13',
            ),
            4 => 
            array (
                'id' => 5,
                'brand_id' => 0,
                'sku' => NULL,
                'name' => 'Áo sơ mi nữ',
                'slug' => 'ao-so-mi-nu',
                'image' => 'https://example.sudospaces.com/core/2021/07/ao-so-mi-nam-aristino-als13001-01x500x500x4.jpeg',
                'slide' => NULL,
                'price' => 400000,
                'price_old' => 500000,
                'detail' => NULL,
                'related_products' => NULL,
                'quantity' => 0,
                'length' => 0,
                'wide' => 0,
                'height' => 0,
                'weight' => 0,
                'tax_id' => NULL,
                'status' => 1,
                'created_at' => '2021-07-05 14:40:02',
                'updated_at' => '2021-07-05 14:41:08',
            ),
        ));
        
        
    }
}