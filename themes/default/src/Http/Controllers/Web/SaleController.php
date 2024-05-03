<?php

namespace Sudo\Theme\Http\Controllers\Web;

use Illuminate\Http\Request;
use Sudo\Ecommerce\Models\Product;
use Sudo\GoldenTime\Models\GoldenTime;
use Sudo\Theme\Models\Province;
use Sudo\Theme\Models\District;
use Sudo\Theme\Models\Ward;
use Cart;
use DB;
use Session;
use App\Mail\notificationOrderAdmin;
use Mail;
use Sudo\Ecommerce\Models\Order;
use Sudo\Ecommerce\Models\Customer;
use Sudo\Ecommerce\Models\OrderDetail;
use Sudo\Voucher\Models\Voucher;
use Sudo\Theme\helpers\OnePay;
use Sudo\Theme\Models\FormTracking;

class SaleController extends Controller
{
    public function index($installment = null) {
        \Asset::addStyle(['sale'])
            ->addScript(['sale']);
        $carts = Cart::content();
        $provinces = Province::all();
        $payment_methods = config('SudoOrder')['payment_method'] ?? [];
        $meta_seo = metaSeo('', '', [
            'title' => 'Giỏ hàng',
            'description' => 'Giỏ hàng',
            'image' => getImage(),
        ]);
        $voucherActive = Session::get('voucher');
        $price_sale = $voucherActive['result']['sale_price_format'] ?? '0';
        $breadcrumb = [
            [
                'name' => __('Giỏ hàng'),
                'link' => route('app.sale.index')
            ]
        ];
        $vouchers = Voucher::where('status', 1)
            ->where('start_time', '<', date('Y-m-d H:i:s'))
            ->where('end_time', '>', date('Y-m-d H:i:s'))
            ->whereColumn('limit', '>', 'used')
            ->where('min_order', '<=', totalCart(false))
            ->get();
        $voucherActive = $voucherActive['voucher'] ?? '';
        if($installment !== null && $installment !== 'installment') {
            return redirect(route('app.sale.index'));
        }
        $checkInstallment = true;
        foreach ($carts as $key => $value) {
            $product = $value->options->product;
            if(!$product->checkInstallment()) {
                $checkInstallment = false;
            }
        }
        // nếu truy cập link TG nhưng có sp k cho phép TG thì dẫn về link bt
        if($installment === 'installment' && $checkInstallment == false) {
            return redirect(route('app.sale.index'));
        }
        return view('Default::web.sale.index', compact('meta_seo', 'carts', 'payment_methods', 'price_sale', 'breadcrumb', 'provinces', 'vouchers', 'voucherActive', 'installment', 'checkInstallment'));
    }

