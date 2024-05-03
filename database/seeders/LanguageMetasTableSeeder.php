<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LanguageMetasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('language_metas')->delete();
        
        \DB::table('language_metas')->insert(array (
            0 => 
            array (
                'lang_table' => 'attributes',
                'lang_table_id' => 1,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b39e7c0c2',
            ),
            1 => 
            array (
                'lang_table' => 'attributes',
                'lang_table_id' => 2,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b3badb815',
            ),
            2 => 
            array (
                'lang_table' => 'attributes',
                'lang_table_id' => 3,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b3d5a3f3a',
            ),
            3 => 
            array (
                'lang_table' => 'brands',
                'lang_table_id' => 1,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b3f365364',
            ),
            4 => 
            array (
                'lang_table' => 'brands',
                'lang_table_id' => 2,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b3ff6cca5',
            ),
            5 => 
            array (
                'lang_table' => 'taxes',
                'lang_table_id' => 1,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b418d23ac',
            ),
            6 => 
            array (
                'lang_table' => 'product_categories',
                'lang_table_id' => 1,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b432aa55a',
            ),
            7 => 
            array (
                'lang_table' => 'product_categories',
                'lang_table_id' => 2,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b4436cbe6',
            ),
            8 => 
            array (
                'lang_table' => 'product_categories',
                'lang_table_id' => 3,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b4596254b',
            ),
            9 => 
            array (
                'lang_table' => 'product_categories',
                'lang_table_id' => 4,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b46dac393',
            ),
            10 => 
            array (
                'lang_table' => 'product_categories',
                'lang_table_id' => 5,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b4861ccbc',
            ),
            11 => 
            array (
                'lang_table' => 'product_categories',
                'lang_table_id' => 6,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b49512634',
            ),
            12 => 
            array (
                'lang_table' => 'products',
                'lang_table_id' => 1,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b4f26fbd7',
            ),
            13 => 
            array (
                'lang_table' => 'products',
                'lang_table_id' => 2,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b5c1f2ff9',
            ),
            14 => 
            array (
                'lang_table' => 'products',
                'lang_table_id' => 3,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b6283d47a',
            ),
            15 => 
            array (
                'lang_table' => 'products',
                'lang_table_id' => 4,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b68d176b7',
            ),
            16 => 
            array (
                'lang_table' => 'products',
                'lang_table_id' => 5,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b75225ebe',
            ),
            17 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 1,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378be7e',
            ),
            18 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 2,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378be9b',
            ),
            19 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 3,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378beaf',
            ),
            20 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 4,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378bec3',
            ),
            21 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 5,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378bed7',
            ),
            22 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 6,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378bee9',
            ),
            23 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 7,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378bef7',
            ),
            24 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 8,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378bf0a',
            ),
            25 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 9,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378bf27',
            ),
            26 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 10,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378bf39',
            ),
            27 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 11,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378bf55',
            ),
            28 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 12,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378bf67',
            ),
            29 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 13,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378bf79',
            ),
            30 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 14,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378bf8a',
            ),
            31 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 15,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378bf9c',
            ),
            32 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 16,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378bfae',
            ),
            33 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 17,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378bfc0',
            ),
            34 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 18,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378bfd3',
            ),
            35 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 19,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378bfe5',
            ),
            36 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 20,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378bff7',
            ),
            37 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 21,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c009',
            ),
            38 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 22,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c01b',
            ),
            39 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 23,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c02d',
            ),
            40 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 24,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c03e',
            ),
            41 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 25,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c050',
            ),
            42 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 26,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c062',
            ),
            43 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 27,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c074',
            ),
            44 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 28,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c086',
            ),
            45 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 29,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c097',
            ),
            46 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 30,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c0aa',
            ),
            47 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 31,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c0bc',
            ),
            48 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 32,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c0ce',
            ),
            49 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 33,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c0e1',
            ),
            50 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 34,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c0f3',
            ),
            51 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 35,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c106',
            ),
            52 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 36,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c117',
            ),
            53 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 37,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c129',
            ),
            54 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 38,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c13b',
            ),
            55 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 39,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c14d',
            ),
            56 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 40,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c15f',
            ),
            57 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 41,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c170',
            ),
            58 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 42,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c182',
            ),
            59 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 43,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c194',
            ),
            60 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 44,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c1a5',
            ),
            61 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 45,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c1b7',
            ),
            62 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 46,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c1c9',
            ),
            63 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 47,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c1db',
            ),
            64 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 48,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c1ec',
            ),
            65 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 49,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c1fe',
            ),
            66 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 50,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c210',
            ),
            67 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 51,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c222',
            ),
            68 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 52,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c234',
            ),
            69 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 53,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c246',
            ),
            70 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 54,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c258',
            ),
            71 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 55,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c26a',
            ),
            72 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 56,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c27b',
            ),
            73 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 57,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c28d',
            ),
            74 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 58,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c29f',
            ),
            75 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 59,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c2b0',
            ),
            76 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 60,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c2cb',
            ),
            77 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 61,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c2de',
            ),
            78 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 62,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c2f0',
            ),
            79 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 63,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c302',
            ),
            80 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 64,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c315',
            ),
            81 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 65,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c328',
            ),
            82 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 66,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c33b',
            ),
            83 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 67,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c34e',
            ),
            84 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 68,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c360',
            ),
            85 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 69,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c372',
            ),
            86 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 70,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c384',
            ),
            87 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 71,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c397',
            ),
            88 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 72,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c3a9',
            ),
            89 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 73,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c3bc',
            ),
            90 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 74,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c3ce',
            ),
            91 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 75,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c3e1',
            ),
            92 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 76,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c3f3',
            ),
            93 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 77,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c405',
            ),
            94 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 78,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c417',
            ),
            95 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 79,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c42a',
            ),
            96 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 80,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c43f',
            ),
            97 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 81,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c451',
            ),
            98 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 82,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c463',
            ),
            99 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 83,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c475',
            ),
            100 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 84,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c487',
            ),
            101 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 85,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c49a',
            ),
            102 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 86,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c4b7',
            ),
            103 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 87,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c4dd',
            ),
            104 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 88,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c4f9',
            ),
            105 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 89,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c516',
            ),
            106 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 90,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c532',
            ),
            107 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 91,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c544',
            ),
            108 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 92,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c556',
            ),
            109 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 93,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c568',
            ),
            110 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 94,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c57b',
            ),
            111 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 95,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c58e',
            ),
            112 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 96,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c5a2',
            ),
            113 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 97,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c5b4',
            ),
            114 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 98,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c5c7',
            ),
            115 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 99,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c5d9',
            ),
            116 => 
            array (
                'lang_table' => 'post_categories',
                'lang_table_id' => 100,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9378c5ec',
            ),
            117 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 2,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d2b6',
            ),
            118 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 3,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d2cf',
            ),
            119 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 4,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d2e4',
            ),
            120 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 5,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d2f4',
            ),
            121 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 6,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d303',
            ),
            122 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 7,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d318',
            ),
            123 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 8,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d32e',
            ),
            124 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 9,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d343',
            ),
            125 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 10,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d35e',
            ),
            126 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 11,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d374',
            ),
            127 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 12,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d384',
            ),
            128 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 13,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d393',
            ),
            129 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 14,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d3a8',
            ),
            130 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 15,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d3bd',
            ),
            131 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 16,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d3d2',
            ),
            132 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 17,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d3e7',
            ),
            133 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 18,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d3fc',
            ),
            134 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 19,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d412',
            ),
            135 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 20,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d427',
            ),
            136 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 21,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d43b',
            ),
            137 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 22,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d450',
            ),
            138 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 23,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d465',
            ),
            139 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 24,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d47a',
            ),
            140 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 25,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d48f',
            ),
            141 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 26,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d4a4',
            ),
            142 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 27,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d4bb',
            ),
            143 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 28,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d4d0',
            ),
            144 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 29,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d4e5',
            ),
            145 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 30,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d4fa',
            ),
            146 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 31,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d50f',
            ),
            147 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 32,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d524',
            ),
            148 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 33,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d539',
            ),
            149 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 34,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d54e',
            ),
            150 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 35,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d564',
            ),
            151 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 36,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d579',
            ),
            152 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 37,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d58d',
            ),
            153 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 38,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d5a2',
            ),
            154 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 39,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d5b7',
            ),
            155 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 40,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d5cc',
            ),
            156 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 41,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d5e0',
            ),
            157 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 42,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d5f5',
            ),
            158 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 43,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d60d',
            ),
            159 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 44,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d621',
            ),
            160 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 45,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d636',
            ),
            161 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 46,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d64b',
            ),
            162 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 47,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d660',
            ),
            163 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 48,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d675',
            ),
            164 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 49,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d68a',
            ),
            165 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 50,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d69e',
            ),
            166 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 51,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d6b3',
            ),
            167 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 52,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d6c8',
            ),
            168 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 53,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d6dd',
            ),
            169 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 54,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d6f2',
            ),
            170 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 55,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d706',
            ),
            171 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 56,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d71b',
            ),
            172 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 57,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d730',
            ),
            173 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 58,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d745',
            ),
            174 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 59,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d75c',
            ),
            175 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 60,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d771',
            ),
            176 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 61,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d786',
            ),
            177 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 62,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d79b',
            ),
            178 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 63,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d7b0',
            ),
            179 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 64,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d7c5',
            ),
            180 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 65,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d7d9',
            ),
            181 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 66,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d7f2',
            ),
            182 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 67,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d808',
            ),
            183 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 68,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d81d',
            ),
            184 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 69,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d832',
            ),
            185 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 70,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d847',
            ),
            186 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 71,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d85d',
            ),
            187 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 72,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d872',
            ),
            188 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 73,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d886',
            ),
            189 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 74,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d89b',
            ),
            190 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 75,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d8b1',
            ),
            191 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 76,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d8c5',
            ),
            192 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 77,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d8da',
            ),
            193 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 78,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d8ef',
            ),
            194 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 79,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d904',
            ),
            195 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 80,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d919',
            ),
            196 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 81,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d92e',
            ),
            197 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 82,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d943',
            ),
            198 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 83,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d958',
            ),
            199 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 84,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d96d',
            ),
            200 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 85,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d981',
            ),
            201 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 86,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d996',
            ),
            202 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 87,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d9ab',
            ),
            203 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 88,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d9c0',
            ),
            204 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 89,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d9d5',
            ),
            205 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 90,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d9ea',
            ),
            206 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 91,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379d9ff',
            ),
            207 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 92,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379da19',
            ),
            208 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 93,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379da2e',
            ),
            209 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 94,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379da43',
            ),
            210 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 95,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379da58',
            ),
            211 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 96,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379da70',
            ),
            212 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 97,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379da86',
            ),
            213 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 98,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379da9c',
            ),
            214 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 99,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379dab1',
            ),
            215 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 100,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379dac6',
            ),
            216 => 
            array (
                'lang_table' => 'posts',
                'lang_table_id' => 101,
                'lang_locale' => 'vi',
                'lang_code' => '60e2b9379dadb',
            ),
            217 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 1,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2bcd25',
            ),
            218 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 2,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2bcd46',
            ),
            219 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 3,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2bcd5c',
            ),
            220 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 4,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2bcd71',
            ),
            221 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 5,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2bcd86',
            ),
            222 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 6,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2bcd9b',
            ),
            223 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 7,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2bcdaf',
            ),
            224 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 8,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2bcdc3',
            ),
            225 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 9,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2bcdd8',
            ),
            226 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 10,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2bcdec',
            ),
            227 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 11,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2bdea0',
            ),
            228 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 12,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2bdeb4',
            ),
            229 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 13,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2bdec7',
            ),
            230 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 14,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2bdedb',
            ),
            231 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 15,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2bdeef',
            ),
            232 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 16,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2bdf03',
            ),
            233 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 17,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2bdf17',
            ),
            234 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 18,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2bdf2b',
            ),
            235 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 19,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2bdf3f',
            ),
            236 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 20,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2bdf53',
            ),
            237 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 21,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2bf4f7',
            ),
            238 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 22,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2bf509',
            ),
            239 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 23,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2bf518',
            ),
            240 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 24,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2bf52c',
            ),
            241 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 25,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2bf540',
            ),
            242 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 26,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2bf554',
            ),
            243 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 27,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2bf567',
            ),
            244 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 28,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2bf57b',
            ),
            245 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 29,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2bf58f',
            ),
            246 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 30,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2bf5a3',
            ),
            247 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 31,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c0f99',
            ),
            248 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 32,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c0faf',
            ),
            249 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 33,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c0fc4',
            ),
            250 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 34,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c0fd9',
            ),
            251 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 35,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c0fe9',
            ),
            252 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 36,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c0ff7',
            ),
            253 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 37,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c1008',
            ),
            254 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 38,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c1016',
            ),
            255 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 39,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c102a',
            ),
            256 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 40,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c103e',
            ),
            257 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 41,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c2353',
            ),
            258 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 42,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c2362',
            ),
            259 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 43,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c236c',
            ),
            260 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 44,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c237b',
            ),
            261 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 45,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c238f',
            ),
            262 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 46,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c23a3',
            ),
            263 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 47,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c23b7',
            ),
            264 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 48,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c23cb',
            ),
            265 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 49,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c23df',
            ),
            266 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 50,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c23f3',
            ),
            267 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 51,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c379c',
            ),
            268 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 52,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c37ae',
            ),
            269 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 53,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c37bf',
            ),
            270 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 54,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c37cd',
            ),
            271 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 55,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c37e1',
            ),
            272 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 56,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c37f5',
            ),
            273 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 57,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c3809',
            ),
            274 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 58,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c381c',
            ),
            275 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 59,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c3830',
            ),
            276 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 60,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c3844',
            ),
            277 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 61,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c4b1a',
            ),
            278 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 62,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c4b2c',
            ),
            279 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 63,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c4b3b',
            ),
            280 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 64,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c4b50',
            ),
            281 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 65,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c4b64',
            ),
            282 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 66,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c4b78',
            ),
            283 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 67,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c4b8c',
            ),
            284 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 68,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c4b9f',
            ),
            285 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 69,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c4bb3',
            ),
            286 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 70,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c4bc7',
            ),
            287 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 71,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c6387',
            ),
            288 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 72,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c6398',
            ),
            289 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 73,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c63a1',
            ),
            290 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 74,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c63af',
            ),
            291 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 75,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c63c3',
            ),
            292 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 76,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c63d7',
            ),
            293 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 77,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c63eb',
            ),
            294 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 78,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c63fe',
            ),
            295 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 79,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c6412',
            ),
            296 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 80,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c642d',
            ),
            297 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 81,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c7a5d',
            ),
            298 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 82,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c7a70',
            ),
            299 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 83,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c7a84',
            ),
            300 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 84,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c7a96',
            ),
            301 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 85,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c7aa4',
            ),
            302 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 86,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c7ab8',
            ),
            303 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 87,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c7acc',
            ),
            304 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 88,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c7ae0',
            ),
            305 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 89,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c7af4',
            ),
            306 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 90,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c7b08',
            ),
            307 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 91,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c8d27',
            ),
            308 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 92,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c8d37',
            ),
            309 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 93,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c8d40',
            ),
            310 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 94,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c8d4c',
            ),
            311 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 95,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c8d55',
            ),
            312 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 96,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c8d67',
            ),
            313 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 97,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c8d75',
            ),
            314 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 98,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c8d89',
            ),
            315 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 99,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c8d9e',
            ),
            316 => 
            array (
                'lang_table' => 'pages',
                'lang_table_id' => 100,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bbd2c8db2',
            ),
            317 => 
            array (
                'lang_table' => 'sync_links',
                'lang_table_id' => 1,
                'lang_locale' => 'vi',
                'lang_code' => '60e2bcd5be663',
            ),
        ));
        
        
    }
}