<?php

namespace Sudo\Theme\Http\Controllers\Web;

use Illuminate\Http\Request;
use Sudo\Post\Models\Post;
use Sudo\Post\Models\PostCategory;
use Sudo\Tag\Models\Tag;
use Sudo\Tag\Models\TagMap;
use Auth;

class PostController extends Controller
{
	public static function index(Request $request, $slug=null) {
		\Asset::addStyle(['post']);
		$config_post = getOption('post_category');
		$cate_tags = [];
		$post_categories = PostCategory::where('status', 1)->where('parent_id', 0)->get();
		$paginate = 9;
		$url_cate = \URL::full();
		$date = date('Y-m-d H:i:s');
		if($slug != null) {
			$category = PostCategory::where('slug', $slug)->where('status',1)->firstOrFail();
			$meta_seo = metaSeo('post_categories', $category->id, [
				'title' => $category->name ?? 'Tin tức',
				'description' => cutString(removeHTML($category->detail ?? ''), 160),
				'image' => $category->getImage(),
				'url' => $category->getUrl(),
				'robots' => 'Index,Follow',
			]);
			$posts_cate = Post::with(['postCategoryMap.category', 'adminUser'])
				->join('post_category_maps', 'post_category_maps.post_id', 'posts.id')
				->whereIn('post_category_maps.post_category_id', $category->childId($category->id))
				->where('posts.status', 1)
				->select('posts.*')
				->distinct('posts.id')
				->where('created_at', '<=', $date)
				->orderBy('id', 'desc');
			$count_post = $posts_cate->count();
			$posts = $posts_cate->paginate($paginate);
			if($request->ajax()) {
				$html =view('Default::web.layouts.post-item',['posts' => $posts])->render();
				$pagination = $posts->appends(Request()->all())->links('Default::general.components.pagination')->toHtml();
	            return [
	                'html' => $html,
	                'pagination' => $pagination,
	            ];
			}
			$breadcrumb = [ 
				[
					'link' => $category->getUrl(),
					'name' => $category->name ?? ''
				],
			];
			$banner = $category->image ?? '';
			$title = $category->name ?? '';
			$admin_bar = route('admin.post_categories.edit', $category->id);
			return view('Default::web.post.index', compact('posts', 'category', 'meta_seo', 'admin_bar', 'cate_tags', 'count_post', 'post_categories', 'breadcrumb', 'config_post', 'banner', 'title', 'url_cate'));
		}else {
			$meta_seo = metaSeo('', '', [
				'title' => $config_post['meta_title'] ?? 'Tin tức',
				'description' => $config_post['meta_description'] ?? 'Danh mục tin tức',
				'image' => getImage($config_post['meta_image'] ?? ''),
				'url' => route('app.post_categories.index'),
				'robots' => 'Index,Follow',
			]);
			$breadcrumb = [ 
				[
					'link' => route('app.post_categories.index'),
					'name' => 'Tin tức'
				],
			];
			$post_news = Post::with(['postCategoryMap.category', 'adminUser'])
					->where('status', 1)
					->where('created_at', '<=', $date)
					->orderBy('id', 'desc')
					->limit(5)->get();
			$posts_cate = Post::with(['postCategoryMap.category', 'adminUser'])
				->where('posts.status', 1)
				->where('created_at', '<=', $date)
				->whereNotIn('id', $post_news->pluck('id')->toArray())
				->orderBy('id', 'desc');
			$count_post = $posts_cate->count();
			$posts = $posts_cate->paginate($paginate);
			if($request->ajax()) {
				$html =view('Default::web.layouts.post-item',['posts' => $posts])->render();
				$pagination = $posts->appends(Request()->all())->links('Default::general.components.pagination')->toHtml();
	            return [
	                'html' => $html,
	                'pagination' => $pagination,
	            ];
			}
			$banner = $config_post['banner'] ?? '';
			$title = 'Tin mới nhất';
			return view('Default::web.post.index', compact('meta_seo', 'posts', 'config_post', 'cate_tags', 'count_post', 'post_categories', 'post_news', 'breadcrumb', 'config_post', 'banner', 'title', 'url_cate'));
		}
	}

