<?php

namespace Sudo\GoldenTime\Models;
use Sudo\Ecommerce\Models\Product;
use Sudo\Base\Models\BaseModel;

class GoldenTimeProduct extends BaseModel {
	
	protected $table = 'golden_time_products';
	protected $guarded = ['id'];

	public function goldenTime() {
		return $this->belongsTo(GoldenTime::class, 'golden_time_id', 'id');
	}

	public function product() {
		return $this->belongsTo(Product::class, 'product_id', 'id');
	}

    public function getPrice() {
        return $this->price;
    }

    public function getInitPrice() {
        $price = $this->product->price_old ?? 0;
        return $price;
    }

    public function getDiscount() {
        $initPrice = $this->getInitPrice();
        if(!$initPrice || ($initPrice <= $this->price)) return 0;
        $sub = $initPrice - $this->price;
        $discount = round(($sub / $initPrice), 2) * 100;
        return $discount;
    }

    public function getName() {
        $name = $this->product->name ?? '';
        return $name;
    }

    public function getThumnail() {
        $image = $this->product->image ?? '';
        return $image;
    }

    public function getStok() {
        $quantity = $this->quantity ?? 0;
        $quantityUsed = $this->quantity_used ?? 0;
        $sub = $quantity - $quantityUsed;
        if($sub > 0) {
            return true;
        }
        return false;
    }

    public function getUrl($device='app') {
        return $this->product->getUrl($device);
    }
    public function getStatusQuo() {
        $status_quo = $this->product->status_quo ?? '';
        return $status_quo;
    }
    public function checkStockOrder($qty) {
        $product = $this->where('id', $this->id)->first();
        $quantity = $product->quantity ?? 0;
        $quantityUsed = $product->quantity_used ?? 0;
        $sub = $quantity - $quantityUsed;
        if($sub > 0 && $sub >= $qty) {
            return true;
        }
        return false;
    }

    public function getMaxProductHas() {
        $quantityHas = (($this->quantity ?? 0) - ($this->quantity_used ?? 0));
        return $quantityHas;
    }

    public function canByFlashSale() {
        $flashSale = $this->flashSale;
        if($flashSale->status != 1) {
            return false;
        }
        $endTime = date('Y-m-d H:i:s', strtotime($flashSale->end_time));
        if($endTime > date('Y-m-d H:i:s') && $this->getStockNumber()) {
            return true;
        }
        return false;
    }

    public function updateQuantity($qty) {
        $itemUpdate = self::where('id', $this->id)->first();
        $itemUpdate->quantity_used += intval($qty);
        $itemUpdate->save();
        return true;
    }
}
