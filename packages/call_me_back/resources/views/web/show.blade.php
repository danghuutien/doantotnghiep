<link rel="stylesheet" type="text/css" href="/platforms/call_me_back/css/style.css">

<div class="call_me_back">
  	<input type="text" name="phone" id="phone" class="phone" placeholder="@lang('Nhập số điện thoại của bạn...')" required><br>
  	<input type="hidden" name="name" class="name" value="{{ $name }}">
  	<input type="hidden" name="url" class="url" value="{{ $url }}">
  	<button class="submit_call" aria-hidden="true">@lang('Gọi lại cho tôi')</button>
</div>
<div id="toast-container" class="toast-top-right" style="display: none;">
    <div class="toast" aria-live="assertive" style="">
        <div class="toast-message"></div>
    </div>
</div>
<script type="text/javascript">
	function alert_show(type='success',message='') {
	    $('#toast-container .toast').addClass('toast-'+type);
	    $('#toast-container .toast div').text(message);
	    $('#toast-container').css('display','block');
	    setTimeout(function() {
	        $('#toast-container').css('display','none');
	        $('#toast-container .toast').removeClass('toast-'+type);
	        $('#toast-container .toast div').text('');
	    }, 5000);
	}
	$(document).ready(function(){
		$('body').on('click','.submit_call',function(){
			var phone =$('.phone').val();
			var name =$('.name').val();
			var url =$('.url').val();
			var vnf_regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
		    if(phone !==''){
		        if (vnf_regex.test(phone) == false) 
		        {
		        	alert_show(type = 'error', '{{__("Số điện thoại của bạn không đúng định dạng!") }}');
					$('.phone').val('');
		        }else{
		            $.ajax({
						headers:{
						'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
						dataType:'json',type:'POST',
						data:{
							phone:phone,
							name:name,
							url:url
						},
						url: '/ajax/phone',
			            method: "POST",
						success:function(data){
							alert_show(type='success', '{{ __("Thành công! Chúng tôi sẽ gọi lại cho bạn!")}}');
						},
						error:function(){
							alert_show(type='error','{{__("Có lỗi xảy ra!") }}');
						}
					})
					$('.phone').val('');
		        }
		    }else{
		        alert_show(type = 'error', '{{__("Bạn chưa điền số điện thoại!") }}');
		    }
		})
	});
</script>