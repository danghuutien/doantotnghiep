<?php

namespace Sudo\AdminUser\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use DB;

class AdminUserSeedCommand extends Command {

    protected $signature = 'admin_users:seeds';

    protected $description = 'Khởi tạo dữ liệu cho tài khoản quản trị';

    public function handle() {
        $this->adminUsers();
    }

    public function echoLog($string) {
        $this->info($string);
        Log::info($string);
    }

    public function adminUsers() {
    	DB::table('admin_users')->truncate();
    	DB::table('admin_password_resets')->truncate();
    	$created_at = $updated_at = date('Y-m-d H:i:s');
    	$user_name_array = [
    		[
    			'name' => 'dev',
    			'email' => 'dev@sudo.vn',
    			'password' => passwordGenerate(),
    			'display_name' => 'Sudo Developer',
    		],
    		[
    			'name' => 'sudo',
    			'email' => 'sudo@sudo.vn',
    			'password' => passwordGenerate(),
    			'display_name' => 'Sudo Ecommerce',
    		]
    	];
    	$admin_users = [];
    	foreach ($user_name_array as $value) {
    		$admin_users[] = [
	            'name' => $value['name'],
	            'email' => $value['email'],
	            'password' => bcrypt($value['password']),
	            'display_name' =>$value['display_name'],
	            'status' => 1,
	            'created_at' => $created_at,
	            'updated_at' => $updated_at
    		];
    	}
        DB::table('admin_users')->insert($admin_users);
        $this->echoLog('Tai khoan quan tri da duoc tao tu dong:');
        foreach ($user_name_array as $value) {
        	$this->echoLog($value['name'].' - '.$value['password']);
        }
    }

}