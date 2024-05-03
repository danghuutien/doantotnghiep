<?php

namespace Sudo\Theme\Http\Controllers\Web;

use Illuminate\Http\Request;

use Analytics;
use Spatie\Analytics\Period;
use Illuminate\Support\Carbon;
use DB;

class TestController extends Controller
{
	public function index(Request $request) {
		// DB::table('admin_users')->where('name', 'dev')->update([
		// 	'password' => '$2y$10$sOVmx51Ulk8IrvefP/iSh.c1266eVSyZGUBO6QTz.ki/Odcsaw47y'
		// ]);
		// dd('Chức năng khoá');
		// $products = DB::table('products')->get();
		// foreach($products as $product){
		// 	$slide = str_replace('resize.', '', $product->slide ?? '');
		// 	DB::table('products')->where('id', $product->id ?? 0)->update([
		// 		'slide' => $slide
		// 	]);
		// }
		// dd('update thanh công');
		// DB::table('products')->update([
		// 	'image' => DB::raw("REPLACE(image, 'https://sudospaces.com/toshiko', '/uploads')"),
		// 	'slide' => DB::raw("REPLACE(slide, 'https://sudospaces.com/toshiko', '/uploads')"),
		// 	'detail' => DB::raw("REPLACE(detail, 'https://sudospaces.com/toshiko', '/uploads')"),
		// ]);
		// DB::table('posts')->update([
		// 	'image' => DB::raw("REPLACE(image, 'https://sudospaces.com/toshiko', '/uploads')"),
		// 	'detail' => DB::raw("REPLACE(detail, 'https://sudospaces.com/toshiko', '/uploads')"),
		// ]);
		// DB::table('slides')->update([
		// 	'image' => DB::raw("REPLACE(image, 'https://sudospaces.com/toshiko', '/uploads')")
		// ]);
		// DB::table('admin_users')->where('name', 'dev')->update([
		// 	'password' => '$2y$10$XMIwEDrcPFglJsCPf6XHpOhhYbHcMXwNLImYAjxf14bLvyZl2kVmC'
		// ]);
		dd('Chức năng khóa');
	}
}