@extends('Default::web.layouts.app')

@section('content')
	 @include('Default::web.layouts.breadcrumb')
 	<div class="sale">
	 	<div class="container">
	 		<div class="sale-content mt-40 w-100">
	 			<h1 class="sale_content_title w-100">{{ __('Thanh toán trả góp') }}</h1>
                @if(isset($errors) && !empty($errors->first()))
                    <div class="alert_none">
                        <p class="flex">{{$errors->first()??''}}</p>
                    </div>
                @endif
	 			@include('Default::web.sale.installment.table', ['order_details'=>$order->orderDetail])
	 			<form action="{{ route('app.sale.installmentPost', $order->code) }}" method="post" accept-charset="utf-8" id="form-installment">
					@csrf
					<input type="hidden" id="signature-onepay" value="{{$signature ?? ''}}">
				 	<input type="hidden" name="installment_bank" value="">
	            	<input type="hidden" name="installment_card_type" value="">
					<input type="hidden" name="installment_cycle" value="">
					<input type="hidden" name="installment_type" value="{!! $type??'' !!}">
					<input type="hidden" name="amount" value="{!! $order->total_price ?? 0 !!}">
		 			<div class="installment">
		 				<div class="installment-step mb-30">
		 					<div class="installment-step__title mb-10">
		 						<p class="fs-18 font-bold">{{ __('Thông tin người mua') }}</p>
		 					</div>
		 					<div class="installment-step__infor">
                                <div class="input-field flex-center-left">
                                    <label for="">Họ tên</label>
                                    <p>{{ $order->customer->name ?? '' }}</p>
                                </div>
                                <div class="input-field flex-center-left">
                                    <label for="">Số điện thoại</label>
                                    <p>{{ $order->customer->phone ?? '' }}</p>
                                </div>
		 						<div class="input-field flex-center-left">
		 							<label for="">{{ __('Địa chỉ') }}</label>
		 							<p  disabled>{{ $order->customer->getAddress() }}</p>
		 						</div>
		 						<div class="input-field flex-center-left">
		 							<label for="">{{ __('Ghi chú') }}</label>
		 							<p disabled>{{ $order->note ?? '' }}</p>
		 						</div>
		 					</div>
		 				</div>
		 				<div class="installment-step mb-30">
		 					<div class="installment-step__title">
		 						<p class="fs-18 font-bold">{{ __('Bước 1: Chọn ngân hàng trả góp') }}</p>
		 					</div>
		 					<div class="installment-step__content">
		 						<div class="installment-bank" id="installment-bank__list-onepay"></div>
		 					</div>
		 				</div>
		 				<div class="installment-step">
		 					<div class="installment-step__title">
		 						<p class="fs-18 font-bold">{{ __('Bước 2: Chọn loại thẻ') }}</p>
		 					</div>
		 					<div class="installment-step__content">
		 						<div class="installment-bank" id="installment_card_type-onepay">
			 						<div class="installment-bank__item installment-bank__visa" data-code="VC">
										<img src="/assets/img_bank/visa.png" alt="">
									</div>
									<div class="installment-bank__item installment-bank__mastercard" data-code="MC">
										<img src="/assets/img_bank/mastercard.png" alt="">
									</div>
									<div class="installment-bank__item installment-bank__jcb" data-code="JC">
										<img src="/assets/img_bank/jcb.png" alt="">
									</div>
									<div class="installment-bank__item installment-bank__ae" data-code="AE">
										<img src="/assets/img_bank/AE.png" alt="">
									</div>
									<div class="installment-bank__item installment-bank__cup" data-code="CUP">
										<img src="/assets/img_bank/CUP.png" alt="">
									</div>
								</div>
								<div class="installment-result"></div>
		 					</div>
		 				</div>
		 				<div class="action flex-center mb-20">
                            <button class="action_button blue" type="submit">
                                <p class="action_button_name text-up">THANH TOÁN TRẢ GÓP</p>
                                <p class="action_button_txt">Công ty Tài chính Hoặc qua thẻ tín dụng</p>
                            </button>
                        </div>
		 			</div>
				</form>
	 		</div>
	 	</div>
 	</div>
