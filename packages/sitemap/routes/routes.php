<?php
App::booted(function() {
	$namespace = 'Sudo\Sitemap\Http\Controllers';

	Route::namespace($namespace)->name('web.')->group(function() {
        Route::get('sitemap.xml','SitemapController@index');
        Route::get('sitemap-misc.xml','SitemapController@misc');
        Route::get('sitemap-{slug}-page-{page}.xml','SitemapController@showPaginate')->where(['slug' => '([^/]*)', 'page' => '[0-9]+']);
        Route::get('sitemap-{slug}.xml','SitemapController@show');
	});
});
