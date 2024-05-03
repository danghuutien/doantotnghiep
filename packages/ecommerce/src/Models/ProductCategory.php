<?php

namespace Sudo\Ecommerce\Models;

use Sudo\Base\Models\BaseModel;

class ProductCategory extends BaseModel
{
    public function parents() {
    	$table_name = self::getTable();
        return $this->hasMany(self::class, 'parent_id');
    }

    public function childrenParents() {
    	$table_name = self::getTable();
        return $this->hasMany(self::class, 'parent_id')
        			->with('childrenParents')
        			->join('language_metas', 'language_metas.lang_table_id', $table_name.'.id')
        			->where('lang_table', self::getTable());
    }

    public function childrenCates()
    {
        return $this->hasMany('Sudo\Ecommerce\Models\ProductCategory', 'parent_id', 'id');
    }

    public function allChildrenCates()
    {
        return $this->childrenCates()->with('allChildrenCates');
    }
    public function scopeChildless($q)
    {
       $q->has('childrenCates', '=', 0);
    }

    public function getAllChildId($cate, $child = [])
    {
        $categories = $cate->allChildrenCates->where('status', 1);
        if(count($categories)>0){
            $child = array_merge($child, $categories->pluck('id', 'id')->toArray());
            foreach ($categories as $key => $value) {
                $child = $this->getAllChildId($value, $child);
            }
            return $child;
        }else{
            return $child;
        }
    }
    public function getUrl(){
        // return route('app.product_categories.index',$this->slug);
        return route('app.handle', $this->slug);
    }

    public function product() {
        return $this->hasMany(Product::class, 'category_id', 'id')->where('status', 1);
    }
}
