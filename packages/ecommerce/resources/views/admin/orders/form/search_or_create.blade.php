<style>
	#sugget-customer{
		width: 100%;
		float: left;
		position: relative;
		display: none;
		/* max-height: 255px; */
		/* overflow-y: scroll; */
	}
	#sugget-customer:before{
		position: absolute;
	    top: -7px;
	    left: 0;
	    right: 0;
	    margin: auto;
	    display: inline-block;
	    border-right: 7px solid transparent;
	    border-left: 7px solid transparent;
	    border-bottom: 7px solid rgba(175,166,166,.2);
	    content: "";
	    width: 3px;
	}
	#sugget-customer ul{
		width: calc(100% - 0px);
	    float: left;
	    list-style-type: none;
	    padding: 0;
	    border: 1px solid #ced4da;
	    margin: 0 0 10px 0;
	    border-radius: 4px;
	}
	#sugget-customer li{
		width: 100%;
	    float: left;
	    padding: 5px 10px;
	    border-bottom: 1px solid #ced4da;
	    cursor: pointer;
	}
	#sugget-customer li:last-child{
		border-bottom: none;
	}
	#sugget-customer .avatar{
		width: 35px;float: left;
	}
	#sugget-customer .avatar img{
		width: 100%;float: left;padding-top: 2px;
	}
	#sugget-customer .create-customer{
		width: calc(100% - 50px);float: right;line-height: 35px;
	}
	#sugget-customer .info{
		width: calc(100% - 50px);float: right;
	}
	#sugget-customer .info .name{
		color: #212529;
		margin: 0;
		font-size: 13px;
	}
	#sugget-customer .info .email{
		color: #0078bd;
		margin: 0;
		font-size: 13px;
	}
</style>
<div class="form-group row">
    <div class="col-lg-12 col-md-12" style="margin-bottom: 15px;">
        <input type="text" class="form-control" autocomplete="off" name="search_or_create" id="search_or_create" placeholder="Tìm kiếm hoặc tạo mới" value="">
    </div>
    <div id="sugget-customer">
    	<ul>
    		<li>
    			<div class="avatar">
    				<img src="/admin_assets/images/no-avatar.svg" alt="">
    			</div>
    			<div class="create-customer" id="create-customer">@lang('Tạo khách hàng mới')</div>
    		</li>
    	</ul>
    </div>
</div>
<script>
	$(document).ready(function(){
		var admin_dir = $('meta[name=admin_dir]').attr('content');
		$('input#name').parents('.mb-3 ').hide();
		$('input#phone').parents('.mb-3 ').hide();
		$('input#email').parents('.mb-3 ').hide();
		$('input#address').parents('.mb-3 ').hide();

		$('input#search_or_create').on('focus', function(){
			$('#sugget-customer').show();
		});
		$('input#search_or_create').on('keyup', function(){
			var key = $(this).val();
			data = {
				key : key,
			};
			setTimeout(function () {
				loadAjaxPost('/'+admin_dir+'/orders/ajax/sugget-customers', data, {
			        success:function(result){
			        	if(result.status == 1){
			        		$('#sugget-customer').empty().append(result.html);
			        	}
			        }
				});
			}, 1000);
		});
		$('body').on('click', '#sugget-customer .user-item', function(){
			var name = $(this).data('name');
			var phone = $(this).data('phone');
			var email = $(this).data('email');
			var address = $(this).data('address');
			var id = $(this).data('id');
			$('input#info_user_id').val(id);
			$('input#name').val(name);
			$('input#phone').val(phone);
			$('input#email').val(email);
			$('input#address').val(address);

			$('input#name').attr('disabled', 'disabled');
			$('input#phone').attr('disabled', 'disabled');
			$('input#email').attr('disabled', 'disabled');
			$('input#address').attr('disabled', 'disabled');

			$('input#name').parents('.mb-3').show();
			$('input#phone').parents('.mb-3').show();
			$('input#email').parents('.mb-3').show();
			$('input#address').parents('.mb-3').show();
			$('#sugget-customer').hide();
		});
		$('body').on('click', '#create-customer', function(){
			$('input#info_user_id').val(0);
			$('input#name').val('');
			$('input#phone').val('');
			$('input#email').val('');
			$('input#address').val('');

			$('input#name').removeAttr('disabled');
			$('input#phone').removeAttr('disabled');
			$('input#email').removeAttr('disabled');
			$('input#address').removeAttr('disabled');

			$('input#name').parents('.mb-3').show();
			$('input#phone').parents('.mb-3').show();
			$('input#email').parents('.mb-3').show();
			$('input#address').parents('.mb-3').show();
			$('#sugget-customer').hide();
		});
	});
</script>