<?php

namespace Sudo\Tag\Http\Controllers;
use Sudo\Base\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use ListData;
use Form;
use ListCategory;

class TagController extends AdminController
{
    function __construct() {
        $this->models = new \Sudo\Tag\Models\Tag;
        $this->table_name = $this->models->getTable();
        $this->module_name = 'Quản lý Tags';
        $this->has_seo = true;
        $this->has_locale = false;
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $requests) {
        $listdata = new ListData($requests, $this->models, 'Tag::table.index', $this->has_locale);
        // Build Form tìm kiếm
        $listdata->search('name', 'Tên', 'string');
        // Build các button hành động
        $listdata->action('status');

        $listdata->table_simple();
        $listdata->no_trash();
        // Build bảng
        $listdata->add('name', 'Tên', 0);
        $listdata->add('status', 'Trạng thái', 0, 'status');
        $listdata->add('', 'Hành động', 0, 'action');

        return $listdata->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        // Danh mục
        $categories = new ListCategory('post_categories', $this->has_locale, Request()->lang_locale ?? \App::getLocale());
        // Khởi tạo form
        $form = new Form;
        $form->card('col-lg-6', 'Thêm Tag', 'Những trường đánh dấu * là bắt buộc');
            $form->text('name', '', 1, 'Tiêu đề', '');
            $form->slug('slug', '', 1, 'Đường dẫn', 'name', true, 'tags');
            $form->editor('detail', '', 0, 'Nội dung');
            $form->checkbox('status', 1, 1, 'Trạng thái', 'col-lg-6');
        $form->endCard();
        $form->card('col-lg-6', 'Danh sách Tag');
            $form->custom('Tag::table.iframe');
        $form->endCard();
        $form->action('add', '', route('admin.home'));
        // Hiển thị form tại view
        return $form->render('create_and_show');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $requests)
    {
        // Xử lý validate
        validateForm($requests, 'name', 'Tiêu đề không được để trống.');
        validateForm($requests, 'slug', 'Đường dẫn không được để trống.');
        validateForm($requests, 'slug', 'Đường dẫn đã bị trùng.', 'unique', 'unique:posts');
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
        $id = $this->models->createRecord($requests, $compact, $this->has_seo, false);
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
    public function show($id)
    {
        //
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

        $form->card('col-lg-6', 'Thêm Tag', 'Những trường đánh dấu * là bắt buộc');
            $form->text('name', $data_edit->name, 1, 'Tên Tag', '');
            $form->slug('slug', $data_edit->slug, 1, 'Đường dẫn', '', false);
            $form->editor('detail', $data_edit->detail, 0, 'Mô tả tag');
            $form->checkbox('status', $data_edit->status, 1, 'Trạng thái', 'col-lg-6');
        $form->endCard();
        $form->card('col-lg-6', 'Danh sách Tag');
            $form->custom('Tag::table.iframe');
        $form->endCard();
        $form->action('edit', '', route('admin.home'));
        // Hiển thị form tại view    
        return $form->render('edit_multi_col', compact('id'));
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
        validateForm($requests, 'name', 'Tiêu đề không được để trống.');
        validateForm($requests, 'slug', 'Đường dẫn không được để trống.');
        validateForm($requests, 'slug', 'Đường dẫn đã bị trùng.', 'unique', 'unique:posts,slug,'.$id);
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
    public function destroy($id)
    {
        //
    }
}
