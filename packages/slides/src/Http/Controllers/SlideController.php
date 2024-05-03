<?php

namespace Sudo\Slide\Http\Controllers;
use Sudo\Base\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use ListData;
use Form;

class SlideController extends AdminController
{
	function __construct() {
        $this->models = new \Sudo\Slide\Models\Slide;
        $this->table_name = $this->models->getTable();
        $this->module_name = 'Slides';
        $this->has_locale = false;
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $requests) {
    	$listdata = new ListData($requests, $this->models, 'Slide::table.index', $this->has_locale);
        // Build Form tìm kiếm
        $listdata->search('title', 'Tiêu đề', 'string');
        $listdata->search('status', 'Trạng thái', 'array', config('app.status'));
        // Build các hành động
        $listdata->action('status');
        // Build bảng
        $listdata->add('image', 'Ảnh', 0);
        $listdata->add('title', 'Tiêu đề', 0);
        $listdata->add('orders', 'Sắp xếp');
        $listdata->add('', 'Thời gian', 0, 'time');
        $listdata->add('status', 'Trạng thái', 0, 'status');
        $listdata->add('', 'Language', 0, 'lang');
        $listdata->add('', 'Hành động', 0, 'action');

        return $listdata->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        // Khởi tạo form
        $form = new Form;

        $form->lang($this->table_name, true);
        $form->text('title', '', 1, 'Tiêu đề', '', true);
        $form->image('image', '', 1, 'Ảnh slides', 'Chọn ảnh','Chọn ảnh có kích thước 924x370 để hiển thị đẹp nhất', true);
        $form->text('link', '', 0, 'Đường dẫn khi click vào ảnh', '', true);
        $form->checkbox('status', 1, 1, 'Trạng thái');
        $form->action('add');
        // Hiển thị form tại view
        return $form->render('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $requests) {
        // Xử lý validate
        validateForm($requests, 'title', 'Tiêu đề không được để trống.');
        // Các giá trị mặc định
        $status = 0;
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);

        // Nếu click lưu nháp
        if($redirect == 'save'){
            $status = 0;
            $redirect = 'edit';
        }

        // Thêm vào DB
        $created_at = $updated_at = date('Y-m-d H:i:s');
        $compact = compact('title','link','image','status','created_at','updated_at');
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
        // Dẽ liệu bản ghi hiện tại
        $data_edit = $this->models->where('id', $id)->first();
        // Khởi tạo form
        $form = new Form;

        $form->lang($this->table_name);
        $form->text('title', $data_edit->title, 1, 'Tiêu đề', '', true);
        $form->image('image', $data_edit->image, 1, 'Ảnh slides', 'Chọn ảnh','Chọn ảnh có kích thước 924x370 để hiển thị đẹp nhất', true);
        $form->text('link', $data_edit->link, 0, 'Đường dẫn khi click vào ảnh', '', true);
        $form->checkbox('status', $data_edit->status, 1, 'Trạng thái');
        $form->action('edit');

        // Hiển thị form tại view
        return $form->render('edit', compact('id'));
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
        validateForm($requests, 'title', 'Tiêu đề không được để trống.');
        // Lấy bản ghi
        $data_edit = $this->models->where('id', $id)->first();
        // Các giá trị mặc định
        $status = 0;
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        // Chuẩn hóa lại dữ liệu
        // Các giá trị thay đổi
        $updated_at = date('Y-m-d H:i:s');
        $compact = compact('title','link','image','status','updated_at');
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
}
