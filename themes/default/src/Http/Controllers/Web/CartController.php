<?php

namespace Sudo\Theme\Http\Controllers\Web;

use App;
use Illuminate\Http\Request;
use Sudo\Ecommerce\Models\Product;
use Sudo\GoldenTime\Models\GoldenTime;
use Sudo\Theme\Models\Province;
use Sudo\Theme\Models\District;
use Sudo\Theme\Models\Ward;
use Sudo\Voucher\Models\Voucher;
use DB;
use Cart;
use Session;
use Sudo\Voucher\Http\Controllers\VoucherController;

class CartController extends Controller
{
	public function addToCart(Request $request)
	{
		try {
            $request->type = isset($request->type) && !empty($request->type) ? $request->type : 1;
            $date = date('Y-m-d H:i:s');
            switch($request->type){
                // mua mặc định
                case(1):
                    $productId = $request->productId ?? '';
                    $product = Product::where('id', $productId)
                        ->active()
                        ->first();
                    if(!$product) {
                        return [
                            'status' => 0,
                            'type' => 'error',
                            'message' => 'Sản phẩm không tồn tại, vui lòng thử lại sau!'
                        ];
                    }
                    if(!$product->getStok()) {
                        return [
                            'status' => 0,
                            'type' => 'error',
                            'message' => 'Sản phẩm đã hết hàng!'
                        ];
                    }
                    $price = $product->getPrice();
                    Cart::add([
                        'id' => $productId,
                        'name'=> $product->getName(),
                        'weight'=> 0,
                        'price'=> $price,
                        'qty'=> 1,
                        'options' => [
                            'product' => $product,
                            'type'=>1
                        ]
                    ]);
                break;
                // mua giờ vàng
                case(2):
                    $productId = $request->productId ?? '';
                    $product = Product::where('id', $productId)
                        ->active()
                        ->first();
                    if(!$product) {
                        return [
                            'status' => 0,
                            'type' => 'error',
                            'message' => 'Sản phẩm không tồn tại, vui lòng thử lại sau!'
                        ];
                    }
                    $golden_time = GoldenTime::where('start_time', '<=', $date)
                                            ->Where('end_time', '>=', $date)
                                            ->where('status', 1)
                                            ->orderBy('id', 'desc')->first();
                    $product_gift_ids = json_decode(base64_decode($golden_time->gift_products ?? ''));
                    $product_gifts = Product::where('status', 1)->whereIn('id', $product_gift_ids ?? [])->pluck('name')->toArray();
                    $product_gift_texts = $golden_time->gift_other ??  '';            
                    !empty($golden_time) ? $goldenTimeProduct = $golden_time->goldenTimeProduct->where('product_id', $product->id)->first(): null;
                    if(isset($goldenTimeProduct) && !empty($goldenTimeProduct)){
                        if(!$goldenTimeProduct->getStok()) {
                            return [
                                'status' => 0,
                                'type' => 'error',
                                'message' => 'Sản phẩm đã hết hàng!'
                            ];
                        }else{
                            $price = $goldenTimeProduct->price;
                            Cart::add([
                                'id' => $productId,
                                'name'=> $product->getName(),
                                'weight'=> 0,
                                'price'=> $price,
                                'qty'=> 1,
                                'options' => [
                                    'product' => $product,
                                    'type'=>2,
                                    'product_gifts' => implode(', ', $product_gifts) ?? '',
                                    'product_gift_texts' => $product_gift_texts ?? ''
                                ]
                            ]);
                        }
                    }
                break;

                // mua combo
                case(3):
                    $productIdList = $request->productId ?? [];
                    $listIds = array_keys($productIdList);
                    $products = Product::whereIn('id', $listIds)
                        ->active()
                        ->get();
                    $product_main = Product::where('id', $listIds[0]??0)
                    ->active()
                    ->first();

                    if($products->isEmpty()) {
                        return [
                            'status' => 0,
                            'type' => 'error',
                            'message' => 'Sản phẩm không tồn tại, vui lòng thử lại sau!'
                        ];
                    }
                    foreach ($products as $product) {
                        $price = floatval($productIdList[$product->id]);
                        if (!$product->getStok()) {
                            return [
                                'status' => 0,
                                'type' => 'error',
                                'message' => 'Sản phẩm đã hết hàng!'
                            ];
                        }
                        $cartItems[] = [
                            'id' => $product->id,
                            'name'=> $product->getName(),
                            'weight'=> 0,
                            'price'=> $price,
                            'qty'=> 1,
                            'options' => [
                                'product' => $product,
                                'main_prd_id'=>  $product->id == $product_main->id ? $product_main->id : 0,
                                'combo_id'=>$product_main->id,
                                'type'=>3,
                                'combo_single_prd'=>$product->id == $product_main->id ? 1:0
                            ]
                        ];
                    }

                    Cart::add($cartItems);
                    break;
            }
			$totalcart = totalCart();
            $result['count'] = Cart::count();
            $result['price'] = formatPrice($totalcart);
            $redirect = route('app.sale.index');
            if(isset($request->type) && $request->type === 'Installment') {
                $redirect = route('app.sale.index', ['installment' => 'installment']);
            }
            return [
                'type' => 'success',
                'message' => 'Thêm giỏ hàng thành công!',
                'count' => Cart::count(),
                'price' => formatPrice($totalcart),
                'redirect' => $redirect,
            ];
		} catch (\Exception $e) {
			\Log::error('Add Cart Error '.$e->getMessage());
			return [
				'status' => 0,
				'type' => 'error',
				'message' => 'Có lỗi xảy ra, vui lòng thử lại sau!'
			];
		}
	}

