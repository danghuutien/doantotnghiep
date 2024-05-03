<?php

namespace Sudo\Base\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use ListData;

class SystemLogController extends AdminController
{
	function __construct() {
        $this->models = new \Sudo\Base\Models\SystemLog;
        $this->table_name = $this->models->getTable();
        $this->module_name = 'Lịch sử hệ thống';
        $this->has_seo = false;
        parent::__construct();
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $requests) {
        $listdata = new ListData($requests, $this->models, 'Core::system_logs.table');
        // Build Form tìm kiếm
        $admin_users = \Sudo\AdminUser\Models\AdminUser::get()->pluck('name', 'id');
        
        $listdata->search('admin_id', 'Quản trị viên', 'array', $admin_users);
        $listdata->search('action', 'Hành động', 'array', [
            'login' => 'Đăng nhập',
            'create' => 'Thêm mới',
            'update' => 'Cập nhật',
        ]);
        $listdata->search('time', 'Ngày tạo', 'range');
        // Build bảng
        $listdata->add('admin_id', 'Người thao tác', 0);
        $listdata->add('ip', 'Địa chỉ IP', 0);
        $listdata->add('action', 'Hành động', 0);
        $listdata->add('type', 'Module thao tác', 0);
        $listdata->add('time', 'Thời gian', 0);
        $listdata->add('', 'Xem', 0, 'show');

        $listdata->no_add();
        $listdata->no_trash();

        return $listdata->render(compact('admin_users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $requests) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        // Dữ liệu logs
        $data = \Sudo\Base\Models\SystemLog::where('id', $id)->firstOrFail();
        // Dữ liệu người thực hiện
        $admin_users = \Sudo\AdminUser\Models\AdminUser::where('id', $data->admin_id)->first();
        // Trả về view
    	return view('Core::'.$this->table_name.'.show', compact(
            'data', 'admin_users'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $requests, $id) {
        //
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