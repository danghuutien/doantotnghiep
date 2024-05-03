<?php

namespace Sudo\Ecommerce\Models;

use Sudo\Base\Models\BaseModel;

class Customer extends BaseModel {

    public function order() {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function province() {
        return $this->belongsTo(\Sudo\Theme\Models\Province::class, 'province_id', 'id');
    }
    public function district() {
        return $this->belongsTo(\Sudo\Theme\Models\District::class, 'district_id', 'id');
    }
    public function ward() {
        return $this->belongsTo(\Sudo\Theme\Models\Ward::class, 'ward_id', 'id');
    }

    public function getGender() {
        if($this->gender == 1) {
            return 'Anh';
        }
        return 'Chị';
    }

    public function getAddress() {
        $address = $this->address . ' - ' . ($this->ward->name ?? '') . ' - ' . ($this->ward->district->name ?? '') . ' - ' . ($this->province->name ?? '');
         return $address;
    }
}
