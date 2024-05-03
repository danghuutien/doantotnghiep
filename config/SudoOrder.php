<?php 
return [

	// Hình thức thanh toán
	'payment_method' =>[
        1 => 'Thanh toán khi nhận hàng',
        2 => 'Thanh toán bằng thẻ ATM nội địa',
        3 => 'Thanh toán trả góp',
        4 => 'Thanh toán bằng thẻ Visa/ Master card',
        5 => 'Thanh toán bằng mã QR',
    ],
    'payment_status' =>  [
        0   => 'Chưa thanh toán',
        1   => 'Đã thanh toán',
        -1  => 'Hoàn tiền'
    ],
    'order_status' => [
        1 => 'Đơn hàng mới',
        11=> 'Đang liên hệ', // để 11 tức là 1.1 không nên sửa thành 2, vì sẽ ảnh hướng rất nhiều đến cái khác
        2 => 'Đã xác nhận',
        3 => 'Huỷ',
        4 => 'Thành công',
    ],
    'shipping_methods' => [
        1 => 'Giao hàng tận nơi',
        2 => 'Nhận tại cửa hàng',
    ],
    'type_buying' => [
        1 => 'Mua mặc định',
        2 => 'Mua giờ vàng',
        3 => 'Mua combo',
    ],

];
