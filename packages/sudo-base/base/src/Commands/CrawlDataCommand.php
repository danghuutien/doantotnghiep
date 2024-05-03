<?php

namespace Sudo\Base\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use DB;
use Request;
use Sudo\Ecommerce\Models\Product;
use Sudo\Post\Models\PostCategoryMap;
use Sudo\Theme\Models\Post;
use Sudo\Theme\Models\PostCategory;
use Sudo\Theme\Models\ProductCategory;

class CrawlDataCommand extends Command {

    protected $signature = 'crawl:seeds';

    protected $description = 'Xóa dữ liệu cache';

    public function handle(Request $request) {
        $finded = [];
        DB::table('post_category_maps')->delete();
        DB::table('slugs')->delete();
        DB::table('pins')->delete();
        DB::table('post_categories')->delete();
        DB::table('posts')->delete();
        DB::table('product_categories')->delete();
        DB::table('products')->delete();
        DB::table('pages')->delete();
        DB::connection('mysql2')->table('wp_posts')->whereNotIn('ID', $finded)->orderBy('id')->chunk(100, function($wp_posts){
            foreach($wp_posts as $wp_post){
                $relas = DB::connection('mysql2')->table('wp_postmeta')->where('post_id', $wp_post->ID)->get();
                if($wp_post->post_type == 'product'){
                    $this->info('product: '.$wp_post->ID);
                    $product = new Product();
                    $name = $wp_post->post_title;
                    $updated_at = $wp_post->post_modified == '0000-00-00 00:00:00' ? date('Y-m-d H:i:s'): $wp_post->post_modified;
                    $created_at = $wp_post->post_modified_gmt == '0000-00-00 00:00:00' ? date('Y-m-d H:i:s'): $wp_post->post_modified_gmt;;
                    $slug = $wp_post->post_name;
                    $quantity = 100;
                    $detail = $wp_post->post_content;
                    $status = 1;
                    $category_id = 0;
                    $sku = '';
                    $price = 0;
                    $price_old = 0;
                    foreach($relas as $rela){
                        if($rela->meta_key == '_sale_price'){
                            $price = $rela->meta_value;
                        }   
                        if($rela->meta_key == '_sku'){
                            $sku = $rela->meta_value;
                        }   
                        if($rela->meta_key == '_regular_price'){
                            $price_old = $rela->meta_value;
                        }   
                        if($rela->meta_key == '_thumbnail_id'){
                            $finded[] = $rela->meta_value;
                            $thumb = DB::connection('mysql2')->table('wp_posts')->where('id', $rela->meta_value)->first();
                            $exp = explode("/uploads/", $thumb->guid);
                            $image = '/uploads/'.$exp[1] ?? '';
                        }   
                        if($rela->meta_key == '_yoast_wpseo_primary_product_cat'){
                            $category = DB::connection('mysql2')->table('wp_terms')->where('term_id', $rela->meta_value)->first();
                            $check = ProductCategory::where('id', $rela->meta_value)->first();
                            $checkPins = DB::table('pins')->where('type_id', $rela->meta_value)->first();
                            if(!isset($check)){
                                DB::table('product_categories')->insert([
                                    'id' => $rela->meta_value,
                                    'name' => $category->name,
                                    'slug' => $category->slug,
                                ]);
                            }
                            if(!isset($checkPins)){
                                DB::table('pins')->insert([
                                    'type'=> 'product_categories',
                                    'type_id'=> $rela->meta_value,
                                    'place'=> 'home',
                                    'value'=>$rela->meta_value
                                ]);
                            }
                            $checkSlug = DB::table('slugs')->where('slug', $category->slug ?? '')->first();
                            if(!$checkSlug){
                                $slug_product_cat= [];
                                $slug_product_cat[] = [
                                    'table' => 'product_categories',
                                    'table_id' => $category->term_id,
                                    'slug' => $category->slug
                                ];
                                DB::table('slugs')->insert($slug_product_cat);
                            }
                            $category_id = $rela->meta_value;
                        }
                    }
                    $compact = compact('quantity', 'category_id','sku', 'price', 'price_old', 'status','name', 'slug', 'detail', 'image', 'created_at', 'updated_at');
                    if(isset($relas)){
                        $id = $product->insertGetId($compact);
                    }
                    $checkSlug = DB::table('slugs')->where('slug', $wp_post->post_name)->first();
                    if(!$checkSlug){
                        $slug_product= [];
                        $slug_product[] = [
                            'table' => 'products',
                            'table_id' => $id,
                            'slug' => $wp_post->post_name
                        ];
                        DB::table('slugs')->insert($slug_product);
                    }
                }
                if($wp_post->post_type == 'post'){
                    $this->info('post: '.$wp_post->ID);
                    $post = new Post();
                    $post_category_id = 0;
                    $name = $wp_post->post_title;
                    $updated_at = ($wp_post->post_date == '0000-00-00 00:00:00') ? date('Y-m-d H:i:s') : $wp_post->post_date;
                    $created_at = ($wp_post->post_date_gmt == '0000-00-00 00:00:00') ? date('Y-m-d H:i:s') : $wp_post->post_date_gmt;
                    $slug = $wp_post->post_name;
                    $status = $wp_post->ping_status == 'open' ? 1 : 0;
                    $detail = $wp_post->post_content;
                    $image = '';
                    foreach($relas as $rela){
                        if($rela->meta_key == '_thumbnail_id'){
                            $finded[] = $rela->meta_value;
                            $thumb = DB::connection('mysql2')->table('wp_posts')->where('id', $rela->meta_value)->first();
                            $exp = explode("/uploads/", $thumb->guid);
                            $image = '/uploads/'.$exp[1] ?? '';
                        } 
                        if($rela->meta_key == '_yoast_wpseo_primary_category'){
                            $post_category_id = $rela->meta_value;
                        }
                    }
                    $compact = compact('status','name', 'slug', 'detail', 'image', 'created_at', 'updated_at');
                    $id = $post->insertGetId($compact);
                    $checkPostCate = PostCategory::where('id', $post_category_id)->first();
                    $checkPins = DB::table('pins')->where('type_id', $post_category_id)->first();
                    $category = DB::connection('mysql2')->table('wp_terms')->where('term_id', $post_category_id)->first();
                    if(!isset($checkPins) && $post_category_id != 0){
                        DB::table('pins')->insert([
                            'type'=> 'posts',
                            'type_id'=> $post_category_id,
                            'place'=> 'home',
                            'value'=> $post_category_id
                        ]);
                    }
                    if(!isset($checkPostCate) && isset($category)){
                        DB::table('post_categories')->insert([
                            'id' => $post_category_id,
                            'name' => $category->name,
                            'slug' => $category->slug,
                        ]);
                    }
                    DB::table('post_category_maps')->where('post_id', $id)->delete();
                    if($post_category_id != 0){
                        DB::table('post_category_maps')->insert([
                            'post_id' => $id,
                            'post_category_id' => $post_category_id,
                        ]);
                    }
                    $checkSlug = DB::table('slugs')->where('slug', $wp_post->post_name)->first();
                    if(!$checkSlug){
                        $slug_post = [];
                        $slug_post[] = [
                            'table' => 'posts',
                            'table_id' => $wp_post->ID,
                            'slug' => $wp_post->post_name
                        ];
                        DB::table('slugs')->insert($slug_post);
                    }
                }
                if($wp_post->post_type == 'page'){
                    $this->info('pages: '.$wp_post->ID);
                    $check = DB::table('pages')->where('slug', $wp_post->post_name)->first();
                    DB::table('pages')->insert([
                        'name'=> $wp_post->post_title,
                        'slug'=> isset($check) ? $wp_post->post_name.'_01' : $wp_post->post_name,
                        'detail'=> $wp_post->post_content,
                        'status'=> $wp_post->post_status == 'publish' ? 1: 0,
                    ]);
                    $checkSlug = DB::table('slugs')->where('slug', $wp_post->post_name)->first();
                    if(!$checkSlug){
                        $slug_page= [] ;
                        $slug_page[] = [
                            'table' => 'pages',
                            'table_id' => $wp_post->ID,
                            'slug' => $wp_post->post_name
                        ];
                        DB::table('slugs')->insert($slug_page);
                    }
                    
                }
            }
        });
        $mapPosts = PostCategoryMap::pluck('post_id');
        DB::table('posts')->whereNotIn('id', $mapPosts)->update([
            'status'=>0
        ]);
    }

}