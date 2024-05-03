<?php
return [
    'domain' => env('APP_URL', 'http://localhost'),
    'page_size' => 200,//số lượng link mỗi trang
    'sitemap' => [
        [
            'table' => 'post_categories',//tên bảng
            'model' => 'Sudo\Theme\Models\PostCategory',//tên kèm namespace model
            'changefreq' => 'daily',//tần xuất thay đổi nội dung: always,hourly,daily,weekly,monthly,yearly,never
            'priority' => '0.5',//độ ưu tiên 0.0 đến 1.0
        ],
        [
            'table' => 'posts',
            'model' => 'Sudo\Theme\Models\Post',
            'changefreq' => 'weekly',
            'priority' => '0.8',
        ],
    ],
];
