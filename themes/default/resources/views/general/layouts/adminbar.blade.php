@if(Auth::guard('admin')->check())
    <div class="adminbar">
    	<style type="text/css">.adminbar {width: 100%;float: left;clear: both;background: #252627;color: #fff;font-family: 'arial', 'Sans-serif';}.adminbar-wrap {padding: 0 10px;}.adminbar-wrap ul {list-style: none;}.adminbar-wrap ul li {font-size: 13px;line-height: 32px;float: left;margin-right: 20px;font-weight: bold;}.adminbar-wrap ul li a {display: block;color: #ffffff;text-decoration: none;}</style>
    	<div class="container wrap adminbar-wrap">
	    	<ul>
	    		<li><a href="{!!route('admin.home')!!}">@lang('Trang quản trị')</a></li>
	    		{{--truyền link edit nội dung vào biến view có tên $admin_bar--}}
	    		@if(isset($admin_bar) && $admin_bar != '')
	    			<li><a href="{!!$admin_bar!!}">&#9998; @lang('Sửa nội dung này')</a></li>
	            @endif
	    	</ul>
    	</div>
    </div>
    <div style="clear: both;"></div>
@endif