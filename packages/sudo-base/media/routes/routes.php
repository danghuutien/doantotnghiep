<?php
App::booted(function() {
	Route::group([
		'prefix'=> config('SudoMedia.admin_dir'),
		'namespace' => 'Sudo\Media\Http\Controllers',
		'middleware' => config('SudoMedia.middleware')
	], function () {
		Route::get('media/view', 'MediaController@view')->name('media.view');
		Route::resource('media', 'MediaController');
	});
});