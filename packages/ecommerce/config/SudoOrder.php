<?php 
return [

	// Hình thức thanh toán
	'payment_method' =>[
        1 => 'Thanh toán khi giao hàng(COD)',
        2 => 'Chuyển khoản ngân hàng',
        3 => 'Thanh toán qua thẻ ngân hàng',
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
    ]

];