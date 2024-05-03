## Hướng dẫn sử dụng Sudo Page ##

**Giới thiệu:** Module tạo sitemap cho website trên SudoCore.

### Cài đặt để sử dụng ###

- Package cần phải có base `sudo/core` để có thể hoạt động không gây ra lỗi
- Để có thể sử dụng Package cần require theo lệnh `composer require sudo/sitemap`
- Chạy php artisan vendor:publish --tag=sudo/sitemap để public file config, và assets ra ngoài
- Cấu hình các dữ liệu muốn hiển thị tại file `config/SudoSitemap.php` 
