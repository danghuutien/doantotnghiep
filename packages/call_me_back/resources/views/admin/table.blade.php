@include('Table::components.text',['text' => $value->phone ?? ''])
<td>
	<a href="{{$value->current_page ?? '#' ??'javascript:;'}}" target="_blank">{{$value->name ?? 'Không xác định'}}</a>
</td>
<td class="form-switch form-switch-lg text-center" style="width: 120px;">
    <input type="checkbox" class="form-check-input" name="active_status" value="{!! $value->active_status?? '' !!}" @if($value->active_status == 1) checked @endif style="padding: 0;margin: 0;left: 0;">
</td>
