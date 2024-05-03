<?php

namespace Sudo\Post\Http\Controllers;
use DB;
use Sudo\Base\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use ListData;
use Form;
use ListCategory;

class PostCategoryController extends AdminController
{
    function __construct() {
        $this->models = new \Sudo\Post\Models\PostCategory;
        $this->table_name = $this->models->getTable();
        $this->module_name = 'Danh mục bài viết';
        $this->has_seo = true;
        $this->has_seo_review = false;
        $this->has_locale = false;
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $requests) {
        $listdata = new \Sudo\Category\MyClass\ListDataCategory($requests, $this->models, 'Post::post_categories.table', $this->has_locale);
        // Build Form tìm kiếm
        $listdata->search('name', 'Tên', 'string');
        // Build các hành động
        $listdata->action('status');
        $listdata->table_simple();
        $listdata->no_paginate();
        $listdata->no_trash();
        // Build bảng
        $listdata->add('name', 'Tên', 1);
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
    public function create(Request $requests)
    {
        // danh mục
        $categories = new ListCategory('post_categories', $this->has_locale, Request()->lang_locale ?? \App::getLocale());
        // Khởi tạo form
        $form = new Form;
        $form->card('col-lg-6', 'Thêm danh mục', 'Những trường đánh dấu * là bắt buộc');
            $form->lang($this->table_name);
            $form->text('name', '', 1, 'Tên danh mục');
            $form->slug('slug', '', 1, 'Đường dẫn', 'name', true);
            $form->select('parent_id', '', 0, 'Danh mục cha', $categories->data_select(), 0);
            $form->image('image', '', 0, 'Ảnh banner', 'Chọn ảnh', '', 'Chọn ảnh có kích thước 1170x750');
            $form->editor('detail', '', 0, 'Mô tả danh mục');
            $form->checkbox('status', 1, 1, 'Trạng thái', 'col-lg-6');
        $form->endCard();
        $form->action('add');
        $form->card('col-lg-6', 'Danh sách danh mục');
            $form->custom('Post::post_categories.index');
        $form->endCard();
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
        validateForm($requests, 'slug', 'Đường dẫn đã bị trùng.', 'unique', 'unique:slugs');
        // Các giá trị mặc định
        $status = 0;
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        // Chuẩn hóa lại dữ liệu
        if (isset($parent_id) && !empty($parent_id)) {
            $parent_id = $parent_id;
        } else {
            $parent_id = 0;
        }

        // Nếu click lưu nháp
        if($redirect == 'save'){
            $status = 0;
            $redirect = 'edit';
        }
        // Thêm vào DB
        $created_at = $updated_at = date('Y-m-d H:i:s');
        $compact = compact('parent_id','name','slug','image','detail','status','created_at','updated_at');
        $id = $this->models->createRecord($requests, $compact, $this->has_seo, true);
        DB::table('slugs')->insert([
            'table' => 'post_categories',
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
    public function edit($id)
    {
        // Dẽ liệu bản ghi hiện tại
        $data_edit = $this->models->where('id', $id)->first();
        // Ngôn ngữ bản ghi hiện tại
        $language_meta = \DB::table('language_metas')->where('lang_table', $this->table_name)->where('lang_table_id', $data_edit->id)->first();
        // danh mục ứng với ngôn ngữ
        $categories = new ListCategory('post_categories', $this->has_locale, $language_meta->lang_locale ?? null);
        $slug_item = DB::table('slugs')->where('table', 'post_categories')->where('table_id', $id)->first();
        $slug = $slug_item->slug ?? $data_edit->slug;
        // Khởi tạo form
        $form = new Form;

        $form->card('col-lg-6', 'Thêm danh mục', 'Những trường đánh dấu * là bắt buộc nhập');
            $form->lang($this->table_name);
            $form->text('name', $data_edit->name, 1, 'Tên danh mục');
            $form->slug('slug', $slug, 1, 'Đường dẫn', '', false);
            $form->select('parent_id', $data_edit->parent_id, 0, 'Danh mục cha', $categories->data_select(), 0, $data_edit->getChildIds());
            $form->image('image', $data_edit->image, 0, 'Ảnh banner', '', 'Chọn ảnh có kích thước 1170x750');
            $form->editor('detail', $data_edit->detail, 0, 'Mô tả danh mục');
            $form->checkbox('status', $data_edit->status, 1, 'Trạng thái', 'col-lg-6');
        $form->endCard();
        $form->action('edit', $data_edit->getUrl());
        $form->card('col-lg-6', 'Danh sách danh mục');
            $form->custom('Post::post_categories.index');
        $form->endCard();
        // Hiển thị form tại view
        return $form->render('edit_and_show', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $requests, $id) {
        $slug_item = DB::table('slugs')->where('table', 'post_categories')->where('table_id', $id)->first();
        // Xử lý validate
        validateForm($requests, 'name', 'Tiêu đề không được để trống.');
        validateForm($requests, 'slug', 'Đường dẫn không được để trống.');
        validateForm($requests, 'slug', 'Đường dẫn đã bị trùng.', 'unique', 'unique:slugs,slug,'.@$slug_item->id??0);
        // Lấy bản ghi
        $data_edit = $this->models->where('id', $id)->first();
        // Các giá trị mặc định
        $status = 0;
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        // Chuẩn hóa lại dữ liệu
        if (isset($parent_id) && !empty($parent_id)) {
            $parent_id = $parent_id;
        } else {
            $parent_id = 0;
        }
        // Các giá trị thay đổi
        $created_at = $updated_at = date('Y-m-d H:i:s');
        $compact = compact('parent_id','name','slug','image','detail','status','updated_at');
        // Cập nhật tại database
        $this->models->updateRecord($requests, $id, $compact, $this->has_seo);
        if($slug_item){
            $slug_item = DB::table('slugs')
                ->where('table', 'post_categories')
                ->where('table_id', $id)
                ->update([
                    'slug' => $slug,
                    'updated_at' => $updated_at,
                ]);
        } else{
            DB::table('slugs')->insert([
                'table' => 'post_categories',
                'table_id' => $id,
                'slug' => $slug,
                'created_at' => $created_at,
                'updated_at' => $updated_at,
            ]);
        }
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
        // Bản ghi cần xóa hiện tại
        $record = $this->models->find($id);
        // Toàn bộ bản ghi con của nó
        $child_record = $this->models->where('parent_id', $record->id)->get();
        // Mảng id của bản ghi con
        $child_record_array_id = $child_record->pluck('id');
        // Cập nhật parent_id của bản ghi con bằng bản ghi cha của bản ghi hiện tại
        $this->models->whereIn('id', $child_record_array_id)->update([
            'parent_id' => $record->parent_id ?? null,
        ]);
        // Ghi logs
        systemLogs('quick_delete', ['status' => -1], $this->table_name, $id);
        // Cập nhật bản ghi hiện tại  không thuộc cha và có trạng thái xóa [-1]
        $this->models->where('id', $id)->update([
            'parent_id' => 0,
            'status'    => -1,
        ]);
        // Trả về
        return [
            'status' => 1,
            'message' => __('Translate::admin.delete_success')
        ];
    }
}
