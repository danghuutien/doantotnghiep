 <?php
App::booted(function() {

	$namespace = 'Sudo\Theme\Http\Controllers\Web';
	Route::namespace($namespace)->name('app.')->middleware(['web'])->group(function() {
		Route::get('/test', 'TestController@index')->name('test');
		// Trang chủ
        Route::middleware(['tracking'])->group(function () {
    		Route::get('/', 'HomeController@index')->name('home');
    		// Trang liên hệ
    		Route::get('/lien-he', 'PageController@contact')->name('contact.show');
            Route::match(['GET', 'POST'], '/tim-kiem', 'SearchController@index')->name('search.index');
    		// chi tiết sản phẩm
    		Route::get('/so-sanh-san-pham', 'ProductController@compare')->name('products.compare');
    		// Tag
    		Route::match(['GET', 'POST'], '/tags/{slug}', 'PostController@tag')->name('tags.show');
            // Danh mục tin tức
            Route::match(['GET', 'POST'], '/tin-tuc', 'PostController@index')->name('post_categories.index');

            // hệ thống cửa hàng
            Route::match(['GET', 'POST'], '/he-thong-cua-hang', 'StoreController@index')->name('stores.index');
            Route::get('/he-thong-cua-hang/{slug}.html', 'StoreController@show')->name('stores.show');
            // gio hang
            Route::name('sale.')->group(function(){
                Route::get('/gio-hang/{installment?}', 'SaleController@index')->name('index');
                Route::post('/thanh-toan', 'SaleController@payment')->name('payment');
                Route::get('/thanh-toan-tra-gop/{code}', 'SaleController@installment')->name('installment');
                Route::post('/thanh-toan-tra-gop/{code}', 'SaleController@installmentPost')->name('installmentPost');
                Route::get('/dat-hang-thanh-cong/{code}', 'SaleController@success')->name('success');
                Route::get('/thanh-toan-lai/{code}', 'SaleController@paymentBack')->name('paymentBack');
            });
        });

        // ajax
        Route::prefix('ajax')->name('ajax.')->group(function(){
            Route::post('add-to-cart', 'CartController@addToCart')->name('addToCart');
            Route::post('edit-cart', 'CartController@editCart')->name('editCart');
            Route::post('load_destination', 'CartController@loadDestination')->name('loadDestination');

            // Onepay
            Route::post('/loadBankOnePay', 'SaleController@loadBankOnePay');
            Route::post('/get-installment-onepay', 'SaleController@getInstallmentOnepay');
            //  rating
			Route::post('formComment', 'AjaxController@formComment')->name('formComment');
			Route::post('loadComment', 'AjaxController@loadComment')->name('loadComment');
			// contact
			Route::post('contact', 'AjaxController@contact')->name('contact');
            // add compare product
            Route::post('add-compare','AjaxController@addCompare')->name('ajax.addCompare');
            // remove compare product
            Route::post('remove-compare','AjaxController@removeCompare')->name('ajax.removeCompare');
            Route::post('/load_post_search', 'AjaxController@loadPostSearch')->name('ajax.loadPostSearch');
            // để lại sd là 1 đơn hàng
            Route::post('phone_order', 'AjaxController@phoneOrder')->name('ajax.phoneOrder');
		});
		// Tin tức
		//Route::get('/{slug}', 'PostController@show')->name('posts.show')->middleware(['tracking']);
        //tin tức, sản phẩm, danh mục tin, danh mục sp, trang đơn
        Route::match(['GET', 'POST'], '{slug}','HandleController@index')
            ->where('slug', '^(?!admin\/|ajax\/)[a-zA-Z0-9-._\/]+$')->name('handle')->middleware(['tracking']);
       // Route::match(['GET', 'POST'], '{slug}','HandleController@index')->name('handle')->middleware(['tracking']);
	});
});
