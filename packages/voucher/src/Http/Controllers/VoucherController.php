<?php

namespace Sudo\Voucher\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Sudo\Base\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use ListData;
use Form;
use File;
use Auth;
use ListCategory;
use Illuminate\Http\Response;
use Sudo\Voucher\Models\Voucher;
use Sudo\Store\Models\StoreProduct;
use Cart;

class VoucherController extends AdminController
{
    function __construct()
    {
        $this->models = new \Sudo\Voucher\Models\Voucher;
        $this->table_name = $this->models->getTable();
        $this->module_name = 'Vouchers';
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
        $listdata = new ListData($requests, $this->models, 'Voucher::table.index', $this->has_locale);
        $listdata->search('name', 'Tên', 'string');
        $listdata->search('created_at', 'Ngày tạo', 'range');
        $listdata->search('status', 'Trạng thái', 'array', config('app.status'));
        // Build các hành động
        $listdata->action('status');
        // Build bảng 
        $listdata->add('name', __('Voucher::field.name'), 0);
        $listdata->add('code', __('Voucher::field.code'), 1);
        $listdata->add('option', __('Voucher::field.option'), 1);
        $listdata->add('type', __('Voucher::field.type'), 1);
        $listdata->add('value', __('Voucher::field.value'), 1);
        $listdata->add('max_value', __('Voucher::field.max_value'), 1);
        $listdata->add('min_order', __('Voucher::field.min_order'), 1);
        $listdata->add('limit', __('Voucher::field.limit'), 1);
        $listdata->add('used', __('Voucher::field.used'), 1);
        $listdata->add('start_time', __('Voucher::field.start_time'), 0);
        $listdata->add('end_time', __('Voucher::field.end_time'), 0);
        $listdata->add('status', 'Trạng thái', 0, 'status');
        $listdata->add('', 'Language', 0, 'lang');
        $listdata->add('', 'Sửa', 0, 'edit');
        $listdata->add('', 'Xóa', 0, 'delete');

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
        $form->card('col-lg-8');
            $form->lang($this->table_name);
            $form->text('name', '', 1, __('Voucher::field.name'));
            $form->text('code', '', 1, __('Voucher::field.code'));
            $form->select('type', '', 0, __('Voucher::field.type'), config('SudoVoucher.voucher_type'));
            $form->text('value', '', 1, __('Voucher::field.value'));
            $form->text('max_value', '', 0, __('Voucher::field.max_value'));
            $form->text('min_order', '0', 0, __('Voucher::field.min_order'));
            $form->text('limit', '', 1, __('Voucher::field.limit'));
            $form->datetimepicker('start_time', '', 1, __('Voucher::field.start_time'));
            $form->datetimepicker('end_time', '', 1, __('Voucher::field.end_time'));
        $form->endCard();
        $form->card('col-lg-4', '');
            $form->action('add');
            $form->radio('option', 1, 'Loại Voucher', $this->models->getOptions());
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
        validateForm($requests, 'name', 'Tên là bắt buộc!');
        validateForm($requests, 'code', 'Mã là bắt buộc!');
        $this->validate($requests, [
            'limit' => 'numeric|min:0',
            'code' => 'unique:vouchers,code',
            'max_value' => 'numeric|min:0|nullable',
            'value' => 'numeric|min:0|nullable',
            'min_order' => 'numeric|min:0|nullable'
        ]);
        // Các giá trị mặc định
        
        $status = 0;
        $option = 1;
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);

