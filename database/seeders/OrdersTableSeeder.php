<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('orders')->delete();
        
        \DB::table('orders')->insert(array (
            0 => 
            array (
                'id' => 1,
                'customer_id' => 1,
                'code' => 'CORE_211',
                'total_price' => 1050000,
                'note' => 'Sudo test đơn hàng',
                'payment_method' => 1,
                'payment_status' => 1,
                'status' => 4,
                'refund_money' => 0,
                'refund_reason' => NULL,
                'created_at' => '2021-07-05 14:43:07',
                'updated_at' => '2021-07-05 14:46:29',
            ),
            1 => 
            array (
                'id' => 2,
                'customer_id' => 1,
                'code' => 'CORE_212',
                'total_price' => 53000000,
                'note' => 'Sudo test đơn hàng',
                'payment_method' => 2,
                'payment_status' => 0,
                'status' => 1,
                'refund_money' => 0,
                'refund_reason' => NULL,
                'created_at' => '2021-07-05 14:46:01',
                'updated_at' => '2021-07-05 14:46:01',
            ),
            2 => 
            array (
                'id' => 3,
                'customer_id' => 1,
                'code' => 'CORE_213',
                'total_price' => 35100000,
                'note' => 'Sudo test',
                'payment_method' => 3,
                'payment_status' => 1,
                'status' => 2,
                'refund_money' => 0,
                'refund_reason' => NULL,
                'created_at' => '2021-07-05 14:47:07',
                'updated_at' => '2021-07-05 14:47:16',
            ),
        ));
        
        
    }
}