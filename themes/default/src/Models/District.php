<?php

namespace Sudo\Theme\Models;

class District extends BaseModel
{

    public function province() {
    	return $this->belongsTo('Sudo\Theme\Models\Province', 'province_id', 'id');
    }

    public function ward() {
    	return $this->hasMany('Sudo\Theme\Models\Ward', 'district_id', 'id');
    }

}