	public static function show($id,$slug) {
		\Asset::addStyle(['post', 'owl-carousel'])
			->addScript(['owl-carousel']);
		$date = date('Y-m-d H:i:s');
       	$post = Post::with('postCategoryMap.category')->where('slug', $slug)->where('id', $id);
       	if(Auth::guard('admin')->check()) {
            $post = $post->where(function($q){
            	$q->whereIn('status', [0,1])
            		->orWhere(function($query){
            			$query->where('status', '<>', -1)
            				->where('admin_user_id', \Auth::guard('admin')->user()->id);
            		});
            })->firstOrFail();
        }else {
        	$post = $post->where('status', 1)->firstOrFail();
        }
       	$post_categories = PostCategory::where('status', 1)->where('parent_id', 0)->get();
       	$category = $post->getCateParent();
       	$url_cate = $category->getUrl();
        $meta_seo = metaSeo('posts',$post->id,[
			'title' => $post->name,
			'description' => cutString(removeHTML($post->description != '' ? $post->description : $post->detail)),
			'url' => $post->getUrl(),
			'image' => $post->getImage(),
			'robots' => 'Index,Follow',
		]);
		$breadcrumb = [ 
			[
				'link' => route('app.post_categories.index'),
				'name' => 'Tin tức'
			],
			[
				'link' => $category->getUrl(),
				'name' => $category->name
			],
			[
				'link' => $post->getUrl(),
				'name' => $post->name
			],
		];
		$admin_bar = route('admin.posts.edit', $post->id);
		$array_related = explode(',', $post->related_posts);
		$related_posts = Post::with('postCategoryMap.category')
				->whereIn('id', $array_related)
				->where('status', 1)
				->where('created_at', '<=', $date)
				->get();
        $arrayMore = explode(',', $post->more_posts);
        $morePosts = Post::with('postCategoryMap.category')
                ->whereIn('id', $arrayMore)
                ->where('status', 1)
                ->where('created_at', '<=', $date)
                ->get();
		if(!isset($related_posts) || count($related_posts) <= 0) {
			// $category_id = $post->category()->id;
			// $related_posts = Post::with('postCategoryMap.category')
			// 	->join('post_category_maps', 'posts.id', 'post_category_maps.post_id')
			// 	->where('.post_category_maps.post_category_id', $category_id)
			// 	->where('posts.status', 1)
			// 	->orderBy('posts.id', 'desc')
			// 	->where('created_at', '<=', $date)
			// 	->limit(4)
			// 	->get();
		}
		$post_news = Post::with(['postCategoryMap.category', 'adminUser'])->where('status', 1)->orderBy('id', 'desc')->limit(6)->get();
		$tag_posts_id = TagMap::where('tag_table','posts')->where('tag_table_id',$post->id??0)->pluck('tag_id')->toArray();
		$tag_posts = Tag::where('status',1)->whereIn('id',$tag_posts_id)->get();
		return view('Default::web.post.show',compact('meta_seo', 'post', 'admin_bar', 'related_posts', 'post_categories', 'category', 'post_news', 'breadcrumb', 'url_cate', 'tag_posts', 'morePosts'));
	}

    public function tag($slug, Request $request) {
        \Asset::addStyle(['post']);
        $config_post = getOption('post_category');
        $post_categories = PostCategory::where('status', 1)->where('parent_id', 0)->get();
        $paginate = 9;
        $url_cate = \URL::full();
        $date = date('Y-m-d H:i:s');
        $tag = Tag::with('tagMap')->where('slug', $slug)
            ->where('status',1)->firstOrFail();
        $post_id = $tag->tagMap()->pluck('tag_table_id')->toArray();
        $meta_seo = metaSeo('post_categories', $tag->id, [
            'title' => $tag->name ?? 'Tin tức',
            'description' => cutString(removeHTML($tag->detail ?? ''), 160),
            'image' => $tag->getImage(),
            'url' => $tag->getUrl(),
            'robots' => 'Index,Follow',
        ]);
        $posts_cate = Post::with(['postCategoryMap.category', 'adminUser'])
            ->whereIn('id', $post_id)
            ->where('posts.status', 1)
            ->select('posts.*')
            ->distinct('posts.id')
            ->where('created_at', '<=', $date)
            ->orderBy('id', 'desc');
        $posts = $posts_cate->paginate($paginate);
        $count_post = $posts->total();
        if($request->ajax()) {
            $html =view('Default::web.layouts.post-item',['posts' => $posts])->render();
            $pagination = $posts->appends(Request()->all())->links('Default::general.components.pagination')->toHtml();
            return [
                'html' => $html,
                'pagination' => $pagination,
            ];
        }
        $breadcrumb = [
            [
                'link' => $tag->getUrl(),
                'name' => $tag->name ?? ''
            ],
        ];
        $banner = $config_post['banner']?? '';
        $title = $tag->name ?? '';
        $admin_bar = route('admin.tags.edit', $tag->id);
        return view('Default::web.post.tag', compact('posts', 'tag', 'meta_seo', 'admin_bar', 'count_post', 'post_categories', 'breadcrumb', 'config_post', 'banner', 'title', 'url_cate'));
    }
}
