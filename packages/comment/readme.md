## Hướng dẫn sử dụng Sudo Page ##

**Giới thiệu:** Đây là package dùng để quản lý bình luận của SudoCms.

Mặc định package sẽ tạo ra giao diện quản lý cho toàn bộ bình luận được đặt tại `/{admin_dir}/comments`, trong đó admin_dir là đường dẫn admin được đặt tại `config('app.admin_dir')`

### Cài đặt để sử dụng ###


- Chạy `php artisan migrate` để tạo các bảng phục vụ cho package

## Publish ##

Mặc định khi chạy lệnh `php artisan sudo/core` đã sinh luôn cho package này, nhưng có một vài trường hợp chỉ muốn tạo lại riêng cho package này thì sẽ chạy các hàm dưới đây:

* Khởi tạo chung theo core
	- Tạo configs `php artisan vendor:publish --tag=sudo/core`
	- Chỉ tạo configs `php artisan vendor:publish --tag=sudo/core/config`
	- Chỉ tạo assets `php artisan vendor:publish --tag=sudo/core/asset`
	- Chỉ tạo views `php artisan vendor:publish --tag=sudo/core/view`
* Khởi tạo riêng theo package
	- Tạo configs `php artisan vendor:publish --tag=sudo/comment`
	- Chỉ tạo configs `php artisan vendor:publish --tag=sudo/comment/config`
	- Chỉ tạo assets `php artisan vendor:publish --tag=sudo/comment/asset`
	- Chỉ tạo views `php artisan vendor:publish --tag=sudo/comment/view`

### Cấu hình tại Menu ###

	[
    	'type' 		=> 'single',
		'name' 		=> 'Bình luận',
		'icon' 		=> 'bx bx-comment',
		'route' 	=> 'admin.comments.index',
		'role'		=> 'comments_index',
		'active'    => [ 'admin.comments.create', 'admin.comments.edit' ]
	],
 
- Vị trí cấu hình được đặt tại `config/SudoMenu.php`

### Cấu hình tại Module ###
	
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

- Vị trí cấu hình được đặt tại `config/SudoModule.php`
 
### Cách dùng ###
Include view dưới đây để có thể nhúng bình luận tại vị trí được sử dụng

	@include('Comment::list', [
		'type' => 'posts',
		'type_id' => 1,
		'regulation_link' => '#',
		'no_comment_text' => 'Hãy để lại bình luận của bạn tại đây!'
	])

Trong đó

- type: là tên bảng và cũng là tên module
- type_id: là id thuộc bảng
- regulation_link: Đường dẫn đến trang `Quy định bình luận`
- no_comment_text: Khi không có comments sẽ hiển thị text này

Truy cập `config/SudoComment.php` (Sau khi publish) để biết thêm các giá trị được hỗ trợ khác. 