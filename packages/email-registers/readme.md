## Hướng dẫn sử dụng Email Register ##

**Giới thiệu:** Đây là package dùng để quản lý email đăng ký của SudoCms.

Mặc định package sẽ tạo ra giao diện quản lý cho email đăng ký được đặt tại `/{admin_dir}/email_registers` , trong đó admin_dir là đường dẫn admin được đặt tại `config('app.admin_dir')`

### Cài đặt để sử dụng ###

- Thêm sudo/email-register vào phần require của file composer.json sau đó chạy composer update
- Chạy `php artisan migrate` để tạo các bảng phục vụ cho package

### Cấu hình tại Menu ###

	[
    	'type' 		=> 'single',
		'name' 		=> 'Đăng ký Email',
		'icon' 		=> 'bx bx-envelope',
		'route' 	=> 'admin.email_registers.index',
		'role'		=> 'email_registers_index'
	],
 
- Vị trí cấu hình được đặt tại `config/SudoMenu.php`

### Cấu hình tại Module ###
	
	'email_registers' => [
		'name' 			=> 'Đăng ký Email',
		'permision' 	=> [
			[ 'type' => 'index', 'name' => 'Truy cập' ],
			[ 'type' => 'edit', 'name' => 'Sửa' ],
			[ 'type' => 'restore', 'name' => 'Lấy lại' ],
			[ 'type' => 'delete', 'name' => 'Xóa' ],
		],
	],

- Vị trí cấu hình được đặt tại `config/SudoModule.php`
 
### Sử dụng ###

Thêm để thêm Email đăng ký hãy gửi ajax đến link dưới đây với param là Email nhập vào từ input

	{domain}/ajax/email_registers
	method: POST
	param: {
		email: email
	}
