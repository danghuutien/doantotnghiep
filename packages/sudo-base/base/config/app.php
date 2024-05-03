<?php 

return [
	// Đường dẫn Admin
	'admin_dir' => env('ADMIN_DIR', 'admin'),

	// Các trạng thái chung trên toàn trang
	'status' => [
		'1' => 'Hoạt động',
		'0' => 'Không hoạt động',
	],

	'page_size' => [ 10, 30, 50, 100 ],

	// Đa ngôn ngữ
	// 'language' => [
 //        'vi' => [
 //            'name' => 'Tiếng việt',
 //            'flag' => '/core/img/flags/vn.png',
 //        ],
 //        'en' => [
 //            'name' => 'English',
 //            'flag' => '/core/img/flags/en.png',
 //        ],
 //    ],

	// Menu form
    // 'menu_form' => [
    //     // Cố định
    //     'menu_link' => [
    //         'vi' => [
    //             '/' => 'Trang chủ',
    //             '/lien-he' => 'Liên hệ',
    //         ],
    //         'en' => [
    //             '/' => 'Home Page',
    //             '/contact' => 'Contact',
    //         ],
    //     ],
    //     // Theo bảng
    //     'table_link' => [
    //         'pages' => [
    //             'name' => 'Trang đơn',
    //             'models' => 'Sudo\Theme\Models\Page',
    //             'has_locale' => true
    //         ],
    //     ],
    // ],
];