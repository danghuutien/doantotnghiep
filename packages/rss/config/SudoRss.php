<?php
return [
    'domain' => env('APP_URL', 'http://localhost'),
    'title' => 'Công ty Thương mại điện tử Sudo',//Tiêu đề trang chính
    'generator' => 'Sudo Ecommerce',//generator
    'rss' => [
        [
            'model' => 'Sudo\Theme\Models\Post',//tên kèm namespace model
            'name_field' => 'name',//tên trường tiêu đề của bảng
            'summary_field' => 'detail',//tên trường mô tả của bảng
            'limit' => 20,//số lượng row lấy ra rss
        ],
    ],
];
