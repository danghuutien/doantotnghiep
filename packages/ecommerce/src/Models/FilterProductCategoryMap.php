<?php

namespace Sudo\Ecommerce\Models;

use Sudo\Base\Models\BaseModel;

class FilterProductCategoryMap extends BaseModel {
	
	protected $fillable = ['category_id', 'filter_id'];

	public function filter() {
    	return $this->belongsTo('Sudo\Ecommerce\Models\Filter', 'filter_id', 'id');
    }
}