<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MediasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('medias')->delete();
        
        \DB::table('medias')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'name' => 'iphone-11-pro-max-tra-ng-5ece24ff5f135-27-05-2020-15-29-51-5ef715ada36f8-27-06-2020-16-47-25-2.png',
                'size' => 386735,
                'type' => 'image',
                'title' => '',
                'caption' => '',
                'extention' => 'png',
                'status' => 1,
                'created_at' => '2021-07-05 14:30:40',
                'updated_at' => '2021-07-05 14:30:40',
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 1,
                'name' => 'iphone-xs-01-5edf42e0b1e1e-09-06-2020-15-05-52.png',
                'size' => 298949,
                'type' => 'image',
                'title' => '',
                'caption' => '',
                'extention' => 'png',
                'status' => 1,
                'created_at' => '2021-07-05 14:33:11',
                'updated_at' => '2021-07-05 14:33:11',
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 1,
                'name' => 'iphone-11-pro-max-den-5edde7f180a10-08-06-2020-14-25-37.png',
                'size' => 304180,
                'type' => 'image',
                'title' => '',
                'caption' => '',
                'extention' => 'png',
                'status' => 1,
                'created_at' => '2021-07-05 14:34:56',
                'updated_at' => '2021-07-05 14:34:56',
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 1,
                'name' => 'ao-so-mi-nam-aristino-als13001-01x500x500x4.jpeg',
                'size' => 133684,
                'type' => 'image',
                'title' => '',
                'caption' => '',
                'extention' => 'jpeg',
                'status' => 1,
                'created_at' => '2021-07-05 14:39:03',
                'updated_at' => '2021-07-05 14:39:03',
            ),
        ));
        
        
    }
}