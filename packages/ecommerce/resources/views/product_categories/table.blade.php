@php
	$prefix = '';
	for ($i=0; $i < $value->level; $i++) { 
		$prefix .= '|— ';
	}
@endphp
@include('Table::components.link', ['text' => $prefix.$value->name, 'url' => route('admin.product_categories.edit', $value->id), 'width'=>'auto'])
@include('Table::components.link', ['text' => 'Click here!', 'url' => route('web.rsscategory', $value->slug), 'width'=>'auto'])
