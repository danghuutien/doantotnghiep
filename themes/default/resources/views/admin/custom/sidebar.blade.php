<div class="settings-sidebar">
	<ul>
		<li @if($setting_name == 'overview') class="active" @endif><a href="{!! route('admin.settings.overview') !!}">@lang('Tổng quan')</a></li>
		<li @if($setting_name == 'email') class="active" @endif><a href="{!! route('admin.settings.email') !!}">@lang('Email')</a></li>
		<li @if($setting_name == 'code') class="active" @endif><a href="{!! route('admin.settings.code') !!}">@lang('Gắn mã chuyển đổi')</a></li>
	</ul>
</div>