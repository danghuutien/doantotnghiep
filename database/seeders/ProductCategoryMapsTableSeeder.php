<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductCategoryMapsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_category_maps')->delete();
        
        \DB::table('product_category_maps')->insert(array (
            0 => 
            array (
                'product_id' => 1,
                'product_category_id' => 1,
            ),
            1 => 
            array (
                'product_id' => 1,
                'product_category_id' => 3,
            ),
            2 => 
            array (
                'product_id' => 2,
                'product_category_id' => 1,
            ),
            3 => 
            array (
                'product_id' => 2,
                'product_category_id' => 3,
            ),
            4 => 
            array (
                'product_id' => 3,
                'product_category_id' => 1,
            ),
            5 => 
            array (
                'product_id' => 3,
                'product_category_id' => 3,
            ),
            6 => 
            array (
                'product_id' => 4,
                'product_category_id' => 2,
            ),
            7 => 
            array (
                'product_id' => 4,
                'product_category_id' => 5,
            ),
            8 => 
            array (
                'product_id' => 5,
                'product_category_id' => 2,
            ),
            9 => 
            array (
                'product_id' => 5,
                'product_category_id' => 6,
            ),
        ));
        
        
    }
}