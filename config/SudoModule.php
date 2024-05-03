<?php 

return [
	'modules' => [
		'products' => [
			'name' 			=> 'Sản phẩm',
			'permision' 	=> [
				[ 'type' => 'index', 'name' => 'Truy cập' ],
				[ 'type' => 'create', 'name' => 'Thêm' ],
				[ 'type' => 'edit', 'name' => 'Sửa' ],
				[ 'type' => 'restore', 'name' => 'Lấy lại' ],
				[ 'type' => 'delete', 'name' => 'Xóa' ],
			],
		],
		'product_categories' => [
			'name' 			=> 'Danh mục sản phẩm',
			'permision' 	=> [
				[ 'type' => 'index', 'name' => 'Truy cập' ],
				[ 'type' => 'create', 'name' => 'Thêm' ],
				[ 'type' => 'edit', 'name' => 'Sửa' ],
				[ 'type' => 'restore', 'name' => 'Lấy lại' ],
				[ 'type' => 'delete', 'name' => 'Xóa' ],
			],
		],
		'filters' => [
			'name' 			=> 'Bộ lọc',
			'permision' 	=> [
				[ 'type' => 'index', 'name' => 'Truy cập' ],
				[ 'type' => 'create', 'name' => 'Thêm' ],
				[ 'type' => 'edit', 'name' => 'Sửa' ],
				[ 'type' => 'restore', 'name' => 'Lấy lại' ],
				[ 'type' => 'delete', 'name' => 'Xóa' ],
			],
		],
		'filter_details' => [
			'name' 			=> 'Chi tiết bộ lọc',
			'permision' 	=> [
				[ 'type' => 'index', 'name' => 'Truy cập' ],
				[ 'type' => 'create', 'name' => 'Thêm' ],
				[ 'type' => 'edit', 'name' => 'Sửa' ],
				[ 'type' => 'restore', 'name' => 'Lấy lại' ],
				[ 'type' => 'delete', 'name' => 'Xóa' ],
			],
		],
        'vouchers' => [
            'name'          => 'Mã giảm giá',
            'permision'     => [
                [ 'type' => 'index', 'name' => 'Truy cập' ],
                [ 'type' => 'create', 'name' => 'Thêm' ],
                [ 'type' => 'edit', 'name' => 'Sửa' ],
                [ 'type' => 'restore', 'name' => 'Lấy lại' ],
                [ 'type' => 'delete', 'name' => 'Xóa' ],
            ],
        ],
		'golden_times' => [
            'name'          => 'Giờ vàng giá sốc',
            'permision'     => [
                [ 'type' => 'index', 'name' => 'Truy cập' ],
                [ 'type' => 'create', 'name' => 'Thêm' ],
                [ 'type' => 'edit', 'name' => 'Sửa' ],
                [ 'type' => 'restore', 'name' => 'Lấy lại' ],
                [ 'type' => 'delete', 'name' => 'Xóa' ],
            ],
        ],
		'slides' => [
			'name' 			=> 'Quản lý slides',
			'permision' 	=> [
				[ 'type' => 'index', 'name' => 'Truy cập' ],
				[ 'type' => 'create', 'name' => 'Thêm' ],
				[ 'type' => 'edit', 'name' => 'Sửa' ],
				[ 'type' => 'restore', 'name' => 'Lấy lại' ],
				[ 'type' => 'delete', 'name' => 'Xóa' ],
			],
		],
		'orders' => [
			'name' 			=> 'Đơn hàng',
			'permision' 	=> [
				[ 'type' => 'index', 'name' => 'Truy cập' ],
				[ 'type' => 'create', 'name' => 'Thêm' ],
				[ 'type' => 'edit', 'name' => 'Sửa' ],
				[ 'type' => 'restore', 'name' => 'Lấy lại' ],
				[ 'type' => 'delete', 'name' => 'Xóa' ],
				[ 'type' => 'show', 'name' => 'Xem chi tiết' ],
			],
		],
		'stores' => [
			'name' 			=> 'Hệ thống cửa hàng',
			'permision' 	=> [
				[ 'type' => 'index', 'name' => 'Truy cập' ],
				[ 'type' => 'create', 'name' => 'Thêm' ],
				[ 'type' => 'edit', 'name' => 'Sửa' ],
				[ 'type' => 'restore', 'name' => 'Lấy lại' ],
				[ 'type' => 'delete', 'name' => 'Xóa' ],
			],
		],
        'posts' => [
            'name'          => 'Bài viết',
            'permision'     => [
                [ 'type' => 'index', 'name' => 'Truy cập' ],
                [ 'type' => 'create', 'name' => 'Thêm' ],
                [ 'type' => 'edit', 'name' => 'Sửa' ],
                [ 'type' => 'restore', 'name' => 'Lấy lại' ],
                [ 'type' => 'delete', 'name' => 'Xóa' ],
            ],
        ],
		'post_categories' => [
			'name' 			=> 'Danh mục bài viết',
			'permision' 	=> [
				[ 'type' => 'index', 'name' => 'Truy cập' ],
				[ 'type' => 'create', 'name' => 'Thêm' ],
				[ 'type' => 'edit', 'name' => 'Sửa' ],
				[ 'type' => 'restore', 'name' => 'Lấy lại' ],
				[ 'type' => 'delete', 'name' => 'Xóa' ],
			],
		],
		'pages' => [
			'name' 			=> 'Trang đơn',
			'permision' 	=> [
				[ 'type' => 'index', 'name' => 'Truy cập' ],
				[ 'type' => 'create', 'name' => 'Thêm' ],
				[ 'type' => 'edit', 'name' => 'Sửa' ],
				[ 'type' => 'restore', 'name' => 'Lấy lại' ],
				[ 'type' => 'delete', 'name' => 'Xóa' ],
			],
		],
		'tags' => [
			'name' 			=> 'Tags',
			'permision' 	=> [
				[ 'type' => 'index', 'name' => 'Truy cập' ],
				[ 'type' => 'create', 'name' => 'Thêm' ],
				[ 'type' => 'edit', 'name' => 'Sửa' ],
				[ 'type' => 'restore', 'name' => 'Lấy lại' ],
				[ 'type' => 'delete', 'name' => 'Xóa' ],
			],
		],
		'sync_links' => [
			'name' 			=> 'Link đồng bộ',
			'permision' 	=> [
				[ 'type' => 'index', 'name' => 'Truy cập' ],
				[ 'type' => 'create', 'name' => 'Thêm' ],
				[ 'type' => 'edit', 'name' => 'Sửa' ],
				[ 'type' => 'restore', 'name' => 'Lấy lại' ],
				[ 'type' => 'delete', 'name' => 'Xóa' ],
			],
		],
		'comments' => [
			'name' 			=> 'Bình luận',
			'permision' 	=> [
				[ 'type' => 'index', 'name' => 'Truy cập' ],
				[ 'type' => 'create', 'name' => 'Thêm' ],
				[ 'type' => 'edit', 'name' => 'Sửa' ],
				[ 'type' => 'restore', 'name' => 'Lấy lại' ],
				[ 'type' => 'delete', 'name' => 'Xóa' ],
			],
		],
		'contacts' => [
			'name' 			=> 'Liên hệ',
			'permision' 	=> [
				[ 'type' => 'index', 'name' => 'Truy cập' ],
				[ 'type' => 'edit', 'name' => 'Sửa' ],
				[ 'type' => 'restore', 'name' => 'Lấy lại' ],
				[ 'type' => 'delete', 'name' => 'Xóa' ],
			],
		],	
		// 'call_me_back' => [
		// 	'name' 			=> 'Call_me_back',
		// 	'permision' 	=> [
		// 		[ 'type' => 'index', 'name' => 'Truy cập' ],
		// 		[ 'type' => 'create', 'name' => 'Thêm' ],
		// 		[ 'type' => 'edit', 'name' => 'Sửa' ],
		// 		[ 'type' => 'restore', 'name' => 'Lấy lại' ],
		// 		[ 'type' => 'delete', 'name' => 'Xóa' ],
		// 	],
		// ],
		'admin_users' => [
			'name' 			=> 'Tài khoản quản trị',
			'permision' 	=> [
				[ 'type' => 'index', 'name' => 'Truy cập' ],
				[ 'type' => 'create', 'name' => 'Thêm' ],
				[ 'type' => 'edit', 'name' => 'Sửa' ],
				[ 'type' => 'restore', 'name' => 'Lấy lại' ],
				[ 'type' => 'delete', 'name' => 'Xóa' ],
			],
		],
		'settings' => [
			'name' 			=> 'Cấu hình',
			'permision' 	=> [
				[ 'type' => 'general', 'name' => 'Giao diện website' ],
				[ 'type' => 'home', 'name' => 'Trang chủ' ],
				[ 'type' => 'postCategory', 'name' => 'Trang danh mục tin tức' ],
				[ 'type' => 'product', 'name' => 'Trang sản phẩm' ],
				[ 'type' => 'menu', 'name' => 'Menu' ],
				[ 'type' => 'contact', 'name' => 'Liên hệ' ],
				[ 'type' => 'overview', 'name' => 'Cài đặt' ],
				// [ 'type' => 'googleAuthenticate', 'name' => 'Bảo mật Google Authenticate' ],
			],
		],
		'media' => [
			'name' 			=> 'Quản lý tập tin',
			'permision' 	=> [
				[ 'type' => 'index', 'name' => 'Truy cập' ]
			],
		],
		'system_logs' => [
			'name' 			=> 'Lịch sử hệ thống',
			'permision' 	=> [
				[ 'type' => 'index', 'name' => 'Truy cập' ],
				[ 'type' => 'show', 'name' => 'Xem chi tiết' ],
			],
		],
	],
	// Tên cho modules hoặc permision (ưu tiên lấy tại modules)
	'name' => [
		'index' 				=> 'Truy cập',
		'create' 				=> 'Thêm',
		'show' 					=> 'Xem chi tiết',
		'edit' 					=> 'Sửa',
		'restore' 				=> 'Lấy lại',
		'delete' 				=> 'Xóa',
	],
	
	// Hiển thị chi tiết tên cho các trường của từng bảng (Ưu tiên nếu không có sẽ lấy logs_name)
	'logs' => [
		'admin_users' => [
			'display_name' 		=> 'Tên hiển thị',
			'avatar' 			=> 'Ảnh đại diện',
			'capabilities' 		=> 'Quyền',
		],
	],
	// Logs hiển thị tên các field chung của các bảng 
	'logs_name' => [
		'category_id' 			=> 'Danh mục',
		'parent_id' 			=> 'Danh mục cha',
		'name' 					=> 'Tên',
		'slug' 					=> 'Đường dẫn Slug',
		'image' 				=> 'Ảnh đại diện',
		'email' 				=> 'Email',
		'phone' 				=> 'Điện thoại',
		'price' 				=> 'Giá',
		'price_old' 			=> 'Giá thị trường',
		'detail' 				=> 'Nội dung',
		'order' 				=> 'Sắp xếp',
		'status' 				=> 'Trạng thái',
		'created_at' 			=> 'Ngày tạo',
		'updated_at' 			=> 'Ngày cập nhật',
	],
	// Trường được set tại fields này là trường nội dung thì hiển thị sẽ là nội dung
	'logs_content_field' => [
		'capabilities',
		'detail', 
		'content',
	],
];
