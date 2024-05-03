<?php

namespace Sudo\Voucher\Models;

use Sudo\Base\Models\BaseModel;

class Voucher extends BaseModel
{
    protected $table = 'vouchers';

    CONST VOUCHER_ORDER = 1;
    CONST VOUCHER_PRODUCT = 2;

    protected $fillable = [
        'id',
        'name',
        'code',
        'option',
        'type',
        'value',
        'max_value',
        'min_order',
        'select',
        'limit',
        'used',
        'start_time',
        'end_time',
        'status',
        'created_at',
        'updated_at'
    ];

    public static function getOptions() {
        return [
            self::VOUCHER_ORDER => 'Áp dụng cho tất cả sản phẩm',
            self::VOUCHER_PRODUCT => 'Áp dụng cho một số sản phẩm',
        ];
    }
    public function getOption() {
        return self::getOptions()[$this->option] ?? '';
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
