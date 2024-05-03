<?php
App::booted(function() {
	$namespace = 'Sudo\Voucher\Http\Controllers';
	
	Route::namespace($namespace)->name('admin.')->prefix(config('app.admin_dir'))->middleware(['web', 'auth-admin'])->group(function() {
		// Bài viết
        Route::resource('vouchers', 'VoucherController');
        Route::post('vouchers/get-data', 'VoucherController@getDataAjax')->name('vouchers.getDataAjax');
        Route::post('vouchers/load_option', 'VoucherController@loadOption')->name('vouchers.loadOption');
	});

	// Not Auth
	Route::namespace($namespace)->prefix('vouchers')->middleware(['web'])->group(function() {
		// lấy giá sản phẩm sau khi sử dụng Voucher (single) params: product_id, code of Voucher
    	Route::post('price-after-voucher', 'VoucherController@getPriceAfterVoucher')->name('vouchers.getPriceAfterVoucher');
	});
});
