<?php
return [
    // Mặc định sẽ là offline, assets sẽ được load từ local, nếu set offline là false và resource có định
    // nghĩa cdn thì assets sẽ được load từ cdn
    'offline' => env('ASSETS_OFFLINE', true),

    // Bật hiển thị version, lúc này link tới resource sẽ được nối thêm "?v=1.0" chẳng hạn.
    'enable_version' => true,

    // Version hiển thị khi enable_vesion là true
    'vesion' => '1.5',

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
            'home' => [
                'use_cdn' => false, 
                'location' => 'bottom',
                'src' => [
                    'local' => '/assets/css/home.min.css',
                    'cdn' => null,
                ],
                'attributes' => [],
            ],
            'general' => [
                'use_cdn' => false, 
                'location' => 'top',
                'src' => [
                    'local' => '/assets/css/general.min.css',
                    'cdn' => null,
                ],
                'attributes' => [],
            ],
            'page' => [
                'use_cdn' => false, 
                'location' => 'top',
                'src' => [
                    'local' => '/assets/css/page.min.css',
                    'cdn' => null,
                ],
                'attributes' => [],
            ],
            'contact' => [
                'use_cdn' => false, 
                'location' => 'top',
                'src' => [
                    'local' => '/assets/css/contact.min.css',
                    'cdn' => null,
                ],
                'attributes' => [],
            ],
            'post' => [
                'use_cdn' => false, 
                'location' => 'top',
                'src' => [
                    'local' => '/assets/css/post.min.css',
                    'cdn' => null,
                ],
                'attributes' => [],
            ],
            'product' => [
                'use_cdn' => false, 
                'location' => 'top',
                'src' => [
                    'local' => '/assets/css/product.min.css',
                    'cdn' => null,
                ],
                'attributes' => [],
            ],
            'sale' => [
                'use_cdn' => false,
                'location' => 'top',
                'src' => [
                    'local' => '/assets/css/sale.min.css',
                    'cdn' => null,
                ],
                'attributes' => [],
            ],
            'owl-carousel' => [
                'use_cdn' => false, 
                'location' => 'bottom',

                'src' => [
                    'local' => '/assets/libs/owl-carousel/owl.carousel.min.css',
                    'cdn' => null,
                ],
                'attributes' => [],
            ],
            'slick' => [
                'use_cdn' => false, 
                'location' => 'bottom',
                'src' => [
                    'local' => '/assets/libs/slick-master/slick/slick.css',
                    'cdn' => null,
                ],
                'attributes' => [],
            ],
            'venobox' => [
                'use_cdn' => false, 
                'location' => 'bottom',
                'src' => [
                    'local' => '/assets/libs/venobox/css/venobox.min.css',
                    'cdn' => null,
                ],
                'attributes' => [],
            ],
        ],

        // Định nghĩa các thư viện js
        'scripts' => [
            'jquery' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => '/assets/libs/jquery/jquery.min.js',
                    'cdn' => null,
                ],
                'attributes' => [
                    'defer' => '',
                ],
            ], 
            'venobox' => [
                'use_cdn' => false, 
                'location' => 'bottom',
                'src' => [
                    'local' => '/assets/libs/venobox/js/venobox.min.js',
                    'cdn' => null,
                ],
                'attributes' => [
                    'defer' => '',
                ],
            ],
            'core' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => '/assets/js/core.min.js',
                    'cdn' => null,
                ],
                'attributes' => [
                    'defer' => '',
                ],
            ],
            'home' => [
                'use_cdn' => false, 
                'location' => 'bottom',
                'src' => [
                    'local' => '/assets/js/home.min.js',
                    'cdn' => null,
                ],
                'attributes' => [
                    'defer' => '',
                ],
            ],
            'webUpdate' => [
                'use_cdn' => false, 
                'location' => 'bottom',
                'src' => [
                    'local' => '/assets/js/webUpdate.min.js',
                    'cdn' => null,
                ],
                'attributes' => [
                    'defer' => '',
                ],
            ],
            'general' => [
                'use_cdn' => false, 
                'location' => 'bottom',
                'src' => [
                    'local' => '/assets/js/general.min.js',
                    'cdn' => null,
                ],
                'attributes' => [
                    'defer' => '',
                ],
            ],
            'page' => [
                'use_cdn' => false, 
                'location' => 'bottom',
                'src' => [
                    'local' => '/assets/js/page.min.js',
                    'cdn' => null,
                ],
                'attributes' => [
                    'defer' => '',
                ],
            ],
            'sale' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => '/assets/js/sale.min.js',
                    'cdn' => null,
                ],
                'attributes' => [
                    'defer' => '',
                ],
            ],
            'product' => [
                'use_cdn' => false, 
                'location' => 'bottom',
                'src' => [
                    'local' => '/assets/js/product.min.js',
                    'cdn' => null,
                ],
                'attributes' => [
                    'defer' => '',
                ],
            ],
            'owl-carousel' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => '/assets/libs/owl-carousel/owl.carousel.min.js',
                    'cdn' => null,
                ],
                'attributes' => [
                    'defer' => '',
                ],
            ],
            'slick' => [
                'use_cdn' => false, 
                'location' => 'bottom',
                'src' => [
                    'local' => '/assets/libs/slick-master/slick/slick.min.js',
                    'cdn' => null,
                ],
                'attributes' => [
                    'defer' => '',
                ],
            ], 
        ],
    ],
];
