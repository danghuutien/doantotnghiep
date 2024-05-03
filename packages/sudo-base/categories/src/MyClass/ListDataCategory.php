<?php

namespace Sudo\Category\MyClass;

class ListDataCategory {

	/*
	* Mảng build form tìm kiếm 
	*/
	private $no_add 			= true;
	private $no_trash 			= true;
	private $search 			= [];
	private $search_btn 		= [];
	private $table_generate 	= [];
	private $action 			= [];
	private $table_action 		= [];
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
	public function __construct($request, $model_name, $view, $has_locale = false, $page_size=30, $order=[]){
		$this->request 		= $request;
		$this->model_name 	= $model_name;
		$this->view 		= $view;
		$this->has_locale 	= $has_locale;
		$this->page_size 	= $page_size;
		$this->order 		= $order;
	}

	// ẩn nút thêm
	public function no_add() {
		$this->no_add = false;
	}
	// ẩn nút thêm
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

	public function action($field_name, $value=[-2,1,0,-1], $label = ['Translate::table.action', 'Translate::table.active', 'Translate::table.no_active', 'Translate::table.trash']) {
		$this->action = [
			'field_name' 	=> $field_name,
			'value' 		=> $value,
			'label' 		=> $label
		];
	}
	public function btnAction($field_name, $label = '', $btnType = 'default', $icon = '') {
		$this->table_action[] = [
			'fields' 	=> $field_name,
			'label' 	=> $label,
			'btnType' 	=> $btnType,
			'icon' 		=> $icon,
		];
	}

	/**
	 * Thêm cột vào bảng
	 * @param string 		$field_name: tên cột
	 * @param string 		$label: tên cột hiển thị
	 * @param number 		$has_order: có sắp xếp theo cột hay không (1 có | 0 không)
	 * @param string 		$type: Loại hiển thị mặc định (show | edit | delete | status)
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
		$show_data = new ListCategory($table_name, $this->has_locale);
		$show_data = $show_data->data_raw(0, 0, [-1, 0, 1]);
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
			$this->table_generate[] = [
				'field' 			=> '',
			    'label' 			=> 'Xóa',
			    'has_order' 		=> 0,
			    'type' 				=> 'delete',
			];
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
			if (in_array('status', $table_collum)) {
				$show_data = $show_data->where('status', -1);
			}
		} else {
			if (in_array('status', $table_collum)) {
				$show_data = $show_data->where('status', '<>', -1);
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
				// Tên trường
				$field_name = $field['fields'];
				// Giá trị search tại trường
				$search_value = $this->request->$field_name;

				switch ($field['field_type']) {
					// chuỗi
					case 'string' :
						if (isset($search_value)) {
							$search_string = $search_value;
							$show_data = $show_data->reject(function($item) use($search_string) {
								return strpos(strtolower($item['name'] ?? ''), $search_string) === false;
							});
						}
					break;
					// Mảng
					case 'array' :
						if (isset($search_value)) {
							$show_data = $show_data->where($field_name, $search_value);
						}
					break;
					// Khoảng thời gian
					case 'range':
						$field_start = $field_name.'_start';
                        $field_end = $field_name.'_end';
                        $search_value_start = $this->request->$field_start;
                        $search_value_end = $this->request->$field_end;
                        if (!empty($search_value_start) && !empty($search_value_end)) {
                            $show_data = $show_data->where($field_name,'>',$search_value_start)->where($field_name,'<',$search_value_end);
                        }
					break;
				}
			}
		}

		// Nếu sắp xếp
		if(isset($this->request->order_fields) && isset($this->request->order_by)) {
			$order_fields = $this->request->order_fields;
			$order_by = $this->request->order_by;
			switch ($order_by) {
				case 'asc': 
					$show_data = $show_data->sortBy($order_fields);
				break;
				case 'desc': 
					$show_data = $show_data->sortByDesc($order_fields);
				break;
			}
		} else {
			foreach ($this->order as $field => $order_array_type) {
				switch ($order_array_type) {
					case 'asc': 
	            		$show_data = $show_data->sortBy($field);
					break;
					case 'desc': 
	            		$show_data = $show_data->sortByDesc($field);
					break;
				}
	        }
		}

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
			'action'			=> $this->action,
			'page_size'			=> $this->page_size,
			'paginate'			=> $this->paginate,
		];
		if ($this->request->ajax()) {
			$data_html = view('Category::item', ['data' => $results])->render();
			$results['data_html'] = $data_html;
		}
		return $results;
	}

	/**
	 * Trả về mảng view
	 * @param array 	$compact: các giá trị thêm truyên vào từ controller
	 * Trả về string nếu là ajax còn không thì trả về view
	 */
	public function render($compact=[]) {
		$data = $compact['data'] ?? $this->data();
		if ($this->request->ajax()) {
            return $data;
        } else {
        	$compact['data'] = $data;
            return view('Category::index', $compact);
        }
	}
	public function render_data($compact=[]) {
		$data = $compact['data'] ?? $this->data();
    	$compact['data'] = $data;
        return $compact;
	}
}