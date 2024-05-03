<?php
/*
 * Lấy tất cả mã giảm giá của sp hiện tại
 * @param store_product_id      $store_product_id: Id store_products
 * @param product_id        $product_id: ID sản phẩm
 * @param category_id        $category_id: id danh mục sp
 */
function getVoucher($store_product_id=0, $product_id=0, $category_id=0) {
	$voucher_for_all = DB::table('vouchers')->where('select', 0)
			->whereColumn('used','<','limit')
			->where('end_time', '>=', date('y-m-d H:i:s'))
			->where('vouchers.status', 1)->get();
	$voucher_for_store = DB::table('vouchers')
		->join('voucher_selects', 'voucher_selects.voucher_id', 'vouchers.id')
		->where('select', 2)
		->where('type_id',$store_product_id)
		->whereColumn('used','<','limit')
		->where('end_time', '>=', date('y-m-d H:i:s'))
		->where('vouchers.status', 1)->get();
	$voucher_cates = DB::table('vouchers')
		->join('voucher_selects', 'voucher_selects.voucher_id', 'vouchers.id')
		->where('select', 1)
		->where('type_id',$category_id)
		->whereColumn('used','<','limit')
		->where('end_time', '>=', date('y-m-d H:i:s'))
		->where('vouchers.status', 1)->get();
	$voucher_of_eshop = DB::table('vouchers')
		->join('voucher_selects', 'voucher_selects.voucher_id', 'vouchers.id')
		->join('store_products', 'store_products.id', 'voucher_selects.type_id')
		->where('store_products.store_id', 1)
		->where('store_products.product_id', $product_id)
		->where('voucher_selects.type_id', '<>', $store_product_id)
		->where('vouchers.select', 2)
		->whereColumn('vouchers.used','<','vouchers.limit')
		->where('vouchers.end_time', '>=', date('y-m-d H:i:s'))
		->where('vouchers.status', 1)->get();
	$vouchers = $voucher_for_all->merge($voucher_for_store)->merge($voucher_cates);
	return $vouchers;
}