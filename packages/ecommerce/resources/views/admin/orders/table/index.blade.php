<td style="min-width: 130px; width: 130px;" class="center">{{$value->code ?? ''}}</td>
@if($value->customer_id != 0)
<td style="min-width: 200px; max-width: 300px;white-space: unset;">
	@php
		$customer = $value->customer;
	@endphp
	<p class="mb-1">{{ $customer->name ?? '' }}</p>
	<p class="mb-1"><strong><a href="tel:{{ $customer->phone ?? '' }}">{{ $customer->phone ?? '' }}</a></strong></p>
	<p class="mb-1">{{ $customer->getAddress() ?? '' }}</p>
</td>
@else
<td style="min-width: 200px;">
	<p class="mb-1"><strong><a href="tel:{{ $value->phone_number }}">{{ $value->phone_number }}</a></strong></p>
</td>
@endif
@php
	$form_tracking = \DB::table('form_trackings')->where('type_id',$value->id)->first();
	// $utm_source = collect(config('app.utm_source'));
@endphp
<td> 
	@if (isset($form_tracking))
		@if ($form_tracking->type_id == $value->id)
	    	@if ($form_tracking->source == 'direct')
	    		<p>{{__('Nguồn')}}: Khác <a href="#" target="_blank" class="btn btn-xs btn-default">Link</a></p>
	    	@else
				<p>{{__('Nguồn')}}: {{ $form_tracking->source ?? 'direct'}} <a href="{{$form_tracking->source_link ?? '#'}}" target="_blank" class="btn btn-xs btn-default">Link</a></p>
	    	@endif
		@endif
	@endif
</td>
<td style="min-width: 130px; width: 130px;" class="center">{{$value->type == 2 ? 'Để lại số điện thoại tư vấn' : 'Thao tác đặt hàng' }}</td>
<td style="width: 110px;">{{$value->getTotalPrice()}}</td>
{{-- <td style="width: 350px;">{{$value->note}}</td> --}}
<td style="width: 150px;text-align: center;">
	{!! $payment_status[$value->payment_status]??'Chưa thanh toán' !!}
</td>
@if($trash != 1)
<td style="width: 100px;">{!! $value->getStatus()['status_label'] ?? '' !!}</td>
@endif
