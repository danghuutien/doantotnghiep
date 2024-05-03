<?php
App::booted(function() {
	$namespace = 'Sudo\Theme\Http\Controllers\Admin';
	Route::namespace($namespace)->name('admin.')->prefix(config('app.admin_dir'))->middleware(['web', 'auth-admin'])->group(function() {
		// route chung cho cấu hình
		Route::name('settings.')->prefix('settings')->group(function() {
			// Cấu hình chung
			Route::match(['GET', 'POST'], 'general', 'SettingController@general')->name('general');
			// Cấu hình menu
			Route::match(['GET', 'POST'], 'menu', 'SettingController@menu')->name('menu');
			// Cấu hình trang chủ
			Route::match(['GET', 'POST'], 'home', 'SettingController@home')->name('home');
			// Cấu hình trang liên hệ
			Route::match(['GET', 'POST'], 'contact', 'SettingController@contact')->name('contact');
			// Cấu hình trang chủ
			Route::match(['GET', 'POST'], 'home', 'SettingController@home')->name('home');
			//Trang danh mục tin tức
			Route::match(['GET', 'POST'], 'postCategory', 'SettingController@postCategory')->name('postCategory');
			//Trang sản phẩm
			Route::match(['GET', 'POST'], 'product', 'SettingController@product')->name('product');
			// Cấu hình tổng quan
			Route::match(['GET', 'POST'], 'overview', 'SettingController@overview')->name('overview');
			// Cấu hình email
			Route::match(['GET', 'POST'], 'email', 'SettingController@email')->name('email');
			// Cấu hình mã chuyển đổi
			Route::match(['GET', 'POST'], 'code', 'SettingController@code')->name('code');
			// Baatj taswt 2fa
			Route::match(['GET', 'POST'], 'google-authenticate', 'SettingController@googleAuthenticate')->name('googleAuthenticate');

			Route::post('mail_configs/test_mail','MailConfigController@testMail')->name('test_mail');
		});
		Route::name('icons.')->prefix('icons')->group(function() {
			Route::get('boxicons','IconController@boxicons')->name('boxicons');
			Route::get('design','IconController@design')->name('design');
			Route::get('dripicons','IconController@dripicons')->name('dripicons');
			Route::get('awesome','IconController@awesome')->name('awesome');
		});

        // stores
        Route::resource('stores', 'StoreController');
	});
});