    public function payment(Request $request) {
        DB::beginTransaction();
        try {
            $setting_mail = getOption('email');
            $carts = Cart::content();
            if(!empty($carts) && Cart::count() > 0){
                $created_at = $updated_at = date('Y-m-d H:i:s');
                extract($request->all(), EXTR_OVERWRITE);
                validateForm($request, 'name', 'Họ tên không được để trống!');
                validateForm($request, 'phone', 'Số điện thoại không được để trống!');
                validateForm($request, 'province_id', 'Tỉnh thành không được để trống!');
                validateForm($request, 'district_id', 'Quận huyện không được để trống!');
                validateForm($request, 'ward_id', 'Phường xã không được để trống!');
                if($shipping_method == 1){
                    validateForm($request, 'address', 'Địa chỉ không được để trống!');
                }
                validateForm($request, 'payment_method', 'Phương thức thanh toán không được để trống!');
                $payment_method = intval($payment_method);
                if(!array_key_exists($payment_method, config('SudoOrder.payment_method'))) {
                    return redirect()->back()->withErrors('Phương thức thanh toán không hợp lệ!');
                }

                $customer = removeScriptArray([
                    "name" => $name,
                    "phone" => $phone,
                    "gender" => intval($gender ?? 1),
                    "province_id" => $province_id,
                    "district_id" => $district_id,
                    "ward_id" => $ward_id,
                    "address" => $address,
                    "created_at" => $created_at,
                    "updated_at" => $updated_at,
                ]);
                $customer_id = Customer::insertGetId($customer);
                $total_price = totalCart();
                $voucher_cart = Session::get('voucher');
                if(!empty($voucher_cart)) {
                    $voucher_item = $voucher_cart['voucher'];
                    $voucher_value = $voucher_cart['result']['sale_price'] ?? 0;
                }
                $codeOrder = randomCodeOrder();
                $order = [
                    'customer_id' => $customer_id,
                    'code' => $codeOrder,
                    'total_price' => $total_price,
                    'note' => removeScript($note??''),
                    'voucher_code' => $voucher_item->code ?? '',
                    'voucher_value' => $voucher_value ?? 0,
                    'payment_method' => $payment_method ?? 1,
                    'shipping_method' => $shipping_method ?? 1,
                    'phone_number' => $phone ?? '',
                    'status' => $status??1,
                    "created_at" => $created_at,
                    "updated_at" => $updated_at,
                ];
                $order_id = Order::insertGetId($order);
                $order_details=[];
                $date = date('Y-m-d H:i:s');
                $golden_time = GoldenTime::where('start_time', '<=', $date)->Where('end_time', '>=', $date)->where('status', 1)->orderBy('id', 'desc')->first();
                foreach($carts as $item) {
                    $product = $item->options->product;
                    switch($item->options->type){
                        case(1):
                            $checkStock = $product->getStok($item->qty);
                            if($checkStock) {
                                $order_details[] = [
                                    'gift_products' => '',
                                    'gift_other' => '',
                                    'order_id' => $order_id,
                                    'product_id' => $item->id,
                                    'type'=>1,
                                    'price' => $item->price,
                                    'quantity' => $item->qty,
                                ];
                                $product->updateQuantity($item->qty);
                            }
                            // Update SL bán
                        case(2):
                            !empty($golden_time) ? $goldenTimeProduct = $golden_time->goldenTimeProduct->where('product_id', $product->id)->first() : null;
                            if(!empty($goldenTimeProduct)){
                                $checkStockGoldentime = $goldenTimeProduct->getStok($item->qty);
                                if($checkStockGoldentime) {
                                    $order_details[] = [
                                        'gift_products'=>$item->options->product_gifts ?? '',
                                        'gift_other'=>$item->options->product_gift_texts ?? '',
                                        'type'=>2,
                                        'order_id' => $order_id,
                                        'product_id' => $item->id,
                                        'price' => $item->price,
                                        'quantity' => $item->qty,
                                    ];
                                    // Update SL bán
                                    $goldenTimeProduct->updateQuantity($item->qty);
                                    $product->updateQuantity($item->qty);
                                }
                            }
                        break;
                        case(3):
                            $checkStock = $product->getStok($item->qty);
                            if($checkStock) {
                                $order_details[] = [
                                    'gift_products' => '',
                                    'gift_other' => '',
                                    'order_id' => $order_id,
                                    'product_id' => $item->id,
                                    'type'=>3,
                                    'price' => $item->price,
                                    'quantity' => $item->qty,
                                ];
                                // Update SL bán
                                $product->updateQuantity($item->qty);
                            }
                        break;
                    }
                }
                if(!count($order_details)) {
                    return redirect()->back()->withErrors('Sản phẩm tạm hết hàng, vui lòng chọn sản phẩm khác!');
                }
                $order['id'] = $order_id;
                OrderDetail::insert($order_details);
                if($payment_method === 1) {
                    try {
                        $setting_mail = getOption('email');
                        $email_admin = $setting_mail['smtp_email_reply_to'] ?? '';
                        if (!empty($email_admin)) {
                            \Log::info('start send mail to admin after order');
                            Mail::to($email_admin)->send(new notificationOrderAdmin($order, $order_details, $customer));
                        }
                    } catch (Exception $e) {
                        \Log::error('Send mail order faild'.$e->getMessage());
                    }
                }
                $voucher_cart = Session::has('voucher') ? Session::get('voucher') : [];
                if(count($voucher_cart) > 0) {
                    $voucher = Voucher::where('code', $voucher_cart['voucher']->code ?? '')->first();
                    if(!empty($voucher)) {
                        $voucher->update(['used' => $voucher->used+1]);
                    }
                }
                if($payment_method === 1 || $payment_method === 3) {
                    Cart::destroy();
                    Session::forget('voucher');
                }
                $form_tracking = [
                    'type' => 'orders',
                    'type_id' => $order_id,
                ];
                FormTracking::add($form_tracking);
                DB::commit();
                if($payment_method === 1){ // TT khi nhận hàng
                    return redirect(route('app.sale.success', $codeOrder));
                } else if($payment_method === 3) {
                    return redirect(route('app.sale.installment', $codeOrder));
                } else if(in_array($payment_method, [2, 4, 5])){ // TT online
                    switch ($payment_method) {
                        case 2:
                            $vpc_CardList = 'DOMESTIC';
                        break;
                        case 4:
                            $vpc_CardList = 'INTERNATIONAL'; // visa
                        break;
                        case 5:
                            $vpc_CardList = 'QR';
                        break;
                        default:
                            $vpc_CardList = 'DOMESTIC';
                        break;
                    }
                    $onepay = new OnePay();
                    $data_onePay = [
                        'AgainLink' => route('app.sale.payment'),
                        'Title' => 'Thanh toán OnePay',
                        'vpc_Amount' => $total_price*100,
                        'vpc_Command' => 'pay',
                        'vpc_Locale' => 'vn',
                        'vpc_MerchTxnRef' => $codeOrder,
                        'vpc_OrderInfo' => $codeOrder,
                        'vpc_ReturnURL' => route('app.sale.success', $codeOrder),
                        'vpc_TicketNo' => getClientIp(),
                        'vpc_Version' => 2,
                        'vpc_CardList' => $vpc_CardList
                    ];
                    $vpcURL = $onepay->createOnePayLink($data_onePay);
                    return redirect($vpcURL);
                }
            } else {
                return redirect()->route('app.home');
            }
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error('Order faild '.$e->getMessage());
            return redirect()->route('app.home');
        }
    }