	public function editCart(Request $request) {
        $rowId=$request->rowId;
		$type=$request->type;
        $listRowId=$request->listRowId??[];
		$cart = Cart::get($rowId);
		if($type == 'sub') {
			$qty = $cart->qty - 1;
			if(!$qty) $qty = 1;
		} else {
			$qty = $cart->qty + 1;
		}
		if($type == 'remove') {
            if(count($listRowId)>0){
                foreach($listRowId as $item){
                    Cart::remove($item);
                }
            }else{
                Cart::remove($rowId);
            }
		} else {
			Cart::update($rowId, $qty);
		}
		$carts = Cart::content();
		$count = Cart::count();
		$voucher_cart = Session::get('voucher');
		$price_sale = 0;

		if(!empty($voucher_cart)) {
			$voucher_controller = new VoucherController();
			$voucher_item = $voucher_cart['voucher'];
			$getpricevoucher = $voucher_controller->changeVoucher($voucher_item->code);
			if($getpricevoucher['status']) {
				$price_sale = $getpricevoucher['data']['sale_price_format'];
			}
		}
		$totalcart = formatPrice(totalCart());
		$voucherActive = $voucher_item ?? '';
		$vouchers = Voucher::where('status', 1)
			->where('start_time', '<', date('Y-m-d H:i:s'))
			->where('end_time', '>', date('Y-m-d H:i:s'))
			->whereColumn('limit', '>', 'used')
			->where('min_order', '<=', totalCart(false))
			->get();
        
		$html = view('Default::web.sale.table', compact('carts','price_sale', 'vouchers', 'voucherActive'))->render();
		if(!$count) {
			return [
				'status' =>1,
				'redirect' => route('app.home'),
				'html' => $html
			];
		}
		return compact('html', 'count', 'price_sale', 'totalcart');
	}

	// load for all
	public function loadDestination(Request $requests) {
		$id = $requests->id ?? 0;
		$type = $requests->type ?? 0;
		$html = '';
		switch ($type) {
			case 'province':
				$data = District::where('province_id',$id)->get();
				$html = '<option value="" >'.__('Quận/Huyện').'</option>';
			break;
			case 'district':
				$data = Ward::where('district_id',$id)->get();
				$html = '<option value="" >'.__('Phường/Xã').'</option>';
			break;
			default:
				$data = [];
			break;
		}
		if(count($data) > 0) {
			foreach ($data as $key => $value) {
				$html .= '<option value='.$value->id.'>'.$value->name.'</option>';
			}
		}
		return $html;
	}

}
