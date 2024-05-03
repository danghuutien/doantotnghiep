<div class="card-body table-responsive p-0" style="max-height: calc(100vh - 250px)">
	<table class="table table-striped table-bordered table-head-fixed">
		<thead>
			<tr>
				<th class="text-center pl-3">@lang('STT')</th>
				<th class="text-center pl-3">@lang('Số điện thoại')</th>
				<th class="text-center pl-3">@lang('Tên trang hiện tại')</th>
				<th class="text-center pl-3">@lang('Đường dẫn trang')</th>
				<th class="text-center pl-3">@lang('Thời gian')</th>
				<th class="text-center pl-3">@lang('Xác nhận')</th>
				<th class="text-center pl-3">@lang('Trạng thái')</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($data as $key => $value)
				<tr>
					<td class="text-center">{{$key+1}}</td>
					<td class="text-center">{{$value->phone ?? ''}}</td>
					<td class="text-center">{{$value->name ?? ''}}</td>
					<td class="text-center">{{$value->current_page ?? ''}}</td>
					<td class="text-center">{{$value->updated_at ?? ''}}</td>
					<td class="text-center">{{$active_status[$value->active_status] ?? ''}}</td>
					<td class="text-center">{{$status[$value->status] ?? ''}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
<!-- /.card-body -->