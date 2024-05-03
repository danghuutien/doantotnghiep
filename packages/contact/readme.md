## Hướng dẫn sử dụng Sudo Contact ##

**Giới thiệu:** Đây là package dùng để quản lý Liên hệ của SudoCms.

### Cài đặt để sử dụng ###

- Chạy `php artisan migrate` để tạo bảng phục vụ cho package
- Chạy `php artisan sudo/contacts:seeds` để tạo dữ liệu mẫu

### Cấu hình tại Menu ###

	[
    	'type' 		=> 'single',
		'name' 		=> 'Liên hệ',
		'icon' 		=> 'bx bxs-user-detail',
		'route' 	=> 'admin.contacts.index',
		'role'		=> 'contacts_index',
		'active'    => [ 'admin.contacts.create', 'admin.contacts.edit' ]
	],
 
- Vị trí cấu hình được đặt tại `config/SudoMenu.php`

### Cấu hình tại Module ###
	
	'contacts' => [
		'name' 			=> 'Liên hệ',
		'permision' 	=> [
			[ 'type' => 'index', 'name' => 'Truy cập' ],
			[ 'type' => 'edit', 'name' => 'Sửa' ],
			[ 'type' => 'restore', 'name' => 'Lấy lại' ],
			[ 'type' => 'delete', 'name' => 'Xóa' ],
		],
	],

- Vị trí cấu hình được đặt tại `config/SudoModule.php`


 