<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TaxesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('taxes')->delete();
        
        \DB::table('taxes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'VAT',
                'percentage' => 10,
                'priority' => 1,
                'status' => 1,
                'created_at' => '2021-07-05 14:26:16',
                'updated_at' => '2021-07-05 14:26:16',
            ),
        ));
        
        
    }
}