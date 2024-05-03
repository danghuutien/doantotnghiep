<?php

namespace Sudo\Theme\Models;

class ProductCategory extends BaseModel
{
	
    public function getUrl() {
    	return route('app.product_categories.index', $this->slug);
    }
}