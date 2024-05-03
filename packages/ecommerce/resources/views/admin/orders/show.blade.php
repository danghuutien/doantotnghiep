@extends('Core::layouts.app')

@section('title') @lang('Chi tiết đơn hàng')  @endsection
@section('content')
<div class="row">
	<div class="col-lg-6 col-md-12">
		{{-- Đơn hàng --}}
		<div class="card">
			<div class="card-body p-3">
				<h4 class="card-title">@lang('Thông tin đơn hàng')</h4>
				<table class="table table-bordered">
					<tbody>
						<tr>
							<th class="p-2" style="width: 200px;">@lang('Loại đơn hàng')</th>
							<td class="p-2">{{ $order->type == 2 ? 'Để lại số điện thoại tư vấn' : 'Thao tác đặt hàng' }}</td>
						</tr>
						<tr>
							<th class="p-2" style="width: 200px;">@lang('Mã đơn hàng')</th>
							<td class="p-2">{{$order->code??''}}</td>
						</tr>
						<tr>
							<th class="p-2" style="width: 200px;">@lang('Giá trị đơn')</th>
							<td class="p-2">{{$order->getTotalPrice()}}</td>
						</tr>
						@if($order->type = 2)
							<tr>
								<th class="p-2" style="width: 200px;">@lang('Số điện thoại')</th>
								<td class="p-2">@lang($order->phone_number ?? '')</td>
							</tr>
						@else
							<tr>
								<th class="p-2" style="width: 200px;">@lang('Hình thức thanh toán')</th>
								<td class="p-2">@lang($payment_method[$order->payment_method] ?? '')</td>
							</tr>
	                        @if(!empty($order->shipping_method))
	                        <tr>
	                            <th class="p-2" style="width: 200px;">@lang('Hình thức giao hàng')</th>
	                            <td class="p-2">@lang($shipping_methods[$order->shipping_method] ?? '')</td>
	                        </tr>
	                        @endif
	                        @if(!empty($order->voucher_value) && !empty($order->voucher_code))
	                        <tr>
	                            <th class="p-2" style="width: 200px;">@lang('Giảm giá')</th>
	                            <td class="p-2">{{ formatPrice($order->voucher_value) }}</td>
	                        </tr>
	                        @endif
	                        <tr>
							<th class="p-2" style="width: 200px;">@lang('Trạng thái thanh toán')</th>
							<td class="p-2">{!! __($payment_status[$order->payment_status]??'') !!}
								@if($order->payment_status == 0)
	                                <a style="margin-left: 10px;" href="{{ route('admin.orders.confirmPayment', $order->id) }}" class="btn btn-sm btn-info">
	                                    @lang('Translate::form.action.comfirm_payment')
	                                </a>
	                            @endif
	                            @if($order->payment_status == 1)
	                                <a style="margin-left: 10px;" href="javascript:;" class="btn btn-sm btn-secondary" id="show-form-refund">
	                                    @lang('Translate::form.action.refund')
	                                </a>
	                                <form id="form-refund" action="{{ route('admin.orders.refund', $order->id) }}" method="get" accept-charset="utf-8">
	                                    <div class="form-refund">
	                                        <input type="number" name="refund_money" placeholder="{!! __('Số tiền hoàn trả') !!}" value="{!! $order->total_price??0 !!}">
	                                        <textarea name="refund_reason" placeholder="{!! __('Lý do hoàn tiền') !!}"></textarea>
	                                        <button type="submit">{!! __('Gửi yêu cầu hoàn tiền') !!}</button>
	                                    </div>
	                                </form>
	                            @endif
                            </td>
						</tr>
						@endif
						
					</tbody>
				</table>
			</div>
		</div>
		{{-- Khách --}}
		@if (isset($customers) && !empty($customers))
			<div class="card">
				<div class="card-body p-3">
					<h4 class="card-title">@lang('Thông tin khách hàng')</h4>
					<table class="table table-bordered">
						<tbody>
							<tr>
								<th class="p-2" style="width: 200px;">@lang('Họ và tên')</th>
								<td class="p-2">{{ $customers->getGender() }} {{!empty($customers->name) ? $customers->name : __('Không cung cấp')}}</td>
							</tr>
							<tr>
								<th class="p-2" style="width: 200px;">@lang('Điện thoại')</th>
								<td class="p-2">{{!empty($customers->phone) ? $customers->phone : __('Không cung cấp')}}</td>
							</tr>
							<tr>
								<th class="p-2" style="width: 200px;">@lang('Địa chỉ')</th>
								<td class="p-2">{{ $customers->getAddress() }}</td>
							</tr>
							<tr>
								<th class="p-2" style="width: 200px;">@lang('Ghi chú tại đơn')</th>
								<td class="p-2">{{$order->note ?? __('Không')}}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		@endif
	</div>
	<div class="col-lg-6 col-md-12">
		<div class="col-lg-12 p-0">
			<div class="card">
				<div class="card-body p-3">
					<h4 class="card-title">@lang('Thêm ghi chú')</h4>
					<form action="{{ route('admin.orders.admin_note', $order->id) }}" method="POST">
						@csrf
						<div class="form-group">
							<textarea name="admin_note" id="admin_note" rows="3" class="form-control" placeholder="@lang('Thêm ghi chú')"></textarea>
						</div>
						<div class="form-group mb-0">
							<button class="btn btn-info btn-sm" type="submit">@lang('Thêm ghi chú')</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-lg-12 p-0">
			<div class="card">
				<div class="card-body p-3">
					<h4 class="card-title">@lang('Lịch sử đơn hàng')</h4>
					<div class="timeline">
						 @php
				            $date_array = [];
				            foreach ($order_histories as $value){
				                $time = date("d-m-Y",strtotime($value->time));
				                if (!in_array($time, $date_array)) {
				                    array_push($date_array, $time);
				                }
				            }
				        @endphp
				        @foreach ($date_array as $date)
							<div class="time-label">
								<span class="bg-red">{{ $date ?? '' }}</span>
							</div>
							@foreach ($order_histories as $value)
								@php
				                    $time = date("d-m-Y",strtotime($value->time));
				                @endphp
				                @if ($date == $time)
									@switch($value->type)

									    @case('admin_create')
									        <div>
												<i class="fas fa-shopping-cart bg-primary"></i>
												<div class="timeline-item">
													<span class="time"><i class="fas fa-clock"></i> {{formatTime($value->time, 'H:i:s')}}</span>
													<h3 class="timeline-header">
														<a href="{{ route('admin.admin_users.edit', $value->admin_user_id) }}" target="_blank">{{$admin_users[$value->admin_user_id] ?? ''}}</a> 
														@lang('đã tạo đơn hàng')
													</h3>
												</div>
											</div>
								        @break

								        @case('customer_create')
											<div>
												<i class="fas fa-shopping-cart bg-primary"></i>
												<div class="timeline-item">
													<span class="time"><i class="fas fa-clock"></i> {{formatTime($value->time, 'H:i:s')}}</span>
													<h3 class="timeline-header">
														<a href="javascript:;">@lang('Khách hàng')</a> 
														@lang('đã tạo đơn hàng')
													</h3>
												</div>
											</div>
								        @break

								        @case('order_fail') 
											<div>
												<i class="fas fa-ban bg-danger"></i>
												<div class="timeline-item">
													<span class="time"><i class="fas fa-clock"></i> {{formatTime($value->time, 'H:i:s')}}</span>
													<h3 class="timeline-header">
														<a href="{{ route('admin.admin_users.edit', $value->admin_user_id) }}" target="_blank">{{$admin_users[$value->admin_user_id] ?? ''}}</a> 
														@lang('đã cập nhật trạng thái đơn hàng') 
														<span class="badge badge-danger">@lang('Huỷ')</span>
													</h3>
												</div>
											</div>
								        @break

								        @case('order_success') 
											<div>
												<i class="fas fa-check-circle bg-success"></i>
												<div class="timeline-item">
													<span class="time"><i class="fas fa-clock"></i> {{formatTime($value->time, 'H:i:s')}}</span>
													<h3 class="timeline-header">
														<a href="{{ route('admin.admin_users.edit', $value->admin_user_id) }}" target="_blank">{{$admin_users[$value->admin_user_id] ?? ''}}</a> 
														@lang('đã cập nhật trạng thái đơn hàng') 
														<span class="badge badge-success">@lang('Thành công')</span>
													</h3>
												</div>
											</div>
								        @break

								        @case('received') 
											<div>
												<i class="fas fa-user bg-primary"></i>
												<div class="timeline-item">
													<span class="time"><i class="fas fa-clock"></i> {{formatTime($value->time, 'H:i:s')}}</span>
													<h3 class="timeline-header">
														<a href="{{ route('admin.admin_users.edit', $value->admin_user_id) }}" target="_blank">{{$admin_users[$value->admin_user_id] ?? ''}}</a> 
														@lang('đã cập nhật trạng thái đơn hàng') 
														<span class="badge badge-primary">@lang('Đã tiếp nhận')</span>
													</h3>
												</div>
											</div>
								        @break

								        @case('admin_note')
								        	@php
								        		$note = json_decode(base64_decode($value->data ?? ''));
								        	@endphp
											<div>
												<i class="fas fa-pencil-alt bg-warning "></i>
												<div class="timeline-item">
													<span class="time"><i class="fas fa-clock"></i> {{formatTime($value->time, 'H:i:s')}}</span>
													<h3 class="timeline-header">
														<a href="{{ route('admin.admin_users.edit', $value->admin_user_id) }}" target="_blank">{{$admin_users[$value->admin_user_id] ?? ''}}</a> 
														@lang('đã thêm ghi chú') 
													</h3>
													<div class="timeline-body" style="white-space: pre;">{{ $note ?? '' }}</div>
												</div>
											</div>
								        @break

								        @case('order_change')
											<div>
												<i class="fas fa-edit bg-info"></i>
												<div class="timeline-item">
													<span class="time"><i class="fas fa-clock"></i> {{formatTime($value->time, 'H:i:s')}}</span>
													<h3 class="timeline-header">
														<a href="{{ route('admin.admin_users.edit', $value->admin_user_id) }}" target="_blank">{{$admin_users[$value->admin_user_id] ?? ''}}</a> 
														@lang('đã chỉnh sửa chi tiết đơn hàng') 
													</h3>
                                                    <div class="timeline-footer">
                                                        <a class="btn btn-info btn-sm" data-bs-toggle="modal" href="#order_history"
                                                           data-order_history="{{ route('admin.orders.embed_history', $value->id) }}">@lang('Click xem chi tiết')</a>
                                                    </div>
												</div>
											</div>
								        @break
								        @case('comfirm_payment')
                                            <div>
                                                <i class="fas fa-user bg-info"></i>
                                                <div class="timeline-item">
                                                    <span class="time"><i class="fas fa-clock"></i> {{formatTime($value->time, 'H:i:s')}}</span>
                                                    <h3 class="timeline-header">
                                                        <a href="{{ route('admin.admin_users.edit', $value->admin_user_id) }}"
                                                           target="_blank">{{$admin_users[$value->admin_user_id] ?? ''}}</a>
                                                        @lang('đã cập nhật trạng thái thanh toán')
                                                        <span class="badge badge-info">@lang('Đã thanh toán')</span>
                                                    </h3>
                                                </div>
                                            </div>
                                        @break

                                        @case('refund')
                                            <div>
                                                <i class="fas fa-user bg-secondary"></i>
                                                <div class="timeline-item">
                                                    <span class="time"><i class="fas fa-clock"></i> {{formatTime($value->time, 'H:i:s')}}</span>
                                                    <h3 class="timeline-header">
                                                        <a href="{{ route('admin.admin_users.edit', $value->admin_user_id) }}"
                                                           target="_blank">{{$admin_users[$value->admin_user_id] ?? ''}}</a>
                                                        @lang('đã cập nhật trạng thái thanh toán')
                                                        <span class="badge badge-secondary">@lang('Hoàn tiền')</span>
                                                        <a>{!! $order->refund_money??'' !!}</a>
                                                    </h3>
                                                    <p style="padding: 10px;">{!! __('Lý do hoàn tiền') !!}: {!! $order->refund_reason??'' !!}</p>
                                                </div>
                                            </div>
                                        @break
									@endswitch
				                @endif
							@endforeach
				        @endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
{{-- Sản phẩm --}}
		@if (isset($order_details) && !empty($order_details))
			@php $total_price = 0; @endphp
			@if (isset($order_details) && count($order_details) > 0)
				<div class="card">
					<div class="card-body p-3">
						<h4 class="card-title">@lang('Thông tin sản phẩm')</h4>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th class="text-center p-2" style="width: 60px;">@lang('Ảnh')</th>
									<th class="text-center p-2">@lang('Tên sản phẩm')</th>
									<th class="text-center p-2">@lang('Kiểu mua')</th>
									<th class="text-center p-2">@lang('Quà tặng đi kèm')</th>
									<th class="text-center p-2" style="width: 130px;">@lang('Giá')</th>
									<th class="text-center p-2" style="width: 100px;">@lang('Số lượng')</th>
									<th class="text-center p-2" style="width: 130px;">@lang('Tổng giá')</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($order_details as $item)
									@php
										$productItem = $item->product;
										$price = $item->price ?? 0;
										$quantity = $item->quantity ?? 0;
										$total_price = $total_price+($price*$quantity);
									@endphp
									<tr>
										<td class="p-2" style="height: 60px;">
											<img src="{{ $productItem->getImage() }}" style="width: 100%; height: 100%; object-fit: contain;">
										</td>
										<td class="p-2">
											<p>{{ $productItem->getName() }}</p>
										</td>
										@if($item->type == 1)
										<td class="p-2">Mua mặc định</td>
										@else
											@if($item->type == 2)
												<td class="p-2">Mua giờ vàng</td>
											@else
												<td class="p-2">Mua combo</td>
											@endif		
										@endif
										<td class="p-2">
											@if($item->type == 2)
												@if(isset($item->gift_other) && !empty($item->gift_other))
													@php
						                                $product_gift_texts = json_decode(base64_decode($item->gift_other ?? ''), 1);
						                            @endphp
						                            @if(isset($product_gift_texts['image']) && count($product_gift_texts['image']) > 0) 
						                                @foreach($product_gift_texts['image']?? [] as $key => $value)
						                                    <div class="flex-center-left flex" style="display: flex;align-items: center;">
						                                        <p>
						                                            @include('Default::general.components.image', [
						                                                'src' => resizeWImage($value, 'w100'),
						                                                'width' => '50px',
						                                                'height' => '50px',
						                                                'lazy'   => true,
						                                                'title' => getAlt($value),
						                                                'alt' => getAlt($value),
						                                            ])
						                                        </p>
						                                        <p style="margin-left: 15px;">
						                                            {{ $product_gift_texts['name'][$key] ?? '' }}. Trị giá: {{ formatPrice($product_gift_texts['price'][$key] ?? '') }}
						                                        </p>

						                                    </div>
						                                @endforeach
						                            @endif
												@endif
												@if(isset($item->gift_products) && !empty($item->gift_products))
													{{ $item->gift_products ?? '' }}
												@endif
											@endif
										</td>
										<td class="p-2">{{formatPrice($price)}}</td>
										<td class="p-2">{{$quantity}}</td>
										<td class="p-2">{{formatPrice($price*$quantity)}}</td>
									</tr>
								@endforeach
							</tbody>
							<tfoot>
                                <tr>
                                    <td colspan="4" class="text-right"><strong>@lang('Tổng giá trị đơn')</strong></td>
                                    <td>{{formatPrice($total_price)}}</td>
                                </tr>
                                @if(!empty($order->voucher_value) && !empty($order->voucher_code))
                                    <tr>
                                        <td colspan="4" class="text-right"><strong>@lang('Giảm giá')</strong></td>
                                        <td>{{formatPrice($order->voucher_value)}}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td colspan="4" class="text-right"><strong>@lang('Thành tiền')</strong></td>
                                    <td>{{ $order->getTotalPrice() }}</td>
                                </tr>
							</tfoot>
						</table>
					</div>
				</div>
			@endif
		@endif
