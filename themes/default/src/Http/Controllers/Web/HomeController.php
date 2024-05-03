<?php

namespace Sudo\Theme\Http\Controllers\Web;

use Illuminate\Http\Request;
use DB;
use Sudo\GoldenTime\Models\GoldenTime;
use Sudo\Post\Models\Post;
use Sudo\Ecommerce\Models\Product;
use Sudo\Ecommerce\Models\ProductCategory;
use Sudo\Post\Models\PostCategory;

class HomeController extends Controller
{
	public function index() {
		\Asset::addScript(['home', 'venobox']);
		$setting_home = getOption('home');
		$meta_seo = metaSeo('', '', [
			'title' => $setting_home['meta_title'] ?? 'Trang chủ',
			'description' => $setting_home['meta_description'] ?? 'Mô tả trang chủ',
			'image' => $setting_home['meta_image'] ?? getImage(),
		]);
		$slides = DB::table('slides')->where('status', 1)->orderBy('orders', 'asc')->get();
		$admin_bar = route('admin.settings.home');
        $saleProducts = $setting_home['saleProducts'] ?? [];
        $categories = ProductCategory::with('childrenCates')->select('product_categories.*')
            ->leftJoin('pins', function ($join) {
                $join->on('pins.type_id','=','product_categories.id');
                $join->on('pins.type',DB::raw("'product_categories'"));
                $join->on('pins.place',DB::raw("'home'"));
            })
            ->addSelect(DB::raw('(case when pins.value is null then 2147483647 else pins.value end) as home'))
            ->orderBy('home', 'ASC')
            ->where('product_categories.status', 1)
            ->limit(3)->get();
        foreach ($categories as $key => $value) {
            $allChildIds = $value->getAllChildId($value, [$value->id]);
            $products = Product::active()
                ->whereIn('category_id', $allChildIds)->orderBy('id', 'desc')->limit(20)->get();
            $value->products = $products;
        }
        if(count($saleProducts)) {
            $saleProductsOrdered = implode(',', $saleProducts);
            $bestProducts = Product::active()
                ->whereIn('id', $saleProducts)
                ->orderByRaw("FIELD(id, $saleProductsOrdered)")->get();
        } else {
            $bestProducts = [];
        }
        $firtCate = $categories->first();
        $otherCates = $categories->where('id', '<>', $firtCate->id);
        // tin
        $date = date('Y-m-d H:i:s');
        $posts = Post::with(['postCategoryMap.category', 'adminUser'])->select('posts.*')
            ->leftJoin('pins', function ($join) {
                $join->on('pins.type_id','=','posts.id');
                $join->on('pins.type',DB::raw("'posts'"));
                $join->on('pins.place',DB::raw("'home'"));
            })
            ->addSelect(DB::raw('(case when pins.value is null then 2147483647 else pins.value end) as home'))
            ->orderBy('home', 'ASC')
            ->where('posts.status', 1)
            ->limit(5)->get();
        $postCates = PostCategory::with('childrenCates')->select('post_categories.*')
            ->leftJoin('pins', function ($join) {
                $join->on('pins.type_id','=','post_categories.id');
                $join->on('pins.type',DB::raw("'post_categories'"));
                $join->on('pins.place',DB::raw("'home'"));
            })
            ->addSelect(DB::raw('(case when pins.value is null then 2147483647 else pins.value end) as home'))
            ->orderBy('home', 'ASC')
            ->where('post_categories.status', 1)
            ->limit(5)->get();
        $golden_time = GoldenTime::where('start_time', '<=', $date)->Where('end_time', '>=', $date)->where('status', 1)->orderBy('id', 'desc')->first();
        $product_sale = $golden_time->goldenTimeProduct ?? [];
		return view('Default::web.home.index', compact(
			'postCates','product_sale','golden_time','meta_seo', 'admin_bar','slides', 'setting_home', 'bestProducts', 'firtCate', 'otherCates', 'posts'
		));
	}
}
