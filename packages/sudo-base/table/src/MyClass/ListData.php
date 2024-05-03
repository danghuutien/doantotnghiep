<?php

namespace Sudo\Table\MyClass;

class ListData {

	/*
	* Mảng build form tìm kiếm
	*/
	private $no_add 			= true;
	private $no_trash 			= true;
	private $search 			= [];
	private $search_btn 		= [];
	private $table_generate 	= [];
	private $table_action 		= [];
	private $action 			= '';
	private $table_simple 		= false;
	private $paginate 			= true;

	/**
	 * Khởi tạo Listdata
	 * @param request 		$request
	 * @param model 		$model_name: Model của Module VD: Sudo\Base\Models\AdminUser
	 * @param string 		$view: view hiển thị của các item cột VD: Core::admin_users.table
	 * @param number 		$page_size: số lượng phân trang tại bảng, mặc định là 30
	 * @param array 		$order: mảng sắp xếp VD: ['order' => 'asc', 'id' => 'desc'] -> ưu tiên sắp xếp theo order trước rồi mới sắp xếp theo mảng này
	 */
	public function __construct($request, $model_name, $view, $has_locale = false, $page_size=30, $order=['id' => 'desc']){
		$this->request 		= $request;
		$this->model_name 	= $model_name;
		$this->view 		= $view;
		$this->has_locale 	= $has_locale;
		$this->page_size 	= $page_size;
		$this->order 		= $order;
	}

	// Ẩn nút thêm
	public function no_add() {
		$this->no_add = false;
	}
	// Ẩn nút xem thùng rác
	public function no_trash() {
		$this->no_trash = false;
	}
	// Gọi table ko có menu, header, footer
	public function table_simple() {
		$this->table_simple = true;
	}
	// ẩn phân trang
	public function no_paginate() {
		$this->paginate = false;
	}

	/**
	 * Build Form tìm kiếm
	 * @param string 		$field_name: tên cột tìm kiếm
	 * @param string 		$label: text hiển thị
	 * @param string 		$field_type: loại form (string, array, range)
	 * @param array 		$option: các cấu hình khác (Thường dùng cho mảng làm giá trị option cho select)
	 */
	public function search($field_name, $label, $field_type='string', $option=[]) {
		$this->search[] = [
			'fields' 		=> $field_name,
			'label' 		=> $label,
			'field_type' 	=> $field_type,
			'option' 		=> $option,
		];
	}

	/**
	 * Nút build các hành động theo forn tìm kiếm: Xuất Excel
	 * @param string 		$label: Text hiển thị nút
	 * @param string 		$url: route url xử lý hành động, thường là route Post xử lý form
	 * @param string 		$btn_type: Loại nút hiển thị (success | danger | primary | warning | default | info | secondary)
	 * @param string 		$btn_icon: icon hiển thị nút (lấy theo icon font-awesome)
	 */
	public function searchBtn($label, $url, $btn_type='success', $btn_icon='') {
		$this->search_btn[] = [
			'label' 		=> $label,
			'url' 			=> $url,
			'btn_type' 		=> $btn_type,
			'btn_icon' 		=> $btn_icon,
		];
	}

	/**
	 * Thêm các nút hành động chung cho toàn bộ bảng
	 * @param string 		$field_name: tên cột
	 * @param string 		$value: giá trị thay đổi
	 * @param string 		$label: tên cột hiển thị
	 * @param string 		$btnType: class màu sắc của nút, lấy theo tên rút ngắn btn- của bs3 (primary | default | danger | warning | ...)
	 * @param string 		$icon: icon hiển thị
	 */
	public function btnAction($field_name, $label = '', $btnType = 'default', $icon = '', $url = '') {
		$this->table_action[] = [
			'fields' 	=> $field_name,
			'label' 	=> $label,
			'btnType' 	=> $btnType,
			'icon' 		=> $icon,
			'url' 		=> $url,
		];
	}
	/**
	 * Thêm các hành động chung cho toàn bộ bảng
	 * @param string 		$field_name: tên cột
	 * @param string 		$value: giá trị thay đổi trong thẻ select option
	 * @param string 		$label: tên hiển thị trong thẻ select option
	 */
	public function action($field_name, $value=[-2,1,0,-1], $label = ['Translate::table.action', 'Translate::table.active', 'Translate::table.no_active', 'Translate::table.trash']) {
		$this->action = [
			'field_name' 	=> $field_name,
			'value' 		=> $value,
			'label' 		=> $label
		];
	}

	/**
	 * Thêm cột vào bảng
	 * @param string 		$field_name: tên cột
	 * @param string 		$label: tên cột hiển thị
	 * @param number 		$has_order: có sắp xếp theo cột hay không (1 có | 0 không)
	 * @param string 		$type: Loại hiển thị mặc định (time | status | show | lang | order | edit | delete | delete_custom | restore)
	 * @param array 		$option: mảng option theo type là status
	 */
	public function add($field_name, $label, $has_order=0, $type='', $option=[]) {
		$this->table_generate[] = [
			'field' 		=> $field_name,
			'label' 		=> $label,
			'has_order' 	=> $has_order,
			'type' 			=> $type,
			'option' 		=> $option,
		];
	}

