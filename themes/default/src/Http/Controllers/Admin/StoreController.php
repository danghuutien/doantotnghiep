<?php

namespace Sudo\Theme\Http\Controllers\Admin;
use Sudo\Base\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use ListData;
use Form;
use Sudo\Theme\Models\Province;
use Sudo\Theme\Models\District;
use Sudo\Theme\Models\Ward;

class StoreController extends AdminController
{
    function __construct() {
        $this->models = new \Sudo\Theme\Models\Store;
        $this->table_name = $this->models->getTable();
        $this->module_name = 'Hệ thống cửa hàng';
        $this->has_seo = true;
        $this->has_locale = false;
        $this->provinces = Province::all();
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $requests) {
        $listdata = new ListData($requests, $this->models, 'Default::admin.stores.index', $this->has_locale);
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
        $form->card('col-lg-8');
            $form->lang($this->table_name, true);
            $form->text('name', '', 1, 'Tên cửa hàng', '', true);
            $form->slug('slug', '', 1, 'Đường dẫn', 'name', true, $this->table_name, true);
            $form->text('phone', '', 0, 'Điện thoại', '', true);
            $form->select('area', '', 1, 'Khu vực', $this->models->getArea(), true, [], true);
            $form->custom('Ecommerce::admin.orders.form.select', ['provinces'=>$this->provinces, 'districts' => [], 'wards' => []]);
            $form->text('address', '', 1, 'Địa chỉ', '', true);
            $form->text('lat', '', 1, 'Latitude', '', true);
            $form->text('long', '', 1, 'Longitude', '', true);
            $form->text('driver_link', '', 0, 'Link chỉ đường', '', true);
            $form->textarea('iframe', '', 1, 'Iframe google map', '', false);
            $form->editor('detail', '', 0, 'Nội dung', false);
            $form->multiSuggest('related_store', '', 0, 'Cửa hàng gần đây', 'Tìm theo tên cửa hàng...', 'stores','id', 'name', $this->has_locale, true, '');
        $form->endCard();
        $form->card('col-lg-4');
            $form->checkbox('status', 1, 1, 'Trạng thái');
            $form->checkbox('p_driver', 1, 1, 'Có chỗ đậu xe');
            $form->image('image', '', 0, 'Ảnh đại diện', 'Chọn ảnh','Chọn ảnh có kích thước 600x600 để hiển thị đẹp nhất');
            $form->multiImage('slides', '', 0, 'Ảnh Slide');
            $form->action('add');
        $form->endCard();
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
        validateForm($requests, 'name', 'Tiêu đề không được để trống.');
        validateForm($requests, 'slug', 'Đường dẫn không được để trống.');
        validateForm($requests, 'slug', 'Đường dẫn đã bị trùng.', 'unique', 'unique:stores');
        validateForm($requests, 'area', 'Khu vực không được để trống.');
        validateForm($requests, 'province_id', 'Tỉnh thành không được để trống.');
        validateForm($requests, 'district_id', 'Quận huyện không được để trống.');
        validateForm($requests, 'ward_id', 'Phường xã không được để trống.');
        validateForm($requests, 'address', 'Địa chỉ chi tiết không được để trống.');
        validateForm($requests, 'lat', 'Đường dẫn không được để trống.');
        validateForm($requests, 'long', 'Longitude không được để trống.');
        // Các giá trị mặc định
        $status = $p_driver = 0;
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);

