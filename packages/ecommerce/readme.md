## Hướng dẫn sử dụng Sudo Ecommerce ##

**Giới thiệu:** Đây là package dùng để quản lý Ecommerce của SudoCms.

### Cài đặt để sử dụng ###

- Thêm sudo/ecommerce vào phần require của file composer.json sau đó chạy composer update
- Chạy `php artisan migrate` để tạo các bảng phục vụ cho package

### Cấu hình tại Menu ###

	[
    	'type' 				=> 'multiple',
    	'name' 				=> 'Trang đơn',
		'icon' 				=> 'fas fa-file',
		'childs' => [
			[
				'name' 		=> 'Thêm mới',
				'route' 	=> 'admin.pages.create',
				'role' 		=> 'pages_create'
			],
			[
				'name' 		=> 'Danh sách',
				'route' 	=> 'admin.pages.index',
				'role' 		=> 'pages_index',
				'active' 	=> [ 'admin.pages.show', 'admin.pages.edit' ]
			]
		]
    ],
 
- Vị trí cấu hình được đặt tại `config/SudoMenu.php`

### Cấu hình tại Module ###
	
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

- Vị trí cấu hình được đặt tại `config/SudoModule.php`

# Hướng dẫn sử dụng các module trong package này

## 1. Thuộc tính sản phẩm
Module này cho phép thêm thuộc tính, chi tiết thuộc tính

Ví dụ: 

- Thuộc tính: Màu sẽ có các chi tiết của thuộc tính là Đỏ, Xanh Vàng,...
- Thuộc tính: Size sẽ có chi tiết của thuộc tính là S, M, L, XL,...
- Thuộc tính: Ram sẽ có các chi tiết của thuộc tính là 2GB, 4GB, 8GB,...

Module này được sử dụng thêm tùy biến các biến thể cho sản phẩm

Ví dụ 1: Chúng ta cần làm 1 website bán quần áo khi đó sẽ phát sinh các khả năng sau

- Áo Phông có Màu Đỏ, Size M, Giá 100.000, Ảnh nhận diện
- Áo Phông có Màu Xanh, Size L, Giá 200.000, Ảnh nhận diện
- ... và nhiều các trường hợp khác có thể sảy ra

Khi đó ta tạm gọi mỗi trường hợp là 1 biến thể của sản phẩm Áo Phông

Ví dụ 2: Chúng ta cần làm 1 website bán điện thoại khi đó sẽ phát sinh các khả năng sau

-  Điện thoại iPhone 12 có Màu Vàng, Dung lượng Ram 4GB, Giá 1.000.000, Ảnh nhận diện
-  Điện thoại iPhone 12 có Màu Xahh, Dung lượng Ram 8GB, Giá 2.000.000, Ảnh nhận diện
-  ... và nhiều các trường hợp khác có thể sảy ra

Khi đó ta tạm gọi mỗi trường hợp là 1 biến thể của sản phẩm Điện thoại iPhone 12

### Các bảng csdl sử dụng cho phần này bao gồm
* products: Lưu thông tin sản phẩm
* attributes: Lưu thông tin thuộc tính
* attribute_details: Lưu thông tin chi tiết thuộc tính
* variants: lưu thông tin biến thể sản phẩm
* attribute_variant_maps: Dùng để maps dữ liệu giữa bảng sản phẩm, thuộc tính sản phẩm và biến thể sản phẩm

## 2. Cấu hình tính phí vận chuyển

Module này được sử dụng để tính phí vận chuyển cho đơn hàng (nếu có website cần đến)

### Mô tả tính năng
* Đầu tiên chúng ta sẽ thêm khu vực vận chuyển (vận chuyển đến tỉnh thành nào)
* Sau khi thêm khu vực, chúng ta sẽ cấu hình phí cho khu vực đó. Sẽ có 2 trường hợp sảy ra, 1 là tính phí vận chuyển theo giá đơn hàng, 2 là tính phí theo trọng lượng đơn hàng
* Tại đây chúng ta sẽ nhập các giới hạn của từng trường hợp và phí ship tương ứng cho trường hợp đó
* Mỗi khu vực có thể thêm nhiều cách tính phí, và có thể thêm nhiều khu vực

### Các bảng csdl sử dụng cho phần này bao gồm

* shippings: Bảng này dùng để lưu thông tin về khu vực (tỉnh thành)
* shipping_rules: Bảng này dùng để lưu thông tin Quy Tắc Vận Chuyển, giới hạn, phí vận chuyển, kiểu tính phí (theo giá or trọng lượng)
* shipping_provinces: Bảng này lưu thông tin khu vực (63 tỉnh thành)
 
 
 