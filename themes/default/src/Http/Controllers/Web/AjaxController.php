<?php

namespace Sudo\Theme\Http\Controllers\Web;

use Illuminate\Http\Request;
use Sudo\Contact\Models\Contact;
use App\Mail\AdminContactSuccess;
use Mail;
use Sudo\EmailRegister\Models\EmailRegister;
use Session;
use Sudo\Post\Models\Post;
use Sudo\Ecommerce\Models\Product;
use Sudo\Ecommerce\Models\ProductCategory;
use Sudo\Ecommerce\Models\Order;
use Sudo\Ecommerce\Models\OrderDetail;
use Sudo\Theme\Models\FormTracking;

class AjaxController extends Controller
{
	
	public function contact(Request $requests)
	{
		$config_email = getOption('email');
		extract($requests->all(), EXTR_OVERWRITE);
		try{
			if($type == 'register'){
				$data = [
                    'name' => $name ?? '',
                    'phone' => $phone ?? '',
                    'email' => '',
                    'content' => 'Yêu cầu tư vấn',
                    'status' => 1,
                ];
                Contact::add($data);
				$message = 'Gửi yêu cầu tư vấn thành công!';
			} elseif($type == 'contact'){
				$data = [
					'name' => $name ?? '',
					'phone' => $phone ?? '',
					'email' => $email ?? '',
					'content' => $content ?? '',
					'status' => 1,
				];
				Contact::add($data);		
				$message = 'Gửi thông tin liên hệ thành công!';
			}
			if (isset($config_email['smtp_email_reply_to']) && ($config_email['smtp_email_reply_to'] != '')) {
                try {
                    $email_admin = $config_email['smtp_email_reply_to'];
                    Mail::to($email_admin)->send(new AdminContactSuccess($data));
                } catch (\Exception $e) {
                    \Log::info('Gửi mail yêu cầu thất bại '.$e);                                
                }
            }
			return [
				'status' => 1,
				'message' => $message
			];
		} catch (Exception $e) {
			return [
				'status' => 0,
				'message' => 'Đã có lỗi xảy ra, vui lòng thử lại sau!'
			];
		}

	}
	public function loadDistrict(Request $request) {
		$districts = District::where('province_id', $request->id)->pluck('name', 'id')->toArray();
		return $districts;
	}
	public function loadWard(Request $request) {
		$wards = Ward::where('district_id', $request->id)->pluck('name', 'id')->toArray();
		return $wards;
	}
    public function addCompare(Request $request) {
        extract($request->all(), EXTR_OVERWRITE);
        $old_compares = Session::get('compare') ?? [];
        $render = View('Default::web.products.compare',[
            'compares' => $old_compares,
        ])->render();
        if(count($old_compares) > 0) {
            foreach ($old_compares as $key => $value) {
                $category_id = $value['cate_id'] ?? 0;
            }
            if($category_id != $cate_id) {
                return [
                    'status' => 2,
                    'html' => $render,
                    'message' => 'Sản phẩm được chọn không cùng danh mục!'
                ];
            }
        }
        if(count($old_compares) >= 3) {
            return [
                'status' => 2,
                'html' => $render,
                'message' => 'Đã có 3 sản phẩm trong so sánh!'
            ];
        }
        if(isset($old_compares[$id])) {
            return [
                'status' => 2,
                'html' => $render,
                'message' => 'Sản phẩm này đã có!'
            ];
        }
        if(isset($id) && $id > 0) {
            $old_compares[$id] = [
                'id' => $id,
                'name' => $name,
                'price' => $price,
                'image' => $image,
                'cate_id' => $cate_id,
            ];
            Session::put('compare', $old_compares);
            $render = View('Default::web.products.compare',[
                'compares' => $old_compares,
            ])->render();
            return [
                'status' => 1,
                'html' => $render,
                'message' => 'Thêm vào so sánh thành công!'
            ];
        }
    }
    public function removeCompare(Request $request) {
        extract($request->all(), EXTR_OVERWRITE);
        $old_compares = Session::get('compare') ?? [];
        unset($old_compares[$id]);
        Session::put('compare', $old_compares);
        if($page == 'compare') {
            return [
                'status' => 1,
                'link' => route('app.products.compare')
            ];
        }
        $render = View('Default::web.products.compare',[
            'compares' => $old_compares,
        ])->render();
        return [
            'status' => 1,
            'html' => $render,
            'message' => 'Thêm vào so sánh thành công!'
        ];
    }
    public function loadPostSearch(Request $request) {
        extract($request->all(), EXTR_OVERWRITE);
        $date = date('Y-m-d H:i:s');
        $post_search = Post::with(['postCategoryMap.category', 'adminUser'])
                ->where('posts.status', 1)
                ->select('posts.*')
                ->distinct('posts.id')
                ->where('id', '<', $id)
                ->where('created_at', '<=', $date)
                ->orderBy('id', 'desc');
        $count_post = $post_search->count();
        $posts = $post_search->limit(16)->get();
        $html = view('Default::web.layouts.post-item')->with([
            'posts' => $posts,              
            'count_post' => $count_post,                
        ])->render();
        return response()->json(['html'=>$html,'status'=>'1']);
    }
    public function phoneOrder(Request $request)
    {
        extract($request->all(), EXTR_OVERWRITE);
        $type = 2;
        try {
            $product = Product::where('id', $product_id)
                ->active()
                ->first();
            if(!$product) {
                return [
                    'status'  => 0,
                    'type'    => 'error',
                    'message' => 'Sản phẩm không tồn tại, vui lòng thử lại sau!'
                ];
            }
            $codeOrder = randomCodeOrder();
            $created_at = $updated_at = date('Y-m-d H:i:s');
            $price = $product->getPrice();
            $order = [
                'customer_id' => 0,
                'code' => $codeOrder,
                'total_price' => $price,
                'note' => '',
                'status' => $status??1,
                'type' => $type??2,
                'phone_number' => $phone??'',
                "created_at" => $created_at,
                "updated_at" => $updated_at,
            ];
            $order_id = Order::insertGetId($order);
            $order_details[] = [
                'order_id' => $order_id,
                'product_id' => $product_id,
                'price' => $price,
                'quantity' => 1,
            ];
            OrderDetail::insert($order_details);
            $form_tracking = [
                'type' => 'orders',
                'type_id' => $order_id,
            ];
            FormTracking::add($form_tracking);
            return [
                'message' => 'Thành công! Chúng tôi sẽ gọi lại cho bạn!',
            ];
        } catch (\Exception $e) {
            \Log::error('Add Cart Error '.$e->getMessage());
            return [
                'status'  => 0,
                'type'    => 'error',
                'message' => 'Có lỗi xảy ra, vui lòng thử lại sau!'
            ];
        }
    }

}
