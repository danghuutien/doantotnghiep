<?php

namespace Sudo\Theme\Http\Controllers\Web;
use Illuminate\Http\Request;
use Sudo\Post\Models\Post;
use Sudo\Post\Models\PostCategory;
use Sudo\Ecommerce\Models\Product;
use Sudo\Ecommerce\Models\ProductCategory;
use Sudo\Page\Models\Page;
use Session;
use DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HandleController extends Controller
{
	public function index(Request $request) {
        $slug = $request->slug;
        $item = DB::table('slugs')->where('slug', $slug)->first();
        $table = $item->table ?? '';
        $id = $item->table_id ?? 0;
        switch ($table) {
            // posts
            case 'posts':
                return PostController::show($id, $slug);
            break;
            case 'post_categories':
                return PostController::index($request, $slug);
            break;
            case 'products':
                return ProductController::show($id, $slug);
            break;
            case 'product_categories':
                return ProductController::index($request, $id, $slug);
            break;
            case 'pages':
                return PageController::show($id, $slug);
            break;
            default: 
               throw new NotFoundHttpException();
            break;
        }
    }
}