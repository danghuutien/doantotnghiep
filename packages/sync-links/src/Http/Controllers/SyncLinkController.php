<?php

namespace Sudo\SyncLink\Http\Controllers;
use Sudo\Base\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use ListData;
use Form;
use ListCategory;

class SyncLinkController extends AdminController
{
    function __construct() {
        $this->models = new \Sudo\SyncLink\Models\SyncLink;
        $this->table_name = $this->models->getTable();
        $this->module_name = 'Link đồng bộ';
        $this->has_seo = false;
        $this->has_locale = false;
        parent::__construct();

        $this->code = [
            '301' => '301 (vĩnh viễn)',
            '302' => '302 (Tạm thời)',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $requests) {
        $listdata = new ListData($requests, $this->models, 'SyncLink::table');
        $code = $this->code;
        // Build Form tìm kiếm
        $listdata->search('old', 'Link nguồn', 'string');
        // Build các hành động
        $listdata->action('status');
        $listdata->table_simple();
        $listdata->no_trash();
        // Build bảng
        $listdata->add('old', 'Link nguồn');
        $listdata->add('new', 'Link đích');
        $listdata->add('', 'Mã', 0,);
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
        // Khởi tạo form
        $form = new Form;
        $form->card('col-lg-6', 'Thêm mới link chuyển tiếp', 'Xin lưu ý và chắc chắn về sự thay đổi của bạn, điều này có thể ảnh hưởng tới thứ hạng từ khóa');
            $form->text('old', '', 0, 'Liên kết nguồn', '');
            $form->text('new', '', 0, 'Liên kết đích', '');
            $form->radio('code', 301, 'Điều hướng', $this->code, 'col-lg-6');
            $form->checkbox('status', 1, 1, 'Trạng thái', 'col-lg-6');
            $form->actionInline('add');
        $form->endCard();

        $form->card('col-lg-6', 'Danh sách link chuyển tiếp', 'Bạn có thể tùy chỉnh thông số, mã trạng thái link chuyển tiếp phù hợp với mục đích của bạn. Có thể mất đến 15 phút hoặc 24h để có thể sử dụng do cache của trình duyệt. Xin vui lòng đợi');
            $form->custom('SyncLink::index');
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
        // Các giá trị mặc định
        $status = 0;
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        // Chuẩn hóa lại dữ liệu
        // Thêm vào DB
        $created_at = $updated_at = date('Y-m-d H:i:s');
        $compact = compact('old','new','code','status');
        $id = $this->models->createRecord($requests, $compact, $this->has_seo, true);
        if ($requests->ajax()) {
            return [
                'status' => 1,
                'message' => __('Translate::admin.create_success')
            ];
        } else {
            // Điều hướng
            return redirect(route('admin.'.$this->table_name.'.'.$redirect, $id))->with([
                'type' => 'success',
                'message' => __('Translate::admin.create_success')
            ]);
        }
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
        $form->card('col-lg-6', 'Thêm mới link chuyển tiếp', 'Xin lưu ý và chắc chắn về sự thay đổi của bạn, điều này có thể ảnh hưởng tới thứ hạng từ khóa');
            $form->text('old', $data_edit->old, 0, 'Liên kết nguồn');
            $form->text('new', $data_edit->new, 0, 'Liên kết đích');
            $form->radio('code', $data_edit->code, 'Điều hướng', $this->code, 'col-lg-6');
            $form->checkbox('status', $data_edit->status, 1, 'Trạng thái', 'col-lg-6');
            $form->actionInline('edit');
        $form->endCard();

        $form->card('col-lg-6', 'Danh sách link chuyển tiếp', 'Bạn có thể tùy chỉnh thông số, mã trạng thái link chuyển tiếp phù hợp với mục đích của bạn. Có thể mất đến 15 phút hoặc 24h để có thể sử dụng do cache của trình duyệt. Xin vui lòng đợi');
            $form->custom('SyncLink::index');
        $form->endCard();

        // Hiển thị form tại view
        return $form->render('edit_and_show', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $requests
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $requests, $id) {
        // Lấy bản ghi
        $data_edit = $this->models->where('id', $id)->first();
        // Các giá trị mặc định
        $status = 0;
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        // Chuẩn hóa lại dữ liệu
        // Các giá trị thay đổi
        $compact = compact('old','new','code','status');
        // Cập nhật tại database
        $this->models->updateRecord($requests, $id, $compact);
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

    /**
     * Thêm dữ liệu từ excel
     */
    public function import(Request $requests) {
        if ($requests->hasFile('files')) {
            $file = $requests->file('files');
            // Lấy thông tin file
            $file_info = pathinfo($file->getClientOriginalName());
            // Phần mở rộng
            $file_extension = $file_info['extension'];
            $allow_extension = ['xlsx','xls'];
            if (in_array($file_extension, $allow_extension)) {
                try {
                    \Excel::import(new \Sudo\SyncLink\Imports\SyncLinkImport, $file);
                    return [
                        'status' => 1,
                        'message' => __('Translate::admin.create_success')
                    ];
                } catch (\Exception $e) {
                    \Log::error($e);
                    return [
                        'status' => 2,
                        'message' => __('Có lỗi trong quá trình phân tích dữ liệu, vui lòng kiểm tra lại cấu trúc File.')
                    ];
                }
            } else {
                return [
                    'status' => 2,
                    'message' => __('Định dạng file không chính xác, chỉ chấp nhận file có đuổi xlsx và xls.')
                ];
            }
        } else {
            return [
                'status' => 2,
                'message' => __('Translate::admin.ajax_error_edit')
            ];
        }
    }

    /**
     * Xuất dữ liệu excel với điều kiện bộ lọc
     */
    public function export(Request $requests) {
        // Đưa mảng về các biến có tên là các key của mảng
        extract($requests->all(), EXTR_OVERWRITE);
        // Lấy dữ liệu được bắt theo bộ lọc
        $data_exports = $this->models::query();
        
        // Link cũ
        if (isset($old) && $old != '') {
            $data_exports = $data_exports->where('subject', 'LIKE', '%'.$old.'%');
        }
        // Link mới
        if (isset($new) && $new != '') {
            $data_exports = $data_exports->where('new', 'LIKE', '%'.$new.'%');
        }
        // lọc trạng thái
        if (isset($redirect) && $redirect != '') {
            $data_query = $data_query->where('redirect', $redirect);
        }
        // lọc trạng thái
        if (isset($status) && $status != '') {
            $data_query = $data_query->where('status', $status);
        }
        $data_exports = $data_exports->where('status', '<>', -1)->get();

        // Mảng export
        $data = [
            'file_name' => 'sync-links-'.time(),
            'data' => [
                // 
            ]
        ];
        // Foreach lấy mảng data
        foreach ($data_exports as $key => $value) {
            $data['data'][] = [
                $value->old,
                $value->new,
                $value->redirect,
            ];
        }
        return \Excel::download(new \Sudo\Base\Export\GeneralExports($data), $data['file_name'].'.xlsx');
    }

}
