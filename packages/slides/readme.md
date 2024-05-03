## Hướng dẫn sử dụng Sudo Slides ##

**Giới thiệu:** Đây là package dùng để quản lý Slide của SudoCms.

### Cài đặt để sử dụng ###

- Thêm sudo/slide vào phần require của file composer.json sau đó chạy composer update
- Chạy `php artisan migrate` để tạo các bảng phục vụ cho package

### Cấu hình tại Menu ###

	[
    	'type' 		=> 'single',
		'name' 		=> 'Quản lý slides',
		'icon' 		=> 'bx bx-images',
		'route' 	=> 'admin.slides.index',
		'role'		=> 'slides_index',
		'active'    => [ 'admin.slides.create', 'admin.slides.edit' ]
	],
 
- Vị trí cấu hình được đặt tại `config/SudoMenu.php`

### Cấu hình tại Module ###
	
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

- Vị trí cấu hình được đặt tại `config/SudoModule.php`
 