<div class="form-actions">
	<div class="form-actions__group">
		@if ($order->status == 1)
			<a href="{{ route('admin.orders.accepts', $order->id) }}" class="btn btn-sm btn-success">
				<i class="fa fa-check mr-1"></i> 
				@lang('Tiếp nhận đơn')
			</a>
		@endif
		@if ($order->status == 11)
            <a href="{{ route('admin.orders.confirmContact', $order->id) }}" class="btn btn-sm btn-warning">
                <i class="fa fa-phone mr-1"></i>
                @lang('Đã liên hệ')
            </a>
        @endif
		@if ($order->status == 2)
			<a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-sm btn-primary">
				<i class="fa fa-edit mr-1"></i> 
				@lang('Chỉnh sửa đơn hàng')
			</a>
			<a href="{{ route('admin.orders.success', $order->id) }}" class="btn btn-sm btn-success">
				<i class="fa fa-check-circle mr-1"></i> 
				@lang('Thành công')
			</a>
			<a href="{{ route('admin.orders.denined', $order->id) }}" class="btn btn-sm btn-danger">
				<i class="fa fa-ban mr-1"></i> 
				@lang('Từ chối')
			</a>
		@endif
		<a href="{{ route('admin.orders.download_invoice', $order->id) }}" class="btn btn-sm btn-primary">
            <i class="fa fa-file mr-1"></i> 
            @lang('Translate::form.action.download_invoice')
        </a>
		<a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-danger">
			<i class="fa fa-sign-out-alt mr-1"></i> 
			@lang('Translate::form.action.exit')
		</a>
	</div>
