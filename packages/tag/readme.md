## Hướng dẫn sử dụng Sudo Tag ##

**Giới thiệu:** Đây là package dùng để quản lý các tags của SudoCms.

Mặc định package sẽ tạo ra giao diện quản lý cho toàn bộ tags được đặt tại `/{admin_dir}/tags`, trong đó admin_dir là đường dẫn admin được đặt tại `config('app.admin_dir')`

### Cài đặt để sử dụng ###

- Package cần phải có base `sudo/core` để có thể hoạt động không gây ra lỗi
- Để có thể sử dụng Package cần require theo lệnh `composer require sudo/tag`
- Chạy `php artisan migrate` để tạo các bảng phục vụ cho package

### Cấu hình tại Menu ###

	[
    	'type' 		=> 'single',
		'name' 		=> 'Quản lý Tags',
		'icon' 		=> 'fas fa-tags',
		'route' 	=> 'admin.tags.index',
		'role'		=> 'tags_index'
	],
 
- Vị trí cấu hình được đặt tại `config/SudoMenu.php`
- Để có thể hiển thị tại menu, chúng ta có thể đặt đoạn cấu hình trên tại `config('SudoMenu.menu')`

### Cấu hình tại Module ###
	
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

- Vị trí cấu hình được đặt tại `config/SudoModule.php`
- Để có thể phân quyền, chúng ta có thể đặt đoạn cấu hình trên tại `config('SudoModule.modules')`
 
### Các Helper hỗ trợ ###

Truy cập `helpers/functions.php` để đọc thêm về các hàm helper được hỗ trợ