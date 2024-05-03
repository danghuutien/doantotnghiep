<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('settings')->delete();
        
        \DB::table('settings')->insert(array (
            0 => 
            array (
                'key' => 'sudo',
                'locale' => NULL,
                'value' => '1de84fad74d60069d3cff841dfa01386',
            ),
            1 => 
            array (
                'key' => 'overview',
                'locale' => 'vi',
                'value' => 'eyJuYW1lX2NvbXBhbnkiOiJTdWRvIEVjb21tZXJjZSIsImRvbWFpbiI6Imh0dHBzOlwvXC9zdWRvLnZuIiwiYWRkcmVzcyI6Ijg4IE5ndXlcdTFlYzVuIFBob25nIFNcdTFlYWZjIiwibmF0aW9uIjoiMSIsInppcF9jb2RlIjpudWxsLCJlbWFpbCI6ImluZm9Ac3Vkby52biIsInBob25lIjpudWxsLCJob3RsaW5lIjoiMDk4OTAyMjAyMiJ9',
            ),
        ));
        
        
    }
}