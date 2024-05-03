<?php
App::booted(function() {
	$namespace = 'Sudo\Ecommerce\Http\Controllers';
	
	Route::namespace($namespace)->name('admin.')->prefix(config('app.admin_dir'))->middleware(['web', 'auth-admin', '2fa'])->group(function() {
		// Sản phẩm
		Route::resource('products', 'ProductController');
		// Danh mục sản phẩm
		Route::resource('product_categories', 'ProductCategoryController');
		// Đơn hàng
		Route::resource('orders', 'OrderController');
		// Khách hàng
		Route::resource('customers', 'CustomerController');
		// filter
		Route::resource('filters', 'FilterController');
		//
		Route::get('orders/{order_id}/comfirm-payment', 'OrderController@confirmPayment')->name('orders.confirmPayment');
		Route::get('orders/{order_id}/refund', 'OrderController@refund')->name('orders.refund');
		Route::delete('/products/delete-forever/{id}', 'ProductController@deleteForever')->name('products.deleteForever');
		Route::post('orders/{order_id}/admin_note', 'OrderController@adminNote')->name('orders.admin_note');
		Route::get('orders/{order_id}/accepts', 'OrderController@accepts')->name('orders.accepts');
		Route::get('orders/{order_id}/success', 'OrderController@success')->name('orders.success');
		Route::get('orders/{order_id}/denined', 'OrderController@denined')->name('orders.denined');
		Route::get('orders/embed_history/{order_history_id}', 'OrderController@embedHistory')->name('orders.embed_history');
		Route::get('orders/download-invoice/{order_id}', 'OrderController@downloadInvoice')->name('orders.download_invoice');
        Route::post('order_details/exports', 'OrderController@exportDetail')->name('order_details.export');
        Route::post('orders/exports', 'OrderController@export')->name('orders.export');
		// Tìm kiếm tại bảng
		Route::post('orders/suggest_products', 'OrderController@suggestProducts')->name('ajax.suggest_products');
		// Bộ lọc
		if (config('SudoProduct.filters') == true) {
			Route::resource('filters', 'FilterController');
			Route::post('/ajax/get_product_filters', 'ProductController@getFilter')->name('products.filters');
		}
		Route::post('/ajax/combo_select', 'OrderController@suggestProducts')->name('ajax.products.combo_select');
	});
});
