<?php
App::booted(function() {
	$namespace = 'Sudo\AdminUser\Http\Controllers';
	
	Route::namespace($namespace)->name('admin.')->prefix(config('app.admin_dir'))->middleware(['web'])->group(function () {
	    Route::get('/login', 'AuthController@login')->name('login')->middleware('check-license');
		Route::post('/login', 'AuthController@setLogin')->name('setLogin')->middleware("throttle:5,10");
		Route::get('/logout', 'AuthController@logout')->name('logout');
		Route::get('/forgot_password', 'AuthController@forgotPassword')->name('forgot_password');
		Route::post('/forgot_password', 'AuthController@setForgotPassword')->name('setForgotPassword');
		Route::get('/change_password', 'AuthController@changePassword')->name('change_password');
		Route::post('/change_password/{id}', 'AuthController@setChangePassword')->name('setChangePassword');
		// get show qr code
		Route::get('/2fa/registerQr', 'AuthController@registerQr')->name('registerQr');
		// 2fa middleware
    	Route::post('/2fa/2faVerify','AuthController@faVerify')->name('2faVerify')->middleware('2fa');
	});

	Route::namespace($namespace)->name('admin.')->prefix(config('app.admin_dir'))->middleware(['web', 'auth-admin', '2fa'])->group(function() {
		// Tài khoản người dùng quản trị
		Route::resource('admin_users', 'AdminUserController');
		Route::get('admin_users/{id}/change_password', 'AdminUserController@changePassword')->name('admin_users.change_password');
		Route::post('admin_users/{id}/change_password', 'AdminUserController@changePasswordPost')->name('admin_users.change_password_post');
		Route::get('admin_users/{id}/change_info', 'AdminUserController@changeInfo')->name('admin_users.change_info');
		Route::post('admin_users/{id}/change_info', 'AdminUserController@changeInfoPost')->name('admin_users.change_info_post');
	});
});