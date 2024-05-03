@if (isset($type) && !empty($type))
	<div class="container-fluid p-0 mb-3" data-toggle_wrap>
		<div class="card card-light m-0">
			<div class="card-header" data-toggle_btn style="cursor: pointer;">
				<h4 class="card-title">@lang($label ?? '')</h4>
			</div>
			<div class="collapse" data-toggle_box>
				<div class="card-body">
					<div class="form-group mb-2">
			    		<label>@lang('Translate::form.menu.display_name')</label>
			    		<input type="text" class="form-control menu-name" placeholder="Tên hiển thị">
			    	</div>
					<div class="form-group mb-2">
						{{-- <label>Image</label>
						<input type="text" class="form-control menu-thumbnail" placeholder="Link Ảnh"> --}}
						@include('Form::base.image', [
					        'name'              => 'thumbnail-'.$type.$table.$name??'',
					        'value'             => $data->thumbnail ?? '',
					        'required'          => 0,
					        'label'             => 'Icon menu',
					        'title_btn'         => 'Thêm ảnh',
					        'class_col'         => '',
					        'has_row'         => 'false',
					    ])
					</div>

			    	@switch($type)
			    	    @case('custom_link')
			    	    	{{-- Liên kết tự tạo --}}
			    	        <div class="form-group mb-2">
					    		<label>@lang('Translate::form.menu.link')</label>
					    		<input type="text" class="form-control menu-link">
					    	</div>
		    	        @break
			    	    @case('fix_link')
			    	    	{{-- Liên kết cố định config('app.menu_link')[\App::getLocale()] --}}
		    	        	<div class="form-group mb-2">
					    		<label>@lang('Translate::form.menu.link')</label>
					    		<select class="form-control menu-link">
					    			@foreach ($option as $link => $text)
					    				<option value="{!! $link ?? '' !!}">@lang($text)</option>
					    			@endforeach
					    		</select>
					    	</div>
		    	        @break
		    	        @case('table_link')
							{{-- Liên kết cố định config('app.menu_link')[\App::getLocale()] --}}
		    	        	<div class="form-group mb-2">
					    		<label>@lang('Translate::form.menu.link')</label>
					    		<input type="hidden" class="menu-table" value="{!! $table ?? '' !!}">
					    		<select class="form-control menu-link">
					    			@foreach ($option as $link => $value)
					    				<option value="{!! $link ?? '' !!}" data-id="{!! $value['id'] ?? '' !!}">{!! $value['name'] ?? '' !!}</option>
					    			@endforeach
					    		</select>
					    	</div>
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
			    				<option value="{!! $key ?? '' !!}">@lang($target)</option>
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
		    				<option value="">-- @lang('Translate::form.menu.no_rel') --</option>
			    			@foreach ($rel_array as $rel)
			    				<option value="{!! $rel !!}">@lang($rel)</option>
			    			@endforeach
			    		</select>
			    	</div>
			    	{{-- Nút thêm --}}
			    	<div class="form-group mb-0 text-right">
			    		<button type="button" class="btn btn-primary btn-menu-submit" data-type="{!! $type ?? '' !!}" data-name="{!! $name ?? '' !!}"><i class="fa fa-plus mr-2"></i>@lang('Translate::form.menu.add_menu')</button>
			    	</div>
				</div>
			</div>
		</div>
	</div>
@endif
