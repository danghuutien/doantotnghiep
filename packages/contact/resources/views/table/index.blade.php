<td>
	<p>Họ Tên: <strong>{!! $value->name??'' !!}</strong></p>
	<p>Email: <strong>{!! $value->email??'' !!}</strong></p>
	<p>SĐT: <strong>{!! $value->phone??'' !!}</strong></p>
	<p>Tiêu đề thư: <strong>{!! $value->subject??'' !!}</strong></p>
</td>
<td>
	{!! $value->content??'' !!}
</td>