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
    <h3>{{ __('Thông báo có yêu cầu tư vấn mới') }}</h3>
    <p style="line-height: 22px;"><span style="font-weight: bold;">Tên: </span>{!! $data['name'] ?? '' !!}</p>
    <p style="line-height: 22px;"><span style="font-weight: bold;">Email: </span>{!! $data['email'] ?? '' !!}</p>
    <p style="line-height: 22px;"><span style="font-weight: bold;">Số điện thoại: </span>{!! $data['phone'] ?? '' !!}</p>
    <p style="line-height: 22px;"><span style="font-weight: bold;">Địa chỉ: </span>{!! $data['address'] ?? '' !!}</p>
    <p style="line-height: 22px;"><span style="font-weight: bold;">Nội dung: </span>{!! $data['content'] ?? '' !!}</p>
</div>
</body>
</html>
