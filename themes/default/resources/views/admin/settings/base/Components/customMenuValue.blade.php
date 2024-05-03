@if (isset($datas) && !empty($datas) )
{{-- @php
	dd($datas);
	$datas = json_decode($datas) ?? [];
@endphp --}}
@foreach ($datas as $key => $data)
@php
	// dump($data);
$table_name = isset($data->table) ? $data->table : '';
@endphp
<li
	class="dd-item"
	data-type="{!! $data->type ?? '' !!}"
	data-name="{!! $data->name ?? '' !!}"
	data-thumbnail="{!! $data->thumbnail ?? '' !!}"
	data-link="{!! $data->link ?? '' !!}"
	data-target="{!! $data->target ?? '' !!}"
    data-rel="{!! $data->rel ?? '' !!}"
    @if (isset($data->type) && $data->type == 'table_link')
       data-table="{!! $data->table ?? '' !!}"
	   data-id="{!! $data->id ?? '' !!}" 
    @endif
>
    <div class="dd-handle">
    	<div class="dd-title">{!! $data->name ?? '' !!}</div>
    </div>
	<div class="dd-action">
		<button type="button" class="plus" data-nestable_edit><i class="fas fa-edit"></i></button>
		<button type="button" class="remove" data-nestable_remove><i class="fas fa-trash"></i></button>
	</div>
    <div class="dd-collape">
        {{-- Tên --}}
    	<div class="form-group mb-2">
    		<label>@lang('Translate::form.menu.display_name')</label>
    		<input type="text" class="form-control menu-name" value="{!! $data->name ?? '' !!}" placeholder="Tên hiển thị">
    	</div>
		@if(isset($image_box) && $image_box == true)
			<div class="form-group mb-2">
				{{-- <label>Image</label> --}}
				{{-- <input type="text" class="form-control menu-thumbnail" value="{!! $data->thumbnail ?? '' !!}" placeholder="Link Ảnh"> --}}
				@include('Form::base.image', [
			        'name'              => 'thumbnail_'.$table_name.$key,
			        'value'             => $data->thumbnail ?? '',
			        'required'          => 0,
			        'label'             => 'Icon menu',
			        'title_btn'         => 'Thêm ảnh',
			        'class_col'         => '',
			        'has_row'         => 'true',
			    ])
			</div>  
		@endif
    	@switch($data->type ?? '')
    	    @case('custom_link')
    	        {{-- Liên kết tự tạo --}}
    	        <div class="form-group mb-2">
		    		<label>@lang('Translate::form.menu.link')</label>
		    		<input type="text" class="form-control menu-link" value="{!! $data->link ?? '' !!}">
		    	</div>
    	    @break
    	    @case('fix_link')
    	        {{-- Liên kết cố định config('app.menu_link')[\App::getLocale()] --}}
	        	<div class="form-group mb-2">
		    		<label>@lang('Translate::form.menu.link')</label>
		    		<select class="form-control menu-link">
		    			@foreach ($menu_link as $link => $text)
		    				<option value="{!! $link ?? '' !!}" @if ($link == $data->link) selected @endif>@lang($text)</option>
		    			@endforeach
		    		</select>
		    	</div>
            @break
            @case('table_link')
                {{-- Liên kết tại bảng được chỉ định --}}
                @if (!empty($table_link))
                    <div class="form-group mb-2">
                        <label>@lang('Translate::form.menu.link')</label>
                        <select class="form-control menu-link">
                            @foreach ($table_link[$data->table] as $link => $value)
                                <option value="{!! $link ?? '' !!}" @if ($link == $data->link) selected @endif data-id="{!! $value['id'] ?? '' !!}">{!! $value['name'] ?? '' !!}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
    	    @break
    	@endswitch
		{{-- Thẻ Target --}}
    	<div class="form-group mb-2">
    		<label>@lang('Target')</label>
    		@php
    			$target_array = [
    				'_self' => __('Translate::form.menu.open_direct'),
    				'_blank' => __('Translate::form.menu.open_blank'),
    			];
    		@endphp
    		<select class="form-control menu-target">
    			@foreach ($target_array as $key => $target)
    				<option value="{!! $key ?? '' !!}" @if ($data->target == $key) selected @endif>@lang($target)</option>
    			@endforeach
    		</select>
    	</div>
        {{-- Thẻ Rel --}}
    	<div class="form-group">
    		<label>@lang('Rel')</label>
    		@php
    			$rel_array = [ 'nofollow', 'noreferrer' ];
    		@endphp
    		<select class="form-control menu-rel">
				<option value="" @if (@$data->rel == '') selected @endif>-- @lang('Translate::form.menu.no_rel') --</option>
    			@foreach ($rel_array as $rel)
    				<option value="{!! $rel !!}" @if ($data->rel == $rel) selected @endif>@lang($rel)</option>
    			@endforeach
    		</select>
    	</div>
        {{-- Nút đóng --}}
    	<div class="form-group mb-0 text-right">
    		<button type="button" class="btn btn-danger btn-sm" data-nestable_edit>@lang('Translate::form.menu.close')</button>
    	</div>
    </div>
    @if (isset($data->children) && !empty($data->children))
   {{--  @php
    	dd($data->children);
    @endphp --}}
        <ol class="dd-list">
            @include('Default::admin.settings.base.Components.customMenuValue', [
                'datas' => $data->children,
                'menu_link' => $menu_link ?? [],
                'image_box' => false
            ])
        </ol>
    @endif
</li>
@endforeach
@endif
{{-- <script>
	$(document).ready(function() {
		$('body').on('click', '.image-box__remove', function() {
            $(this).parents('#image-box-menu_image').hide();
            $(this).parents('#image-box-menu_image').find('input').val('');
            $(this).parents().find('.dropzone').show();
        });
	});
</script> --}}