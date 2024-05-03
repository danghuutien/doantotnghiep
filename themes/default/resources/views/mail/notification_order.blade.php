<div marginwidth="0" marginheight="0" style="padding:0">
	<div dir="ltr" style="background-color:#f5f5f5;margin:0;padding:70px 0;width:100%">
        @php
            $payment_method = config('SudoOrder')['payment_method'];
        @endphp
        <table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color:#fdfdfd;border:1px solid #dcdcdc;border-radius:3px;margin: 0 auto;padding: 15px 0;">
            <tbody>
                <tr>
                    <td>
                        <img style="display: block;margin: 0 auto;" src="https://example.sudospaces.com/haledco/2021/08/haled-store.png" alt="{{ env('APP_NAME', 'Toshiko') }}">
                        <p style="padding: 0 20px">Chào Quý khách, cảm ơn Quý khách đã đặt hàng tại {{ env('APP_NAME', 'Toshiko') }}</p>
                    </td>
                </tr>
                <tr style="padding: 0 10px;display: block;">
                     
                    <td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;display: block;width: 100%">
                        <h2 style="text-align:left;margin:10px;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px;color:#078546">THÔNG TIN ĐƠN HÀNG #{!! getOrderCode($order['id'] ?? '') !!} ({!!date('d/m/Y H:m:i', strtotime($order['created_at'] ?? ''))!!})
                        </h2> 
                        <table style="display: block;" width="100%" cellspacing="0" cellpadding="0" border="0">
                            <thead>
                                <tr>
                                    <th style="padding:6px 9px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%" align="left">Thông tin thanh toán
                                    </th>
                                    <th style="padding:6px 9px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%" align="left">Địa chỉ giao hàng
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="padding:3px 9px 9px 9px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">                              
                                      <span style="text-transform:capitalize">{{ $user['name'] ?? ''}}</span>
                                      <br>  <a href="mailto:{{ $user['email'] ?? '' }}" target="_blank">{{ $user['email'] ?? '' }}</a>
                                      <br>  {{ $user['phone'] ?? ''}}                              
                                    </td>
                                    <td style="padding:3px 9px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">
                                        {{ $user['name'] ?? ''}}
                                        <br>
                                        {{ $user['address'] ?? ''}}
                                        <br>
                                        {{ $user['phone'] ?? ''}}   
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:7px 9px 0px 9px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444" colspan="2" valign="top">
                                        <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:normal">
                                        <br>
                                        <b>Phí vận chuyển: </b>{{formatPrice($order['shipping_fee'] ?? '')}}                                        
                                        <br>
                                        <b>Phương thức thanh toán: </b>{{$payment_method[$order['payment_method'] ?? 1]}}{{--                                 
                                        <br>
                                        <b>Xuất hóa đơn điện tử: </b>{{$order->user_name ?? ''}}
                                        <br> -------
                                        <br> {{$user_address->getAddress() ?? ''}} --}}
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr style="padding: 0 20px;display: block;">
                    <td style="display: block;width: 100%">
                        <h2 style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px;color:#078546">CHI TIẾT ĐƠN HÀNG #{!! getOrderCode($order['id']) !!}
                        </h2>      
                        <table style="background:#f5f5f5" width="100%" cellspacing="0" cellpadding="0" border="0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th style="padding:6px 9px;color:#fff;text-transform:uppercase;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px" bgcolor="#078546" align="left">Sản phẩm</th>
                                    <th style="padding:6px 9px;color:#fff;text-transform:uppercase;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px" bgcolor="#078546" align="left"> Đơn giá</th>
                                    <th style="padding:6px 9px;color:#fff;text-transform:uppercase;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px" bgcolor="#078546" align="left">Số lượng</th>
                                    <th style="padding:6px 9px;color:#fff;text-transform:uppercase;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px" bgcolor="#078546" align="right">Tổng tạm</th>
                                </tr>
                            </thead>

                            <tbody style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" bgcolor="#eee">
                                @php
                                    $total_price = 0;
                                @endphp
                                @foreach ($data_insert as $order_detail)
                                    @php
                                        $price = $order_detail['price'] ?? 0;
                                        $quantity = $order_detail['quantity'] ?? 0;
                                        $provisional_price = $price*$quantity;
                                        $total_price = $total_price+($price*$quantity);
                                        $product = DB::table('products')->where('id', $order_detail['product_id'])->first();
                                    @endphp                                
                                    <tr>
                                        <td></td>
                                        <td style="padding:3px 9px" valign="top" align="left">
                                            <b>{!!$product->name ?? ''!!}
                                                @if(!empty($order_detail['variant_text']))
                                                    @php
                                                        $variant_text = json_decode($order_detail['variant_text'], 1);
                                                    @endphp
                                                        @if(isset($variant_text['attibute']))
                                                        @foreach($variant_text['attibute'] as $v)
                                                            - <span class="attribute" style="margin-bottom: 2px;">{!! $v??'' !!}</span>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            </b>
                                        </td>                    
                                        <td style="padding:3px 9px" valign="top" align="left"><span>{!!formatPrice($order_detail['price'] ?? '')!!}</span></td>
                                        <td style="padding:3px 9px" valign="top" align="left">{{ $order_detail['quantity'] ?? '0' }}</td>
                                        <td style="padding:3px 9px" valign="top" align="right">
                                            <span>{!! formatPrice($provisional_price ?? '') !!}</span>              
                                        </td>
                                    </tr> 
                                @endforeach   
                            </tbody>  
                            <tfoot style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
                                @if(isset($order['voucher_value']) && !empty($order['voucher_value']))
                                    <tr>
                                        <td colspan="4" style="padding:5px 9px" align="right">Mã giảm giá: </td>
                                        <td style="padding:5px 9px" align="right"><span>{!!formatPrice($order['voucher_value'])!!}</span></td>
                                    </tr>
                                @endif
                                <tr>
                                    <td colspan="4" style="padding:5px 9px" align="right">Chi phí vận chuyển</td>
                                    <td style="padding:5px 9px" align="right"><span>{{formatPrice($order['shipping_fee'] ?? '')}}</span></td>
                                </tr>                                
                                <tr bgcolor="#eee">
                                    <td colspan="4" style="padding:7px 9px" align="right"><b><big>Tổng tiền</big></b></td>
                                    <td style="padding:7px 9px" align="right"><b><big><span>{{ formatPrice($order['total_price'] + $order['shipping_fee'] ?? 0) }}</span></big></b></td>
                                </tr>
                            </tfoot>
                        </table>
                    </td>
                </tr>
                <tr style="display: block;padding: 0 20px;">
                    <td>
                        <p>Liên hệ hotline {{$config_general['hotline'] ?? '1800 0072'}} (miễn phí) để gặp nhân viên chăm sóc khách hàng khi quý khách cần hỗ trợ.</p>                        
                        <p>{{ env('APP_NAME', 'Toshiko') }} cảm ơn Quý khách.</p>
                    </td>
                <tr>
            </tbody>
        </table>
	</div>
</div>