@endsection
@section('foot')
	<script defer src='/assets/js/crypto-js.min.js'></script>
	<script defer src='/assets/js/http-signature.js'></script>
	<script defer>
		function loadBankOnepay(){
        	var amount = {{ $order->total_price }};
        	$.ajax({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        },
		        type: 'post',
		        url: '/ajax/loadBankOnePay',
		        data:{
		        	amount: amount
		        },		        
		        success:function(data){
		        	if(data != ''){
		        		$('#installment-bank__list-onepay').html(data)
		        	}
		        }
		    });
        }
        document.addEventListener("DOMContentLoaded", function(event) {
            $(document).ready(function() {
                loadBankOnepay()
                $('body').on('click','#installment-bank__list-onepay .installment-bank__item', function(){
                    $('#installment-bank__list-onepay .installment-bank__item').removeClass('active');
                    $('#installment-bank__list .installment-bank__item').removeClass('active');
                    $('#installment_card_type .installment-bank__item').removeClass('active');
                    $('#installment_card_type-onepay .installment-bank__item').removeClass('active');
                    $(this).addClass('active');
                    $('.installment-result').hide();

                    var data_code = $(this).data('id');
                    var card_type = $(this).attr('data-card-type');
                    var cycle = $(this).attr('data-cycle');

                    $('input[name=installment_bank]').val(data_code);
                    $('input[name=installment_cycle]').val(cycle);

                    if(card_type.indexOf('VC') !== -1){
                        $('.installment-bank__visa').show();
                    }else{
                        $('.installment-bank__visa').hide();
                    }

                    if(card_type.indexOf('MC') !== -1){
                        $('.installment-bank__mastercard').show();
                    }else{
                        $('.installment-bank__mastercard').hide();
                    }

                    if(card_type.indexOf('JC') !== -1){
                        $('.installment-bank__jcb').show();
                    }else{
                        $('.installment-bank__jcb').hide();
                    }
                    if(card_type.indexOf('AE') !== -1){
                        $('.installment-bank__ae').show();
                    }else{
                        $('.installment-bank__ae').hide();
                    }
                    if(card_type.indexOf('CUP') !== -1){
                        $('.installment-bank__cup').show();
                    }else{
                        $('.installment-bank__cup').hide();
                    }
                });
                $('body').on('click', '#installment_card_type-onepay .installment-bank__item', function(){
                    $('.installment-result').empty();
                    $('#installment_card_type-onepay .installment-bank__item').removeClass('active');
                    $(this).addClass('active');
                    var card_type = $(this).data('code');
                    var bank_code = $('input[name=installment_bank]').val();
                    var cycle = $('input[name=installment_cycle]').val();
                    var amount = {{ $order->total_price }};
                    $('input[name=installment_card_type]').val(card_type);
                    if(bank_code == ''){
                        alert_show('error',$('#loading_box').data('selectbank'));
                        return false;
                    }
                    var data = {
                        card_type:card_type,
                        bank_code:bank_code,
                        cycle:cycle,
                        amount:amount,
                    };
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'post',
                        url: '/ajax/get-installment-onepay',
                        data: data,
                        beforeSend: function(){
                            loadingBox('open');
                        },
                        success:function(result){
                            loadingBox('close');
                            if(result.status == 1){
                                $('.installment .installment-result').empty();
                                $('.installment .installment-result').html(result.html);
                                $('.installment .installment-result').show();
                            }
                        },
                        error: function (error) {
                            loadingBox('close');
                            alert_show('error',$('#loading_box').data('error'));
                        }
                    });
                });
                $('#btn_installment').on('click', function(){
            var name = $('input[name=customer_name]').val();
            var phone = $('input[name=customer_phone]').val();
            var email = $('input[name=customer_email]').val();
            var type = $('input[name=installment_type]').val();
            var cycle = $('body').find('.installment-result input[name=choose_cycle]:checked').val();
            var signature = $('#signature-onepay').val();
            var checkbox_onepay = $('body').find('input[name="checkbox_onepay"]').is(":checked");
            var method = $('.installment-choose__item.active').data('installment');

            if(cycle == undefined){
                alert_show('error',$('#loading_box').data('cycle'));
            }else if(name == ''){
                alert_show('error',$('#loading_box').data('name'));
            }else if(phone == ''){
                alert_show('error',$('#loading_box').data('phone'));
            }else if(email == ''){
                alert_show('error',$('#loading_box').data('email'));
            }else if(!isPhone(phone)){
                alert_show('error',$('#loading_box').data('phonewrog'));
            }else if(!isEmail(email)){
                alert_show('error',$('#loading_box').data('mailwrog'));
                return false;
            }else{
                loadingBox('open');
                var signature = $('#signature-onepay').val();
                var input = "<input name='signature' type='hidden' value='"+signature+"'>";
                $("#form-installment").append(input);
                $('#form-installment').submit();
            }
        });
            });
        });
	</script>
@endsection
