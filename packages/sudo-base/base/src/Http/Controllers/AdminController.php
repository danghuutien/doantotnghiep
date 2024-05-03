<?php

namespace Sudo\Base\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use DB;
use View;
use Session;

class AdminController extends Controller
{
    public $module_name;
    public $table_name;
    public $has_seo;
	public $has_locale;
    public $breadcrumbs;

    function __construct() {
        // khai báo assets cho admin
        loadStyleAdmin();
    	// share tên module và tên bảng
    	View::share('module_name', $this->module_name);
        View::share('table_name', $this->table_name);
        View::share('has_seo', $this->has_seo);
        View::share('has_locale', $this->has_locale);
        // Breadcrumb tự động
        if (isset($this->table_name)) {
            $this->breadcrumbs[] = [
            	'name' => $this->module_name, 
            	'url' => route('admin.'.$this->table_name.'.index')
            ];
            // Lấy breadcrumbs theo tên route
            $action_method = str_replace('admin.'.$this->table_name.'.', '', \Route::currentRouteName());
            switch ($action_method) {
                case 'create': $this->breadcrumbs[] = ['name' => trans('Translate::table.create')]; break;
                case 'show': $this->breadcrumbs[] = ['name' => trans('Translate::table.show')]; break;
                case 'edit': $this->breadcrumbs[] = ['name' => trans('Translate::table.edit')]; break;
            }
            View::share('breadcrumbs',$this->breadcrumbs);
        }
        // Sử dụng middleware để check phân quyền và set ngôn ngữ
        $this->middleware(function ($request, $next) {
            // Đặt lại ngôn ngữ nếu trên url có request setLanguage
            setLanguage($request->setLanguage);
            
            // Nếu tồn tại table_name thì mới check quyền
            if (isset($this->table_name)) {
                // Lấy ra action method
                $action_method = request()->route()->getName();
                $action_method = array_last(explode('.', $action_method));
                // Lấy ra toàn bộ phương thức từ config SudoModule
                $module_method = [];
                foreach (config('SudoModule')['modules'] as $key => $module) {
                    // Nếu tồn tại config(SudoModule.modules.{module_name}.permision)
                    if (isset($module['permision']) && !empty($module['permision'])) {
                        foreach ($module['permision'] as $permision) {
                            // Nếu tồn tại config(SudoModule.modules.{module_name}.permision.type)
                            if (isset($permision['type']) && !empty($permision['type'])) {
                                // Thêm phương thức
                                $module_method[] = $permision['type'];
                            }
                        }
                    }
                }
                $module_method = array_unique($module_method);
                // Kiểm tra action_method mới các quyền CURD cơ bản
                if(in_array($action_method, $module_method)) {
                    // Nếu phường thức là store thì sẽ check quyền create
                    if ($action_method == 'store') {
                        $action_method = 'create';
                    }
                    // Nếu phường thức là update thì sẽ check quyền edit
                    if ($action_method == 'update') {
                        $current_action = 'edit';
                    }
                    // Quyền
                    $permission = $this->table_name.'_'.$action_method;
                    // Kiểm tra quyền
                    if (checkRole($permission) == false) {
                        return redirect(route('admin.home'))->with([
                            'type' => 'danger',
                            'message' => 'Core::admin.role.no_permission',
                        ]);
                    }
                }
                // Nếu hợp lệ hoặc action_method không thuộc CURD cơ bản ở trên thì tiếp tục
                // Nếu Muốn check quyền tại trang kế tiếp thì phải viết cho từng route
                return $next($request);
            } else {
                return $next($request);
            }
        });
    }

    /** 
     * Kiểm tra slug có tồn tại hay không
     * @param string     $request->table: tên bảng
     * @param string     $request->slug: slug cần check
     */
    public function checkSlug(Request $request) {
        // Các biến lấy ra từ request
        // $table = $request->table;
        $slug = $request->slug;
        $check = DB::table('slugs')->where('slug', $slug)->first();
        // dd($check, $slug);
        if (empty($check)) {
            return 1; // Không có slug tra về true
        } else {
            return 2; // có slug trả về false
        }
    }

