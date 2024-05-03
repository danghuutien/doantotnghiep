<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SyncLinksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sync_links')->delete();
        
        \DB::table('sync_links')->insert(array (
            0 => 
            array (
                'id' => 1,
                'old' => '/iphone11',
                'new' => '/iphone-11',
                'code' => '301',
                'status' => 1,
            ),
        ));
        
        
    }
}