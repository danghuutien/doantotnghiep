@extends('Core::layouts.app')

@section('head')
<link rel="stylesheet" href="{{ asset('core/css/logs-content.css') }}">
@endsection

@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-body logs">
				<h4 class="card-title">@lang('Core::admin.logs.title')</h4>
				<div class="col-lg-12 logs-info">
					<table class="table table-bordered logs-info__table">
						<thead>
							<tr>
								<th colspan="2" class="text-center">@lang('Core::admin.logs.info_title')</th>
							</tr>
						</thead>
						<tbody>
							@if (isset($admin_users) && !empty($admin_users))
								<tr>
									<td>@lang('Core::admin.logs.name')</td>
									<td>{!! $admin_users->getName() !!}</td>
								</tr>
							@endif
							@if (isset($data->ip) && !empty($data->ip))
								<tr>
									<td>@lang('Core::admin.logs.ip')</td>
									<td>{!! $data->ip !!}</td>
								</tr>
							@endif
							@if (isset($data->action) && !empty($data->action))
								<tr>
									<td>@lang('Core::admin.logs.action')</td>
									<td>{!! $data->getActionName() !!}</td>
								</tr>
							@endif
							@if (isset($data->type) && !empty($data->type))
								<tr>
									<td>@lang('Core::admin.logs.type')</td>
									<td>{!! $data->getModuleName() !!}</td>
								</tr>
							@endif
							@if (isset($data->type_id) && !empty($data->type_id))
								<tr>
									<td>@lang('Core::admin.logs.type_id')</td>
									<td>{!! $data->type_id !!}</td>
								</tr>
							@endif
							@if (isset($data->time) && !empty($data->time))
								<tr>
									<td>@lang('Core::admin.logs.time')</td>
									<td>{!! $data->getTime('time') !!}</td>
								</tr>
							@endif
						</tbody>
					</table>
				</div>

				@switch($data->action)
				    @case('create') 
						@php
				    		$detail = $data->getDetail();
				    	@endphp
				    	<table class="table table-bordered logs-table">
							<thead>
								<tr>
									<th colspan="3" class="text-center">@lang('Core::admin.logs.detail')</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th>@lang('Core::admin.logs.field')</th>
									<th>@lang('Core::admin.logs.data')</th>
								</tr>
								@if (isset($detail['fields']) && !empty($detail['fields']))
									@foreach ($detail['fields'] as $field)
										@if (!in_array($field, ['password']))
											@php
												$data_create = $detail['data'][$field] ?? '';
											@endphp
											<tr>
												<td>{!! __( config('SudoModule.logs')[$data->type][$field] ?? config('SudoModule.logs_name')[$field] ?? $field ?? '' )  !!}</td>
												@if (in_array($field, config('SudoModule.logs_content_field')))
													<td class="logs-content logs-content__limit">
														<div class="limit">{!! $old ??'' !!}</div>
													</td>
												@else
													<td>{!! $data_create ??'' !!}</td>
												@endif
											</tr>
										@endif
									@endforeach
								@endif
							</tbody>
						</table>
				    @break
				    @case('login') @break
				    @default
						@php
				    		$detail = $data->getDetail();
				    	@endphp
				    	<table class="table table-bordered logs-table">
							<thead>
								<tr>
									<th colspan="3" class="text-center">@lang('Core::admin.logs.detail')</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th>@lang('Core::admin.logs.field')</th>
									<th>@lang('Core::admin.logs.old')</th>
									<th>@lang('Core::admin.logs.new')</th>
								</tr>
								@if (isset($detail['fields']) && !empty($detail['fields']))
									@foreach ($detail['fields'] as $field)
										@if (!in_array($field, ['password']))
											@php
												$old = $detail['old'][$field] ?? '';
												$new = $detail['new'][$field] ?? '';
											@endphp
											<tr>
												<td>{!! __( config('SudoModule.logs')[$data->type][$field] ?? config('SudoModule.logs_name')[$field] ?? $field ?? '' )  !!}</td>
												@if (in_array($field, config('SudoModule.logs_content_field')))
													<td class="logs-content logs-content__limit">
														<div class="limit">{!! $old ??'' !!}</div>
													</td>
													<td class="logs-content logs-content__limit" @if($old != $new) style="background: #e6e6e6;" @endif>
														<div class="limit">{!! $new ??'' !!}</div>
													</td>
												@else
													<td>{!! $old ??'' !!}</td>
													<td class="" @if($old != $new) style="background: #e6e6e6;" @endif>{!! $new ??'' !!}</td>
												@endif
											</tr>
										@endif
									@endforeach
								@endif
							</tbody>
						</table>
				    @break
				@endswitch
			</div>
		</div>
	</div>
</div>
@endsection