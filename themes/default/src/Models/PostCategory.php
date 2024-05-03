<?php

namespace Sudo\Theme\Models;

class PostCategory extends BaseModel
{
	
    public function getUrl() {
    	return route('app.post_categories.index', $this->slug);
    }
    
}