<?php

namespace Sudo\EmailRegister\Models;

use Sudo\Base\Models\BaseModel;

class EmailRegister extends BaseModel {
	
	public static function add($data) {
		$data = json_decode(json_encode(removeScriptArray($data)));
		$time = date('Y-m-d H:i:s');
		// Kiểm tra trùng
		$check_exist = EmailRegister::where('email', $data->email)->first();
		if ($check_exist == null) {
			// Thêm đăng ký Email
			EmailRegister::insert([
                'email' 			=> $data->email ?? '',
                'status' 			=> $data->status,
                'created_at' 		=> $time,
                'updated_at' 		=> $time
			]);
		}
	}

}