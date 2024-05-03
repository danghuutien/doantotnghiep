<?php 
function getFilterCategoryMap($category_id) {
    $filter_product_category_maps = \Sudo\Ecommerce\Models\FilterProductCategoryMap::where('category_id', $category_id)->get();
    $coutinue = (count($filter_product_category_maps) == 0) ? true : false;
    while ($coutinue == true) {
        $category = \Sudo\Ecommerce\Models\ProductCategory::where('id', $category_id)->first();
        $filter_product_category_maps = \Sudo\Ecommerce\Models\FilterProductCategoryMap::where('category_id', $category->parent_id)->get();
        if (count($filter_product_category_maps) > 0 || $category->parent_id == 0) {
            $coutinue = false;
        }
        $category_id = $category->parent_id;
    }
    return $filter_product_category_maps;
}
/**
 * Lấy bộ lọc ứng với danh mục, nếu danh mục hiện tại không có thì sẽ lấy theo danh mục cha
 * @param number        $id: lấy ra id của nhóm bộ lọc
 */
function getIDFilterCategoryMap($category_id) {
    $filter_product_category_maps = \Sudo\Ecommerce\Models\FilterProductCategoryMap::where('category_id', $category_id)->get();
    $coutinue = (count($filter_product_category_maps) == 0) ? true : false;
    while ($coutinue == true) {
        $category = \Sudo\Ecommerce\Models\ProductCategory::where('id', $category_id)->first();
        $cat_id = $category->parent_id ?? 0;
        $filter_product_category_maps = \Sudo\Ecommerce\Models\FilterProductCategoryMap::where('category_id', $cat_id ?? 0)->get();
        if (count($filter_product_category_maps) > 0 || $cat_id == 0) {
            $coutinue = false;
        }
        $category_id = $cat_id ?? 0;
    }
    return $filter_product_category_maps->pluck('filter_id');
}
?>

