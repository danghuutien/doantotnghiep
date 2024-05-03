<style>
	li.link-group-item {
    	width: 100%;
    	float: left;
	}
</style>
<td style="width: 300px;">
	<div class="float-left mb-1" style="width: calc(100% - 40px - 10px);">
		<p class="m-0 text-bold" style="line-height: 20px;">{{$value->name}}</p>
		<p class="m-0 text-xs">{{$value->email}}</p>
		<p class="m-0 text-xs" style="line-height: 20px;">{{ $value->getTime('time') }}</p>
		<p class="m-0 text-xs">{{$value->ip}}</p>
	</div>
</td>
<td style="min-width: 400px;">
	<div class="col col-12 p-0 mb-2" style="white-space: pre-line;">{{$value->content}}</div>
	<div class="col col-12 p-0 mb-2 float-left">
		@if (!empty($value->image))
			@php
				$parent_image = explode(',', $value->image);
			@endphp
			@foreach ($parent_image as $image)
				<div class="image float-left mr-2" style="width: 80px; height: 80px; border: 1px solid #cccccc; display: flex; align-items: center;">
					<img src="{{getImage($image, 'tiny')}}" style="min-width: 100%; max-height: 100%; object-fit: contain;">
				</div>
			@endforeach
		@endif
	</div>
	<div class="col col-12 p-0 mt-1">
		<ul class="link-group">
			{{-- <li class="link-group-item text-xs"><a href="#reply-{{$value->id}}" data-bs-toggle="modal">@lang('Trả lời')</a></li> --}}
			<li class="link-group-item text-xs"><a href="#edit-{{$value->id}}" data-bs-toggle="modal">@lang('Sửa nhanh')</a></li>
			@if ($value->parent_id != 0)
			<li class="link-group-item text-xs">@lang('Trả lời cho bình luận:') <a href="{{ route('admin.comments.edit', $value->parent_id) }}" target="_blank">#{{$value->parent_id}}</a></li>
			@endif
		</ul>
	</div>
	<div class="modal fade" id="reply-{{$value->id}}">
		<div class="modal-dialog">
			<form action="{{ route('admin.ajax.comments.quick_reply', $value->id) }}" method="POST">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">@lang('Trả lời bình luận')</h4>
						<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					</div>
					<div class="modal-body">
						@include('Form::base.text', [
					    	'name'				=> 'name_'.$value->id,
							'value' 			=> Auth::guard('admin')->user()->getName(),
							'required' 			=> 0,
							'label' 			=> '*'.__('Họ và tên'),
							'placeholder' 		=> '',
							'has_row' 			=> false,
							'class_col' 		=> '',
							'disable'			=> false,
					    ])
					    @include('Form::base.text', [
					    	'name'				=> 'email_'.$value->id,
							'value' 			=> Auth::guard('admin')->user()->email,
							'required' 			=> 0,
							'label' 			=> 'Email',
							'placeholder' 		=> '',
							'has_row' 			=> false,
							'class_col' 		=> '',
							'disable'			=> false,
					    ])
					    @if (config('SudoComment.upload_image') == true)
						    @include('Form::base.multiImage', [
						    	'name'				=> 'image_'.$value->id,
								'value' 			=> [],
								'required' 			=> 0,
								'label' 			=> __('Ảnh bình luận'),
								'title_btn' 		=> 'ảnh',
								'has_row' 			=> false,
								'class_col'			=> 'col-lg-12'
						    ])
					    @endif
					    <div style="clear: both;"></div>
					    @include('Form::base.textarea', [
					    	'name'				=> 'content_'.$value->id,
							'value' 			=> '',
							'required' 			=> 0,
							'label' 			=> '*'.__('Nội dung bình luận'),
							'placeholder' 		=> '',
							'has_row' 			=> false,
							'class_col' 		=> '',
							'disable'			=> false,
					    ])
					</div>
					<div class="modal-footer justify-content-between">
						<input type="hidden" name="type" value="{{ $value->type }}">
						<input type="hidden" name="type_id" value="{{ $value->type_id }}">
						<button type="button" class="btn btn-default btn-sm" data-bs-dismiss="modal">@lang('Đóng')</button>
						<button type="submit" class="btn btn-primary btn-sm" 
							data-quick_reply_comment
							data-empty_content="@lang('Nội dung bình luận') @lang('Translate::form.valid.no_empty')"
							data-empty_name="@lang('Họ và tên') @lang('Translate::form.valid.no_empty')"
						>@lang('Trả lời')</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="modal fade" id="edit-{{$value->id}}">
		<div class="modal-dialog">
			<form action="{{ route('admin.ajax.comments.quick_edit', $value->id) }}" method="POST">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">@lang('Sửa bình luận')</h4>
						<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					</div>
					<div class="modal-body">
						@include('Form::base.textarea', [
					    	'name'				=> 'edit_content_'.$value->id,
							'value' 			=> $value->content,
							'required' 			=> 0,
							'label' 			=> '*'.__('Nội dung bình luận'),
							'placeholder' 		=> '',
							'has_row' 			=> false,
							'class_col' 		=> '',
							'disable'			=> false,
					    ])
					    @if (config('SudoComment.upload_image') == true)
						    @include('Form::base.multiImage', [
						    	'name'				=> 'edit_image_'.$value->id,
								'value' 			=> array_diff(explode(',', $value->image), array("")),
								'required' 			=> 0,
								'label' 			=> __('Ảnh bình luận'),
								'title_btn' 		=> 'ảnh',
								'has_row' 			=> false,
								'class_col'			=> 'col-lg-12'
						    ])
					    @endif
					</div>
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-default btn-sm" data-bs-dismiss="modal">@lang('Đóng')</button>
						<button type="submit" class="btn btn-primary btn-sm" data-quick_edit_comment data-empty="@lang('Nội dung bình luận') @lang('Translate::form.valid.no_empty')">@lang('Sửa')</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</td>
<td>
	@php
		$rows = DB::table($value->type)->where('id', $value->type_id)->first();
		$total_rows = DB::table('comments')->where('type', $value->type)->where('type_id', $value->type_id)->count();
	@endphp
	
	<div class="col col-12 p-0 mb-2">
		<p class="m-0"><strong>{{ $rows->name ?? '' }}</strong></p>
	</div>
	<div class="col col-12 p-0 mt-1">
		<ul class="link-group">
			@if(!empty($rows))
			<li class="link-group-item text-xs"><a href="{{ env('APP_URL'). '/'. $rows->slug ?? ''}}" target="_blank">@lang('Xem bài viết')</a></li>
			@endif
			<li class="link-group-item text-xs"><p class="m-0">{{ $total_rows }}</p></li>
		</ul>
	</div>
</td>
