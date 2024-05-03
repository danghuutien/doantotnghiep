<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AttributeDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('attribute_details')->delete();
        
        \DB::table('attribute_details')->insert(array (
            0 => 
            array (
                'id' => 1,
                'attribute_id' => 1,
                'name' => 'Đen',
                'slug' => 'den',
                'color_code' => '#000000',
                'image' => '',
                'order' => 99999,
                'created_at' => '2021-07-05 14:24:14',
                'updated_at' => '2021-07-05 14:24:14',
            ),
            1 => 
            array (
                'id' => 2,
                'attribute_id' => 1,
                'name' => 'Trắng',
                'slug' => 'trang',
                'color_code' => '#000000',
                'image' => '',
                'order' => 99999,
                'created_at' => '2021-07-05 14:24:14',
                'updated_at' => '2021-07-05 14:24:14',
            ),
            2 => 
            array (
                'id' => 3,
                'attribute_id' => 1,
                'name' => 'Xanh',
                'slug' => 'xanh',
                'color_code' => '#000000',
                'image' => '',
                'order' => 99999,
                'created_at' => '2021-07-05 14:24:14',
                'updated_at' => '2021-07-05 14:24:14',
            ),
            3 => 
            array (
                'id' => 4,
                'attribute_id' => 1,
                'name' => 'Đỏ',
                'slug' => 'do',
                'color_code' => '#000000',
                'image' => '',
                'order' => 99999,
                'created_at' => '2021-07-05 14:24:14',
                'updated_at' => '2021-07-05 14:24:14',
            ),
            4 => 
            array (
                'id' => 5,
                'attribute_id' => 2,
                'name' => 'S',
                'slug' => 's',
                'color_code' => '#000000',
                'image' => '',
                'order' => 99999,
                'created_at' => '2021-07-05 14:24:42',
                'updated_at' => '2021-07-05 14:24:42',
            ),
            5 => 
            array (
                'id' => 6,
                'attribute_id' => 2,
                'name' => 'M',
                'slug' => 'm',
                'color_code' => '#000000',
                'image' => '',
                'order' => 99999,
                'created_at' => '2021-07-05 14:24:42',
                'updated_at' => '2021-07-05 14:24:42',
            ),
            6 => 
            array (
                'id' => 7,
                'attribute_id' => 2,
                'name' => 'L',
                'slug' => 'l',
                'color_code' => '#000000',
                'image' => '',
                'order' => 99999,
                'created_at' => '2021-07-05 14:24:42',
                'updated_at' => '2021-07-05 14:24:42',
            ),
            7 => 
            array (
                'id' => 8,
                'attribute_id' => 2,
                'name' => 'XL',
                'slug' => 'xl',
                'color_code' => '#000000',
                'image' => '',
                'order' => 99999,
                'created_at' => '2021-07-05 14:24:42',
                'updated_at' => '2021-07-05 14:24:42',
            ),
            8 => 
            array (
                'id' => 9,
                'attribute_id' => 3,
                'name' => '4GB',
                'slug' => '4gb',
                'color_code' => '#000000',
                'image' => '',
                'order' => 99999,
                'created_at' => '2021-07-05 14:25:09',
                'updated_at' => '2021-07-05 14:25:09',
            ),
            9 => 
            array (
                'id' => 10,
                'attribute_id' => 3,
                'name' => '8GB',
                'slug' => '8gb',
                'color_code' => '#000000',
                'image' => '',
                'order' => 99999,
                'created_at' => '2021-07-05 14:25:09',
                'updated_at' => '2021-07-05 14:25:09',
            ),
            10 => 
            array (
                'id' => 11,
                'attribute_id' => 3,
                'name' => '16GB',
                'slug' => '16gb',
                'color_code' => '#000000',
                'image' => '',
                'order' => 99999,
                'created_at' => '2021-07-05 14:25:09',
                'updated_at' => '2021-07-05 14:25:09',
            ),
            11 => 
            array (
                'id' => 12,
                'attribute_id' => 3,
                'name' => '32GB',
                'slug' => '32gb',
                'color_code' => '#000000',
                'image' => '',
                'order' => 99999,
                'created_at' => '2021-07-05 14:25:09',
                'updated_at' => '2021-07-05 14:25:09',
            ),
        ));
        
        
    }
}