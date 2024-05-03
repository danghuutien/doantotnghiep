<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrderHistoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('order_histories')->delete();
        
        \DB::table('order_histories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'order_id' => 1,
                'admin_user_id' => 1,
                'type' => 'admin_create',
                'data' => NULL,
                'time' => '2021-07-05 14:43:07',
            ),
            1 => 
            array (
                'id' => 2,
                'order_id' => 2,
                'admin_user_id' => 1,
                'type' => 'admin_create',
                'data' => NULL,
                'time' => '2021-07-05 14:46:01',
            ),
            2 => 
            array (
                'id' => 3,
                'order_id' => 1,
                'admin_user_id' => 1,
                'type' => 'received',
                'data' => NULL,
                'time' => '2021-07-05 14:46:22',
            ),
            3 => 
            array (
                'id' => 4,
                'order_id' => 1,
                'admin_user_id' => 1,
                'type' => 'comfirm_payment',
                'data' => NULL,
                'time' => '2021-07-05 14:46:25',
            ),
            4 => 
            array (
                'id' => 5,
                'order_id' => 1,
                'admin_user_id' => 1,
                'type' => 'order_success',
                'data' => NULL,
                'time' => '2021-07-05 14:46:29',
            ),
            5 => 
            array (
                'id' => 6,
                'order_id' => 3,
                'admin_user_id' => 1,
                'type' => 'admin_create',
                'data' => NULL,
                'time' => '2021-07-05 14:47:07',
            ),
            6 => 
            array (
                'id' => 7,
                'order_id' => 3,
                'admin_user_id' => 1,
                'type' => 'received',
                'data' => NULL,
                'time' => '2021-07-05 14:47:12',
            ),
            7 => 
            array (
                'id' => 8,
                'order_id' => 3,
                'admin_user_id' => 1,
                'type' => 'comfirm_payment',
                'data' => NULL,
                'time' => '2021-07-05 14:47:16',
            ),
        ));
        
        
    }
}