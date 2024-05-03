<?php

namespace Sudo\AdminUser\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use ListData;
use Form;
use Sudo\Base\Http\Controllers\AdminController;
class AdminUserController extends AdminController
{
    function __construct() {
        $this->models = new \Sudo\AdminUser\Models\AdminUser;
        $this->table_name = $this->models->getTable();
        $this->module_name = 'Tài khoản quản trị';
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
        $listdata = new ListData($requests, $this->models, 'AdminUser::admin_users.table');
        // Build Form tìm kiếm
        $listdata->search('name', 'Tên', 'string');
        $listdata->search('email', 'Email', 'string');
        $listdata->search('created_at', 'Ngày tạo', 'range');
        $listdata->search('status', 'Trạng thái', 'array', config('app.status'));
        // Build các hành động
        $listdata->action('status');
        // Build các btn hành động
        $listdata->btnAction('status', __('Translate::table.apply'), 'primary');
        // Build bảng
        $listdata->add('image', 'Ảnh', 0, 'image');
        $listdata->add('name', 'Tên', 1);
        $listdata->add('email', 'Email', 1);
        $listdata->add('', 'Phân quyền');
        $listdata->add('status', 'Trạng thái', 1, 'status');
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
        $form->card('col-lg-6', 'Thêm mới tài khoản quản trị', 'Những trường dưới đây là bắt buộc');
            $form->row();
                $form->text('name', '', 1, 'Tên đăng nhập', '', false, 'col-lg-6');
                $form->text('position', '', 1, 'Vị trí', '', false, 'col-lg-6');
            $form->endRow();
            $form->row();
                $form->passwordGenerate('password', '', 1, 'Mật khẩu', '', '', false, 'col-lg-6');
                $form->password('password_confirm', '', 1, 'Nhập lại mật khẩu', '', 'password', false, 'col-lg-6');
            $form->endRow();
            $form->email('email', '', 1, 'Email', '');
            $form->checkbox('status', 1, 1, 'Trạng thái', 'col-lg-12');
            $form->custom('AdminUser::admin_users.role');
        $form->endCard();
        $form->card('col-lg-6', 'Thông tin bổ xung', 'Không bắt buộc');
            $form->row();
                $form->text('display_name', '', 0, 'Họ tên', '', false, 'col-lg-6');
                $form->text('phone', '', 0, 'Số điện thoại', '', false, 'col-lg-6');
            $form->endRow();
            $form->text('address', '', 0, 'Địa chỉ', '');
            $form->row();
                $form->datepicker('birthday', '', 0, 'Sinh nhật', '', false, 'col-lg-6');
                $form->datetimepicker('created_at', '', 0, 'Ngày tạo tài khoản', '', false, 'col-lg-6');
            $form->endRow();
            $form->image('avatar', '', 0, 'Ảnh đại diện', 'Chọn ảnh có kích thước 600x600');
            $form->textarea('infomation', '', 0, 'Tiểu sử tác giả', 'Chỉ nhập nội dung text, có thể xuống dòng', 5, false, 'col-lg-12', '');
            $form->custom('AdminUser::admin_users.custom.social');
        $form->endCard();
        $form->action('add');
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
        validateForm($requests, 'name', 'Tên đăng nhập không được để trống.');
        validateForm($requests, 'email', 'Email không được để trống.');
        validateForm($requests, 'email', 'Đinh dạng Email không chính xác', 'email');
        // Các giá trị mặc định
        $status = 0;
        $created_at = $updated_at = date('Y-m-d H:i:s');
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        // Chuẩn hóa lại dữ liệu
        $social = $this->socialHandle($requests);
        $password = $this->passwordHandle($requests);
        $capabilities = $this->capabilityHandle($requests);
        // Thêm vào DB

        if($redirect == 'save'){
            $status = 0;
            $redirect = 'edit';
        }
        $compact = compact('name','email','password','position', 'display_name', 'phone','address','birthday','avatar','infomation','social','capabilities','status','created_at','updated_at');

        $id = $this->models->createRecord($requests, $compact, $this->has_seo);
        // Điều hướng
        return redirect(route('admin.'.$this->table_name.'.'.$redirect, $id))->with([
            'type' => 'success',
            'message' => __('Core::admin.create_success')
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
        $form->card('col-lg-6', 'Sửa tài khoản quản trị', 'Những trường dưới đây là bắt buộc');
            $form->row();
                $form->text('name', $data_edit->name, 1, 'Tên đăng nhập', '', false, 'col-lg-6', true);
                $form->text('position', $data_edit->position, 1, 'Vị trí', '', false, 'col-lg-6');
            $form->endRow();
            $form->checkbox('change_password', 0, 1, 'Đổi mật khẩu', 'col-lg-6');
            $form->row();
                $form->passwordGenerate('password', '', 0, 'Mật khẩu', '', '', false, 'col-lg-6');
                $form->password('password_confirm', '', 0, 'Nhập lại mật khẩu', '', 'password', false, 'col-lg-6');
            $form->endRow();
            $form->email('email', $data_edit->email, 1, 'Email', '', false, '', true);
            $form->checkbox('status', $data_edit->status, 1, 'Trạng thái', 'col-lg-12');
            $form->custom('AdminUser::admin_users.role');
        $form->endCard();
        $form->card('col-lg-6', 'Thông tin bổ xung', 'Không bắt buộc');
            $form->row();
                $form->text('display_name', $data_edit->display_name, 0, 'Họ tên', '', false, 'col-lg-6');
                $form->text('phone', $data_edit->phone, 0, 'Số điện thoại', '', false, 'col-lg-6');
            $form->endRow();
            $form->text('address', $data_edit->address, 0, 'Địa chỉ', '');
            $form->row();
                $form->datepicker('birthday', $data_edit->birthday, 0, 'Sinh nhật', '', false, 'col-lg-6');
                $form->datetimepicker('created_at', $data_edit->created_at, 0, 'Ngày tạo tài khoản', '', false, 'col-lg-6');
            $form->endRow();
            $form->image('avatar', $data_edit->avatar, 0, 'Ảnh đại diện');
            $form->textarea('infomation', $data_edit->infomation, 0, 'Tiểu sử tác giả', 'Chỉ nhập nội dung text, có thể xuống dòng', 5, false, 'col-lg-12', '');
            $form->custom('AdminUser::admin_users.custom.social');
        $form->endCard();
        $form->action('edit');

        // Hiển thị form tại view
        return $form->render('edit_multi_col', compact('id', 'data_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $requests, $id) {
        // Các giá trị mặc định
        $status = 0;
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        // Chuẩn hóa lại dữ liệu
        if (isset($change_password) && $change_password == 1) {
            $password = $this->passwordHandle($requests);
        }
        $social = $this->socialHandle($requests);
        $capabilities = $this->capabilityHandle($requests); 
        // Các giá trị thay đổi
        $created_at = $updated_at = date('Y-m-d H:i:s');
        $compact = compact('password','position', 'display_name', 'phone','address','birthday','avatar','infomation','social','capabilities','status','updated_at');
        // Chuẩn xóa tiếp compact
        if (!isset($change_password)) {
            unset($compact['password']);
        }
        // Cập nhật tại database
        $this->models->updateRecord($requests, $id, $compact, $this->has_seo);
        // Điều hướng
    	return redirect(route('admin.'.$this->table_name.'.'.$redirect, $id))->with([
            'type' => 'success',
            'message' => __('Core::admin.update_success')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        if ($id == 1) {
            return [
                'status' => 2,
                'message' => __('Core::admin.can_delete_users'),
            ];
        } else {
            // Ghi logs
            systemLogs('quick_delete', ['status' => -1], $this->table_name, $id);
            // Cập nhật bản ghi hiện tại  không thuộc cha và có trạng thái xóa [-1]
            $this->models->where('id', $id)->update([
                'status'    => -1,
            ]);
        	return [
                'status' => 1,
                'message' => $id
            ];
        }
    }

    /**
     * Xử lý mật khẩu
     * @param  requests  $requests
     * @return $password
     */
    public function passwordHandle($requests) {
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        // Xử lý validate
        validateForm($requests, 'password', 'Core::admin.validate.required_password');
        validateForm($requests, 'password_confirm', 'Core::admin.validate.required_password_comfirm');
        validateForm($requests, 'password', 'Core::admin.validate.required_equal', 'same', 'same:password_confirm');
        // Trả về
        return $password = bcrypt($password);
    }

    /**
     * Xử lý phân quyền
     * @param  requests  $requests
     * @return $password
     */
    public function capabilityHandle($requests) {
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        // json_encode lại quyền
        $capabilities = json_encode($role ?? []);
        // Trả về
        return $capabilities;
    }

    /**
     * Xử lý liên kết mạng xã hội
     * @param  requests  $requests
     * @return $password
     */

    public function socialHandle($requests){
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        $social['social_name'] = $social_name??'';
        $social['social_link'] = $social_link??'';
        return json_encode($social);
    }

    /**
     * View đổi mật khẩu
     * @param  requests  $id
     * @return view
     */
    public function changePassword($id) {
        // Chỉ tài khoản hiện tại được truy cập và sửa
        if ($id != \Auth::guard('admin')->user()->id) {
            return redirect(route('admin.home'))->with([
                'type' => 'success',
                'message' => __('Core::admin.no_permission')
            ]);
        }
        // Khởi tạo form
        $form = new Form;
        $form->passwordGenerate('password', '', 1, 'Mật khẩu', 'Mật khẩu mới');
        $form->password('password_confirm', '', 1, 'Nhập lại mật khẩu', 'Nhập lại mật khẩu mới', 'password');
        $form->action('custom', '', '', [
                                            [ 
                                                'type' => 'submit', 
                                                'label' => __('Translate::form.action.save'),
                                                'btn_type' => 'success',
                                                'icon' => 'fas fa-save',
                                                'value' => 'edit',
                                            ]
                                        ]);
        // Hiển thị form tại view
        $action = 'change_password';
        $action_name = 'Core::admin.change_password';
        return $form->render('custom', compact('id', 'action', 'action_name'), 'AdminUser::admin_users.change_info');
    }

    /**
     * Xử lý đổi mật khẩu
     * @param  requests  $requests
     * @param  requests  $id
     * @return redirect
     */
    public function changePasswordPost(Request $requests, $id) {
        // Chỉ tài khoản hiện tại được truy cập và sửa
        if ($id != \Auth::guard('admin')->user()->id) {
            return redirect(route('admin.home'))->with([
                'type' => 'success',
                'message' => __('Core::admin.no_permission')
            ]);
        }
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        // Chuẩn hóa lại dữ liệu
        $password = $this->passwordHandle($requests);
        // Các giá trị thay đổi
        $compact = compact('password');
        // Cập nhật tại database
        $this->models->updateRecord($requests, $id, $compact, $this->has_seo, false);
        // Điều hướng
        return redirect()->back()->with([
            'type' => 'success',
            'message' => __('Core::admin.update_success')
        ]);
    }

    /**
     * View thay đổi thông tin
     * @param  requests  $id
     * @return view
     */
    public function changeInfo($id) {
        // Dẽ liệu bản ghi hiện tại
        $data_edit = $this->models->where('id', $id)->first();
        // Chỉ tài khoản hiện tại được truy cập và sửa
        if ($id != \Auth::guard('admin')->user()->id) {
            return redirect(route('admin.home'))->with([
                'type' => 'success',
                'message' => __('Core::admin.no_permission')
            ]);
        }
        $google2fa = (new \PragmaRX\Google2FAQRCode\Google2FA());
        $google2fa_url = $google2fa->getQRCodeInline(
            env('APP_NAME', 'Sudo'),
            $data_edit->email,
            $data_edit->google2fa_secret
        );
        // Khởi tạo form
        $form = new Form;

        $form->row();
            if($google2fa_url){
                $form->custom('AdminUser::admin_users.custom.qrcode', ['google2fa_url' => $google2fa_url]);
            }
            $form->text('display_name', $data_edit->display_name, 0, 'Họ tên', '', false, 'col-lg-6');
            $form->text('phone', $data_edit->phone, 0, 'Số điện thoại', '', false, 'col-lg-6');
        $form->endRow();
        $form->row();
            $form->text('address', $data_edit->address, 0, 'Địa chỉ', '', false, 'col-lg-6');
            $form->datepicker('birthday', $data_edit->birthday, 0, 'Sinh nhật', '', false, 'col-lg-6');
        $form->endRow();
        $form->image('avatar', $data_edit->avatar, 0, 'Ảnh đại diện');
        $form->textarea('infomation', $data_edit->infomation, 0, 'Tiểu sử', 'Chỉ nhập nội dung text, có thể xuống dòng', 5, false, 'col-lg-12', '');
        $form->custom('AdminUser::admin_users.custom.social');

        $form->action('custom', '', '', [
                                            [ 
                                                'type' => 'submit', 
                                                'label' => __('Translate::form.action.save'),
                                                'btn_type' => 'success',
                                                'icon' => 'fas fa-save',
                                                'value' => 'edit',
                                            ]
                                        ]);
        // Hiển thị form tại view
        $action = 'change_info';
        $action_name = 'Core::admin.account_info';
        return $form->render('custom', compact('id', 'action', 'action_name', 'data_edit'), 'AdminUser::admin_users.change_info');
    }

    /**
     * Xử lý đổi thông tin
     * @param  requests  $requests
     * @param  requests  $id
     * @return redirect
     */
    public function changeInfoPost(Request $requests, $id) {
        // Chỉ tài khoản hiện tại được truy cập và sửa
        if ($id != \Auth::guard('admin')->user()->id) {
            return redirect(route('admin.home'))->with([
                'type' => 'success',
                'message' => __('Core::admin.no_permission')
            ]);
        }
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        // Chuẩn hóa lại dữ liệu
        $social = $this->socialHandle($requests);
        // Các giá trị thay đổi
        $created_at = $updated_at = date('Y-m-d H:i:s');
        $compact = compact('display_name', 'phone', 'address','birthday','avatar', 'infomation', 'social','updated_at');
        // Cập nhật tại database
        $this->models->updateRecord($requests, $id, $compact, $this->has_seo, false);
        // Điều hướng
        return redirect()->back()->with([
            'type' => 'success',
            'message' => __('Core::admin.update_success')
        ]);
    }
}