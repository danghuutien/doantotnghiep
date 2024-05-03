<?php

namespace Sudo\Theme\Http\Controllers\Web;

use Illuminate\Http\Request;
use Sudo\Ecommerce\Models\Product;
use Sudo\Post\Models\Post;

class SearchController extends Controller
{

    public function index(Request $request) {
        \Asset::addStyle(['product', 'slick'])
            ->addScript(['slick', 'product']);
        $config_product = getOption('product');
        $date = date('Y-m-d H:i:s');
        $meta_seo = metaSeo('', '', [
            'title' => 'Tìm kiếm',
            'description' => 'Tìm kiếm',
        ]);
        $breadcrumb = [
            [
                'link' => route('app.search.index'),
                'name' => 'Tìm kiếm'
            ],
        ];
        $products = Product::active();
        $sort = $request->sort ?? 'default';
        $priceSort = $request->priceSort ?? '';
        $search = $this->getOrder($sort);
        $keyword = $request->keyword ?? '';
        if(!empty($priceSort)) {
            $priceSort = explode('_', $priceSort);
            $startPrice = intval(($priceSort[0] ?? 0).'000000');
            $endPrice = intval(($priceSort[1] ?? 0).'000000');
            $products = $products->whereBetween('price', [$startPrice, $endPrice]);
        }
        if(!empty($keyword)) {
            $formatKey = formatKeyword($keyword);
            $products = $products->where('name', 'LIKE', '%'.$formatKey['key'].'%');
        }
        if(!empty($search)) {
            $products = $products->orderByRaw($search);
        } else {
            $products = $products->orderBy('products.id', 'desc');
        }

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
        
        $search_posts = Post::with(['postCategoryMap.category', 'adminUser'])
                ->where('name', 'LIKE', '%'.formatKeyword($keyword)['key'].'%')
                ->where('status', 1)
                ->where('created_at', '<=', $date)
                ->orderBy('id', 'desc');
        $count_post = $search_posts->count();
        $search_posts = $search_posts->limit(16)->get();
        return view('Default::web.search.index',compact('breadcrumb', 'meta_seo', 'products', 'config_product', 'keyword', 'search_posts', 'count_post'));
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
}
