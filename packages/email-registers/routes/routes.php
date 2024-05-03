<?php
App::booted(function() {
	$namespace = 'Sudo\EmailRegister\Http\Controllers';
	
	Route::namespace($namespace)->name('admin.')->prefix(config('app.admin_dir'))->middleware(['web', 'auth-admin'])->group(function() {
		// Tài khoản người dùng quản trị
		Route::resource('email_registers', 'EmailRegisterController');
		Route::post('email_registers/exports', 'EmailRegisterController@exports')->name('email_registers.exports');
	});

	Route::namespace($namespace)->name('app.ajax')->middleware(['web'])->group(function() {
		Route::post('/ajax/email_registers', 'AjaxController@ajaxStore')->name('email_registers');
	});
});