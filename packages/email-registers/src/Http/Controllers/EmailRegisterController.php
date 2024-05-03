<?php

namespace Sudo\EmailRegister\Http\Controllers;
use Sudo\Base\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use ListData;
use Form;
use ListCategory;

class EmailRegisterController extends AdminController
{
    function __construct() {
        $this->models = new \Sudo\EmailRegister\Models\EmailRegister;
        $this->table_name = $this->models->getTable();
        $this->module_name = 'Đăng ký Email';
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
        $listdata = new ListData($requests, $this->models, 'EmailRegister::table.index', $this->has_locale);

        // Build Form tìm kiếm
        $listdata->search('email', 'Email', 'string');
        $listdata->search('created_at', 'Ngày tạo', 'range');
        $listdata->search('status', 'Trạng thái', 'array', config('app.status'));
        // Build các button hành động
        $listdata->btnAction('status', 1, __('Translate::table.active'), 'info', 'fas fa-window-close');
        $listdata->btnAction('status', 2, __('Translate::table.no_active'), 'success', 'fas fa-edit');
        $listdata->btnAction('delete', -1, __('Translate::table.trash'), 'danger', 'fas fa-trash');
        // Build bảng
        $listdata->add('name', 'Email người gửi');
        $listdata->add('', 'Thời gian', 0, 'time');
        $listdata->add('status', 'Trạng thái', 0, 'status', config('app.status'));
        $listdata->add('', 'Xóa', 0, 'delete');
        $listdata->no_add();

        return $listdata->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $requests)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $requests
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
    public function destroy($id)
    {
        //
    }

    public function exports(Request $requests) {
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        // Lấy dữ liệu được bắt theo bộ lọc
        $data_exports = $this->models::query();
        // Email
        if (isset($email) && $email != '') {
            $data_exports = $data_exports->where('email', 'LIKE', '%'.$email.'%');
        }
        // lọc ngày
        if($created_at_end != '' && $created_at_start != '') {
            $data_exports = $data_exports->where('created_at','>',$created_at_start);
            $data_exports = $data_exports->where('created_at','<',$created_at_end);
        }
        // lọc trạng thái
        if (isset($status) && $status != '') {
            $data_exports = $data_exports->where('status',$status);
        }
        $data_exports = $data_exports->where('status', '<>', -1)->get();
        // Mảng export
        $data = [
            'file_name' => 'email-register-'.time(),
            'fields' => [
                __('Email'),
                __('Thời gian'),
                __('Trạng thái'),
            ],
            'data' => [
                // 
            ]
        ];
        $status = config('app.status');
        foreach ($data_exports as $key => $value) {
            $data['data'][] = [
                $value->email,
                $value->getTime(),
                $status[$value->status] ?? '',
            ];
        }
        return \Excel::download(new \Sudo\Base\Export\GeneralExports($data), $data['file_name'].'.xlsx');
    }

}
