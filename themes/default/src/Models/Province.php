<?php

namespace Sudo\Theme\Models;

class Province extends BaseModel
{

    public function district() {
    	return $this->hasMany('Sudo\Theme\Models\District', 'province_id', 'id');
    }

}