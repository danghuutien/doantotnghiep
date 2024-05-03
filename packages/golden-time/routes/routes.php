<?php
App::booted(function() {
	$namespace = 'Sudo\GoldenTime\Http\Controllers';
	
	Route::namespace($namespace)->name('admin.')->prefix(config('app.admin_dir'))->middleware(['web', 'auth-admin'])->group(function() {
		// Bài viết
        Route::resource('golden_times', 'GoldenTimeController');
		Route::post('ajax/suggest_products', 'GoldenTimeController@suggestProducts')->name('golden_times.suggest_products');
        Route::post('goldentimes/get-data', 'GoldenTimeController@getDataAjax')->name('goldentimes.getDataAjax');
        Route::post('goldentimes/load_option', 'GoldenTimeController@loadOption')->name('goldentimes.loadOption');
	});

	// Not Auth
	Route::namespace($namespace)->prefix('goldentimes')->middleware(['web'])->group(function() {
		// lấy giá sản phẩm sau khi sử dụng GoldenTime (single) params: product_id, code of Voucher
    	Route::post('price-after-voucher', 'GoldenTimeController@getPriceAfterVoucher')->name('goldentimes.getPriceAfterVoucher');
	});
});