	/**
	 * Trả về mảng data
	 * @return array
	 */
	public function data() {
		// Models
		$models = new $this->model_name;
		// Lấy tên bảng
		$table_name = $models->getTable();
		// Lấy các trường trong bảng
		$table_collum = \DB::getSchemaBuilder()->getColumnListing($table_name);
		// Dùng $show_data để query
		$show_data = $models;
		// Điều kiện khởi đầu được định nghĩa tại hàm queryAdmin của $models
		$show_data = $show_data->queryAdmin($show_data, $this->request);
		$show_data = $show_data->select($table_name.'.*');
		// Kết nối với bảng đa ngôn ngữ
		if ($this->has_locale == true) {
			$show_data = $show_data->join('language_metas', 'language_metas.lang_table_id', $table_name.'.id')
									->where('lang_table', $table_name)
									->where('lang_locale', $_COOKIE['table_locale'] ?? \App::getLocale())
									->addSelect('language_metas.*');
		}
		// Kết nối với bảng Pins
        foreach ($this->table_generate as $key => $value) {
        	// Nếu có cột pin thì join với bảng pin để order
            if ($value['type'] == 'pin') {
                $pin_field = $value['field'];
                $pin_table = 'pin_table_'.$value['field'];
                $pin_value = 'pin_'.$value['field'];
                $show_data = $show_data->leftJoin('pins as '.$pin_table, function ($join) use ($table_name, $pin_field, $pin_table, $pin_value) {
                    $join->on($pin_table.'.type_id','=',$table_name.'.id');
                    $join->on($pin_table.'.type',\DB::raw("'".$table_name."'"));
                    $join->on($pin_table.'.place',\DB::raw("'".$pin_field."'"));
                })
                ->addSelect(
                    \DB::raw('(case when '.$pin_table.'.value is null then 2147483647 else '.$pin_table.'.value end) as '.$pin_value.'')//2147483647 là số lớn nhất có thể lưu ở int(11)
                );
            }
            /*
            	Hàm trên sẽ thêm số ghim của bản ghi vào $show_data
	            Bản chất của đoạn trên với ví dụ ghim vị trí home với bảng posts là:
	            $show_data = $show_data->leftJoin('pins as pin_table_home', function ($join) {
	                $join->on('pin_table_home.type_id','=','posts.id');
	                $join->on('pin_table_home.type',DB::raw("'posts'"));
	                $join->on('pin_table_home.place',DB::raw("'home'"));
	            })
	            ->addSelect(
	                DB::raw('(case when pin_table_home.value is null then 2147483647 else pin_table_home.value end) as pin_home')
	            );
	            Giá trị pin_home lấy được chính là giá trị ghim
            */
        }
		// Bắt đầu lọc query
		// Nếu là view thùng rác thì xử lý riêng
		if (isset($this->request->trash) && $this->request->trash == true) {
			// Bỏ toàn bộ cột [trạng thái, xem, sửa, xóa] tại bảng
			foreach ($this->table_generate as $key => $value) {
				if (in_array($value['field'], ['status','show', 'edit', 'delete', 'delete_custom'])) {
					unset($this->table_generate[$key]);
				}
				if (in_array($value['type'], ['status','show', 'edit', 'delete', 'delete_custom'])) {
					unset($this->table_generate[$key]);
				}
			}
			// Bỏ toàn bộ tìm kiếm [trạng thái] tại thanh tìm kiếm
			foreach ($this->search as $key => $value) {
				if (in_array($value['fields'], ['status'])) {
					unset($this->search[$key]);
				}
			}
			// Thêm cột restore
			$this->table_generate[] = [
				'field' 			=> '',
			    'label' 			=> 'Lấy lại',
			    'has_order' 		=> 0,
			    'type' 				=> 'restore',
			];
			// Thêm lại cột xóa
			// $this->table_generate[] = [
			// 	'field' 			=> '',
			//     'label' 			=> 'Xóa',
			//     'has_order' 		=> 0,
			//     'type' 				=> 'delete',
			// ];
			// Hiển thị nút lấy lại
			$this->table_action = [];
			$this->table_action[] = [
				'fields' 			=> 'status',
				'value' 			=> 1,
				'label' 			=> 'Lấy lại',
				'btnType' 			=> 'primary',
				'icon' 				=> 'fas fa-edit',
			];
			// Không hiển thị nút đi đến thùng rác
			$this->no_trash = false;
			// Chỉ lấy bản ghi có status là -1
			if (\Schema::hasColumn($table_name, 'status')) {
				$show_data = $show_data->where($table_name.'.status', -1);
			}
		} else {
			if (\Schema::hasColumn($table_name, 'status')) {
				$show_data = $show_data->where($table_name.'.status', '<>', -1);
			}
		}

		// Kiểm tra quyền của users hiện tại
		foreach ($this->table_generate as $key => $value) {
			if (in_array($value['type'], ['show', 'edit', 'lang','restore', 'delete'])) {
				if ($value['type'] == 'lang') { $value['type'] = 'edit'; }
				if ($value['type'] == 'delete_custom') { $value['type'] = 'delete'; }
				if (!checkRole($table_name.'_'.$value['type'])) {
					unset($this->table_generate[$key]);
				}
			}
		}
		// Kiểm tra thêm
		if (!checkRole($table_name.'_create')) {
			$this->no_add = false;
		}
		// Kiểm tra các button hành động tất cả
		foreach ($this->table_action as $key => $value) {
			if ($value['fields'] == 'delete') {
				$method = 'delete';
			} if ($value['fields'] == 'delete_custom') {
				$method = 'delete';
			} elseif ($value['label'] == 'Lấy lại') {
				$method = 'restore';
			} else {
				$method = 'edit';
			}
			if (!checkRole($table_name.'_'.$method)) {
				unset($this->table_action[$key]);
			}
		}

		// Nếu tìm kiếm
		if(isset($this->request->search)) {
			foreach ($this->search as $field) {
				// Chỉ lọc các trường có tại bảng hiện tại
				if (in_array($field['fields'], $table_collum)) {
					// Tên trường
					$field_name = $table_name.'.'.$field['fields'];
					// Giá trị search tại trường
					$search_field = $field['fields'];
					$search_value = $this->request->$search_field;
					switch ($field['field_type']) {
						// chuỗi
						case 'string' :
							if (isset($search_value)) {
								$search_string = str_replace(" ", "%", trim($search_value));
								$show_data = $show_data->where($field_name, 'LIKE', '%'.$search_string.'%');
							}
						break;
						// Mảng
						case 'array' :
							if (isset($search_value)) {
								$show_data = $show_data->where($field_name, $search_value);
							}
						break;
						// trường ẩn
						case 'hidden' :
							if (isset($search_value)) {
								$show_data = $show_data->where($field_name, $search_value);
							}
						break;
						// Khoảng thời gian
						case 'range':
							$field_start = $field['fields'].'_start';
	                        $field_end = $field['fields'].'_end';
	                        $search_value_start = $this->request->$field_start;
	                        $search_value_end = $this->request->$field_end;
	                        if (!empty($search_value_start) && !empty($search_value_end)) {
	                            $show_data = $show_data->where($field_name,'>',$search_value_start)->where($field_name,'<',$search_value_end);
	                        }
						break;
					}
				}
			}
		}

		// Nếu sắp xếp
		if(isset($this->request->order_fields) && isset($this->request->order_by)) {
			$order_fields = $this->request->order_fields;
			$order_by = $this->request->order_by;
			if (in_array($order_fields, $table_collum)) {
				$order_fields = $table_name.'.'.$order_fields;
			}
			$show_data = $show_data->orderBy($order_fields, $order_by);
		} else {
			foreach ($this->order as $field => $order_array_type) {
				if (in_array($field, $table_collum)) {
					$field = $table_name.'.'.$field;
				}
	            $show_data = $show_data->orderBy($field, $order_array_type);
	        }
		}
		$show_data = $show_data->paginate($_COOKIE['sudo_page_size'] ?? $this->page_size);
		$results = [
			'show_data'			=> $show_data,
			'table_name' 		=> $table_name,
			'view' 				=> $this->view,
			'search' 			=> $this->search,
			'search_btn' 		=> $this->search_btn,
			'table_generate' 	=> $this->table_generate,
			'no_add'			=> $this->no_add,
			'no_trash'			=> $this->no_trash,
			'table_simple'		=> $this->table_simple,
			'table_action'		=> $this->table_action,
			'action'			=> $this->action,
			'page_size'			=> $this->page_size,
			'paginate'			=> $this->paginate,
		];
		return $results;
	}

	/**
	 * Trả về mảng view
	 * @param array 	$compact: các giá trị thêm truyên vào từ controller
	 * Trả về string nếu là ajax còn không thì trả về view
	 */
	public function render($compact=[], $view = 'Table::index', $view_item = 'Table::item') {
		// Nếu như truyền dữ liệu data tại controller thì sẽ lấy
		$data = $compact['data'] ?? $this->data();
		if ($this->request->ajax()) {
			// Merge mảng dữ liệu vào compact
			$compact['data'] = $data;
			// Truyền dữ liệu compact vào Table:item
			$data_html = view($view_item, $compact)->render();
			// Tạo HTML phân trang
			$paginate = $data['show_data']->appends(request()->all())->links()->toHtml();
			// Truyền giá trị cần lấy vào mảng vào Data
			$data['data_html'] = $data_html;
			$data['paginate'] = $paginate;
			// Trả về mảng giá trị data
			unset($compact['data']);
			$data = array_merge($data, $compact);
            return $data;
        } else {
        	// Merge mảng dữ liệu vào compact
        	$compact['data'] = $data;
        	// Trả về view
            return view($view, $compact);
        }
	}
}
