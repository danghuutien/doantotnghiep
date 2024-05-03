<?php

namespace Sudo\Ecommerce\Http\Controllers;
use Sudo\Base\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use ListData;
use Form;
use ListCategory;
use DB;
use Auth;
use Carbon\Carbon;
use \Sudo\Ecommerce\Models\Order;
use \Sudo\Ecommerce\Models\OrderDetail;
use \Sudo\Ecommerce\Models\OrderHistory;
use \Sudo\Ecommerce\Models\Customer;
use PDF;
use Sudo\Theme\Models\Province;
use Sudo\Theme\Models\District;
use Sudo\Theme\Models\Ward;

class OrderController extends AdminController
{
    function __construct() {
        $this->models = new \Sudo\Ecommerce\Models\Order;
        $this->table_name = $this->models->getTable();
        $this->module_name = 'Đơn hàng';
        $this->has_seo = false;
        $this->has_locale = false;
        parent::__construct();

        $this->order_status = config('SudoOrder.order_status');

        $this->payment_method = config('SudoOrder.payment_method');
        $this->payment_status = config('SudoOrder.payment_status');
        $this->shipping_methods = config('SudoOrder.shipping_methods');
        $this->provinces = Province::all();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $requests) {
        $listdata = new ListData($requests, $this->models, 'Ecommerce::admin.orders.table.index', $this->has_locale);
        $order_status = $this->order_status;
        $payment_method = $this->payment_method;
        $trash = 0;
        if($requests->trash == true) {
            $trash = 1;
        } 
        // Build Form tìm kiếm
        $listdata->search('code', 'Mã đơn hàng', 'string');
        $listdata->search('customer_name', 'Họ tên người đặt', 'string');
        $listdata->search('phone_number', 'Điện thoại người đặt', 'string');
        $listdata->search('created_at', 'Ngày tạo', 'range');
        $listdata->search('status', 'Trạng thái', 'array', $order_status);
        $listdata->search('payment_method', 'Thanh toán', 'array', $payment_method);
        $listdata->search('payment_status', 'Trạng thái', 'array', $this->payment_status);
        // $listdata->action('status');
        if(!$requests->trash){
            $listdata->searchBtn('Xuất Excel', route('admin.orders.export'), 'primary', 'fas fa-file-excel');
            $listdata->searchBtn('Xuất Excel chi tiết', route('admin.order_details.export'), 'success', 'fas fa-file-excel');
        }    
        // Build bảng
        $listdata->add('id', 'Mã đơn hàng', 0);
        $listdata->add('', 'Thông tin người đặt', 0);
        $listdata->add('', 'Nguồn tracking', 0);
        $listdata->add('type', 'Loại đơn hàng', 'string');
        $listdata->add('total_price', 'Giá trị đơn', 0);
        $listdata->add('payment_status', 'Tình trạng thanh toán', 0);
        if(!$requests->trash) {
            $listdata->add('status', 'Trạng thái', 0);
        }
        $listdata->add('created_at', 'Thời gian', 0, 'time');
        $listdata->add('', 'Xem', 0, 'show');
        $listdata->add('', 'Hành động', 0, 'action');
        if($requests->trash) {
            $listdata->action('status');
        }

        $payment_status = $this->payment_status;

        $listdata->no_add();

        return $listdata->render(compact('payment_status', 'trash'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return redirect()->back()->withErrors('Tính năng không hỗ trợ');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $requests)
    {
        return redirect()->back()->withErrors('Tính năng không hỗ trợ');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment_method = $this->payment_method;
        // Toàn bộ admin_user để hiển thị cho lịch xử
        $admin_user_query = \DB::table('admin_users')->get();
        $admin_users = [];
        foreach ($admin_user_query as $value) {
            $admin_users[$value->id] = $value->display_name ?? $value->name;
        }
        // Lấy bản ghi
        $order = $this->models->with(['orderDetail', 'customer'])->where('id', $id)->first();
        // Khách hàng
        $customers = $order->customer ;
        // Thông tin sản phẩm
        $order_details = $order->orderDetail ;
        // Lịch sử hành động của đơn hàng
        $order_histories = OrderHistory::getOrderHistory($order->id);
        $payment_status = $this->payment_status;
        $shipping_methods = $this->shipping_methods;
        return view('Ecommerce::admin.orders.show', compact(
            'payment_method',
            'admin_users',
            'order',
            'customers',
            'order_details',
            'payment_status',
            'order_histories',
            'shipping_methods'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        // Lấy bản ghi
        $data_edit = $this->models->where('id', $id)->first();
        // Chỉ được sửa khi ở trạng thái đã tiếp nhận
        if ($data_edit->status != 2) {
            return redirect(route('admin.orders.show', $id))->with([
                'type' => 'success',
                'message' => __('Để sửa đơn hàng phải ở trạng thái Đã tiếp nhận')
            ]);
        }
        // Khách hàng
        $customers = Customer::where('id', $data_edit->customer_id)->first();
        // Thông tin sản phẩm
        $orderDetails = OrderDetail::with('product')->where('order_id', $data_edit->id)->get();
        if($data_edit->type == 2) {
            $districts = District::get();
            $wards = Ward::get();
        }else {
            $districts = District::where('province_id', $customers->province_id)->get();
            $wards = Ward::where('district_id', $customers->district_id)->get();
            $customers = Customer::where('id', $data_edit->customer_id)->first();
        }
       
        // Khởi tạo form
        $form = new Form;
        $form->title('Thông tin khách hàng');
        if($data_edit->type == 2) {
            $form->text('name','', 1, 'Tên người đặt', '', true);
            $form->text('phone', $data_edit->phone_number, 1, 'Điện thoại', '', true);
            $form->text('address', '', 0, 'Địa chỉ', '', true);
            $form->custom('Ecommerce::admin.orders.form.select', ['provinces'=>$this->provinces, 'districts' => $districts, 'wards' => $wards, 'data_edit'=> '']);
            $form->select('payment_method', $data_edit->payment_method, 1, 'Hình thức thanh toán', $this->payment_method, 0, [], true);
            $form->select('shipping_method', $data_edit->shipping_method, 1, 'Phương thức giao hàng', $this->shipping_methods, 0, [], true);
            $form->textarea('note', $data_edit->note, 0, 'Ghi chú', '', 5, 1);
        }else {
            $form->text('name', $customers->name ?? '', 1, 'Tên người đặt', '', true);
            $form->text('phone', $customers->phone, 1, 'Điện thoại', '', true);
            $form->text('address', $customers->address, 0, 'Địa chỉ', '', true);
            $form->custom('Ecommerce::admin.orders.form.select', ['provinces'=>$this->provinces, 'districts' => $districts, 'wards' => $wards, 'data_edit'=> $customers]);
            $form->select('payment_method', $data_edit->payment_method, 1, 'Hình thức thanh toán', $this->payment_method, 0, [], true);
            $form->select('shipping_method', $data_edit->shipping_method, 1, 'Phương thức giao hàng', $this->shipping_methods, 0, [], true);
            $form->textarea('note', $data_edit->note, 0, 'Ghi chú', '', 5, 1);  
        }
        
        $form->title('Thông tin Sản phẩm');
        $form->custom('Ecommerce::admin.orders.form.product_in_orders', compact('orderDetails'));
        $form->action('edit');
        return $form->render('edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $requests
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $requests, $id) {
        // Xử lý validate
        validateForm($requests, 'name', 'Tên người đặt không được để trống.');
        validateForm($requests, 'phone', 'Điện thoại người đặt không được để trống.');
        validateForm($requests, 'province_id', 'Tỉnh thành người đặt không được để trống.');
        validateForm($requests, 'district_id', 'Quận huyện người đặt không được để trống.');
        validateForm($requests, 'ward_id', 'Phường xã người đặt không được để trống.');
        validateForm($requests, 'shipping_method', 'Phương thức giao hàng không được để trống.');
        validateForm($requests, 'payment_method', 'Hình thức thanh toán không được để trống.');
        validateForm($requests, 'products', 'Sản phẩm không được để trống.');
        \DB::beginTransaction();
        // try {
            // Lấy bản ghi
            $data_edit = $this->models->where('id', $id)->first();
            // Chỉ được sửa khi ở trạng thái đã tiếp nhận
            if ($data_edit->status != 2) {
                return redirect(route('admin.orders.show', $id))->with([
                    'type' => 'success',
                    'message' => __('Để sửa đơn hàng phải ở trạng thái Đã tiếp nhận')
                ]);
            }
            // Đưa mảng về các biến có tên là các key của mảng
            extract($requests->all(), EXTR_OVERWRITE);
            // Lịch sử thay đổi cập nhật trước khi update bất kỳ thông gì
            $data_history = [];
            $customer_history = Customer::where('id', $data_edit->customer_id)->first();
            $data_history['old'] = [
                'customers' => [
                    'name'      => isset($customer_history) ? (string)$customer_history->name  : '',
                    'phone'     => isset($customer_history) ? (string)$customer_history->phone : '',
                    'email'     => isset($customer_history) ? (string)$customer_history->email : '',
                    'address'   => isset($customer_history) ? (string)$customer_history->getAddress() : '',
                ],
                'orders' => [
                    'note' => (string)$data_edit->note,
                    'payment_method' => (int)$data_edit->payment_method,
                ],
            ];
            $data_history['new'] = [
                'customers' => [
                    'name'      => (string)$name,
                    'phone'     => (string)$phone,
                    'address'   => (string)$address,
                ],
                'orders' => [
                    'note' => (string)$note,
                    'payment_method' => (int)$payment_method,
                    'shipping_method' => (int)$shipping_method,
                ],
            ];
            $detail_history = OrderDetail::where('order_id', $id)->get();
            if (isset($detail_history) && !empty($detail_history)) {
                foreach ($detail_history as $value) {
                    $order_detail = [
                        'order_id'      => (int)$id,
                        'product_id'    => (int)$value->product_id ?? 0,
                        'price'         => (int)$value->price ?? 0,
                        'quantity'      => (int)$value->quantity ?? 0,
                    ];
                    $data_history['old']['products'][] = $order_detail;
                }
            }
            $total = 0;
            if (isset($products) && !empty($products)) {
                foreach ($products as $value) {
                    $order_detail = [
                        'order_id'      => (int)$id,
                        'product_id'    => (int)$value['id'] ?? 0,
                        'price'         => (int)$value['price'] ?? 0,
                        'quantity'      => (int)$value['quantity'] ?? 0,
                    ];
                    $data_history['new']['products'][] = $order_detail;
                    $total += $value['price']*$value['quantity'];
                }
            }
            $customers = [
                'name'      => $name,
                'phone'     => $phone,
                'province_id'     => $province_id,
                'district_id'     => $district_id,
                'ward_id'     => $ward_id,
                'address'   => $address,
                'created_at' => $customer_history->created_at ?? date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            $customer_id = $data_edit->customer_id;
            if($customer_id != 0) {
                Customer::where('id', $data_edit->customer_id)->update($customers);
            }else {
                $customer_id = Customer::insertGetId($customers);
            }
            // update lai gia neu co voucher
            if($data_edit->voucher_code) {
                $voucher = \Sudo\Voucher\Models\Voucher::where('code', $data_edit->voucher_code)->first();
                if(!empty($voucher) && $voucher->min_order < $total) {
                    $voucher_controller = new \Sudo\Voucher\Http\Controllers\VoucherController();
                    $total_after_voucher = $voucher_controller->calculator($voucher, $total);
                    $voucher_code = $data_edit->voucher_code;
                    $voucher_value = $total_after_voucher['sale_price'];
                } else {
                    $voucher_code = '';
                    $voucher_value = 0;
                }
            } else {
                $voucher_code = '';
                $voucher_value = 0;
            }

            if(isset($total_after_voucher) && !empty($total_after_voucher['price_after_sale'])){
                $total = $total_after_voucher['price_after_sale'];
            }
            // Đơn hàng
            $orders = [
                'customer_id'        => $customer_id,
                'shipping_method'    => $shipping_method,
                'payment_method'    => $payment_method,
                'voucher_code'    => $voucher_code ?? '',
                'voucher_value'    => $voucher_value ?? 0,
                'note'              => $note,
                'total_price'       => $total,
                'updated_at'        => date('Y-m-d H:i:s'),
            ];
            $data_edit->update($orders);
            if ($data_history['new'] != $data_history['old']) {
                OrderHistory::add($id, 'order_change', $data_history);
            }
            // Chi tiết đơn hàng
            if (isset($products) && !empty($products)) {
                OrderDetail::where('order_id', $id)->delete();
                $orderDetails = [];
                foreach ($products as $value) {
                    $orderDetails[] = [
                        'order_id'      => $id,
                        'product_id'    => $value['id'] ?? 0,
                        'price'         => $value['price'] ?? 0,
                        'quantity'      => $value['quantity'] ?? 0
                    ];
                }
                OrderDetail::insert($orderDetails);
            }
            // Điều hướng
            if ($redirect == 'edit') {
                $redirect = 'show';
            }
            \DB::commit();
            return redirect(route('admin.'.$this->table_name.'.'.$redirect, $id))->with([
                'type' => 'success',
                'message' => __('Translate::admin.update_success')
            ]);
        // } catch (\Exception $e) {
        //     \Log::error('Update order error '.$e->getMessage());
        //     \DB::rollback();
        //     return redirect(route('admin.'.$this->table_name.'.show', $id))->with([
        //         'type' => 'danger',
        //         'message' => __('Có lỗi xảy ra trong tuần tự xử lý, vui lòng thử lại!')
        //     ]);
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Ghi chú dành cho Admin
     */
    public function adminNote(Request $requests) {
        // Không có quyền sửa thì trả về trang chủ
        if (!checkRole($this->table_name.'_edit')) {
            return redirect(route('admin.home'))->with([
                'type' => 'danger',
                'message' => 'Translate::admin.role.no_permission',
            ]);
        }
        // 
        $note = $requests->admin_note;
        $order_id = $requests->order_id;
        // Không có note sẽ không ghi
        if (!empty($note)) {
            OrderHistory::add($order_id, 'admin_note', $note);
        }
        return redirect(route('admin.orders.show', $order_id));
    }

    /**
     * Tiếp nhận đơn hàng
     */
    public function accepts(Request $requests) {
        // Không có quyền sửa thì trả về trang chủ
        if (!checkRole($this->table_name.'_edit')) {
            return redirect(route('admin.home'))->with([
                'type' => 'danger',
                'message' => 'Translate::admin.role.no_permission',
            ]);
        }
        // ID đơn hàng
        $order_id = $requests->order_id;
        // Lấy bản ghi
        $order = $this->models->where('id', $order_id)->first();
        // Nếu trạng thái đơn không phải đơn hàng mới thì sẽ không cho tiếp nhận
        if ($order->status == 1) {
            // Đổi trạng thái tiếp nhận
            $this->models->where('id', $order_id)->update(['status' => 2]);
            // Ghi lịch sử
            OrderHistory::add($order_id, 'received');
            return redirect(route('admin.orders.show', $order_id))->with([
                'type' => 'success',
                'message' => 'Cập nhật trạng thái thành công.',
            ]);
        } else {
            return redirect(route('admin.orders.show', $order_id))->with([
                'type' => 'danger',
                'message' => 'Chỉ chuyển được khi đơn là đơn hàng mới.',
            ]);
        }
    }

    /**
     * Thành công
     */
    public function success(Request $requests) {
        // Không có quyền sửa thì trả về trang chủ
        if (!checkRole($this->table_name.'_edit')) {
            return redirect(route('admin.home'))->with([
                'type' => 'danger',
                'message' => 'Translate::admin.role.no_permission',
            ]);
        }
        // ID đơn hàng
        $order_id = $requests->order_id;
        // Lấy bản ghi
        $order = $this->models->where('id', $order_id)->first();
        // Nếu trạng thái đơn không phải đơn hàng mới thì sẽ không cho tiếp nhận
        if ($order->status == 2) {
            // Đổi trạng thái tiếp nhận
            $this->models->where('id', $order_id)->update(['status' => 4]);
            // Ghi lịch sử
            OrderHistory::add($order_id, 'order_success');
            return redirect(route('admin.orders.show', $order_id))->with([
                'type' => 'success',
                'message' => 'Cập nhật trạng thái thành công.',
            ]);
        } else {
            return redirect(route('admin.orders.show', $order_id))->with([
                'type' => 'danger',
                'message' => 'Chỉ chuyển được khi đơn đang được tiếp nhận.',
            ]);
        }
    }

    /**
     * Từ chối
     */
    public function denined(Request $requests) {
        // Không có quyền sửa thì trả về trang chủ
        if (!checkRole($this->table_name.'_edit')) {
            return redirect(route('admin.home'))->with([
                'type' => 'danger',
                'message' => 'Translate::admin.role.no_permission',
            ]);
        }
        // ID đơn hàng
        $order_id = $requests->order_id;
        // Lấy bản ghi
        $order = $this->models->where('id', $order_id)->first();
        // Nếu trạng thái đơn không phải đơn hàng mới thì sẽ không cho tiếp nhận
        if ($order->status == 2) {
            // Đổi trạng thái tiếp nhận
            $this->models->where('id', $order_id)->update(['status' => 3]);
            // Ghi lịch sử
            OrderHistory::add($order_id, 'order_fail');
            return redirect(route('admin.orders.show', $order_id))->with([
                'type' => 'success',
                'message' => 'Cập nhật trạng thái thành công.',
            ]);
        } else {
            return redirect(route('admin.orders.show', $order_id))->with([
                'type' => 'danger',
                'message' => 'Chỉ chuyển được khi đơn đang được tiếp nhận.',
            ]);
        }
    }

    public function embedHistory(Request $requests) {
        // Không có quyền sửa thì trả về trang chủ
        if (!checkRole($this->table_name.'_index')) {
            exit(__('Translate::admin.role.no_permission'));
        }
        // Lịch sử
        $history_id = $requests->order_history_id;
        // Chi tiết lịch sử
        $order_history = OrderHistory::where('id', $history_id)->first();
        // Nếu có dữ liệu thì mới hiển thị ra view
        if (isset($order_history->data) && !empty($order_history->data)) {
            $data = json_decode(base64_decode($order_history->data), true);
            $payment_method = $this->payment_method;
            $shipping_methods = $this->shipping_methods;
            return view('Ecommerce::admin.orders.embed_history', compact('data', 'payment_method', 'shipping_methods'));
        } else {
            exit(__('Lịch sử trống'));
        }
    }
    public function downloadInvoice($order_id){
        $order = Order::find($order_id);
        $customer = Customer::find($order->customer_id);
        $order_detail = OrderDetail::where('order_id', $order->id)->get();
        $pdf = PDF::loadView('Ecommerce::admin.orders.download_invoice',  compact('order', 'customer', 'order_detail'));
        return $pdf->download($order->code.'.pdf');
    }
    public function confirmPayment(Request $requests){
        // Không có quyền sửa thì trả về trang chủ
        if (!checkRole($this->table_name.'_edit')) {
            return redirect(route('admin.home'))->with([
                'type' => 'danger',
                'message' => 'Translate::admin.role.no_permission',
            ]);
        }
        // ID đơn hàng
        $order_id = $requests->order_id;
        // Lấy bản ghi
        $order = $this->models->where('id', $order_id)->first();
        // Nếu tình trạng thanh toán đang là chưa thanh toán thì cho phép chuyển trạng thái
        if ($order->payment_status == 0) {

            $this->models->where('id', $order_id)->update(['payment_status' => 1]);
            // Ghi lịch sử
            OrderHistory::add($order_id, 'comfirm_payment');
            return redirect(route('admin.orders.show', $order_id))->with([
                'type' => 'success',
                'message' => 'Xác nhận thanh toán thành công.',
            ]);
        } else {
            return redirect(route('admin.orders.show', $order_id))->with([
                'type' => 'danger',
                'message' => 'Xác nhận thanh toán không thành công',
            ]);
        }
    }
    public function refund(Request $requests){
        // Không có quyền sửa thì trả về trang chủ
        if (!checkRole($this->table_name.'_edit')) {
            return redirect(route('admin.home'))->with([
                'type' => 'danger',
                'message' => 'Translate::admin.role.no_permission',
            ]);
        }
        $refund_money = $requests->refund_money??'';
        $refund_reason = $requests->refund_reason??'';
        // ID đơn hàng
        $order_id = $requests->order_id;
        // Lấy bản ghi
        $order = $this->models->where('id', $order_id)->first();
        // Nếu tình trạng thanh toán đang là đã thanh toán thì cho phép chuyển trạng thái hoàn tiền
        if ($order->payment_status == 1) {

            $this->models->where('id', $order_id)->update(['payment_status' => -1, 'status' => 3, 'refund_money' => $refund_money, 'refund_reason' => $refund_reason]);
            // Ghi lịch sử
            OrderHistory::add($order_id, 'order_fail');
            OrderHistory::add($order_id, 'refund');
            return redirect(route('admin.orders.show', $order_id))->with([
                'type' => 'success',
                'message' => 'Yêu cầu hoàn tiền thành công',
            ]);
        } else {
            return redirect(route('admin.orders.show', $order_id))->with([
                'type' => 'danger',
                'message' => 'Yêu cầu hoàn tiền không thành công',
            ]);
        }
    }

    /**
     * Tìm kiếm và trả về dữ liệu tại bảng products
     * @param string     $request->table: tên bảng
     * @param string     $request->table_field: Tên cột lấy tên
     * @param string     $request->keyword: tên trường
     * @param string     $request->suggest_locale: có search theo đa ngôn ngữ hay không
     * @param array      $request->id_not_where: Không lấy id có tại mảng này
     */
    public function suggestProducts(Request $request) {
        $table = $request->table ??'';
        $table_field = $request->table_field ?? 'name';
        $keyword = $request->keyword ?? '';
        $suggest_locale = $request->suggest_locale ?? 'false';
        $id_not_where = $request->id_not_where ?? [];

        $lists = \Sudo\Ecommerce\Models\Product::active()
            ->whereColumn('quantity', '>', 'quantity_used');
        // Tiếp tục tìm
        $products = $lists->whereNotIn('id',$id_not_where)->where($table_field,'like','%'.$keyword.'%')->orderBy('id','DESC')->limit(30)->get();
        $html = view('Ecommerce::admin.orders.form.product_in_orders_item', ['data' => $products, 'id_not_where' => $id_not_where])->render();
        if ($products->count()) {
            return response()->json(['status' => 1, 'message' => __('Translate::admin.has_found_data'), 'data' => $products, 'html' => $html]);
        } else {
            return response()->json(['status' => 0, 'message' => __('Translate::admin.not_found_data')]);
        }
    }

        // export excel danh sách đơn
    public function export(Request $requests) {
        $payment_methods = $this->payment_method;
        $shipping_methods = $this->shipping_methods;
        $paymentStatus = $this->payment_status;
        $order_status = $this->order_status;
        extract($requests->all(), EXTR_OVERWRITE);
        $listdata = Order::with(['customer.province.district.ward', 'orderDetail.product'])
            ->where('orders.status', '<>', -1);
        if(isset($search) && $search == 1) {
            if(isset($code) && !empty($code)) {
                $listdata = $listdata->where('code',$code);
            }
            if(isset($payment_method) && !empty($payment_method)) {
                $listdata = $listdata->where('payment_method',$payment_method);
            }
            if(isset($shipping_method) && !empty($shipping_method)) {
                $listdata = $listdata->where('shipping_method',$shipping_method);
            }
            if((isset($customer_phone) && !empty($customer_phone) || (isset($customer_name) && $customer_name != ''))) {
                $listdata = $listdata->join('customers', 'customers.id', 'orders.customer_id');
            }
            if(isset($customer_phone) && !empty($customer_phone)) {
                $listdata = $listdata->where('customers.phone', $customer_phone);
            }
            if (isset($customer_name) && $customer_name != '') {
                $listdata = $listdata->where('customers.name', 'LIKE', "%".str_replace(' ', '%', $customer_name).'%');
            }
            if(isset($status) && in_array($status, $order_status)) {
                $listdata = $listdata->where('orders.status', $status);
            }
            if(isset($payment_status) && !empty($payment_status)) {
                $listdata = $listdata->where('payment_status', $payment_status);
            }
            if(isset($created_at_start) && !empty($created_at_start)) {
                $listdata = $listdata->whereBetween('orders.created_at', [$created_at_start, $created_at_end]);
            }
        }
        $listdata = $listdata->select('orders.*')->orderBy('orders.id', 'asc')->get();
        $data_export = [
            'file_name' => 'Danh_sach_don_hang_'.time(),
            'fields' => [
                'STT',
                'Mã Đơn hàng',
                'Tên Khách hàng',
                'Điện thoại Khách hàng',
                'Địa chỉ',
                'Phương thức giao hàng',
                'Hình thức thanh toán',
                'Trạng thái đơn',
                'Trạng thái thanh toán',
                'Thời gian',
            ],
            'data' => [
            ]
        ];
        $stt = 1;
        foreach($listdata as $key => $value){
            $data_export['data'][] = [
                $stt,
                $value->code,
                $value->customer->getName(),
                $value->customer->phone,
                $value->customer->getAddress(),
                $shipping_methods[$value->shipping_method] ?? '',
                $payment_methods[$value->payment_method] ?? '',
                $value->getStatus()['status_text'] ?? '',
                $paymentStatus[$value->payment_status] ?? '',
                date('H:i:s d-m-Y', strtotime($value->created_at))
            ];
            $stt++;
        }
        return \Excel::download(new \Sudo\Ecommerce\Export\GeneralExports($data_export), $data_export['file_name'].'.xlsx');
    }

    public function exportDetail(Request $requests) {
        $payment_methods = $this->payment_method;
        $shipping_methods = $this->shipping_methods;
        $paymentStatus = $this->payment_status;
        $order_status = $this->order_status;

        extract($requests->all(), EXTR_OVERWRITE);
        $listdata = OrderDetail::with(['order.customer.province.district.ward', 'product'])
            ->where('orders.status', '<>', -1);
        if(isset($search) && $search == 1) {
            $listdata = $listdata->join('orders', 'orders.id', 'order_details.order_id');
            if(isset($code) && $code) {
                $listdata = $listdata->where('orders.code', $code);
            }
            if (isset($customer_name) || isset($customer_phone)) {
                $listdata = $listdata->join('customers', 'customers.id', 'orders.customer_id');

                if (isset($customer_name) && $customer_name != '') {
                    $listdata = $listdata->where('customers.name', 'LIKE', "%".str_replace(' ', '%', $customer_name).'%');
                }
                if (isset($customer_phone) && $customer_phone != '') {
                    $listdata = $listdata->where('customers.phone', $customer_phone);
                }
            }
            if(isset($payment_method) && $payment_method) {
                $listdata = $listdata->where('orders.payment_method', $payment_method);
            }
            if(isset($shipping_method) && $shipping_method) {
                $listdata = $listdata->where('orders.shipping_method', $shipping_method);
            }
            if(isset($status) && $status) {
                $listdata = $listdata->where('orders.status', $status);
            }
            if(isset($created_at_start) && !empty($created_at_start) && isset($created_at_end) && !empty($created_at_end)) {
                $listdata = $listdata->whereBetween('orders.created_at', [$created_at_start, $created_at_end]);
            }
        }
        $listdata = $listdata->select('order_details.*')->orderBy('orders.id', 'asc')->get();
        $data_export = [
            'file_name' => 'Chi_tiet_don_hang_'.time(),
            'fields' => [
                'STT',
                'Mã Đơn hàng',
                'Sản phẩm',
                'Số lượng',
                'Giá bán',
                'Thành tiền',
                'Tên Khách hàng',
                'Điện thoại Khách hàng',
                'Địa chỉ',
                'Phương thức giao hàng',
                'Hình thức thanh toán',
                'Trạng thái đơn',
                'Trạng thái thanh toán',
                'Thời gian',
            ],
            'data' => [
            ]
        ];
        $stt = 1;
        foreach($listdata as $key => $value){
            $product = $value->product;
            $order = $value->order;
            $customer = $order->customer;
            $data_export['data'][] = [
                $stt,
                $value->order->code,
                $product->name,
                $value->quantity,
                $value->price,
                $order->total_price,
                $customer->getName(),
                '`'.$customer->phone,
                $customer->getAddress(),
                $shipping_methods[$order->shipping_method] ?? '',
                $payment_methods[$order->payment_method] ?? '',
                $order->getStatus()['status_text'] ?? '',
                $paymentStatus[$order->payment_status] ?? '',
                date('H:i:s d-m-Y', strtotime($order->created_at))
            ];
            $stt++;
        }
        return \Excel::download(new \Sudo\Ecommerce\Export\GeneralExports($data_export), $data_export['file_name'].'.xlsx');
    }

}
