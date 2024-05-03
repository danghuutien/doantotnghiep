<?php

namespace Sudo\Theme\Models;

class Ward extends BaseModel
{

    public function district() {
    	return $this->belongsTo('Sudo\Theme\Models\District', 'district_id', 'id');
    }

}