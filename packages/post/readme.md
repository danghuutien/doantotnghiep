## Hướng dẫn sử dụng Sudo Post ##

**Giới thiệu:** Đây là package dùng để quản lý bài viết của SudoCms.

Mặc định package sẽ tạo ra giao diện quản lý cho toàn bộ bài viết và danh mục bài viết được đặt tại `/{admin_dir}/posts` và `/{admin_dir}/post_categories`, trong đó admin_dir là đường dẫn admin được đặt tại `config('app.admin_dir')`

### Cài đặt để sử dụng ###

- Thêm sudo/post vào phần require của file composer.json sau đó chạy composer update
- Package cũng cần package `sudo/tag` để có thể hoạt động, Thêm sudo/tag vào phần require của file composer.json sau đó chạy composer update

- Chạy `php artisan migrate` để tạo các bảng phục vụ cho package

### Cấu hình tại Menu ###

	[
    	'type' 				=> 'multiple',
        'name' 				=> 'Ecommerce',
        'icon' 				=> 'bx bx-store',
        'childs' => [
            [
                'name' 		=> 'Sản phẩm',
                'route' 	=> 'admin.products.index',
                'role' 		=> 'products_create',
                'active'    => ['admin.products.edit', 'admin.products.create']
            ],
            [
                'name' 		=> 'Danh mục sản phẩm',
                'route' 	=> 'admin.product_categories.index',
                'role' 		=> 'product_categories_index',
                'active'    => ['admin.product_categories.edit', 'admin.product_categories.create']
            ],
            [
                'name' 		=> 'Thuộc tính sản phẩm',
                'route' 	=> 'admin.attributes.index',
                'role' 		=> 'attributes_index',
                'active'    => ['admin.attributes.edit', 'admin.attributes.create']
            ],
            [
                'name' 		=> 'Thương hiệu',
                'route' 	=> 'admin.brands.index',
                'role' 		=> 'brands_index',
                'active'    => ['admin.brands.edit', 'admin.brands.create']
            ],
            [
                'name' 		=> 'Đơn hàng',
                'route' 	=> 'admin.orders.index',
                'role' 		=> 'orders_index',
                'active'    => ['admin.orders.edit', 'admin.orders.create', 'admin.orders.show']
            ],
            [
                'name' 		=> 'Khách hàng',
                'route' 	=> 'admin.customers.index',
                'role' 		=> 'customers_index',
                'active'    => ['admin.customers.edit', 'admin.customers.create']
            ],
            [
                'name' 		=> 'Vận chuyển',
                'route' 	=> 'admin.shippings.create',
                'role' 		=> 'shippings_create',
            ],
            [
                'name' 		=> 'Thuế',
                'route' 	=> 'admin.taxes.index',
                'role' 		=> 'taxes_index',
                'active'    => ['admin.taxes.edit', 'admin.taxes.create']
            ]
        ]
    ],
 
- Vị trí cấu hình được đặt tại `config/SudoMenu.php`

### Cấu hình tại Module ###
	
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
	'attributes' => [
		'name' 			=> 'Thuộc tính sản phẩm',
		'permision' 	=> [
			[ 'type' => 'index', 'name' => 'Truy cập' ],
			[ 'type' => 'create', 'name' => 'Thêm' ],
			[ 'type' => 'edit', 'name' => 'Sửa' ],
			[ 'type' => 'restore', 'name' => 'Lấy lại' ],
			[ 'type' => 'delete', 'name' => 'Xóa' ],
		],
	],
	'brands' => [
		'name' 			=> 'Thương hiệu',
		'permision' 	=> [
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
		],
	],
	'customers' => [
		'name' 			=> 'Khách hàng',
		'permision' 	=> [
			[ 'type' => 'index', 'name' => 'Truy cập' ],
			[ 'type' => 'create', 'name' => 'Thêm' ],
			[ 'type' => 'edit', 'name' => 'Sửa' ],
			[ 'type' => 'restore', 'name' => 'Lấy lại' ],
			[ 'type' => 'delete', 'name' => 'Xóa' ],
		],
	],
	'shippings' => [
		'name' 			=> 'Vận chuyển',
		'permision' 	=> [
			[ 'type' => 'index', 'name' => 'Truy cập' ],
			[ 'type' => 'create', 'name' => 'Thêm' ],
			[ 'type' => 'edit', 'name' => 'Sửa' ],
			[ 'type' => 'restore', 'name' => 'Lấy lại' ],
			[ 'type' => 'delete', 'name' => 'Xóa' ],
		],
	],
	'taxes' => [
		'name' 			=> 'Thuế',
		'permision' 	=> [
			[ 'type' => 'index', 'name' => 'Truy cập' ],
			[ 'type' => 'create', 'name' => 'Thêm' ],
			[ 'type' => 'edit', 'name' => 'Sửa' ],
			[ 'type' => 'restore', 'name' => 'Lấy lại' ],
			[ 'type' => 'delete', 'name' => 'Xóa' ],
		],
	],

- Vị trí cấu hình được đặt tại `config/SudoModule.php`





 