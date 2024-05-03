<?php

namespace Sudo\CallMeBack\Http\Controllers\Admin;

use Sudo\Base\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use ListData;
use Form;
use Excel;
use Sudo\CallMeBack\Export\Export;

class CallMeBackController extends AdminController
{
    function __construct() {
        $this->models = new \Sudo\CallMeBack\Models\CallMeBack;
        $this->table_name = $this->models->getTable();
        $this->module_name = __('Gọi cho tôi');
        $this->has_seo = false;
        $this->has_locale = false;
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $requests) {
    	$listdata = new ListData($requests, $this->models, 'CallMeBack::admin.table', $this->has_locale);
        // khai báo
        $active_status = [0 => 'Chưa liên hệ', 1 => 'Liên hệ thành công'];
        // Build Form tìm kiếm
        $listdata->search('phone', 'Số điện thoại', 'string');
        $listdata->search('current_page', 'Tên trang hiện tại', 'string');
        $listdata->search('active_status', 'Xác nhận', 'array', $active_status);
        $listdata->search('status', 'Trạng thái', 'array', config('app.status'));
        // Build các button hành động
        $listdata->btnAction('status', 1, __('Translate::table.active'), 'primary', 'fas fa-edit');
        $listdata->btnAction('status', 0, __('Translate::table.no_active'), 'warning', 'fas fa-edit');
        $listdata->btnAction('delete', -1, __('Translate::table.trash'), 'danger', 'fas fa-trash');
        // $listdata->searchBtn( 'Xuất Excel', 'export/phone', 'primary', 'fa fa-file-excel');
        // Build bảng
        $listdata->add('phone', 'Số điện thoại', 0);
        $listdata->add('name', 'Tên trang hiện tại', 0);
        $listdata->add('active_status', 'Liên hệ thành công', 0);
        $listdata->add('', 'Thời gian', 0, 'time');
        $listdata->add('', 'Xóa', 0, 'delete');

        return $listdata->render();
    }

    public function create() {
        // Khởi tạo form
        $form = new Form;

        $form->card('col-lg-9');
            $form->lang($this->table_name);
            $form->text('phone', '', 1, 'Số điện thoại');
            $form->text('name', '', 1, 'Tên trang hiện tại');
            $form->text('current_page', '', 1, 'Đường dẫn trang');
        $form->endCard();

        $form->card('col-lg-3', '');
            $form->action('add');
        $form->endCard();

        $form->hasFullForm();
        // Hiển thị form tại view
        return $form->render('create_multi_col');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $requests) {
        // Xử lý validate
        $this->validate($requests,['phone' => 'required|regex:/(0)([0-9]{9})/'],  ['phone.regex' => 'Số điện thoại của bạn không đúng định dạng!'] );
        // Các giá trị mặc định
        $active_status = 0;
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        // Chuẩn hóa lại dữ liệu
        // Thêm vào DB
        $created_at = $updated_at = date('Y-m-d H:i:s');
        $compact = compact('phone', 'name', 'current_page', 'active_status', 'created_at', 'updated_at');
        $id = $this->models->createRecord($requests, $compact, $this->has_seo, true);
        // Điều hướng
        return redirect(route('admin.'.$this->table_name.'.'.$redirect, $id))->with([
            'type' => 'success',
            'message' => __('Translate::admin.create_success')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //khai báo
        $active_status = [0 => 'Chờ xử lý', 1 => 'Đã gọi khách'];
        // Dẽ liệu bản ghi hiện tại
        $data_edit = $this->models->where('id', $id)->first();
        // Khởi tạo form
        $form = new Form;

        $form->card('col-lg-9');
            $form->text('phone', $data_edit->phone, 1,'Số điện thoại');
            $form->text('name', $data_edit->name, 1, 'Tên trang hiện tại');
            $form->text('current_page', $data_edit->current_page, 1, 'Đường dẫn trang');
        $form->endCard();

        $form->card('col-lg-3', '');
            // lấy link xem
            $link = (config('app.call_me_back_models')) ? config('app.call_me_back_models')::where('id', $id)->first()->getUrl() : '';
            $form->action('edit', $link);
            $form->radio('active_status', $data_edit->active_status, 'Xác nhận', $active_status);
        $form->endCard();

        $form->hasFullForm();

        // Hiển thị form tại view
        return $form->render('edit_multi_col', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $requests, $id) {
        // Xử lý validate
        $this->validate($requests,['phone'=>'required|min:11|numeric'],  ['phone.numeric' => 'Vui lòng nhập đúng số điện thoại!'] );
        // Lấy bản ghi
        $data_edit = $this->models->where('id', $id)->first();
        // Các giá trị mặc định
        $active_status = 0;
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        // Chuẩn hóa lại dữ liệu
        // Các giá trị thay đổi
        $created_at = $updated_at = date('Y-m-d H:i:s');
        $compact = compact('phone', 'name', 'current_page', 'active_status', 'created_at', 'updated_at');
        // Cập nhật tại database
        $this->models->updateRecord($requests, $id, $compact, $this->has_seo);
        // Điều hướng
        return redirect(route('admin.'.$this->table_name.'.'.$redirect, $id))->with([
            'type' => 'success',
            'message' => __('Translate::admin.update_success')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
    public function export() {
        return Excel::download(new Export, 'Export_call_me_back.xlsx');
    }
}