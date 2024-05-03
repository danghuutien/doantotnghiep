<?php

namespace Sudo\GoldenTime\Models;

use Sudo\Base\Models\BaseModel;

class GoldenTime extends BaseModel
{
    protected $table = 'golden_times';

    CONST VOUCHER_ORDER = 1;
    CONST VOUCHER_PRODUCT = 2;

    protected $fillable = [
        'id',
        'used',
        'start_time',
        'end_time',
        'gift',
        'status',
        'created_at',
        'updated_at'
    ];

    public function goldenTimeProduct() {
		return $this->hasMany(GoldenTimeProduct::class, 'golden_time_id', 'id')->where('quantity', '>', 0);
	}
    public function updateQuantity()
    {
        try{
            $this->increment('used');
            return ['status' => true, 'message' => 'Success!'];
        }catch (\Exception $e){
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    public function getSale() {
        if($this->type) {
            return $this->value.'%';
        }
        return formatPrice($this->value);
    }
}
