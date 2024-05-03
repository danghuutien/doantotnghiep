<?php

namespace Sudo\Theme\Http\Controllers\Web;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use Sudo\Comment\Models\Comment;
use DB;
use Sudo\Ecommerce\Models\ProductCategory;
use Sudo\Theme\Models\Page;

class Controller extends BaseController
{

	function __construct() {

		$this->middleware(function ($request, $next) {
			setLanguage(\Session::get('locale'));
			\Asset::addScript(['jquery','general','owl-carousel', 'webUpdate']);
			// Cache cấu hình general
	        $config_general = getOption('general');
	        \View::share('config_general',$config_general);
			
			$parentCatesProducts = ProductCategory::where('parent_id', 0)->get();
			\View::share('parentCatesProducts', $parentCatesProducts);
	        // cache menu 
	        $config_menu = getOption('menu');
	        \View::share('config_menu',$config_menu);

	        // cache mã chuyển đổi
	        $config_code = getOption('code');
	        \View::share('config_code',$config_code);
	        $comment_products = Comment::where('type', 'products')
	        	->where('status', 1)
	        	->select('type_id', DB::raw('count(id) as number_comment'))
	        	->groupBy('type_id')
	        	->pluck('number_comment', 'type_id')->toArray();
	        \View::share('comment_products',$comment_products);

	        $vote_products = Comment::where('type', 'products')
	        	->where('status', 1)
	        	->where('parent_id', 0)
	        	->select('type_id', DB::raw('round(AVG(vote)) as star'))
	        	->groupBy('type_id')
	        	->pluck('star', 'type_id')->toArray();
	        \View::share('vote_products',$vote_products);

            $allStores = \Sudo\Theme\Models\Store::with(['province', 'district', 'ward'])->active()
                ->get();
            \View::share('allStores', $allStores);
	        return $next($request);
		});
	}
}
