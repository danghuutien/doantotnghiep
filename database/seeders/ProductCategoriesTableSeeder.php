<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_categories')->delete();
        
        \DB::table('product_categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'parent_id' => 0,
                'name' => 'Điện thoại',
                'slug' => 'dien-thoai',
                'image' => NULL,
                'detail' => NULL,
                'order' => 99999,
                'status' => 1,
                'created_at' => '2021-07-05 14:26:42',
                'updated_at' => '2021-07-05 14:26:42',
            ),
            1 => 
            array (
                'id' => 2,
                'parent_id' => 0,
                'name' => 'Thời trang',
                'slug' => 'thoi-trang',
                'image' => NULL,
                'detail' => NULL,
                'order' => 99999,
                'status' => 1,
                'created_at' => '2021-07-05 14:26:59',
                'updated_at' => '2021-07-05 14:27:06',
            ),
            2 => 
            array (
                'id' => 3,
                'parent_id' => 1,
                'name' => 'iPhone',
                'slug' => 'iphone',
                'image' => NULL,
                'detail' => NULL,
                'order' => 99999,
                'status' => 1,
                'created_at' => '2021-07-05 14:27:21',
                'updated_at' => '2021-07-05 14:27:21',
            ),
            3 => 
            array (
                'id' => 4,
                'parent_id' => 1,
                'name' => 'Samsung',
                'slug' => 'samsung',
                'image' => NULL,
                'detail' => NULL,
                'order' => 99999,
                'status' => 1,
                'created_at' => '2021-07-05 14:27:41',
                'updated_at' => '2021-07-05 14:27:41',
            ),
            4 => 
            array (
                'id' => 5,
                'parent_id' => 2,
                'name' => 'Thời trang nam',
                'slug' => 'thoi-trang-nam',
                'image' => NULL,
                'detail' => NULL,
                'order' => 99999,
                'status' => 1,
                'created_at' => '2021-07-05 14:28:06',
                'updated_at' => '2021-07-05 14:28:06',
            ),
            5 => 
            array (
                'id' => 6,
                'parent_id' => 2,
                'name' => 'Thời trang nữ',
                'slug' => 'thoi-trang-nu',
                'image' => NULL,
                'detail' => NULL,
                'order' => 99999,
                'status' => 1,
                'created_at' => '2021-07-05 14:28:20',
                'updated_at' => '2021-07-05 14:28:20',
            ),
        ));
        
        
    }
}