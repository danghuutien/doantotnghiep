## Hướng dẫn sử dụng Sudo CallMeBack ##

**Giới thiệu:** Đây là package dùng để thêm module 'Gọi lại cho tôi'.


### Cài đặt để sử dụng ###

- Chạy `php artisan migrate` để tạo các bảng phục vụ cho package
- Chạy php artisan vendor:publish --tag=sudo/call_me_back để public file config, và assets ra ngoài
- Thêm câu lệnh@include('CallMeBack::web.show', ['name' => 'name', 'url' => 'url'])  vào vị trí muốn hiển thị tính năng 'Gọi lại cho tôi', (Ví dụ : @include('CallMeBack::web.show', ['name'=> 'home', 'url' => '/']))

### Cấu hình tại Menu ###

	[
    	'type' 				=> 'multiple',
    	'name' 				=> 'Call_me_back',
		'icon' 				=> 'fas fa-phone',
		'childs' => [
			[
				'name' 		=> 'Thêm mới',
				'route' 	=> 'admin.call_me_backs.create',
				'role' 		=> 'call_me_backs_create'
			],
			[
				'name' 		=> 'Danh sách',
				'route' 	=> 'admin.call_me_backs.index',
				'role' 		=> 'call_me_backs_index',
				'active' 	=> [ 'admin.call_me_backs.show', 'admin.call_me_backs.edit' ]
			]
		]
    ],
 
- Vị trí cấu hình được đặt tại `config/SudoMenu.php`
- Để có thể hiển thị tại menu, chúng ta có thể đặt đoạn cấu hình trên tại `config('SudoMenu.menu')`

### Cấu hình tại Module ###
	
		'call_me_back' => [
			'name' 			=> 'Call_me_back',
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
