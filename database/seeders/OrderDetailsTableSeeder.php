<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrderDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('order_details')->delete();
        
        \DB::table('order_details')->insert(array (
            0 => 
            array (
                'id' => 1,
                'order_id' => 1,
                'product_id' => 4,
                'price' => 250000,
                'quantity' => 1,
                'variant_id' => 6,
                'variant_text' => '{"attibute":["M\\u00e0u: \\u0110en","Size: M"],"name":"\\u00c1o s\\u01a1 mi nam","image":"","price":0}',
            ),
            1 => 
            array (
                'id' => 2,
                'order_id' => 1,
                'product_id' => 4,
                'price' => 250000,
                'quantity' => 1,
                'variant_id' => 7,
                'variant_text' => '{"attibute":["M\\u00e0u: Tr\\u1eafng","Size: M"],"name":"\\u00c1o s\\u01a1 mi nam","image":"","price":0}',
            ),
            2 => 
            array (
                'id' => 3,
                'order_id' => 1,
                'product_id' => 4,
                'price' => 300000,
                'quantity' => 1,
                'variant_id' => 4,
                'variant_text' => '{"attibute":["M\\u00e0u: \\u0110en","Size: S"],"name":"\\u00c1o s\\u01a1 mi nam","image":"https:\\/\\/example.sudospaces.com\\/core\\/2021\\/07\\/ao-so-mi-nam-aristino-als13001-01x500x500x4.jpeg","price":0}',
            ),
            3 => 
            array (
                'id' => 4,
                'order_id' => 1,
                'product_id' => 4,
                'price' => 250000,
                'quantity' => 1,
                'variant_id' => 5,
                'variant_text' => '{"attibute":["M\\u00e0u: Tr\\u1eafng","Size: S"],"name":"\\u00c1o s\\u01a1 mi nam","image":"","price":250000}',
            ),
            4 => 
            array (
                'id' => 5,
                'order_id' => 2,
                'product_id' => 3,
                'price' => 23000000,
                'quantity' => 1,
                'variant_id' => 3,
            'variant_text' => '{"attibute":["M\\u00e0u: \\u0110en","Ram: 4GB"],"name":"iPhone 11 Pro Max 256GB Qu\\u1ed1c T\\u1ebf (\\u0110\\u1eb9p 99%)","image":"https:\\/\\/example.sudospaces.com\\/core\\/2021\\/07\\/iphone-11-pro-max-den-5edde7f180a10-08-06-2020-14-25-37.png","price":23000000}',
            ),
            5 => 
            array (
                'id' => 6,
                'order_id' => 2,
                'product_id' => 2,
                'price' => 11000000,
                'quantity' => 1,
                'variant_id' => 2,
            'variant_text' => '{"attibute":["M\\u00e0u: \\u0110en","Ram: 4GB"],"name":"iPhone Xs 256GB Qu\\u1ed1c T\\u1ebf (\\u0110\\u1eb9p 99%)","image":"https:\\/\\/example.sudospaces.com\\/core\\/2021\\/07\\/iphone-xs-01-5edf42e0b1e1e-09-06-2020-15-05-52.png","price":11000000}',
            ),
            6 => 
            array (
                'id' => 7,
                'order_id' => 2,
                'product_id' => 1,
                'price' => 19000000,
                'quantity' => 1,
                'variant_id' => 1,
                'variant_text' => '{"attibute":["M\\u00e0u: \\u0110en","Ram: 4GB"],"name":"iPhone 11 Pro Max 64GB Qu\\u1ed1c T\\u1ebf","image":"https:\\/\\/example.sudospaces.com\\/core\\/2021\\/07\\/iphone-11-pro-max-tra-ng-5ece24ff5f135-27-05-2020-15-29-51-5ef715ada36f8-27-06-2020-16-47-25-2.png","price":19000000}',
            ),
            7 => 
            array (
                'id' => 8,
                'order_id' => 3,
                'product_id' => 3,
                'price' => 23000000,
                'quantity' => 1,
                'variant_id' => 3,
            'variant_text' => '{"attibute":["M\\u00e0u: \\u0110en","Ram: 4GB"],"name":"iPhone 11 Pro Max 256GB Qu\\u1ed1c T\\u1ebf (\\u0110\\u1eb9p 99%)","image":"https:\\/\\/example.sudospaces.com\\/core\\/2021\\/07\\/iphone-11-pro-max-den-5edde7f180a10-08-06-2020-14-25-37.png","price":23000000}',
            ),
            8 => 
            array (
                'id' => 9,
                'order_id' => 3,
                'product_id' => 2,
                'price' => 11000000,
                'quantity' => 1,
                'variant_id' => 2,
            'variant_text' => '{"attibute":["M\\u00e0u: \\u0110en","Ram: 4GB"],"name":"iPhone Xs 256GB Qu\\u1ed1c T\\u1ebf (\\u0110\\u1eb9p 99%)","image":"https:\\/\\/example.sudospaces.com\\/core\\/2021\\/07\\/iphone-xs-01-5edf42e0b1e1e-09-06-2020-15-05-52.png","price":11000000}',
            ),
            9 => 
            array (
                'id' => 10,
                'order_id' => 3,
                'product_id' => 5,
                'price' => 250000,
                'quantity' => 1,
                'variant_id' => 8,
                'variant_text' => '{"attibute":["M\\u00e0u: \\u0110en","Size: S"],"name":"\\u00c1o s\\u01a1 mi n\\u1eef","image":"","price":250000}',
            ),
            10 => 
            array (
                'id' => 11,
                'order_id' => 3,
                'product_id' => 5,
                'price' => 300000,
                'quantity' => 1,
                'variant_id' => 9,
                'variant_text' => '{"attibute":["M\\u00e0u: \\u0110en","Size: M"],"name":"\\u00c1o s\\u01a1 mi n\\u1eef","image":"","price":300000}',
            ),
            11 => 
            array (
                'id' => 12,
                'order_id' => 3,
                'product_id' => 5,
                'price' => 300000,
                'quantity' => 1,
                'variant_id' => 10,
                'variant_text' => '{"attibute":["M\\u00e0u: \\u0110en","Size: XL"],"name":"\\u00c1o s\\u01a1 mi n\\u1eef","image":"","price":300000}',
            ),
            12 => 
            array (
                'id' => 13,
                'order_id' => 3,
                'product_id' => 5,
                'price' => 250000,
                'quantity' => 1,
                'variant_id' => 11,
                'variant_text' => '{"attibute":["M\\u00e0u: Tr\\u1eafng","Size: S"],"name":"\\u00c1o s\\u01a1 mi n\\u1eef","image":"","price":250000}',
            ),
        ));
        
        
    }
}