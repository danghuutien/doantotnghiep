<?php 

return [
	'modules' => [
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