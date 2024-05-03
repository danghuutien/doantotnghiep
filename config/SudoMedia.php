<?php 
return [
    /* Hình thức lưu: local | Server ảnh quy định trong config/FileSystem */
    'storage_type' => env('STORAGE_TYPE','local'),

    /* Linh ảnh cũ sẽ được thay bằng link ảnh mới đặt tại image_new nếu qua hàm getImage() */
    'image_old' => ['https://example.sudospaces.com'],
    /* Linh ảnh mới sẽ được thay bằng link ảnh cũ đặt tại image_old nếu qua hàm getImage() */
    'image_new' => 'https://sudospaces.com',

    /* thư mục uploads trên local hoặc server */
    'folder' => env('FOLDER','uploads'),

    /* Các kích thước resize Ảnh */
    'imageSize' => [
        'large' => 600,
        'medium' => 300,
        'small' => 150,
        'tiny' => 80
    ],

    /* Đuôi Ảnh chấp nhận cho up */
    'allowed_extension_image' => ['jpg','jpeg','png'],

    /* Đuôi file chấp nhận cho up */
    'allowed_extension_file' => ['pdf','xlsx','xls','gif'],

    /* Kích thước tối đa từng File */
    'allowed_size' => 2097152,

    /* Ảnh hiển thị trong 1 trang */
    'paginate' => 50,

    /* middleware. VD ['web', ...] */
    'middleware' => ['web', 'auth-admin'],

    /* đường dẫn admin */
    'admin_dir' => env('ADMIN_DIR', 'admin'),
];
