<?php

namespace Sudo\Ecommerce\Models;

use Sudo\Base\Models\BaseModel;

class OrderDetail extends BaseModel {

    public function order() {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
