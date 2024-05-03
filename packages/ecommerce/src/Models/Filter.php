<?php

namespace Sudo\Ecommerce\Models;

use Sudo\Base\Models\BaseModel;

class Filter extends BaseModel {
	
	protected $fillable = ['name'];

	public function filterDetail() {
    	return $this->hasMany('Sudo\Ecommerce\Models\FilterDetail', 'filter_id', 'id');
    }
}