        // Nếu click lưu nháp
        if($redirect == 'save'){
            $status = 0;
            $redirect = 'edit';
        }
        $slides = implode(',', $slides ?? []);
        if (isset($related_store) && !empty($related_store)) { $related_store = implode(',', $related_store); } else { $related_store = null; }
        // Thêm vào DB
        $created_at = $updated_at = date('Y-m-d H:i:s');
        $compact = compact('name','slug', 'image', 'slides', 'phone', 'area', 'province_id', 'district_id', 'ward_id', 'address', 'lat', 'long','detail', 'p_driver', 'iframe', 'driver_link', 'related_store', 'status','created_at','updated_at');
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
        $districts = District::where('province_id', $data_edit->province_id)->get();
        $wards = Ward::where('district_id', $data_edit->district_id)->get();
        // Khởi tạo form
        $form = new Form;
        $form->card('col-lg-8');
            $form->lang($this->table_name);
            $form->text('name', $data_edit->name, 1, 'Tiêu đề', '', true);
            $form->slug('slug', $data_edit->slug, 1, 'Đường dẫn', '', false, '', true);
            $form->text('phone', $data_edit->phone, 0, 'Điện thoại', '', true);
            $form->select('area', $data_edit->area, 1, 'Khu vực', $this->models->getArea(), true, [], true);
            $form->custom('Ecommerce::admin.orders.form.select', ['provinces'=>$this->provinces, 'districts' => $districts, 'wards' => $wards, 'data_edit' => $data_edit]);
            $form->text('address', $data_edit->address, 1, 'Địa chỉ', '', true);
            $form->text('lat', $data_edit->lat, 1, 'Latitude', '', true);
            $form->text('long', $data_edit->long, 1, 'Longitude', '', true);
            $form->text('driver_link', $data_edit->driver_link, 0, 'Link chỉ đường', '', true);
            $form->textarea('iframe', $data_edit->iframe, 1, 'Iframe google map', '', true);
            $form->editor('detail', $data_edit->detail, 0, 'Nội dung', false);
            $form->multiSuggest('related_store', $data_edit->related_store, 0, 'Cửa hàng gần đây', 'Tìm theo tên cửa hàng...', 'stores','id', 'name', $this->has_locale, true, '');
        $form->endCard();
        $form->card('col-lg-4');
            $form->checkbox('status', $data_edit->status, 1, 'Trạng thái');
            $form->checkbox('p_driver', $data_edit->p_driver, 1, 'Có chỗ đậu xe');
            $form->image('image', $data_edit->image, 0, 'Ảnh đại diện', 'Chọn ảnh','Chọn ảnh có kích thước 600x600 để hiển thị đẹp nhất');
            $form->multiImage('slides', explode(',', $data_edit->slides), 0, 'Ảnh Slide');
            $form->action('edit', $data_edit->getUrl());
        $form->endCard();

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
        validateForm($requests, 'name', 'Tiêu đề không được để trống.');
        validateForm($requests, 'slug', 'Đường dẫn không được để trống.');
        validateForm($requests, 'slug', 'Đường dẫn đã bị trùng.', 'unique', 'unique:stores,slug,'.$id);
        validateForm($requests, 'area', 'Khu vực không được để trống.');
        validateForm($requests, 'province_id', 'Tỉnh thành không được để trống.');
        validateForm($requests, 'district_id', 'Quận huyện không được để trống.');
        validateForm($requests, 'ward_id', 'Phường xã không được để trống.');
        validateForm($requests, 'address', 'Địa chỉ chi tiết không được để trống.');
        validateForm($requests, 'lat', 'Đường dẫn không được để trống.');
        validateForm($requests, 'long', 'Longitude không được để trống.');
        // Lấy bản ghi
        $data_edit = $this->models->where('id', $id)->first();
        // Các giá trị mặc định
        $status = $p_driver = 0;
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        // Chuẩn hóa lại dữ liệu
        $slides = implode(',', $slides ?? []);
        if (isset($related_store) && !empty($related_store)) { $related_store = implode(',', $related_store); } else { $related_store = null; }
        // Thêm vào DB
        $updated_at = date('Y-m-d H:i:s');
        $compact = compact('name','slug', 'image', 'slides', 'phone', 'area', 'province_id', 'district_id', 'ward_id', 'address', 'lat', 'long','detail', 'p_driver', 'iframe', 'driver_link', 'related_store', 'status','updated_at');
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