    /** 
     * Xóa nhanh
     * @param string     $request->table: tên bảng
     * @param array      $request->id_array: mảng ID cần xóa
     */
    public function quickDelete(Request $request) {
        $status = 0;
        $message = '';
        // Các biến lấy ra từ request
        $table = $request->table??'';
        $id_array = $request->id_array??[];

        // Kiếm tra xem có quyền hay không
        if (checkRole($table.'_delete')) {
            // Kiểm tra có tồn tại bản ghi hay không
            $check = collect(DB::table($table)->whereIn('id',$id_array)->get());
            // Kiểm tra có tồn tại bản ghi hay không
            if (count($check) > 0) {
                // Hành động khi dữ liệu thay đổi
                $this->updateAction($table);
                // Mảng id xóa tạm
                $delete_id = [];
                // Dùng vòng lặp xác định status vả chuyển về trạng thái tương ứng
                // [0,1] => -1 thùng rác
                // [-1] => xóa vĩnh viễn
                foreach ($id_array as $id) {
                    $record = $check->where('id', $id)->first();
                    if (!empty($record)) {
                        if ($record->status == -1) {
                            // Xóa vĩnh viễn ở đây
                        } else {
                            // Đưa vào thùng rác
                            $delete_id[] = $id;
                            // Ghi logs
                            systemLogs('quick_delete', ['status' => -1], $table, $id);
                        }
                    }
                }
                DB::table($table)->whereIn('id',$delete_id)->update(['status' => -1]);
                $status = 1;
                $message = 'Core::admin.delete_success';
            } else {
                $message = 'Core::admin.no_data_delete';
            }
        } else {
            $message = 'Core::admin.no_permission';
        }
        return [
            'status' => $status,
            'message' => __($message),
        ];
    }

    /** 
     * Lấy lại nhanh
     * @param string     $request->table: tên bảng
     * @param array      $request->id_array: mảng ID cần lấy lại
     */
    public function quickRestore(Request $request) {
        $status = 0;
        $message = '';
        // Các biến lấy ra từ request
        $table = $request->table??'';
        $id_array = $request->id_array??[];

        // Kiếm tra xem có quyền hay không
        if (checkRole($table.'_restore')) {
            // Kiểm tra có tồn tại bản ghi hay không
            $check = DB::table($table)->whereIn('id',$id_array)->get();
            // Kiểm tra có tồn tại bản ghi hay không
            if (count($check) > 0) {
                // Hành động khi dữ liệu thay đổi
                $this->updateAction($table);
                // Thay đổi dữ liệu
                $save_count = DB::table($table)->whereIn('id',$id_array)->update(['status' => 1]);
                // Kiểm tra dữ liệu đã được thay đổi hay chưa
                if ($save_count != 0) {
                    foreach ($id_array as $id) {
                        // Ghi logs
                        systemLogs('quick_restore', ['status' => -1], $table, $id);
                    }
                    $status = 1;
                    $message = 'Core::admin.restore_success';
                } else {
                    $message = 'Core::admin.ajax_error';
                }
            } else {
                $message = 'Core::admin.no_data_restore';
            }
        } else {
            $message = 'Core::admin.no_permission';
        }
        return [
            'status' => $status,
            'message' => __($message),
        ];
    }

    /** 
     * Cập nhật nhanh
     * @param string     $request->table: tên bảng
     * @param array      $request->id_array: mảng ID cần sửa
     * @param string     $request->value: giá trị
     * @param string     $request->field: tên trường
     */
    public function quickEdit(Request $request) {
        $status = 0;
        $message = '';
        // Các biến lấy ra từ request
        $table = $request->table ?? '';
        $id_array = $request->id_array ?? [];
        $value = $request->value ?? '';
        $field = $request->field ?? '';
        // Kiếm tra xem có quyền hay không
        if (checkRole($table.'_edit')) {
            // Kiểm tra có tồn tại bản ghi hay không
            $check = DB::table($table)->whereIn('id',$id_array)->get();
            // Kiểm tra có tồn tại bản ghi hay không
            if (count($check) > 0) {
                // Hành động khi dữ liệu thay đổi
                $this->updateAction($table);
                // Ghi logs
                foreach ($id_array as $id) {
                    systemLogs('quick_update', [$field => $value], $table, $id);
                }
                // Thay đổi dữ liệu
                $save_count = DB::table($table)->whereIn('id',$id_array)->update([$field => $value]);
                // Kiểm tra dữ liệu đã được thay đổi hay chưa
                if ($save_count != 0) {
                    $status = 1;
                    $message = 'Core::admin.update_success';
                } else {
                    $message = 'Core::admin.ajax_error_edit';
                }
            } else {
                $message = 'Core::admin.no_data_edit';
            }
        } else {
            $message = 'Core::admin.no_permission';
        }
        return [
            'status' => $status,
            'message' => __($message),
        ];
    }

