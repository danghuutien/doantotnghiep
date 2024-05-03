<?php

namespace Sudo\Theme\Models;

class Post extends BaseModel
{

    public function getUrl() {
    	return route('app.posts.show', $this->slug);
    }
    
}