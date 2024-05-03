@foreach($products as $k => $item)
	@include('Default::web.products.product_item', compact('item'))
@endforeach