@include('Table::components.image',['image' => $value->getImage()])
@include('Table::components.link',['text' => $value->name, 'url' => route('admin.products.edit', $value->id), 'width' => 'auto'])
<td style="width: 300px;">
	<a href="{{ route('admin.product_categories.edit', $value->category_id) }}" class="btn btn-xs btn-success float-left text-white mr-1 mb-1" target="_blank" style="padding: 2px 5px;margin-right: 2px;">{{ $value->category->name ?? '' }}</a>
</td>