    public function installment($code) {
        $order = Order::where('code', $code)
            ->with('customer','orderDetail')
            ->where('payment_method', 3) // TT TG
            ->where('payment_status', 0) // Chưa TT
            ->whereNull('onepay_code') // Chưa TT
            ->firstOrFail();
        \Asset::addStyle(['sale'])
            ->addScript(['sale']);
        $onepay = new OnePay();
        $signature = $onepay->CreateRequestSignature($order->total_price);
        $breadcrumb = [
            [
                'name' => __('Trả góp'),
                'link' => route('app.sale.installment', $code)
            ],
        ];
        $meta_seo = metaSeo('','',[
            'title' =>  __('Trả góp'),
            'description' => __('Trả góp'),
            'image' => getImage(),
            'robots' => 'Noindex'
        ]);
        return view('Default::web.sale.installment.index',compact('breadcrumb','meta_seo','signature', 'order'));
    }

    public function installmentPost($code, Request $requests){
        validateForm($requests, 'installment_bank', 'Vui lòng chọn ngân hàng trả góp!');
        validateForm($requests, 'installment_card_type', 'Vui lòng chọn loại thẻ!');
        validateForm($requests, 'choose_cycle', 'Vui lòng chọn gói trả góp!');
        try {
            $order = Order::where('code', $code)
            ->where('payment_method', 3) // TT TG
            ->where('payment_status', 0) // Chưa TT
            ->whereNull('onepay_code') // Chưa TT
            ->with('customer','orderDetail')->firstOrFail();
            $order->update([ 'onepay_code'=> $code ]);
            $data_form = $requests->all();
            extract($data_form,EXTR_OVERWRITE); // đưa mảng về các biến có tên là các key của mảng

            $totalAmout = $order->total_price;
            $codeOrder = $order->code;
            $onepay = new Onepay();
            $loadFeeAmount = $onepay->loadBank([
                'signature' => $requests->signature ?? '',
                'amount' => $totalAmout
            ]);
            $list_bank = json_decode($loadFeeAmount)->installments;
            $vpc_ItaFeeAmount = '';
            foreach ($list_bank as $key => $value) {
                if ($value->bank_id == $requests->installment_bank) {
                    foreach ($value->cards as $card) {
                        if($card->type == $requests->installment_card_type){
                            foreach($card->times as $v){
                                if($v->time == $requests->choose_cycle){
                                    $vpc_ItaFeeAmount = $v->fee_amount;
                                }
                            }
                        }
                    }
                }
            }
            $data_onePay = [
                'AgainLink' => route('app.sale.installment', $code),
                'Title' => __('Trả góp qua OnePay'),
                'vpc_Amount' => (int)$totalAmout*100,
                'vpc_Command' => 'pay',
                'vpc_Locale' => 'vn',
                'vpc_MerchTxnRef' => $codeOrder,
                'vpc_OrderInfo' => $codeOrder,
                'vpc_ReturnURL' => route('app.sale.success', $codeOrder),
                'vpc_TicketNo' => getClientIp(),
                'vpc_Version' => 2,
                'vpc_Theme' => 'ita',
                'vpc_CardList' => $requests->installment_card_type ?? '',
                'vpc_ItaBank' => $requests->installment_bank ?? '',
                'vpc_ItaTime' => $requests->choose_cycle ?? '0',
                'vpc_ItaFeeAmount' => (int)$vpc_ItaFeeAmount*100 ?? '0',

            ];
            $vpcURL = $onepay->createOnePayInstallmentLink($data_onePay);
            if(is_array($vpcURL) && isset($vpcURL['status'])) {
                return redirect()->back()->withErrors('Có lỗi xảy ra trong tuần tự xử lý, Vui lòng thử lại!');
            }
            return redirect($vpcURL);
        } catch (\Exception $e) {
            \Log::error('installmentPost error '.$e->getMessage());
            return redirect()->back()->withErrors('Có lỗi xảy ra trong tuần tự xử lý, Vui lòng thử lại!');
        }
    }

