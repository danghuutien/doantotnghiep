<?php

namespace Sudo\Theme\Http\Controllers\Web;

use Illuminate\Http\Request;
use Sudo\Ecommerce\Models\Product;
use Sudo\Ecommerce\Models\ProductCategory;
use Sudo\Comment\Models\Comment;
use DB;
use Session;
use Auth;
use Sudo\Ecommerce\Models\Filter;
use Sudo\Ecommerce\Models\FilterDetail;
use Sudo\Ecommerce\Models\ProductFilter;
use Sudo\Ecommerce\Models\ProductFilterMap;
use Sudo\GoldenTime\Models\GoldenTime;
class ProductController extends Controller
{
	public static function index(Request $request, $id, $slug) {
		\Asset::addStyle(['product', 'slick'])
		->addScript(['slick', 'product']);
		$product_categorie = ProductCategory::where('slug', $slug)->where('id', $id)->firstOrFail();	
		$products = Product::where('status',1)->where('category_id',$product_categorie->id);
		$config_product = getOption('product');
		if( isset($config_product['product_favorite']) && count($config_product['product_favorite']) > 0) {
			$product_favorite = Product::where('status', 1)->whereIn('id', $config_product['product_favorite'])->get();
		} else { $product_favorite = []; }
		$admin_bar = route('admin.product_categories.edit', $product_categorie->id);
		$meta_seo = metaSeo('products', $product_categorie->id, [
			'title' => $product_categorie->name,
			'description' => removeHTML(cutString($product_categorie->description,250)),
			'image' => $product_categorie->getImage('medium'),
		]);
		$breadcrumb = [ 
			[
				'link' => $product_categorie->getUrl(),
				'name' => $product_categorie->name
			],
		];
		$sort = $request->sort ?? 'default';
        $priceSort = $request->priceSort ?? '';
		$filter = $request->filter ?? [];
		$search = SearchController::getOrder($sort);
		if(!empty($priceSort)) {
			$priceSort = explode('_', $priceSort);
            $startPrice = intval(($priceSort[0] ?? 0).'000000');
            $endPrice = intval(($priceSort[1] ?? 0).'000000');
			$products = $products->whereBetween('price', [$startPrice, $endPrice]);
		}
        if(!empty($search)) {
			$products = $products->orderByRaw($search);
        } else {
            $products = $products->orderBy('products.id', 'desc');
        }
        $filters = $request->filter ?? [];
        $filter_ids = count($filters) > 0 ? array_keys($filters) : [];
        $products_id = [];
		if(!empty($filters) && count($filters) > 0) {
			foreach($filters as $key => $filter){
				$products_id = ProductFilter::whereIn('filter_detail_id', $filter)->select('product_id')->pluck('product_id','product_id')->toArray();
			}
		}
		if(count($filters) > 0) {
			$products = $products->whereIn('products.id', $products_id);
        }
		$filter_id = getIDFilterCategoryMap($product_categorie->id);
		$filters = Filter::with(['filterDetail'=> function($query){
				$query->where('filter_details.status',1);
			}])				
			->where('status',1)
			->whereIn('id',$filter_id)
			->orderBy('order','asc')->get();
        $date = date('Y-m-d H:i:s');
		$products = $products->where('created_at', '<=', $date)->paginate(16);
		if($request->ajax()) {
			$html =view('Default::web.products.list-item', ['products' => $products])->render();
			$pagination = $products->appends(Request()->all())->links('Default::general.components.pagination')->toHtml();
            $type = 'append';
            if(!isset($request->page)) {
				$type = 'reload';
            }
            return [
                'html' => $html,
                'pagination' => $pagination,
                'type' => $type
            ];
		}
		
		return view('Default::web.products.index',compact('product_categorie','filters', 'breadcrumb', 'meta_seo', 'admin_bar', 'products', 'config_product', 'product_favorite'));
	}

