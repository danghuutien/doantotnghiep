<?php

namespace Sudo\Ecommerce\Models;
use Sudo\GoldenTime\Models\GoldenTime;
use Sudo\Base\Models\BaseModel;

class Product extends BaseModel
{
	public function queryAdmin($show_data, $requests) {
        return $show_data;
    }

    public function getAlt() {
        return getAlt($this->image);
    }
    public function getImage($size = '',$name = '') {
        return getImage($this->image,$size, $name);
    }
    public function getUrl() {
    	// return route('app.products.show', $this->slug);
        return route('app.handle', $this->slug);
    }

    public function updateQuantity($qty) {
        $itemUpdate = self::where('id', $this->id)->first();
        $itemUpdate->quantity_used += intval($qty);
        $itemUpdate->save();
        return true;
    }

    public function category(){
    	return $this->belongsTo('\Sudo\Ecommerce\Models\ProductCategory', 'category_id', 'id');
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

    public function checkStockOrder($qty) {
        $product = self::where('id', $this->id)->first();
        $quantity = $product->quantity ?? 0;
        $quantityUsed = $product->quantity_used ?? 0;
        $sub = $quantity - $quantityUsed;
        if($sub > 0 && $sub >= $qty) {
            return true;
        }
        return false;
    }

    public function getPrice() {
        return $this->price;
    }

    public function checkInstallment() {
        $product = self::where('id', $this->id)->first();
        if($product->compare) {
            return true;
        }
        return false;
    }

    public function productFilter(){
        return $this->hasMany(\Sudo\Filter\Models\ProductFilterMap::class);
    }
    public function getMaxProductHas() {
        $quantityHas = (($this->quantity ?? 0) - ($this->quantity_used ?? 0));
        return $quantityHas;
    }
    
    public function getComboProducts() {
        $product = self::where('id', $this->id)->first();
        $combos =  json_decode($product->combo ?? '',1);
        $id_product = collect($combos)->pluck('product_id');
        $products = self::whereIn('id', $id_product)->orderBy('id', 'desc')->get();
        if(count($products)>0){
            foreach($combos as $key=>$combo){
                foreach($products as $product){
                    if($product->id == $combo['product_id']){
                        $product['price_sale'] = $combo['price'];
                    }
                }
            }
        }
        return $products;
    }

    public function checktype(){
        $date = date('Y-m-d H:i:s');
        $golden_time = GoldenTime::where('start_time', '<=', $date)->Where('end_time', '>=', $date)->where('status', 1)->orderBy('id', 'desc')->first();
        if(!empty($goldenTimeProduct)){
            $goldenTimeProduct = $golden_time->goldenTimeProduct;
            if(!empty($goldenTimeProduct)){
                $product = $goldenTimeProduct->where('product_id', $this->id)->first();
                if(!empty($product)){
                    if( $product->getStok()){
                        return 2;
                    }
                }
            }
        }
        return 1;
    }
}
