<?php

namespace Sudo\Post\Models;

use Sudo\Base\Models\BaseModel;

class PostCategoryMap extends BaseModel
{
	public function category(){
		return $this->belongsTo('Sudo\Post\Models\PostCategory', 'post_category_id', 'id');
	}
	public function post(){
		return $this->belongsTo('Sudo\Post\Models\Post', 'post_id', 'id');
	}
}
