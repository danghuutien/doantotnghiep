<ul>
<li>
	<div class="avatar">
		<img src="/admin_assets/images/no-avatar.svg" alt="">
	</div>
	<div class="create-customer" id="create-customer">@lang('Tạo khách hàng mới')</div>
</li>
@foreach($customers as $value)
<li data-id="{!! $value->id !!}" data-name="{!! $value->name !!}" data-email="{!! $value->email !!}" data-phone="{!! $value->phone !!}" data-address="{!! $value->address !!}" class="user-item">
	<div class="avatar">
		<img src="/admin_assets/images/no-avatar.svg" alt="">
	</div>
	<div class="info">
		<p class="name">{!! $value->name !!}</p>
		<p class="email">{!! $value->email !!}</p>
	</div>
</li>
@endforeach
</ul>