<?php

namespace Sudo\EmailRegister\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController
{

    /**
     * Ajax đăng ký Email được gửi lên từ người dùng
     */
    public function ajaxStore(Request $requests) {
    	$email = $requests->email;
        if (!empty($email)) {
        	if (verifyEmailOrg($email)) {
        		\Sudo\EmailRegister\Models\EmailRegister::add([
        			'email' => $email,
        			'status' => 1
        		]);
        		return [
	        		'status' 	=> 1,
	        		'message' 	=> __('Đăng ký thành công!'),
	        	];
        	} else {
        		return [
	        		'status' 	=> 2,
	        		'message' 	=> __('Địa chỉ Email không tốn tại!'),
	        	];
        	}
        } else {
        	return [
        		'status' 	=> 2,
        		'message' 	=> __('Địa chỉ Email không được để trống!'),
        	];
        }
    }

}



