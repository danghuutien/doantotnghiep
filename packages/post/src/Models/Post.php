<?php

namespace Sudo\Post\Models;

use Sudo\Base\Models\BaseModel;

class Post extends BaseModel
{
	public function queryAdmin($show_data, $requests) {
		// Lọc theo danh mục
		if (isset($requests->category_id)) {
			$search_value = $requests->category_id;
			$show_data = $show_data->join('post_category_maps', 'post_category_maps.post_id', 'id')
									->where('post_category_maps.post_category_id', $search_value)
									->select('posts.*');
		}
        return $show_data;
    }
     public function adminUser() {
        return $this->belongsTo('Sudo\AdminUser\Models\AdminUser', 'admin_id', 'id');
    }
    public function getAdminUrl($device='app') {
        if(!$this->adminUser) return '';
        return route($device.'.author', $this->adminUser->slug);
    }
    public function getUrl()
    {
        // return route('app.posts.show', ['slug' => $this->slug]);
        return route('app.handle', $this->slug);
    }
    public function getAlt() { 
        return getAlt($this->image);
    }
    public function getImage($size = '',$name = '') {
    	$image_resize = getImage($this->image,$size, $name);
    	// dump($image_resize);
        return $image_resize;
    }
    public function postCategoryMap()
    {
        return $this->hasOne('Sudo\Post\Models\PostCategoryMap', 'post_id', 'id');
    }
    public function category(){
        $cate = PostCategory::query()
            ->join('post_category_maps', 'post_category_maps.post_category_id', 'post_categories.id')
            ->where('post_categories.status', 1)
            ->where('post_id', $this->id)->first();
        return $cate;
    }
    public function getCateParent(){
        $category = $this->category();
        $list_cate = $category->getParentCase();
        $parents = $list_cate[0];
        return $parents;
    }
    public function getRatings() {
        return \Sudo\Vote\Models\Vote::selectRaw("COUNT(id) as count, SUM(value) as sum, AVG(value) as avg")->where('type','posts')->where('type_id',$this->id)->first();
    }
}
