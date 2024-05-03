<?php
return [
    // Mặc định sẽ là offline, assets sẽ được load từ local, nếu set offline là false và resource có định
    // nghĩa cdn thì assets sẽ được load từ cdn
    'offline' => env('ASSETS_OFFLINE', true),

    // Bật hiển thị version, lúc này link tới resource sẽ được nối thêm "?v=1.0" chẳng hạn.
    'enable_version' => true,

    // Version hiển thị khi enable_vesion là true
    'vesion' => '1.0',

    // Các thư viện js mặc định được sử dụng, là key được định nghĩa trong phần resource bên dưới.
    'scripts' => [ 
        //
    ],

    // Các thư viện css mặc định
    'styles' => [
        //
    ],

    // Định nghĩa tất cả đường dẫn tới assets.
    'resources' => [
    	// Định nghĩa các thư viện css
    	'styles' => [ 
         //    'style' => [
         //    	// Có cho phép sử dụng cdn hay không, nếu là true thì bạn phải định nghĩa link tới cnd bên dưới
	        //     'use_cdn' => false, 
	        //     // Vị trí chèn, trên header hay dưới footer [top | bottom]
	        //     'location' => 'bottom',
	        //     'src' => [
	        //     	// Đường dẫn tới thư viện
	        //     	'local' => '/assets/css/style.min.css',
	        //     	'cdn' => null,
	        //     ],
	        //     // Các thuộc tính bổ sung, nếu cần
	        //     'attributes' => [],
	        // ],
        ],

        // Định nghĩa các thư viện js
        'scripts' => [
         //    'main' => [
         //    	// Có cho phép sử dụng cdn hay không, nếu là true thì bạn phải định nghĩa link tới cnd bên dưới
	        //     'use_cdn' => false, 
	        //     // Vị trí chèn, trên header hay dưới footer [top | bottom]
	        //     'location' => 'bottom',
	        //     'src' => [
	        //     	// Đường dẫn tới thư viện
	        //     	'local' => '/assets/js/main.min.js',
	        //     	'cdn' => null,
	        //     ],
	        //     // Các thuộc tính bổ sung, nếu cần
	        //     'attributes' => [
	        //     	'defer' => null,
	        //     ],
	        // ],
        ],
    ],
];