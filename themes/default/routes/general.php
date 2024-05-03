<?php
App::booted(function() {
	$namespace = 'Sudo\Theme\Http\Controllers';
	Route::namespace($namespace)->name('app.')->middleware(['web'])->group(function() {
		
	});
});