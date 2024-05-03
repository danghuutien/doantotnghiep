<?php

namespace Sudo\Base\Models;

use Sudo\Base\Models\BaseModel;

class SystemLog extends BaseModel {
	
	/**
     * Lấy ra tên modules
     * @return string $name
	 */
	public function getModuleName() {
		switch ($this->type) {
			case 'admin_authorizations': $name = 'Phân quyền'; break;
			default:
				$name = config('SudoModule.modules')[$this->type]['name'] ?? config('SudoModule.name')[$this->type]?? '';
			break;
		}
		return __($name);
	}

	/**
     * Lấy ra tên hành động
     * @return string $action_name
	 */
	public function getActionName() {
		$action = [
			'create' 		=> 'Core::admin.create',
			'update' 		=> 'Core::admin.update',
			'login' 		=> 'Core::admin.login.login',
			'quick_delete' 	=> 'Core::admin.quick_delete',
			'quick_update' 	=> 'Core::admin.quick_update',
			'quick_restore' => 'Core::admin.quick_restore',
		];
		return __($action[$this->action] ?? 'Core::admin.unknown');
	}

	/**
     * Lấy ra chi tiết
     * @return array $action
	 */
	public function getDetail() {
		if (isset($this->detail) && !empty($this->detail)) {
			$data = json_decode(base64_decode($this->detail), true);
			return $data;
		} else {
			return [];
		}
	}

}