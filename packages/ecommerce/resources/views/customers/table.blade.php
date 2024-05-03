@include('Table::components.link',['text' => $value->name, 'url' => route('admin.customers.edit', $value->id), 'width'=>'auto'])
<td class="center" style="width: 300px">
	{!! $value->phone !!}
</td>
<td style="width: 300px;">
	{!! $value->address !!}
</td>