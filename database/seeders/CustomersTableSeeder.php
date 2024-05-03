<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('customers')->delete();
        
        \DB::table('customers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Sudo',
                'phone' => '0989022022',
                'email' => 'info@sudo.vn',
                'address' => '99 Nguyễn Phong Sắc',
                'status' => 1,
                'created_at' => '2021-07-05 14:43:07',
                'updated_at' => '2021-07-05 14:47:07',
            ),
        ));
        
        
    }
}