</div>
<div class="modal fade" id="order_history">
	<div class="modal-dialog" style="max-width: 50%;">
		<div class="modal-content">
			<div class="modal-body p-0" style="height: calc(100vh - 60px);">
				<iframe src="" frameborder="0" class="float-left" style="width: 100%; height: 100%;"></iframe>
			</div>
		</div>
	</div>
</div>
<style>
	#form-refund{
        display: none;
    }
    .form-refund{
        width: 100%;
        float: left;
        margin-top: 10px;
    }
    .form-refund input{
        width: 100%;
        float: left;
        border: 1px solid #dee2e6;
        margin-bottom: 10px;
        height: 40px;
        padding-left: 10px;
        border-radius: 4px;
    }
    .form-refund textarea{
        width: 100%;
        float: left;
        border: 1px solid #dee2e6;
        margin-bottom: 10px;
        height: 100px;
        padding: 10px;
        border-radius: 4px;
        box-sizing: border-box;
    }
    .form-refund button{
        background: #6d757d;
        border: none;
        border-radius: 4px;
        padding: 5px 20px;
        color: #fff;
    }
    .card .card-body .card-title{
        padding-bottom: 10px;
        border-bottom: 1px solid #ced4da;
        margin-bottom: 15px;
	}
</style>
<script>
	$(document).ready(function() {
		$('body').on('click', '*[data-order_history]', function() {
			$('#order_history').find('iframe').attr('src', $(this).data('order_history'));
			$('#order_history').modal();
		});
		$('#order_history').on('hidden.bs.modal', function() {
			$(this).find('iframe').attr('src', '');
		});
		$('#show-form-refund').on('click', function(){
            $(this).remove();
            $('#form-refund').slideDown();
        });
	});
</script>
@endsection
