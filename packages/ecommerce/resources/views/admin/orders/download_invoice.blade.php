<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            html, body {
                background-color: #fff;
                color: #313131;
                font-family: DejaVu Sans, sans-serif;
                font-weight: 100;
                margin: 0;
            }
            .container{
                width: 90%;
                margin: 50px auto;
                padding: 20px;
                box-sizing: border-box;
                border: 1px solid #ddd;
            }
            .default{
                width: 100%;
            }
            .header .logo{
                width: 200px;
                display: inline-block;
            }
            .header img{
                width: 100%;
                padding-top: 15px;
            }
            .header .created{
                width: 300px;
                margin-top: 15px;
                margin-left: 50px;
                box-sizing: border-box;
                display: inline-block;
            }
            .header .created p{
                line-height: 10px;
                width: 100%;
                display: block;
            }
            .infomation{
                margin-top: 20px;
            }
            .infomation span{
                font-weight: normal;
            }
            .infomation span,
            .infomation p{
                width: fit-content !important;
                margin: 0;
                line-height: 16px;
                margin-bottom:10px;
                color:#3c4043;
            }
            .payment-method{
                margin-top: 20px;
                margin-bottom:40px;
            }
            .info-product table,
            .payment-method table{
                width: 100%;
                border-collapse: collapse;
            }
            .info-product thead,
            .payment-method thead{
                background: #f1f1f1;
                border-bottom: 1px solid #ddd;
            }
            .info-product th,
            .payment-method th{
                text-align: left;
                font-size: 18px;
                padding: 20px;
                box-sizing: border-box;
                border: 1px solid #ddd;
            }
            .info-product td,
            .payment-method td{
                border:1px solid #ccc;
                padding: 10px;
                box-sizing: border-box;
            }
            .info-product{
                margin-top: 10px;
                border-bottom: 1px solid #ddd;
            }
            .total-price {
                padding-left:20px;
                margin-top: 20px;
            }
            .total-price p{
                font-weight: bold;
                font-size: 18px;
                line-height: 20px;
                color:#AD1023;
            }
            tbody th{
                font-weight: normal;
                font-size: 15px;
            }
            .bold{
                font-weight: bold;
            }
            .fw-700{
                font-weight: 700;
            }
            .line_1{
                margin-bottom:10px;
            }
            .line_1 p{
                display: inline-block;
                margin:0 !important;
                width: 49% !important;
            }
            .fs-20{
                font-size:20px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header default">
                <div class="logo">
                    <img src="{{env('APP_URL').'/assets/images/logo-order.png'}}" alt="">
                </div>
                <div class="created">
                    <p class="bold">Invoice: {!! $order->code??'' !!}</p>
                    <p class="bold">Created: {!! date('Y-m-d H:i:s', strtotime($order->created_at)) !!}</p>
                </div>
            </div>
            <div class="infomation default">
                <p class="bold fs-20">{!! $customer->name??'' !!}</p>
                <div class="line_1">
                    <p class="fw-700"><span>@lang('Địa chỉ: ')</span>{!! $customer->address??'' !!}</p>
                    <p class="fw-700"><span>@lang('Mã đơn hàng:') </span> {!! $order->code??'' !!}</p>
                </div>
                <p class="fw-700"><span>@lang('Điện thoại:') </span> {!! $customer->phone??'' !!}</p>
                <p class="fw-700"><span>@lang('Email:') </span> {!! $customer->email??'' !!}</p>
            </div>
            <div class="payment-method default">
                <table>
                    <thead>
                        <tr>
                            <th>@lang('Phương thức thanh toán')</th>
                            <th>@lang('Trạng thái thanh toán')</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>{!! config('SudoOrder.payment_method')[$order->payment_method] !!}</td>
                            <th>{!! __(config('SudoOrder.payment_status')[$order->payment_status]) !!}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="info-product default">
                <table>
                    <thead>
                        <tr>
                            <th>@lang('Sản phẩm')</th>
                            <th>@lang('Số lượng')</th>
                            <th>@lang('Giá')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($order_detail as $value)
                        @php
                            $products = DB::table('products')->where('id', $value->product_id)->first();
                            $total = $total + $value->price*$value->quantity;
                        @endphp
                        <tr>
                            <th>{!! $products->name??'' !!}</th>
                            <th>{!! $value->quantity??'' !!}</th>
                            <th>
                                {!! number_format($value->price * $value->quantity) !!}
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="total-price default">
                <p>@lang('Tổng tiền'): {!! number_format($total) !!}</p>
            </div>
        </div>
    </body>
</html>