    public function loadBankOnePay(Request $request){
        $onepay = new Onepay();
        $result = $onepay->loadBank($request);

        $list_bank = json_decode($result)->installments ?? [];
        $str_bank = '';
        foreach ($list_bank as $key => $value) {
            $cards = $value->cards;
            $type = array_column($cards, 'type');
            if(array_key_exists($value->bank_id, config('onepay.code_bank'))){
                foreach ($cards as $k => $v) {
                    $month = array_column($v->times, 'time');
                }
                $str_bank .= '<div class="installment-bank__item" data-id="' . $value->bank_id . '" data-cycle="' . implode(',', $month) . '" data-card-type="' . strtoupper(implode(',', $type)) . '">
                    <img src="/assets/img_bank/' . $value->bank_id . '.png" alt="">
                </div>';
            }
        }
        return $str_bank;
    }
    public function getInstallmentOnepay(Request $request){
        $product_id = $request->product_id;
        $bank_code = $request->bank_code;
        $card_type = $request->card_type;
        $cycle = $request->cycle;
        $price = $request->amount;
        $cycle = explode(',', $cycle);

        $onepay = new Onepay();
        $result_onepay = json_decode($onepay->loadBank($request));
        foreach ($result_onepay->installments as $key => $value) {
            if($value->bank_id == $bank_code){
                foreach($value->cards as $k => $v){
                    if(strtolower($v->type) == strtolower($card_type)){
                        $bank = $v;
                    }
                }
            }
        }
        $data_onepay = [];
        foreach ($bank->times as $value) {
            $data_onepay[$value->time]['time'] =$value->time;
            $data_onepay[$value->time]['monthly'] = $value->monthly_amount;
            $data_onepay[$value->time]['fee'] = $value->fee_amount;
        }
        $result['status'] = 1;
        $code_bank = config('onepay.code_bank');
        $result['html'] = view('Default::web.sale.installment.get_installment', compact('bank_code', 'card_type', 'cycle', 'price','data_onepay', 'code_bank'))->render();
        return $result;
    }
    public function paymentBack($code, Request $request)
    {
        $order = Order::where('code', $code)
            ->with('customer','orderDetail')
            ->whereIn('payment_method', [2,4,5]) 
            ->where('payment_status', 0) // Chưa TT
            ->firstOrFail();
        \Asset::addStyle(['sale'])
            ->addScript(['sale']);
        switch ($order->payment_method) {
            case 2:
                $vpc_CardList = 'DOMESTIC';
            break;
            case 4:
                $vpc_CardList = 'INTERNATIONAL'; // visa
            break;
            case 5:
                $vpc_CardList = 'QR';
            break;
            default:
                $vpc_CardList = 'DOMESTIC';
            break;
        }
        $newCode = randomCodeOrder();
        $order->update(['code' => $newCode]);
        $onepay = new OnePay();
        $data_onePay = [
            'AgainLink' => route('app.sale.payment'),
            'Title' => 'Thanh toán OnePay',
            'vpc_Amount' => $order->total_price,
            'vpc_Command' => 'pay',
            'vpc_Locale' => 'vn',
            'vpc_MerchTxnRef' => $newCode,
            'vpc_OrderInfo' => $newCode,
            'vpc_ReturnURL' => route('app.sale.success', $newCode),
            'vpc_TicketNo' => getClientIp(),
            'vpc_Version' => 2,
            'vpc_CardList' => $vpc_CardList
        ];
        $vpcURL = $onepay->createOnePayLink($data_onePay);
        return redirect($vpcURL);
    }
    public function success($code,Request $request){
        \Asset::addStyle(['sale']);
        $order = Order::where('code', $code)->with('customer','orderDetail')->firstOrFail();
        $onepay = new OnePay();
        $onepayResponse = $onepay->onePayResponse($request->all());
        if($onepayResponse['status'] == 'CORRECT'){
            Cart::destroy();
            Session::forget('voucher');
            DB::table('orders')->where('code',$onepayResponse['order_code'])->update([
                'payment_status'=> $onepayResponse['payment_status']
            ]);
            $order = Order::where('code', $code)->with('customer','orderDetail')->firstOrFail();
        }
        $payment_methods = config('SudoOrder')['payment_method'] ?? [];
        $meta_seo = metaSeo('', '', [
            'title' => __('Đặt hàng thành công'),
            'description' => __('Đặt hàng thành công'),
            'image' => getImage(),
            'robots' => 'Noindex'
        ]);
        $breadcrumb = [
            [
                'name' => __('Đặt hàng thành công'),
                'link' => route('app.sale.success', $code)
            ]
        ];
        return view('Default::web.sale.success', compact('meta_seo', 'payment_methods', 'order', 'breadcrumb'));
    }
}