	public static function show($id, $slug) {
		\Asset::addStyle(['product', 'slick', 'venobox'])
			->addScript(['slick', 'product', 'venobox']);
		$config_product = getOption('product');
        // $product = Product::with('category')->where('slug', $slug)->where('status', 1)->firstOrFail();
        $product = Product::with('category')->where('id', $id);
       	if(Auth::guard('admin')->check()) {
            $product = $product->where(function($q){
            	$q->whereIn('status', [0,1])
            		->orWhere(function($query){
            			$query->where('status', '<>', -1);
            		});
            })->firstOrFail();
        }else {
        	$product = $product->where('status', 1)->firstOrFail();
        }
		$related_id = explode(',', $product->related_products);
		$category = $product->category;
		$date = date('Y-m-d H:i:s');
		if(empty($product->related_products)) {
			$relatedProducts = Product::where('status', 1)
				->where('category_id', $product->category_id)
				->where('id', '<>', $product->id)
				->orderBy('id', 'desc')
				->where('created_at', '<=', $date)
				->limit(8)->get();
		} else {
			$relatedProducts = Product::where('status', 1)
				->where('created_at', '<=', $date)
				->whereIn('id', $related_id)->get();
		}
		$type = 'products';
		$list_comment = Comment::where('status', 1)
			->where('type_id', $product->id)
			->where('type', $type)->where('parent_id', 0)->orderBy('id','desc')->paginate(5);
        $count_comment = $list_comment->total();
        $commentCountType = Comment::where('status', 1)
            ->where('type_id', $product->id)
            ->where('type', $type)
            ->where('parent_id', 0)
            ->select(DB::raw('count(*) as number'), 'vote')
            ->groupBy('vote')
            ->pluck('number', 'vote')->toArray();
		$admin_bar = route('admin.products.edit', $product->id);
		$meta_seo = metaSeo('products', $product->id, [
			'title' => $product->name,
			'description' => removeHTML(cutString($product->description,250)),
			'image' => $product->getImage('medium'),
		]);
		$breadcrumb = [ 
			[
				'link' => $category->getUrl(),
				'name' => $category->name ?? ''
			],
			[
				'link' => $product->getUrl(),
				'name' => $product->name
			],
		];
		
		$golden_time = GoldenTime::where('start_time', '<=', $date)->Where('end_time', '>=', $date)->first();
		if(!empty($golden_time)){
			$goldenTimeProduct = $golden_time->goldenTimeProduct->where('product_id', $product->id)->first();
			if(!empty($goldenTimeProduct) && $goldenTimeProduct->getStok()){
				$product->price = $goldenTimeProduct->price;
			}
		}
		$combos = $product->getComboProducts();
		$filter_product = [];
		$filter_detail_id = ProductFilter::where('product_id', $product->id)->pluck('filter_detail_id')->toArray();
		$filter_currents = FilterDetail::whereIn('id', $filter_detail_id)->with('filter')->get();
		$products_id = ProductFilter::whereIn('filter_detail_id',$filter_detail_id)->select('product_id', DB::raw('count(*) as total'))->groupBy('product_id')->get();
		foreach ($products_id as $key => $value) {
			if($value->total == count($filter_detail_id)){
				array_push($filter_product, $value->product_id);
			}
		}
		if(!empty($product->related_products)){
			$relate_products = Product::where('status', 1)
							->whereIn('id', explode(",", $product->related_products ?? ''))
							->where('id', '<>', $product->id)
							->orderBy('id', 'desc')
							->limit(8)->get();
		}else{
			$relate_products = Product::where('status', 1)
							->where('category_id', $product->category_id)
							->whereIn('id', $filter_product)
							->where('id', '<>', $product->id)
							->orderBy('id', 'desc')
							->where('price', '>=', $product->price)
							->where('created_at', '<=', $date)
							->limit(8)->get();
		}
		return view('Default::web.products.show', compact('golden_time','combos','meta_seo', 'admin_bar', 'product', 'category','type','count_comment','list_comment', 'breadcrumb', 'relatedProducts', 'config_product', 'relate_products'));
	}
	public static function getOrder($order) {
		switch ($order) {	
			case 'low_price':
				$search = 'price asc';
			break;
			case 'high_price':
				$search = 'price desc';
			break;
			case 'newest':
				$search = 'id desc';
			break;
			case 'oldest':
				$search = 'id asc';
			break;
			case 'asc':
				$search = 'name asc';
			break;
			case 'desc':
				$search = 'name desc';
			break;
			default:
				$search = '';
				break;
		}
		return $search;
	}
    public function compare(Request $request) {
        \Asset::addStyle(['product']);
        $compare = Session::get('compare')??[];
        if(empty($compare)) {
            return redirect()->route('app.home');
        }
        $meta_seo = metaSeo('', '', [
            'title' =>  'So sánh sản phẩm',
            'description' => 'So sánh sản phẩm',
            'image' => getImage(),
        ]);
        $products = Product::whereIn('id', array_keys($compare))
        	// ->where('created_at', '<=', $date)
            ->active()->get();
        $breadcrumd = [
            [
                'name' => 'So sánh sản phẩm',
                'link' => route('app.products.compare')
            ]
        ];
        return view('Default::web.products.compare-list', compact('products', 'meta_seo', 'breadcrumd', 'compare'));
    }
	function getIDFilterCategoryMap($category_id) {
		$filter_product_category_maps = \Sudo\Filter\Models\FilterProductCategoryMap::where('category_id', $category_id)->get();
		$coutinue = (count($filter_product_category_maps) == 0) ? true : false;
		while ($coutinue == true) {
			$category = \Sudo\Ecommerce\Models\ProductCategory::where('id', $category_id)->first();
			$filter_product_category_maps = \Sudo\Filter\Models\FilterProductCategoryMap::where('category_id', $category->parent_id)->get();
			if (count($filter_product_category_maps) > 0 || $category->parent_id == 0) {
				$coutinue = false;
			}
			$category_id = $category->parent_id;
		}
		return $filter_product_category_maps->pluck('filter_id');
	}
}
