<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Log;
use Goutte\Client;
use Illuminate\Support\Str;
use Symfony\Component\HttpClient\HttpClient;
use DOMXPath;
use DOMDocument;

class GetData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'GetData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lấy dữ liệu cũ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->connect = DB::connection('mysql2');
        $this->arr_status = [
            'publish' => 1,
            'private' => 1,
        ];
        parent::__construct();
    }

    public function echoLog($string, $type = 'info') {
        $this->info($string);
        switch ($type) {
            case 'info':
                Log::info($string);
            break;
            case 'warning':
                Log::warning($string);
            break;
            case 'error':
                Log::error($string);
            break;
        }
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    	// Bắt đầu Job
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        $arr_status = $this->arr_status;
        $connect = $this->connect;
        $this->echoLog('Bắt đầu lấy dữ liệu');
        $this->getDataPage($arr_status, $connect);
        $this->getDataPostCategory($arr_status, $connect);
        $this->getDataPost($arr_status, $connect);
        $this->getDataProductCategory($arr_status, $connect);
        $this->getDataProduct($arr_status, $connect);

        $this->echoLog('Hoàn thành lấy dữ liệu');
    }
    public function getDataPage($arr_status, $connect){
        $this->echoLog('Bắt đầu lấy dữ liệu trang đơn');
        \DB::table('pages')->truncate();
        \DB::table('seos')->where('type', 'pages')->delete();
        \DB::table('slugs')->where('table', 'pages')->delete();
        $page_olds = $connect->table('pages')->get();
        
        $arr_pages = [];
        $arr_slugs = [];
        foreach ($page_olds as $value) {
            $slug = $connect->table('slugs')->where('table', 'pages')->where('table_id', $value->id)->first();
            $seo = $connect->table('seos')->where('type', 'pages')->where('type_id', $value->id)->first();
            $arr_pages[] = [
                'id' => $value->id,
                'name' => $value->name,
                'slug' => $slug->slug,
                'detail' => $value->detail,
                'status' => $value->status,
                'created_at' => $value->created_at,
                'updated_at' => $value->updated_at
            ];
            $arr_slugs[] = [
                'table' => $slug->table,
                'table_id' => $slug->table_id,
                'slug' => $slug->slug,
                'created_at' => $slug->created_at,
                'updated_at' => $slug->updated_at,
            ];
            // seo
            $arr_seos[] = [
                'type' => $seo->type,
                'type_id' => $seo->type_id,
                'title' => $seo->title,
                'description' => $seo->description,
                'robots' => $seo->robots,
                'social_image' => $seo->social_image,
                'social_title' => $seo->social_title,
                'social_description' => $seo->social_description,
            ];
        }
        
        $pages = \Sudo\Page\Models\Page::insert($arr_pages);
        dump("Đã thêm ". count($arr_pages). " bản ghi vào bản Page");

        $slugs = \DB::table('slugs')->insert($arr_slugs);
        dump("Đã thêm ". count($arr_slugs). " bản ghi vào bản slug");
        
        $sync_links = DB::table('seos')->insert($arr_seos);
        dump("Đã thêm ". count($arr_seos). " bản ghi sync_links page vào bảng sync_links");

        $this->echoLog('Đã hoàn tất lấy dữ liệu trang đơn');
    }
    public function getDataPostCategory($arr_status, $connect){
        $this->echoLog('Bắt đầu lấy dữ liệu danh mục bài viết');
        \DB::table('post_categories')->truncate();
        \DB::table('post_category_maps')->truncate();
        \DB::table('seos')->where('type', 'post_categories')->delete();
        \DB::table('slugs')->where('table', 'post_categories')->delete();
        $list_ids = [
            101,
            102,
            103,
            104
        ];
        $post_category_maps = $connect->table('post_category_maps')->whereIn('post_category_id', $list_ids)->get();
        $post_categories = $connect->table('post_categories')->whereIn('id', $list_ids)->get();
        $arr_categories = [];
        foreach($post_categories as $key => $value){
            $slug = $connect->table('slugs')->where('table', 'post_categories')->where('table_id', $value->id)->first();
            $seo = $connect->table('seos')->where('type', 'post_categories')->where('type_id', $value->id)->first();
            $arr_categories[] = [
                'id' => $value->id,
                'parent_id' => $value->parent_id,
                'name' => $value->name,
                'slug' => $slug->slug,
                'image' => str_replace('/wp-content/uploads/', 'https://sudospaces.com/toshiko/uploads/', $value->image),
                'detail' => str_replace('/wp-content/uploads/', 'https://sudospaces.com/toshiko/uploads/', $value->detail),
                'order' => $value->order,
                'status' => $value->status,
                'created_at' => $value->created_at,
                'updated_at' => $value->updated_at,
            ];

            $arr_slugs[] = [
                'table' => $slug->table,
                'table_id' => $slug->table_id,
                'slug' => $slug->slug,
                'created_at' => $slug->created_at,
                'updated_at' => $slug->updated_at,
            ];

            $arr_seos[] = [
                'type' => $seo->type,
                'type_id' => $seo->type_id,
                'title' => $seo->title,
                'description' => $seo->description,
                'robots' => $seo->robots,
                'social_image' => $seo->social_image,
                'social_title' => $seo->social_title,
                'social_description' => $seo->social_description,
            ];
        }
        $arr_category_maps = [];
        foreach ($post_category_maps as $key => $value) {
            $arr_category_maps[] = [
                'post_id' => $value->post_id,
                'post_category_id' => $value->post_category_id,
            ];
        }
        $post_categories = \Sudo\Post\Models\PostCategory::insert($arr_categories);
        dump("Đã thêm ". count($arr_categories). " bản ghi vào bảng post_categories");
        
        $slugs = \DB::table('slugs')->insert($arr_slugs);
        dump("Đã thêm ". count($arr_slugs). " bản ghi vào bản slug");

        $post_category_maps = \Sudo\Post\Models\PostCategoryMap::insert($arr_category_maps);
        dump("Đã thêm ". count($arr_category_maps). " bản ghi vào bảng post_category_maps");

        $seos = DB::table('seos')->insert($arr_seos);
        dump("Đã thêm ". count($arr_seos). " bản ghi seo post_cate vào bảng seos");

        $this->echoLog('Đã hoàn tất lấy dữ liệu danh mục bài viết');
    }
    public function getDataPost($arr_status, $connect){
        $this->echoLog('Bắt đầu lấy dữ liệu bài viết');
        \DB::table('posts')->truncate();
        \DB::table('seos')->where('type', 'posts')->delete();
        \DB::table('slugs')->where('table', 'posts')->delete();
        $posts = $connect->table('posts')->get();
        $arr_posts = [];
        foreach($posts as $key => $value){
            $slug = $connect->table('slugs')->where('table', 'posts')->where('table_id', $value->id)->first();
            $seo = $connect->table('seos')->where('type', 'posts')->where('type_id', $value->id)->first();
            $arr_posts[] = [
                'id' => $value->id,
                'admin_user_id' => $value->admin_user_id,
                'name' => $value->name,
                'slug' => $value->slug,
                'image' => str_replace('/wp-content/uploads/', 'https://sudospaces.com/toshiko/uploads/', $value->image),
                'detail' => str_replace('/wp-content/uploads/', 'https://sudospaces.com/toshiko/uploads/', $value->detail),
                'related_posts' => $value->related_posts,
                'status' => $value->status,
                'created_at' => $value->created_at,
                'updated_at' => $value->updated_at,
            ];

            $arr_slugs[] = [
                'table' => $slug->table,
                'table_id' => $slug->table_id,
                'slug' => $slug->slug,
                'created_at' => $slug->created_at,
                'updated_at' => $slug->updated_at,
            ];

            $arr_seos[] = [
                'type' => $seo->type,
                'type_id' => $seo->type_id,
                'title' => $seo->title,
                'description' => $seo->description,
                'robots' => $seo->robots,
                'social_image' => $seo->social_image,
                'social_title' => $seo->social_title,
                'social_description' => $seo->social_description,
            ];
        }
        $posts = \Sudo\Post\Models\Post::insert($arr_posts);
        dump("Đã thêm ". count($arr_posts). " bản ghi vào bảng posts");
        
        $slugs = \DB::table('slugs')->insert($arr_slugs);
        dump("Đã thêm ". count($arr_slugs). " bản ghi vào bản slug");

        $seos = DB::table('seos')->insert($arr_seos);
        dump("Đã thêm ". count($arr_seos). " bản ghi seo post vào bảng seos");

        $this->echoLog('Đã hoàn tất lấy dữ liệu bài viết');
    }
    public function getDataProductCategory($arr_status, $connect){
        $this->echoLog('Bắt đầu lấy dữ liệu danh mục sản phẩm');
        \DB::table('product_categories')->truncate();
        \DB::table('seos')->where('type', 'product_categories')->delete();
        \DB::table('slugs')->where('table', 'product_categories')->delete();
        $product_categories = $connect->table('product_categories')->get();
        $arr_product_categories = [];
        foreach($product_categories as $key => $value){
            $slug = $connect->table('slugs')->where('table', 'product_categories')->where('table_id', $value->id)->first();
            $seo = $connect->table('seos')->where('type', 'product_categories')->where('type_id', $value->id)->first();
            $arr_product_categories[] = [
                'id' => $value->id,
                'parent_id' => $value->parent_id,
                'name' => $value->name,
                'slug' => $slug->slug,
                'image' => str_replace('/wp-content/uploads/', 'https://sudospaces.com/toshiko/uploads/', $value->image),
                'icon' => $value->icon,
                'detail' => str_replace('/wp-content/uploads/', 'https://sudospaces.com/toshiko/uploads/', $value->detail),
                'order' => $value->order,
                'status' => $value->status,
                'created_at' => $value->created_at,
                'updated_at' => $value->updated_at,
            ];

            $arr_slugs[] = [
                'table' => $slug->table,
                'table_id' => $slug->table_id,
                'slug' => $slug->slug,
                'created_at' => $slug->created_at,
                'updated_at' => $slug->updated_at,
            ];

            $arr_seos[] = [
                'type' => $seo->type,
                'type_id' => $seo->type_id,
                'title' => $seo->title,
                'description' => $seo->description,
                'robots' => $seo->robots,
                'social_image' => $seo->social_image,
                'social_title' => $seo->social_title,
                'social_description' => $seo->social_description,
            ];
        }
        $new_product_categories = \Sudo\Ecommerce\Models\ProductCategory::insert($arr_product_categories);
        dump("Đã thêm ". count($arr_product_categories). " bản ghi vào bảng product_categories");
        
        $slugs = \DB::table('slugs')->insert($arr_slugs);
        dump("Đã thêm ". count($arr_slugs). " bản ghi vào bản slug");

        $seos = DB::table('seos')->insert($arr_seos);
        dump("Đã thêm ". count($arr_seos). " bản ghi seo product_cates vào bảng seos");

        $this->echoLog('Đã hoàn tất lấy dữ liệu danh mục sản phẩm');
    }
    public function getDataProduct($arr_status, $connect){
        $this->echoLog('Bắt đầu lấy dữ liệu sản phẩm');
        \DB::table('products')->truncate();
        \DB::table('seos')->where('type', 'products')->delete();
        \DB::table('slugs')->where('table', 'products')->delete();

        $product_old = $connect->table('products')->get();

        $product_data = [];
        foreach ($product_old as $value) {
            
            $slug = $connect->table('slugs')->where('table', 'products')->where('table_id', $value->id)->first();
            $seo = $connect->table('seos')->where('type', 'products')->where('type_id', $value->id)->first();
            $category_id = $connect->table('product_category_maps')->where('product_id', $value->id)->first();
            $arr_products[] = [
                'id' => $value->id,
                'category_id' => $category_id->product_category_id,
                'sku' => $value->sku,
                'name' => $value->name,
                'slug' => $slug->slug,
                'image' => str_replace('/wp-content/uploads/', 'https://sudospaces.com/toshiko/uploads/', $value->image),
                'price' => $value->price,
                'price_old' => $value->price_old,
                'detail' => str_replace('/wp-content/uploads/', 'https://sudospaces.com/toshiko/uploads/', $value->detail),
                'length' => $value->length,
                'quantity' => 1,
                'wide' => $value->wide,
                'height' => $value->height,
                'weight' => $value->weight,
                'created_at' => $value->created_at,
                'updated_at' => $value->updated_at,
            ];

            $arr_slugs[] = [
                'table' => $slug->table,
                'table_id' => $slug->table_id,
                'slug' => $slug->slug,
                'created_at' => $slug->created_at,
                'updated_at' => $slug->updated_at,
            ];

            $arr_seos[] = [
                'type' => $seo->type,
                'type_id' => $seo->type_id,
                'title' => $seo->title,
                'description' => $seo->description,
                'robots' => $seo->robots,
                'social_image' => $seo->social_image,
                'social_title' => $seo->social_title,
                'social_description' => $seo->social_description,
            ];
        }
        $new_products = \Sudo\Ecommerce\Models\Product::insert($arr_products);
        dump("Đã thêm ". count($arr_products). " bản ghi vào bảng products");

        $slugs = \DB::table('slugs')->insert($arr_slugs);
        dump("Đã thêm ". count($arr_slugs). " bản ghi vào bản slug");

        $seos = DB::table('seos')->insert($arr_seos);
        dump("Đã thêm ". count($arr_seos). " bản ghi seo product vào bảng seos");

        $this->echoLog('Đã hoàn tất lấy dữ liệu sản phẩm');  
    }
}