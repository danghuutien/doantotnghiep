# Hướng dẫn sử dụng SudoCore V3
* Clone source code từ bitbucket
* Xóa folder .git trong project để tránh push nhầm code lên Core
* Tạo file .env, nội dung copy từ file .env.example
* Cấu hình và tạo DB
* Kiểm tra file /root/composer.json và gọi các module cần thiết cho dự án
* Chạy composer install
* Chạy php artisan key:generate để tạo APP_KEY
* Chạy php artisan migrate để tạo bảng CSDL theo từng package
* Chạy php artisan admin_users:seeds để tạo tài khoản quản trị
* Chạy php artisan license:seeds để khởi tạo dữ liệu license (Tính năng này dùng để giảm thiểu khả năng người ngoài có thể sử dụng cms của Sudo)
* Mặc định core khi bắt đầu sẽ là đa ngôn ngữ, nếu website dùng 1 ngôn ngữ thì xóa nội dung sau tại file root/config/app.php
	`
		'language' => [
	        'vi' => [
	            'name' => 'Tiếng việt',
	            'flag' => '/admin_assets/images/flags/vn.jpg',
	            'locale' => 'vi_VN',
	        ],
	        'en' => [
	            'name' => 'English',
	            'flag' => '/admin_assets/images/flags/us.jpg',
	            'locale' => 'en_EN',
	        ],
	    ],
	`
Trên đây là các bước để khởi tạo core, Hướng dẫn chi tiết của từng package sẽ được viết tại file readme.md của package tương ứng

* Bổ sung tính năng bảo mật 2 lớp thông qua App Google Authenticate
  - Cài extension PHP Imagick để tính năng hoạt động, ở local làm theo hướng dẫn tại đây https://mlocati.github.io/articles/php-windows-imagick.html
  - Cấu hình thông báo lỗi, route .. tại config.google2fa
  - Bật tắt tính năng này tại phân quyền bảo mật Google Authenticate
  - Lấy lại QR CODE nếu mất tại phần changeInfo trong quản trị
  - Các route quản trị cần được bảo mật 2 bước vui lòng thêm middleware '2fa' vào route

  dev - FwM!ePb1REOj
sudo - PPburczlPq06
dev - MjHB8%M16D61
sudo - 1@$hP8Au2tHT
dev - %NOlCUhek!hl
sudo - hRUIGCa@Dbbk
VCB - ATM NGUYEN VAN A 9704360000000000002 01/13 123456
