<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VariantsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('variants')->delete();
        
        \DB::table('variants')->insert(array (
            0 => 
            array (
                'id' => 1,
                'product_id' => 1,
                'sku' => NULL,
                'price' => 19000000,
                'price_old' => 23000000,
                'image' => 'https://example.sudospaces.com/core/2021/07/iphone-11-pro-max-tra-ng-5ece24ff5f135-27-05-2020-15-29-51-5ef715ada36f8-27-06-2020-16-47-25-2.png',
                'quantity' => NULL,
                'length' => 0,
                'wide' => 0,
                'height' => 0,
                'weight' => 0,
                'created_at' => NULL,
                'updated_at' => '2021-07-05 14:31:44',
            ),
            1 => 
            array (
                'id' => 2,
                'product_id' => 2,
                'sku' => NULL,
                'price' => 11000000,
                'price_old' => 13000000,
                'image' => 'https://example.sudospaces.com/core/2021/07/iphone-xs-01-5edf42e0b1e1e-09-06-2020-15-05-52.png',
                'quantity' => NULL,
                'length' => 0,
                'wide' => 0,
                'height' => 0,
                'weight' => 0,
                'created_at' => NULL,
                'updated_at' => '2021-07-05 14:33:46',
            ),
            2 => 
            array (
                'id' => 3,
                'product_id' => 3,
                'sku' => NULL,
                'price' => 23000000,
                'price_old' => 30000000,
                'image' => 'https://example.sudospaces.com/core/2021/07/iphone-11-pro-max-den-5edde7f180a10-08-06-2020-14-25-37.png',
                'quantity' => NULL,
                'length' => 0,
                'wide' => 0,
                'height' => 0,
                'weight' => 0,
                'created_at' => NULL,
                'updated_at' => '2021-07-05 14:35:26',
            ),
            3 => 
            array (
                'id' => 4,
                'product_id' => 4,
                'sku' => NULL,
                'price' => 0,
                'price_old' => 0,
                'image' => 'https://example.sudospaces.com/core/2021/07/ao-so-mi-nam-aristino-als13001-01x500x500x4.jpeg',
                'quantity' => NULL,
                'length' => 0,
                'wide' => 0,
                'height' => 0,
                'weight' => 0,
                'created_at' => NULL,
                'updated_at' => '2021-07-05 14:39:10',
            ),
            4 => 
            array (
                'id' => 5,
                'product_id' => 4,
                'sku' => NULL,
                'price' => 250000,
                'price_old' => 550000,
                'image' => NULL,
                'quantity' => NULL,
                'length' => 0,
                'wide' => 0,
                'height' => 0,
                'weight' => 0,
                'created_at' => '2021-07-05 14:37:11',
                'updated_at' => '2021-07-05 14:37:11',
            ),
            5 => 
            array (
                'id' => 6,
                'product_id' => 4,
                'sku' => NULL,
                'price' => 0,
                'price_old' => 0,
                'image' => NULL,
                'quantity' => NULL,
                'length' => 0,
                'wide' => 0,
                'height' => 0,
                'weight' => 0,
                'created_at' => '2021-07-05 14:37:21',
                'updated_at' => '2021-07-05 14:37:21',
            ),
            6 => 
            array (
                'id' => 7,
                'product_id' => 4,
                'sku' => NULL,
                'price' => 0,
                'price_old' => 0,
                'image' => NULL,
                'quantity' => NULL,
                'length' => 0,
                'wide' => 0,
                'height' => 0,
                'weight' => 0,
                'created_at' => '2021-07-05 14:37:29',
                'updated_at' => '2021-07-05 14:37:29',
            ),
            7 => 
            array (
                'id' => 8,
                'product_id' => 5,
                'sku' => NULL,
                'price' => 250000,
                'price_old' => 0,
                'image' => NULL,
                'quantity' => NULL,
                'length' => 0,
                'wide' => 0,
                'height' => 0,
                'weight' => 0,
                'created_at' => NULL,
                'updated_at' => '2021-07-05 14:41:05',
            ),
            8 => 
            array (
                'id' => 9,
                'product_id' => 5,
                'sku' => NULL,
                'price' => 300000,
                'price_old' => 0,
                'image' => NULL,
                'quantity' => NULL,
                'length' => 0,
                'wide' => 0,
                'height' => 0,
                'weight' => 0,
                'created_at' => '2021-07-05 14:40:22',
                'updated_at' => '2021-07-05 14:40:59',
            ),
            9 => 
            array (
                'id' => 10,
                'product_id' => 5,
                'sku' => NULL,
                'price' => 300000,
                'price_old' => 0,
                'image' => NULL,
                'quantity' => NULL,
                'length' => 0,
                'wide' => 0,
                'height' => 0,
                'weight' => 0,
                'created_at' => '2021-07-05 14:40:34',
                'updated_at' => '2021-07-05 14:40:34',
            ),
            10 => 
            array (
                'id' => 11,
                'product_id' => 5,
                'sku' => NULL,
                'price' => 250000,
                'price_old' => 0,
                'image' => NULL,
                'quantity' => NULL,
                'length' => 0,
                'wide' => 0,
                'height' => 0,
                'weight' => 0,
                'created_at' => '2021-07-05 14:40:44',
                'updated_at' => '2021-07-05 14:40:44',
            ),
        ));
        
        
    }
}