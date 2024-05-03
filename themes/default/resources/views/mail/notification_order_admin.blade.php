<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	<div class="container"> 
		<h3>Thông tin đơn hàng</h3>
		<p style="line-height: 22px;"><span style="font-weight: bold;">Họ tên:</span>{{ $user['name'] ?? '' }}</p>
		<p style="line-height: 22px;"><span style="font-weight: bold;">Số điện thoại:</span>{{ $user['phone'] ?? '' }}</p>
		<p style="line-height: 22px;"><span style="font-weight: bold;">Địa chỉ:</span>{{ $user['address'] ?? '' }}</p>
		<p style="line-height: 22px;"><span style="font-weight: bold;">Tổng tiền:</span>{{ formatPrice($order['total_price']) }}</p>
		<p style="line-height: 22px;"><span style="font-weight: bold;">Xem chi tiết: <b><a href="{{ route('admin.orders.show', $order['id'] ?? 0) }}" target="_blank">Tại đây</a></p>
	</div>
</body>
</html>
