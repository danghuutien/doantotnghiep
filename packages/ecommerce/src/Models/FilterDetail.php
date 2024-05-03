<?php

namespace Sudo\Ecommerce\Models;

use Sudo\Base\Models\BaseModel;

class FilterDetail extends BaseModel {

    public function productFilter() {
    	return $this->hasMany('Sudo\Ecommerce\Models\ProductFilter', 'filter_detail_id', 'id');
    }	
    public function filter() {
    	return $this->belongsTo('Sudo\Ecommerce\Models\Filter', 'filter_id', 'id');
    }	
}