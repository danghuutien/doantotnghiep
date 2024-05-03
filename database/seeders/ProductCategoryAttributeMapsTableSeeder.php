<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductCategoryAttributeMapsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_category_attribute_maps')->delete();
        
        \DB::table('product_category_attribute_maps')->insert(array (
            0 => 
            array (
                'product_category_id' => 1,
                'attribute_id' => 1,
            ),
            1 => 
            array (
                'product_category_id' => 1,
                'attribute_id' => 3,
            ),
            2 => 
            array (
                'product_category_id' => 2,
                'attribute_id' => 1,
            ),
            3 => 
            array (
                'product_category_id' => 2,
                'attribute_id' => 2,
            ),
            4 => 
            array (
                'product_category_id' => 3,
                'attribute_id' => 1,
            ),
            5 => 
            array (
                'product_category_id' => 3,
                'attribute_id' => 3,
            ),
            6 => 
            array (
                'product_category_id' => 4,
                'attribute_id' => 1,
            ),
            7 => 
            array (
                'product_category_id' => 4,
                'attribute_id' => 3,
            ),
            8 => 
            array (
                'product_category_id' => 5,
                'attribute_id' => 1,
            ),
            9 => 
            array (
                'product_category_id' => 5,
                'attribute_id' => 2,
            ),
            10 => 
            array (
                'product_category_id' => 6,
                'attribute_id' => 1,
            ),
            11 => 
            array (
                'product_category_id' => 6,
                'attribute_id' => 3,
            ),
        ));
        
        
    }
}