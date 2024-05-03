<?php
return [
    'domain' => env('APP_URL', 'http://localhost'),
    'title' => 'TOSHIKO VIỆT NAM',//Tiêu đề trang chính
    'generator' => 'Toshiko',//generator
    'rss' => [
        [
            'model' => 'Sudo\Post\Models\Post',//tên kèm namespace model
            'name_field' => 'name',//tên trường tiêu đề của bảng
            'summary_field' => 'detail',//tên trường mô tả của bảng
            'limit' => 20,//số lượng row lấy ra rss
        ],
        [
            'model' => 'Sudo\Post\Models\PostCategory',
            'name_field' => 'name',
            'summary_field' => 'detail',
            'limit' => 20,
        ],   
        [
            'model' => 'Sudo\Ecommerce\Models\Product',
            'name_field' => 'name',
            'summary_field' => 'detail',
            'limit' => 20,
        ],     
        [
            'model' => 'Sudo\Ecommerce\Models\ProductCategory',
            'name_field' => 'name',
            'summary_field' => 'detail',
            'limit' => 20,
        ],
    ],
];
