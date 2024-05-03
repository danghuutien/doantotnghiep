<?php

namespace Sudo\Contact\Models;

use Sudo\Base\Models\BaseModel;

class Contact extends BaseModel {
	protected $table = 'contacts';
    protected $fillable = ['name', 'email','phone', 'content'];
    public static function add($data) {
        $data = json_decode(json_encode(removeScriptArray($data)));
        $time = date('Y-m-d H:i:s');
        // Thêm đăng ký Email
        Contact::insert([
            'name'             => $data->name ?? '',
            'email'             => $data->email ?? '',
            'phone'             => $data->phone ?? '',
            'content'             => $data->content ?? '',
            'status'            => $data->status,
            'created_at'        => $time,
            'updated_at'        => $time
        ]);
    }
}