<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AttributeVariantMapsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('attribute_variant_maps')->delete();
        
        \DB::table('attribute_variant_maps')->insert(array (
            0 => 
            array (
                'product_id' => 1,
                'attribute_id' => 1,
                'attribute_detail_id' => 1,
                'variant_id' => 1,
            ),
            1 => 
            array (
                'product_id' => 1,
                'attribute_id' => 3,
                'attribute_detail_id' => 9,
                'variant_id' => 1,
            ),
            2 => 
            array (
                'product_id' => 2,
                'attribute_id' => 1,
                'attribute_detail_id' => 1,
                'variant_id' => 2,
            ),
            3 => 
            array (
                'product_id' => 2,
                'attribute_id' => 3,
                'attribute_detail_id' => 9,
                'variant_id' => 2,
            ),
            4 => 
            array (
                'product_id' => 3,
                'attribute_id' => 1,
                'attribute_detail_id' => 1,
                'variant_id' => 3,
            ),
            5 => 
            array (
                'product_id' => 3,
                'attribute_id' => 3,
                'attribute_detail_id' => 9,
                'variant_id' => 3,
            ),
            6 => 
            array (
                'product_id' => 4,
                'attribute_id' => 1,
                'attribute_detail_id' => 1,
                'variant_id' => 4,
            ),
            7 => 
            array (
                'product_id' => 4,
                'attribute_id' => 2,
                'attribute_detail_id' => 5,
                'variant_id' => 4,
            ),
            8 => 
            array (
                'product_id' => 4,
                'attribute_id' => 1,
                'attribute_detail_id' => 2,
                'variant_id' => 5,
            ),
            9 => 
            array (
                'product_id' => 4,
                'attribute_id' => 2,
                'attribute_detail_id' => 5,
                'variant_id' => 5,
            ),
            10 => 
            array (
                'product_id' => 4,
                'attribute_id' => 1,
                'attribute_detail_id' => 1,
                'variant_id' => 6,
            ),
            11 => 
            array (
                'product_id' => 4,
                'attribute_id' => 2,
                'attribute_detail_id' => 6,
                'variant_id' => 6,
            ),
            12 => 
            array (
                'product_id' => 4,
                'attribute_id' => 1,
                'attribute_detail_id' => 2,
                'variant_id' => 7,
            ),
            13 => 
            array (
                'product_id' => 4,
                'attribute_id' => 2,
                'attribute_detail_id' => 6,
                'variant_id' => 7,
            ),
            14 => 
            array (
                'product_id' => 5,
                'attribute_id' => 1,
                'attribute_detail_id' => 1,
                'variant_id' => 8,
            ),
            15 => 
            array (
                'product_id' => 5,
                'attribute_id' => 2,
                'attribute_detail_id' => 5,
                'variant_id' => 8,
            ),
            16 => 
            array (
                'product_id' => 5,
                'attribute_id' => 1,
                'attribute_detail_id' => 1,
                'variant_id' => 9,
            ),
            17 => 
            array (
                'product_id' => 5,
                'attribute_id' => 2,
                'attribute_detail_id' => 6,
                'variant_id' => 9,
            ),
            18 => 
            array (
                'product_id' => 5,
                'attribute_id' => 1,
                'attribute_detail_id' => 1,
                'variant_id' => 10,
            ),
            19 => 
            array (
                'product_id' => 5,
                'attribute_id' => 2,
                'attribute_detail_id' => 8,
                'variant_id' => 10,
            ),
            20 => 
            array (
                'product_id' => 5,
                'attribute_id' => 1,
                'attribute_detail_id' => 2,
                'variant_id' => 11,
            ),
            21 => 
            array (
                'product_id' => 5,
                'attribute_id' => 2,
                'attribute_detail_id' => 5,
                'variant_id' => 11,
            ),
        ));
        
        
    }
}