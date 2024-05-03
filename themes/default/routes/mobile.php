<?php
App::booted(function() {

	$namespace = 'Sudo\Theme\Http\Controllers\Mobile';
	Route::namespace($namespace)->name('app.')->middleware(['web'])->group(function() {
		// Trang chủ
		Route::get('/', 'HomeController@index')->name('home');
	});


});