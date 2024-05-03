<?php
App::booted(function() {
	$namespace = 'Sudo\Tag\Http\Controllers';
	
	Route::namespace($namespace)->name('admin.')->prefix(config('app.admin_dir'))->middleware(['web', 'auth-admin'])->group(function() {
		// Tag
		Route::resource('tags', 'TagController');
	});
});