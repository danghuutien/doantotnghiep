<?php

namespace Sudo\Category\MyClass;

use DB;

class ListCategory {

	public $index = -1;
	public $categories = [];

	/*
	 * Khởi tạo List danh mục
	 * @param string 			$table: Bảng hiện tại
	 * @param boolean 			$has_locate: có đa ngôn ngữ hay không (true có | false không)
	 * @param string 			$locate: Ngôn ngữ bản ghi hiện tại. Để Null sẽ lấy theo ngôn ngữ hệ thống
	 * @return array mảng danh sách các categories theo thứ tự cấp độ - sắp xếp (order)
	 */
	function __construct($table, $has_locate = true, $locate = null) {
		$this->table = $table;
		$this->has_locate = $has_locate;
		$this->locate = $locate;
	}
	
	/*
	 * Lấy ra danh sách danh mục thuộc mảng
	 * @param int 				$parent_id id danh mục cha
	 * @param int 				$level level của cấp bắt đầu
	 * @param array 			$status trang thái lấy (1 = hoạt động, 2 = không hoạt động, 3 = thùng rác)
	 * @return array mảng danh sách các categories theo thứ tự cấp độ - sắp xếp (order)
	 */
	public function lists($parent_id = 0, $level = 0, $status = [1]) {
		// Lấy dữ liệu bảng và đưa vào collection
		$list_data = DB::table($this->table);
		// Lấy các trường trong bảng
		$table_collum = \DB::getSchemaBuilder()->getColumnListing($this->table);
		// Nếu có sử dụng module đa ngôn ngữ
		if ($this->has_locate == true) {
			// Ưu tiên: ngôn ngữ truyền vào > ngôn ngữ của bản ghi thêm > Ngôn ngữ bảng hiện tại > ngôn ngữ hệ thống
			$locale = $this->locate ?? Request()->lang_locale ?? $_COOKIE['table_locale'] ?? \App::getLocale();
			$list_data = $list_data->join('language_metas', 'language_metas.lang_table_id', $this->table.'.id')
									->where('lang_table', $this->table)
									->where('lang_locale', $locale);
		}
		// Ghim
		$pins = \DB::table('pins')->where('type', $this->table)->get();
		// Đưa dữ liệu vào collection
		$list_data = collect($list_data->get());
		// Chỉ lấy $parent_id hiện tại
		$parent_categories = $list_data->where('parent_id', $parent_id);
		$parent_categories = $parent_categories->whereIn('status', $status);
		// Nếu $categories có dữ liệu
		if($parent_categories->count() > 0) {
			$num = 0;
			foreach ($parent_categories as $key => $value) {
				$num++;
				$this->index++;
				$fields = array_keys((array)$value);
				// Lấy toàn bộ bản ghi có parent là $parent_id
				for ($i = 0; $i < count($fields); $i++){
                    $field_name = trim($fields[$i]);
                    $this->categories[$this->index][$field_name] = $value->$field_name;
                }
                // lấy số level của danh mục hiện tại
                $this->categories[$this->index]["level"] = $level;
                // Lấy Ghim
                foreach ($pins as $pin) {
                	if ($value->id == $pin->type_id) {
                		$this->categories[$this->index]['pin_'.$pin->place] = $pin->value;
                	}
                }
                // Lấy danh mục con
                $category_childs = $list_data->where('parent_id', $value->id)->whereIn('status', $status);
				if ($category_childs->count()) {
					$this->categories[$this->index]["haschild"] = 1;
					$this->lists($value->id, $level+1, $status);
				} else {
					$this->categories[$this->index]["haschild"] = 0;
				}
			}
		}
		return $this->categories;
	}

	public function data_raw($parent_id = 0,$level = 0,$status = [1]) {
		return collect($this->lists($parent_id, $level, $status));
	}

	public function data($parent_id = 0,$level = 0,$status = [1]) {
		$list_categories = $this->lists($parent_id, $level, $status);
        $array_categories = [];
        foreach($list_categories as $key=>$value) {
            $prefix = '';
            for($i = 0; $i < $value['level']; $i++) $prefix .= '|—';
            $array_categories[$value['id']] = $prefix.$value['name'];
        }
        return $array_categories;
	}

	public function data_select($parent_id = 0,$level = 0,$status = [1]) {
		$list_categories = $this->lists($parent_id, $level, $status);
        $array_categories = [];
        $array_categories[''] = 'Translate::admin.no_select_category';
        foreach($list_categories as $key=>$value) {
            $prefix = '';
            for($i = 0; $i < $value['level']; $i++) $prefix .= '|—';
            $array_categories[$value['id']] = $prefix.$value['name'];
        }
        return $array_categories;
	}
}