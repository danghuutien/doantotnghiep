<?php
return [
    'domain' => env('APP_URL', 'http://localhost'),
    'page_size' => 200,//số lượng link mỗi trang
    'sitemap' => [
        [
            'table' => 'post_categories',//tên bảng
            'model' => 'Sudo\Post\Models\PostCategory',//tên kèm namespace model
            'changefreq' => 'daily',//tần xuất thay đổi nội dung: always,hourly,daily,weekly,monthly,yearly,never
            'priority' => '0.5',//độ ưu tiên 0.0 đến 1.0
        ],
        [
            'table' => 'posts',
            'model' => 'Sudo\Post\Models\Post',
            'changefreq' => 'weekly',
            'priority' => '0.8',
        ],
        [
            'table' => 'product_categories',
            'model' => 'Sudo\Ecommerce\Models\ProductCategory',
            'changefreq' => 'weekly',
            'priority' => '0.8',
        ],
        [
            'table' => 'products',
            'model' => 'Sudo\Ecommerce\Models\Product',
            'changefreq' => 'daily',
            'priority' => '0.5',
        ],
        [
            'table' => 'pages',
            'model' => 'Sudo\Page\Models\Page',
            'changefreq' => 'daily',
            'priority' => '0.5',
        ],
    ],
];
