<div class="form-actions-inline">
	<div class="form-actions__group float-left">
		<button type="button" class="btn btn-sm btn-primary" id="test_mail_btn">@lang('Kiểm tra cấu hình mail')</button>
	</div>
</div>
<div id="test_mail_notificate">Đang kiểm tra. Vui lòng chờ giây lát!</div>
<script>
	$(document).ready(function() {
		$('body').on('click', '#test_mail_btn', function() {
			email = $('#test_mail').val();
			if (email == '') {
				alertText('@lang('Email nhận thư của bạn không được để trống')', 'warning');
			} else {
				data = $(this).closest('form').serialize()+'&email='+email;
				loadAjaxPost('{{route('admin.settings.test_mail')}}', data, {
					beforeSend: function(){
				        $('#test_mail_notificate').html('@lang('Đang kiểm tra. Vui lòng chờ giây lát!')');
				        $('#test_mail_notificate').show();
				    },
				    success:function(result){
				        $('#test_mail_notificate').html(result.message);
				    },
				    error: function (error) {
				        $('#test_mail_notificate').html('@lang('Có lỗi xảy ra! Lỗi:') <br>'+error.responseJSON.message);
				    }
				});
			}
		});
	});
</script>