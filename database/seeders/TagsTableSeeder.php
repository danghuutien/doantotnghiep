<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tags')->delete();
        
        \DB::table('tags')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'iPhone',
                'slug' => 'iphone',
                'image' => NULL,
                'detail' => NULL,
                'status' => 1,
                'created_at' => '2021-07-05 15:02:35',
                'updated_at' => '2021-07-05 15:02:35',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'iPhone 11',
                'slug' => 'iphone-11',
                'image' => NULL,
                'detail' => NULL,
                'status' => 1,
                'created_at' => '2021-07-05 15:02:58',
                'updated_at' => '2021-07-05 15:02:58',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'iPhone 12',
                'slug' => 'iphone-12',
                'image' => NULL,
                'detail' => NULL,
                'status' => 1,
                'created_at' => '2021-07-05 15:03:08',
                'updated_at' => '2021-07-05 15:03:08',
            ),
        ));
        
        
    }
}