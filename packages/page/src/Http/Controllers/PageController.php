<?php

namespace Sudo\Page\Http\Controllers;
use Sudo\Base\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use ListData;
use Form;
use DB;

class PageController extends AdminController
{
	function __construct() {
        $this->models = new \Sudo\Page\Models\Page;
        $this->table_name = $this->models->getTable();
        $this->module_name = 'Trang đơn';
        $this->has_seo = true;
        $this->has_locale = true;
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $requests) {
    	$listdata = new ListData($requests, $this->models, 'Page::table.index', $this->has_locale);
        // Build Form tìm kiếm
        $listdata->search('name', 'Tên', 'string');
        $listdata->search('created_at', 'Ngày tạo', 'range');
        $listdata->search('status', 'Trạng thái', 'array', config('app.status'));
        // Build các hành động
        $listdata->action('status');
        // Build bảng
        $listdata->add('name', 'Tên', 1);
        $listdata->add('', 'Thời gian', 0, 'time');
        $listdata->add('status', 'Trạng thái', 1, 'status');
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
        $form->text('name', '', 1, 'Tiêu đề', '', true);
        $form->slug('slug', '', 1, 'Đường dẫn', 'name', true, $this->table_name, true);
        $form->editor('detail', '', 0, 'Nội dung', true);
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
        validateForm($requests, 'name', 'Tiêu đề không được để trống.');
        validateForm($requests, 'slug', 'Đường dẫn không được để trống.');
        validateForm($requests, 'slug', 'Đường dẫn đã bị trùng.', 'unique', 'unique:slugs');
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
        $compact = compact('name','slug','detail','status','created_at','updated_at');
        $id = $this->models->createRecord($requests, $compact, $this->has_seo, true);
        DB::table('slugs')->insert([
            'table' => 'pages',
            'table_id' => $id,
            'slug' => $slug,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ]);
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
        $slug_item = DB::table('slugs')->where('table', 'pages')->where('table_id', $id)->first();
        $slug = $slug_item->slug;
        // Khởi tạo form
        $form = new Form;

        $form->lang($this->table_name);
        $form->text('name', $data_edit->name, 1, 'Tiêu đề', '', true);
        $form->slug('slug', $slug, 1, 'Đường dẫn', '', false, '', true);
        $form->editor('detail', $data_edit->detail, 0, 'Nội dung', true);
        $form->checkbox('status', $data_edit->status, 1, 'Trạng thái');
        $form->action('edit', $data_edit->getUrl());

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
        $slug_item = DB::table('slugs')->where('table', 'pages')->where('table_id', $id)->first();
        // Xử lý validate
        validateForm($requests, 'name', 'Tiêu đề không được để trống.');
        validateForm($requests, 'slug', 'Đường dẫn không được để trống.');
        validateForm($requests, 'slug', 'Đường dẫn đã bị trùng.', 'unique', 'unique:slugs,slug,'.$slug_item->id);
        // Lấy bản ghi
        $data_edit = $this->models->where('id', $id)->first();
        // Các giá trị mặc định
        $status = 0;
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        // Chuẩn hóa lại dữ liệu
        // Các giá trị thay đổi
        $created_at = $updated_at = date('Y-m-d H:i:s');
        $compact = compact('name','slug','detail','status','updated_at');
        $slug_item = DB::table('slugs')
            ->where('table', 'pages')
            ->where('table_id', $id)
            ->update([
                'slug' => $slug,
                'updated_at' => $updated_at,
            ]);
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
