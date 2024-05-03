<?php

namespace Sudo\GoldenTime\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Sudo\Base\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use ListData;
use Form;
use File;
use Auth;
use ListCategory;
use Illuminate\Http\Response;
use Sudo\Ecommerce\Models\Product;
use Sudo\GoldenTime\Models\GoldenTimeProduct;
use Sudo\Voucher\Models\Voucher;
use Sudo\Store\Models\StoreProduct;
use Cart;

class GoldenTimeController extends AdminController
{
    function __construct()
    {
        $this->models = new \Sudo\GoldenTime\Models\GoldenTime;
        $this->table_name = $this->models->getTable();
        $this->module_name = 'giờ vàng deal sốc';
        $this->has_seo = false;
        $this->has_locale = false;
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $requests)
    { 
        $listdata = new ListData($requests, $this->models, 'GoldenTime::table.index', $this->has_locale);
        $listdata->search('created_at', 'Ngày tạo', 'range');
        $listdata->search('status', 'Trạng thái', 'array', config('app.status'));
        // Build các hành động
        $listdata->action('status');
        // Build bảng 
        $listdata->add('name', __('Tên chương trinh'), 0);
        $listdata->add('start_time', __('GoldenTime::field.start_time'), 0);
        $listdata->add('end_time', __('GoldenTime::field.end_time'), 0);
        $listdata->add('status', 'Trạng thái', 0, 'status');
        $listdata->add('', 'Language', 0, 'lang');
        $listdata->add('', 'Sửa', 0, 'edit');
        $listdata->add('', 'Xóa', 0, 'delete_custom');
        return $listdata->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Khởi tạo form
        $form = new Form;
        $form->card('col-lg-12');
            $form->lang($this->table_name);
            $form->text('name', '', 1, 'Tên chương trình');
            $form->datetimepicker('start_time', '', 1, __('GoldenTime::field.start_time'));
            $form->datetimepicker('end_time', '', 1, __('GoldenTime::field.end_time'));
            $form->custom('GoldenTime::form.add_product');
            $form->custom('Form::custom.drag_drop',
                [
                    'has_full'          => true,
                    'name'              => 'gift_products',
                    'value'             => [],
                    'required'          => 0,
                    'label'             => 'Chọn quà tặng kèm là sản phẩm',
                    'placeholder'       => 'Tìm kiếm theo tên sản phẩm',
                    'suggest_table'     => 'products',
                    'suggest_id'        => 'id',
                    'suggest_name'      => 'name',
                ]
            );
            $form->custom('Form::custom.form_custom', [
                'has_full' => false,
                'name' => 'gift_other',
                'value' => [],
                'label' => 'Quà tặng ngoài sản phẩm',
                'generate' => [
                    [ 'type' => 'image', 'name' => 'image', 'size' => 'Chọn ảnh có kích thước '.'50x50', ],
                    [ 'type' => 'text', 'name' => 'name', 'placeholder' => 'Tên quà tặng', ],
                    [ 'type' => 'text', 'name' => 'price', 'placeholder' => 'Giá trị quà tặng', ],
                ],
            ]);
        $form->endCard();
        $form->card('col-lg-12', '');
            $form->action('add');
            $form->radio('status', 1, 'Trạng thái', config('app.status'));
        $form->endCard();
        return $form->render('create_multi_col');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $requests)
    {
        $date = date('Y-m-d H:i:s');
        validateForm($requests, 'start_time', 'Thời gian bắt đầu là bắt buộc!');
        validateForm($requests, 'end_time', 'Thời gian kết thúc là bắt buộc!');
        $time_start = $requests->start_time ?? '';
        $this->validate($requests, [
            // 'start_time' => [
            //     function ($attribute, $value, $fail) use ($date) {
            //         if (strtotime($value) < strtotime($date)) {
            //             $fail('Thời gian bắt đầu không được bé hơn thời điểm hiện tại!');
            //         }
            //     },
            // ],
            'end_time'=>[
                function ($attribute, $value, $fail) use ($date, $time_start) {
                    if (strtotime($value) < strtotime($date)) {
                        $fail('Thời gian Kết thúc không được bé hơn thời điểm hiện tại!');
                    }
                    if (strtotime($value) < strtotime($time_start)) {
                        $fail('Thời gian Kết thúc không được bé hơn thời gian bắt đầu!');
                    }
                    if (date('Y-m-d', strtotime($value)) !== date('Y-m-d', strtotime($time_start))) {
                        $fail('Thời gian bắt đầu và kết thúc phải là trong ngày!');
                    }
                },
            ]
        ]);
        // Các giá trị mặc định
        $status = 0;
        $option = 1;
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        $created_at = $updated_at = date('Y-m-d H:i:s');
        if(isset($gift_other)){
            $gift_other = base64_encode(json_encode($gift_other));
        }else{
            $gift_other = null;
        }
        if(isset($gift_products)){
            $gift_products = base64_encode(json_encode($gift_products));
        }else{
            $gift_products = null;
        }
        $compact = compact('name','gift_products', 'gift_other', 'status', 'start_time', 'end_time', 'created_at', 'updated_at');
        $id = $this->models->createRecord($requests, $compact, $this->has_seo);
        $this->handleProduct($requests, $id);
        if($redirect == 'save'){
            // $status = 0;
            $redirect = 'edit';
        }
        // Điều hướng
        return redirect(route('admin.' . $this->table_name . '.' . $redirect, $id))->with([
            'type' => 'success',
            'message' => __('Translate::admin.create_success')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Dẽ liệu bản ghi hiện tại
        $data_edit = $this->models->where('id', $id)->first();
        $products = GoldenTimeProduct::with('product')->where('golden_time_id', $data_edit->id)->get();
        $gift_other = json_decode(base64_decode($data_edit->gift_other ?? ''), 1);
        $gift_products = json_decode(base64_decode($data_edit->gift_products ?? ''), 1);
        $form = new Form;
        $form->card('col-lg-12');
        $form->lang($this->table_name);
        $form->text('name', $data_edit->name, 1, 'Tên chương trình');
        $form->custom('GoldenTime::form.add_product', ['product_sale' => $products ,'sale_id' => $id, 'isGoldenTime'=>true]);

        $form->custom('Form::custom.drag_drop',
            [
                'has_full'          => true,
                'name'              => 'gift_products',
                'value'             => $gift_products,
                'required'          => 0,
                'label'             => 'Chọn quà tặng là sản phẩm',
                'placeholder'       => 'Tìm kiếm theo tên sản phẩm',
                'suggest_table'     => 'products',
                'suggest_id'        => 'id',
                'suggest_name'      => 'name',
            ]
        );
        $form->custom('Form::custom.form_custom', [
            'has_full' => false,
            'name' => 'gift_other',
            'value' => $gift_other ?? [],
            'label' => 'Quà tặng ngoài sản phẩm',
            'generate' => [
                [ 'type' => 'image', 'name' => 'image', 'size' => 'Chọn ảnh có kích thước '.'50x50', ],
                [ 'type' => 'text', 'name' => 'name', 'placeholder' => 'Tên quà tặng', ],
                [ 'type' => 'text', 'name' => 'price', 'placeholder' => 'Giá trị quà tặng', ],
            ],
        ]);
        
        $form->datetimepicker('start_time', $data_edit->start_time, 1, __('GoldenTime::field.start_time'));
        $form->datetimepicker('end_time', $data_edit->end_time, 1, __('GoldenTime::field.end_time'));
        $form->endCard();
        $form->card('col-lg-12', '');
        $form->action('edit');
        $form->radio('status', $data_edit->status, 'Trạng thái', config('app.status'));
        $form->endCard();

        // Hiển thị form tại view
        return $form->render('edit_multi_col', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $requests, $id)
    {
        // so sánh date ngày hiện tại// 

        // Xử lý validate
        validateForm($requests, 'start_time', 'Thời gian bắt đầu là bắt buộc!');
        validateForm($requests, 'end_time', 'Thời gian kết thúc là bắt buộc!');
        // Lấy bản ghi
        $data_edit = $this->models->where('id', $id)->first();
        // Các giá trị mặc định
        $status = 0;
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        if(isset($gift_other)){
            $gift_other = base64_encode(json_encode($gift_other));
        }else{
            $gift_other = null;
        }
        if(isset($gift_products)){
            $gift_products = base64_encode(json_encode($gift_products));
        }else{
            $gift_products = null;
        }
        $updated_at = date('Y-m-d H:i:s');
        $compact = compact('name','gift_other','gift_products' ,'status', 'start_time', 'end_time', 'updated_at');
        // Cập nhật tại database
        $this->models->updateRecord($requests, $id, $compact, $this->has_seo);
        $this->handleProduct($requests, $id);
        // Điều hướng
        return redirect(route('admin.' . $this->table_name . '.' . $redirect, $id))->with([
            'type' => 'success',
            'message' => __('Translate::admin.update_success')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    /**
     * Get price product after use Voucher
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function getPriceAfterVoucher(Request $request)
    {
        $code_voucher = $request->voucher ?? '';

        $cart = \Cart::content();

        $total_price = totalCart(false);

        $voucher = Voucher::where('code', $code_voucher)
            ->where('status', 1)->first();

        $result = $this->checkVoucher($voucher, $total_price);

        if (!$result['status']) {

            return response([
                'status' => $result['status'],
                'message' => $result['message']
            ]);
        }


        $result = $this->calculator($voucher, $total_price);

        if (!empty($result)) {
            $vouchers = [
                'voucher' => $voucher,
                'result' => $result,
            ];
            Session::put('voucher', $vouchers);
        }

        return response(['status' => 1, 'data' => $result ?? null, 'message' => 'Áp dụng mã giảm giá thành công!']);
    }

    public function checkVoucher($voucher, $total)
    {
        if (!$voucher) {
            return ['status' => 0, 'message' => __('Voucher::message.not_exists')];
        }

        if ($voucher->used >= $voucher->limit || $voucher->used < 0) {
            return ['status' => 0, 'message' => __('Voucher::message.has_been_used')];
        }

        if ($voucher->end_time < date('Y-m-d H:i:s')) {
            return ['status' => 0, 'message' => __('Voucher::message.time_expired')];
        }

        if (date('Y-m-d H:i:s') < $voucher->start_time) {
            return ['status' => 0, 'message' => __('Voucher::message.cant_use')];
        }

        if ($voucher->min_order > $total) {
            return ['status' => 0, 'message' => __('Voucher::message.min_order', ['min' => formatPrice($voucher->min_order)])];
        }

        if($voucher->option == 2) {
            $cart = \Cart::content();
            $productIDS = $cart->pluck('id')->toArray();
            $checkProducts = \DB::table('voucher_product_maps')
                ->where('voucher_id', $voucher->id)
                ->whereIn('product_id', $productIDS)->count();
            if(!$checkProducts) {
                $productNames = \DB::table('products')
                    ->whereIn('id', \DB::table('voucher_product_maps')
                ->where('voucher_id', $voucher->id)->pluck('product_id'))->pluck('name')->toArray();
                return ['status' => 0, 'message' => 'Mã giảm giả chỉ áp dụng cho một số sản phẩm sau: '.implode(',', $productNames)];
            }
        }

        return ['status' => 1, 'message' => ''];
    }

    public function calculator($voucher, $price)
    {
        if ($voucher->type) { // 0: money, 1: percent
            $sale = (int)$price * ((int)$voucher->value / 100);
        } else {
            $sale = (int)$voucher->value;
        }

        // if price sale greater then max_value, return max_value
        if ($voucher->max_value > 0 && $sale > $voucher->max_value) {
            $sale = $voucher->max_value;
        }

        $price_after_sale = (int)$price - (int)$sale;

        if ($price_after_sale < 0) {
            $price_after_sale = 0;
        }

        return [
            'price_after_sale' => $price_after_sale,
            'price_after_sale_format' => formatPrice($price_after_sale),
            'sale_price' => $sale,
            'sale_price_format' => formatPrice($sale),
        ];
    }

    public function changeVoucher($voucher_code)
    {
        $voucher = $voucher_code ?? '';

        $cart = \Cart::content();

        $total_price = totalCart(false);

        $voucher = Voucher::where('code', $voucher)
            ->where('status', 1)->first();

        $result = $this->checkVoucher($voucher, $total_price);

        if (!$result['status']) {
            Session::forget('voucher');
            return [
                'status' => $result['status'],
                'message' => $result['message']
            ];
        }


        $result = $this->calculator($voucher, $total_price);

        if (!empty($result)) {
            $vouchers = [
                'voucher' => $voucher,
                'result' => $result,
            ];
            Session::put('voucher', $vouchers);
        }
        return ['status' => 1, 'data' => $result ?? null, 'message' => 'Áp dụng mã giảm giá thành công!'];
    }


    public function handleProduct($request, $goldentimeID) {
        \DB::table('golden_time_products')->where('golden_time_id', $goldentimeID)
            ->delete();
        extract($request->all(), EXTR_OVERWRITE);
        if(isset($sale) && count($sale)>0) {
            $datas = [];
            foreach ($sale as $key => $value) {
                if(!empty($value['product_id'])) {
                    $price = str_replace(',', '', $value['price'] ?? 0);
                    $datas[] = [
                        'golden_time_id' => $goldentimeID,
                        'product_id' => $value['product_id'] ?? 0,
                        "price" => empty($price)? null: intval($price),
                        "quantity" => intval($value['quantity'] ?? 0),
                    ];
                }
            }
            if(count($datas)) {
                \DB::table('golden_time_products')->insert($datas);
            }
        }
    }
    public function suggestProducts(Request $request) {
        $id = $request->id ?? 'id';
        $name = $request->name ?? 'name';
        $keyword = $request->keyword ?? '';
        $id_not_where = $request->id_not_where ?? [];
        $store_id = $request->store_id ?? 1;
        $flash_sale_id = $request->sale_id ?? 0;
        $variant_not = $request->variant_not ?? [];
        $lists = Product::where('products.status',1)
            ->where($name,'like','%'.$keyword.'%')
            ->orderBy($id,'DESC')->limit(30)->offset(0)->get();
        if ($lists->count()) {
            $result = [];
            foreach ($lists as $item) {
                if(!in_array($item->id, $id_not_where)) {
                    $quantityHas = (($item->quantity ?? 0) - ($item->quantity_used ?? 0));
                    if($quantityHas) {
                        $result[] = [
                            'id'=>$item->id,
                            'name'=> $item->$name,
                            'price' => $item->price??0,
                            'quantity' => $quantityHas,
                        ];
                    }
                }
            }
            return response()->json(['status' => 1, 'message' => __('Translate::admin.has_found_data'), 'data' => $result]);
        } else {
            return response()->json(['status' => 0, 'message' => __('Translate::admin.not_found_data')]);
        }
    }
}
