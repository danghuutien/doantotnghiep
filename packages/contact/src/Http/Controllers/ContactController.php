<?php

namespace Sudo\Contact\Http\Controllers;
use Sudo\Base\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use ListData;
use Form;

class ContactController extends AdminController
{
	function __construct() {
        $this->models = new \Sudo\Contact\Models\Contact;
        $this->table_name = $this->models->getTable();
        $this->module_name = 'Liên hệ';
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
    	$listdata = new ListData($requests, $this->models, 'Contact::table.index', $this->has_locale);
        // Build Form tìm kiếm
        $listdata->search('status', 'Trạng thái', 'array', config('app.status'));
        // Build các hành động
        $listdata->action('status');
        // Build bảng
        $listdata->no_add();
        $listdata->add('name', 'Thông tin liên hệ', 0);
        $listdata->add('content', 'Nội dung liên hệ', 0);
        $listdata->add('', 'Thời gian', 0, 'time');
        $listdata->add('status', 'Trạng thái', 0, 'status');
        $listdata->add('', 'Language', 0, 'lang');
        $listdata->add('', 'Xóa', 0, 'delete');

        return $listdata->render();
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