    /**
     * Cập nhật nhanh vị trí ghim
     * @param string     $request->table: tên bảng
     * @param array      $request->id_array: mảng ID cần sửa
     * @param string     $request->value: giá trị
     * @param string     $request->place: vị trí ghim (home, hot, ...)
     */
    public function quickPinEdit(Request $request) {
        $status = 0;
        $message = '';
        // Các biến lấy ra từ request
        $table = $request->table ?? '';
        $id_array = $request->id_array ?? [];
        $value = $request->value ?? '';
        $place = $request->place ?? '';
        // Kiếm tra xem có quyền hay không
        if (checkRole($table.'_edit')) {
            // Kiểm tra có tồn tại bản ghi hay không
            $check = DB::table($table)->whereIn('id',$id_array)->get();
            // Kiểm tra có tồn tại bản ghi hay không
            if (count($check) > 0) {
                // Hành động khi dữ liệu thay đổi
                $this->updateAction($table);
                // Thêm pin và ghi logs
                try {
                    if(intval($value) <= 0) {//nếu nhỏ hơn hoặc bằng 0 thì xóa ghim
                        $save_count = DB::table('pins')->where('type', $table)->whereIn('type_id', $id_array)->where('place', $place)->delete();
                    } else {
                        foreach ($id_array as $id) {
                            DB::table('pins')->where('type', $table)->where('type_id', $id)->where('place',$place)->delete();
                            $compact = [
                                'type' => $table,
                                'type_id' => $id,
                                'place' => $place,
                                'value' => $value,
                            ];
                            DB::table('pins')->insert($compact);
                            systemLogs('create', $compact, 'pins', 0);
                        }
                    }
                    $status = 1;
                    $message = 'Core::admin.update_success';
                } catch (\Exception $e) {
                    $message = 'Core::admin.ajax_error_edit';
                }
            } else {
                $message = 'Core::admin.no_data_edit';
            }
        } else {
            $message = 'Core::admin.no_permission';
        }
        return [
            'status' => $status,
            'message' => __($message),
        ];
    }
    /**
     * Tìm kiếm tại Form
     * @param string     $request->table: tên bảng
     * @param array      $request->id: Tên cột lấy giá trị
     * @param string     $request->name: Tên cột lấy tên
     * @param string     $request->keyword: tên trường
     * @param array      $request->id_not_where: Không lấy id có tại mảng này
     * @param string     $request->suggest_locale: có search theo đa ngôn ngữ hay không
     */
    public function suggestSearch(Request $request) {
        $table = $request->table ??'';
        $id = $request->id ?? 'id';
        $name = $request->name ?? 'name';
        $keyword = $request->keyword ?? '';
        $id_not_where = $request->id_not_where ?? [];
        $suggest_locale = $request->suggest_locale ?? 'false';
        $lists = DB::table($table)->where('status',1);
        // Search theo đa ngôn ngữ
        if ($suggest_locale == 'true') {
            $lists = $lists->join('language_metas', 'language_metas.lang_table_id', $table.'.id')
                                ->where('language_metas.lang_table', $table)
                                ->where('language_metas.lang_locale', Request()->lang_locale ?? \App::getLocale())
                                ->select($table.'.*');     
        }
        // Tiếp tục tìm
        $lists = $lists->whereNotIn('id',$id_not_where)->where($name,'like','%'.$keyword.'%')->orderBy($id,'DESC')->limit(30)->offset(0)->get();
        if ($lists->count()) {
            $result = [];
            foreach ($lists as $item) {
                $result[] = ['id'=>$item->$id, 'name'=> $item->$name];
            }
            return response()->json(['status' => 1, 'message' => __('Translate::admin.has_found_data'), 'data' => $result]);
        } else {
            return response()->json(['status' => 0, 'message' => __('Translate::admin.not_found_data')]);
        }
    }

    /**
     * Tìm kiếm và trả về dữ liệu tại bảng
     * @param string     $request->table: tên bảng
     * @param string     $request->table_field: Tên cột lấy tên
     * @param string     $request->keyword: tên trường
     * @param string     $request->suggest_locale: có search theo đa ngôn ngữ hay không
     * @param array      $request->id_not_where: Không lấy id có tại mảng này
     */
    public function suggestTable(Request $request) {
        $table = $request->table ??'';
        $table_field = $request->table_field ?? 'name';
        $keyword = $request->keyword ?? '';
        $suggest_locale = $request->suggest_locale ?? 'false';
        $id_not_where = $request->id_not_where ?? [];

        $lists = DB::table($table)->where('status',1);
        // Search theo đa ngôn ngữ
        if ($suggest_locale == 'true') {
            $lists = $lists->join('language_metas', 'language_metas.lang_table_id', $table.'.id')
                                ->where('language_metas.lang_table', $table)
                                ->where('language_metas.lang_locale', Request()->lang_locale ?? \App::getLocale())
                                ->select($table.'.*');     
        }
        // Tiếp tục tìm
        $lists = $lists->whereNotIn('id',$id_not_where)->where($table_field,'like','%'.$keyword.'%')->orderBy('id','DESC')->limit(30)->get();
        if ($lists->count()) {
            return response()->json(['status' => 1, 'message' => __('Translate::admin.has_found_data'), 'data' => $lists]);
        } else {
            return response()->json(['status' => 0, 'message' => __('Translate::admin.not_found_data')]);
        }
    }

    /** 
     * Xóa cache
     */
    public function cacheClear() {
        $exitCode = \Artisan::call('sudo:clear');
        if ($exitCode == 0) {
            return [
                'status' => 1,
                'message' => __('Core::admin.cache_clear_success'),
            ];
        } else {
            return [
                'status' => 2,
                'message' => __('Core::admin.cache_clear_fail'),
            ];
        }
    }

    // Hành động khi dữ liệu thay đổi
    public function updateAction($table) {}
}