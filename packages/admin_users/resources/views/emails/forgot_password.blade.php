@extends('AdminUser::emails.layouts')
@section('content')

<div class="container">
	<div class="chanhtuoi-email">
		<div class="css-content">
			<h3>@lang('Chào') {{$data['emails']}},</h3>
			<p>@lang('Bạn nhận được email này vì chúng tôi đã nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn.')</p>
			<div class="text-center">
				<a href="{{$data['links']}}" class="btn btn-primary">@lang('Đặt lại mật khẩu')</a>
			</div>
			<p>@lang('Nếu bạn không yêu cầu đặt lại mật khẩu, bạn không cần thực hiện thêm hành động nào nữa.')</p>
			<p>@lang('Nếu bạn có vấn đề khi Click vào nút "Đặt lại mật khẩu", hãy truy cập theo đường link sau:') <a href="{{$data['links']}}">{{$data['links']}}</a></p>
			<p>@lang('Trân trọng'),</p>
			<p><b>@lang('Sudo Team')</b></p>
		</div>
	</div>
</div>

@endsection