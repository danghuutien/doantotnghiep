<?php 

return [
	'menu' => [
		[
			'type' 		=> 'single',
	        'name' 		=> 'Trang chủ',
	        'icon' 		=> 'fas fa-tachometer-alt',
	        'route' 	=> 'admin.home',
	        'role'		=> 'home'
		],
		[
	        'type' 		=> 'group',
	        'name' 		=> 'Tài khoản',
	        'role' 		=> [
	        	'admin_users_create',
	        	'admin_users_index'
	        ],
	    ],
	    [
	    	'type' 				=> 'multiple',
	        'name' 				=> 'Tài khoản quản trị',
	        'icon' 				=> 'fas fa-users',
	        'childs' => [
	            [
	                'name' 		=> 'Thêm mới',
	                'route' 	=> 'admin.admin_users.create',
	                'role' 		=> 'admin_users_create'
	            ],
	            [
	                'name' 		=> 'Danh sách',
	                'route' 	=> 'admin.admin_users.index',
	                'role' 		=> 'admin_users_index',
	                'active' 	=> [ 'admin.admin_users.show', 'admin.admin_users.edit' ]
	            ]
	        ]
	    ],
	    [
	        'type' 		=> 'group',
	        'name' 		=> 'Quản trị nội dung',
	        'role' 		=> []
	    ],
	    [
	        'type' 		=> 'group',
	        'name' 		=> 'Khác',
	        'role' 		=> [
	        	'media_view',
	        	'system_logs_index'
	        ]
	    ],
	    [
	    	'type' 		=> 'single',
			'name' 		=> 'Quản lý tập tin',
			'icon' 		=> 'fas fa-photo-video',
			'route' 	=> 'media.view',
			'role'		=> 'media_view'
		],
		[
			'type' 		=> 'single',
			'name' 		=> 'Lịch sử hệ thống',
			'icon' 		=> 'fas fa-redo',
			'route' 	=> 'admin.system_logs.index',
			'role'		=> 'system_logs_index',
			'active' 	=> [ 'admin.system_logs.show' ]
		]
	],
];