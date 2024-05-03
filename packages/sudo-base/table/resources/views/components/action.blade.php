@switch($type)
    @case('show')
    	<td class="text-center table-action" style="width: 60px;">
        	<a href="{!! route('admin.'.$table_name.'.show', $value->id) !!}"><i class="fa fa-eye text-green"></i></a>
    	</td>
    @break
    @case('edit')
    	<td class="text-center table-action" style="width: 60px;">
        	<a href="{!! route('admin.'.$table_name.'.edit', $value->id) !!}"><i class="fas fa-edit text-green"></i></a>
    	</td>
    @break
    @case('delete')
        <td class="text-center table-action" style="width: 60px;">
            <a class="delete-record" href="javascript:;" data-quick_delete data-message="@lang('Translate::table.delete_question')"><i class="fas fa-trash text-red"></i></a>
        </td>
    @break
    @case('action')
        <td class="text-center table-action" style="width: 100px;">
            <a href="{!! route('admin.'.$table_name.'.edit', $value->id) !!}" style="padding-right: 15px;"><i class="fas fa-edit text-green"></i></a>
            @if (!Request()->trash)
                <a href="javascript:;" class="delete-record" data-quick_delete data-message="@lang('Translate::table.delete_question')" style="cursor: pointer;"><i class="fas fa-trash text-red"></i></a>
            @endif
            @if (Request()->trash)
                <a class="delete-record" href="javascript:;" data-delete_forever data-id="{{ $value->id }}" data-message="@lang('Translate::table.delete_question')"><i class="fas fa-trash text-red"></i></a>
            @endif
        </td>
    @break
    @case('delete_custom')
        <td class="text-center table-action" style="width: 60px;">
            <a class="delete-record" href="javascript:;" data-delete_custom data-message="@lang('Translate::table.delete_question')"><i class="fas fa-trash text-red"></i></a>
        </td>
    @break
    @case('restore')
        <td class="text-center" style="width: 60px;">
            <a class="delete-record" href="javascript:;" data-quick_restore><i class="fas fa-window-restore text-green"></i></a>
        </td>
    @break
@endswitch
