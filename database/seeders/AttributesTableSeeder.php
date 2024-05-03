<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AttributesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('attributes')->delete();
        
        \DB::table('attributes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Màu',
                'slug' => 'mau',
                'display_layout' => 'text',
                'is_searchable' => 1,
                'order' => 99999,
                'status' => 1,
                'created_at' => '2021-07-05 14:24:14',
                'updated_at' => '2021-07-05 14:24:14',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Size',
                'slug' => 'size',
                'display_layout' => 'text',
                'is_searchable' => 1,
                'order' => 99999,
                'status' => 1,
                'created_at' => '2021-07-05 14:24:42',
                'updated_at' => '2021-07-05 14:24:42',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Ram',
                'slug' => 'ram',
                'display_layout' => 'text',
                'is_searchable' => 1,
                'order' => 99999,
                'status' => 1,
                'created_at' => '2021-07-05 14:25:09',
                'updated_at' => '2021-07-05 14:25:09',
            ),
        ));
        
        
    }
}