        // Nếu click lưu nháp
        if($redirect == 'save'){
            $status = 0;
            $redirect = 'edit';
        }
        if($option == 2 && (!isset($products) || !count($products))) {
            return redirect()->back()->withErrors('Sản phẩm áp dụng là bắt buộc!');
        }
        $max_value = !empty($max_value) ? $max_value : 0;
        $min_order = !empty($min_order) ? $min_order : 0;
        $created_at = $updated_at = date('Y-m-d H:i:s');
        if($option == 2) {
            $min_order = 0;
        }
        $compact = compact('option', 'name', 'code', 'max_value', 'value', 'min_order', 'type', 'status', 'limit', 'start_time', 'end_time', 'created_at', 'updated_at');
        $id = $this->models->createRecord($requests, $compact, $this->has_seo);
        if($option == 2) {
            $this->handleProduct($requests, $id);
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
        $form = new Form;
        $form->card('col-lg-8');
        $form->lang($this->table_name);
        $form->text('name', $data_edit->name, 1, __('Voucher::field.name'));
        $form->text('code', $data_edit->code, 1, __('Voucher::field.code'));
        $form->select('type', $data_edit->type, 0, __('Voucher::field.type'), config('SudoVoucher.voucher_type'));
        $form->text('value', $data_edit->value, 0, __('Voucher::field.value'));
        $form->text('max_value', $data_edit->max_value, 0, __('Voucher::field.max_value'));
        $form->text('min_order', $data_edit->min_order, 0, __('Voucher::field.min_order'));
        if($data_edit->option == 2) {
            $products = \DB::table('voucher_product_maps')
                ->where('voucher_id', $id)->pluck('product_id')->toArray();
            $form->custom('Form::custom.drag_drop',
                [
                    'has_full'          => true,
                    'name'              => 'products',
                    'value'             => $products,
                    'required'          => 0,
                    'label'             => 'Chọn sản phẩm áp dụng',
                    'placeholder'       => 'Tìm kiếm theo tên sản phẩm',
                    'suggest_table'     => 'products',
                    'suggest_id'        => 'id',
                    'suggest_name'      => 'name',
                ]
            );
        }
        $form->text('limit', $data_edit->limit, 1, __('Voucher::field.limit'));
        $form->datetimepicker('start_time', $data_edit->start_time, 1, __('Voucher::field.start_time'));
        $form->datetimepicker('end_time', $data_edit->end_time, 1, __('Voucher::field.end_time'));
        $form->endCard();
        $form->card('col-lg-4', '');
        $form->action('edit');
        $form->radio('option', $data_edit->option, 'Loại Voucher', $this->models->getOptions());
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

        // Xử lý validate
        validateForm($requests, 'name', 'Name is required!');
        validateForm($requests, 'code', 'Code is required!');
        $this->validate($requests, [
            'limit' => 'numeric|min:0',
            'code' => 'unique:vouchers,code,' . $id,
            'max_value' => 'numeric|min:0|nullable',
            'value' => 'numeric|min:0|nullable',
            'min_order' => 'numeric|min:0|nullable',
        ]);
        // Lấy bản ghi
        $data_edit = $this->models->where('id', $id)->first();
        // Các giá trị mặc định
        $status = 0;
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        if($option == 2 && (!isset($products) || !count($products))) {
            return redirect()->back()->withErrors('Sản phẩm áp dụng là bắt buộc!');
        }
        $max_value = !empty($max_value) ? $max_value : 0;
        $value = !empty($value) ? $value : 0;
        $min_order = !empty($min_order) ? $min_order : 0;
        $updated_at = date('Y-m-d H:i:s');
        if($option == 2) {
            $min_order = 0;
        }
        $compact = compact('option', 'name', 'code', 'type', 'max_value', 'min_order', 'value', 'status', 'limit', 'start_time', 'end_time', 'updated_at');
        // Cập nhật tại database
        $this->models->updateRecord($requests, $id, $compact, $this->has_seo);
        if($option == 2) {
            $this->handleProduct($requests, $id);
        } else {
            \DB::table('voucher_product_maps')->where('voucher_id', $id)
                ->delete();
        }
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
        // 
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

    public function loadOption(Request $request) {
        $option = $request->option ?? 1;
        if($option == 1) {
            $html = '';
        } else {
            $html = view('Form::custom.drag_drop',
                [
                    'has_full'          => true,
                    'name'              => 'products',
                    'value'             => $data['products'] ?? [],
                    'required'          => 0,
                    'label'             => 'Chọn sản phẩm áp dụng',
                    'placeholder'       => 'Tìm kiếm theo tên sản phẩm',
                    'suggest_table'     => 'products',
                    'suggest_id'        => 'id',
                    'suggest_name'      => 'name',
                ]
            )->render();
        }
        return $html;
    }

    public function handleProduct($request, $voucherID) {
        \DB::table('voucher_product_maps')->where('voucher_id', $voucherID)
            ->delete();
        extract($request->all(), EXTR_OVERWRITE);
        if(count($products)) {
            $datas = [];
            foreach ($products as $key => $value) {
                $datas[$value] = [
                    'voucher_id' => $voucherID,
                    'product_id' => $value,
                ];
            }
            if(count($datas)) {
                \DB::table('voucher_product_maps')->insert($datas);
            }
        }
    }
}
