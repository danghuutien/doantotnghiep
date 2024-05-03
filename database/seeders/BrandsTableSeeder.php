<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('brands')->delete();
        
        \DB::table('brands')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Apple',
                'slug' => 'apple',
                'image' => NULL,
                'detail' => NULL,
                'status' => 1,
                'created_at' => '2021-07-05 14:25:39',
                'updated_at' => '2021-07-05 14:25:39',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Samsung',
                'slug' => 'samsung',
                'image' => NULL,
                'detail' => NULL,
                'status' => 1,
                'created_at' => '2021-07-05 14:25:51',
                'updated_at' => '2021-07-05 14:25:59',
            ),
        ));
        
        
    }
}