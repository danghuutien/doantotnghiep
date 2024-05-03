<div class="comments-add" @if (isset($type) && $type == 'reply') style="display: none;" @endif>
	@if($type != 'reply')
	<div class="comments-add__vote flex mt-11 mb-18">
		<span class="mr-11 fs-16 lh-20">{{ __('Đánh giá của bạn') }}:</span>
		<div class="list-inline vote">
			<input type="hidden" class="active" name="rank" value="" style="color: red;">
			<a data-point="1" class="star-1 votes-star" href="#"><svg width="24" height="24" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z"/></svg></a>
            <a data-point="2" class="star-2 votes-star" href="#"><svg width="24" height="24" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z"/></svg></a>
            <a data-point="3" class="star-3 votes-star" href="#"><svg width="24" height="24" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z"/></svg></a>
            <a data-point="4" class="star-4 votes-star" href="#"><svg width="24" height="24" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z"/></svg></a>
            <a data-point="5" class="star-5 votes-star" href="#"><svg width="24" height="24" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z"/></svg></a>
		</div>
	</div>
	@endif
	<div class="comments-add__form">
		<div class="form-top w-100 flex">
			<input type="hidden" name="type_origin" value="{{ $type_origin ?? 1 }}">
			<input type="text" class="comments-add__form-input fs-14 lh-22" name="name" placeholder="@lang('Họ và tên')">
			<input type="text" class="comments-add__form-input fs-14 lh-22" name="phone" placeholder="@lang('Số điện thoại')">
		</div>
		<textarea class="comments-add__form-field fs-14 lh-22" name="content" placeholder="@lang('Nhập nội dung bình luận')"></textarea>
	</div>
	<div class="comments-add__action">
		<div class="comments-add__action-left w-100">
			<ul>
				@if (config('SudoComment.upload_image') == true)
					<li>
						@php
							if (isset($type) && $type == 'reply') {
								$image_id = 'comments_image_'.$parent_id??'';
							} else {
								$image_id = randString(20);
							}
						@endphp
						<input type="file" name="comment_file" id="{{$image_id ?? ''}}" accept="image/x-png, image/jpeg" multiple>
						<label for="{{$image_id ?? ''}}"><i class="fa fa-camera"></i> @lang('Gửi ảnh')</label>
					</li>
				@endif
			</ul>
		</div>
		
	</div>
	@if (config('SudoComment.upload_image') == true)
		<div class="comments-add__preview"></div>
	@endif
	<div class="comments-add__action-right">
		<button type="button" class="fs-14 lh-31 text-center color-white" data-comments_submit data-comment_id="{{$parent_id ?? 0}}">{{ isset($type_origin) && $type_origin == 2 ? __('Gửi câu trả lời') :__('Gửi bình luận') }}</button>
	</div>
</div>