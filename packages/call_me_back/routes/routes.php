<?php
App::booted(function() {
	$namespace = 'Sudo\CallMeBack\Http\Controllers';
	
	Route::namespace($namespace)->name('admin.')->prefix(config('app.admin_dir'))->middleware(['web', 'auth-admin'])->group(function() {
		// Tài khoản người dùng quản trị
		Route::resource('call_me_backs', 'Admin\CallMeBackController');
		Route::post('/export/phone', 'Admin\CallMeBackController@export')->name('CallMeBackControllerte.export');
	});
	Route::namespace($namespace)->name('web.')->group(function() {
		Route::post('/ajax/phone', 'Web\CallMebackController@phone')->name('CallMeBackControllerte.phone');
	});
});
