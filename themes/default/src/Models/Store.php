<?php

namespace Sudo\Theme\Models;

class Store extends BaseModel
{
    CONST MB = 1;
    CONST MT = 2;
    CONST MN = 3;
    public static function getArea() {
        return [
            self::MB => 'Miền Bắc',
            self::MT => 'Miền Trung',
            self::MN => 'Miền Nam'
        ];
    }
    public function district() {
        return $this->belongsTo('Sudo\Theme\Models\District', 'district_id', 'id');
    }

    public function province() {
        return $this->belongsTo('Sudo\Theme\Models\Province', 'province_id', 'id');
    }

    public function ward() {
        return $this->belongsTo('Sudo\Theme\Models\Ward', 'ward_id', 'id');
    }

    public function getAddress() {
        $address = $this->address . ' - ' . ($this->ward->name ?? '') . ' - ' . ($this->ward->district->name ?? '') . ' - ' . ($this->province->name ?? '');
         return $address;
    }

    public function getUrl() {
        return route('app.stores.show', $this->slug);
    }

    public function getSlides() {
        if(!empty($this->slides)) {
            return explode(',', $this->slides);
        }
        return [];
    }

}
