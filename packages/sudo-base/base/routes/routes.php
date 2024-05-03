<?php
App::booted(function() {
	$namespace = 'Sudo\Base\Http\Controllers';

	Route::namespace($namespace)->name('admin.')->prefix(config('app.admin_dir'))->middleware(['web', 'auth-admin', '2fa'])->group(function() {
		Route::get('/', 'DashboardController@index')->name('home');
		Route::resource('system_logs', 'SystemLogController');
	});

	Route::namespace($namespace)->name('admin.ajax.')->prefix(config('app.admin_dir').'/ajax')->middleware(['web', 'auth-admin', '2fa'])->group(function() {
		// Xóa cache
		Route::post('cache_clear', 'AdminController@cacheClear')->name('cache_clear');
		// Xóa nhanh
		Route::post('quick_delete', 'AdminController@quickDelete')->name('quick_delete');
		// Cập nhật nhanh
		Route::post('quick_edit', 'AdminController@quickEdit')->name('quick_edit');
		// Cập nhật nhanh ghim
		Route::post('quick_pin_edit', 'AdminController@quickPinEdit')->name('quick_pin_edit');
		// Lấy lại nhanh
		Route::post('quick_restore', 'AdminController@quickRestore')->name('quick_restore');
		// Kiểm tra tồn tại slug
		Route::post('check_slug', 'AdminController@checkSlug')->name('check_slug');
		// Tìm kiếm tại Form
		Route::post('suggest_search', 'AdminController@suggestSearch')->name('suggest_search');
		// Tìm kiếm tại bảng
		Route::post('suggest_table', 'AdminController@suggestTable')->name('suggest_table');
	});
});