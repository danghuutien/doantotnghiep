@php
	$comments = \Sudo\Comment\Models\Comment::loadComment($type, $type_id);
	$comment_totals = $comments['comment_totals'] ?? 0;
	$comment_parents = $comments['comment_parents'] ?? [];
	$comment_childs = $comments['comment_childs'] ?? [];
	if($count_comment > 0) {
		$commentCountType = \Sudo\Comment\Models\Comment::where('status', 1)
            ->where('type_id', $type_id)
            ->where('type', $type)
            ->select(DB::raw('count(*) as number'), 'vote')
            ->groupBy('vote')
            ->pluck('number', 'vote')->toArray();
        $fiveStar = round((($commentCountType[5] ?? 0)/$count_comment), 2)*100;
        $fourStar = round((($commentCountType[4] ?? 0)/$count_comment), 2)*100;
        $threeStar = round((($commentCountType[3] ?? 0)/$count_comment), 2)*100;
        $twoStar = round((($commentCountType[2] ?? 0)/$count_comment), 2)*100;
        $oneStar = round((($commentCountType[1] ?? 0)/$count_comment), 2)*100;
    }
@endphp
<div class="comments" data-type="{{ $type ?? '' }}" data-type_id="{{ $type_id ?? '' }}">
	<div class="votes flex mt-30 mb-20">
	    <div class="votes_count flex">
	        <div class="votes_count__content text-center">
	            <p class="fs-24 lh-22 fw-600 color-main">{!! $vote_products[$product->id] ?? 0 !!}/5</p>
	            <ul class="flex mt-8 mb-8">
	                @for($i = 1; $i <= 5; $i++)
	                    @if(isset($vote_products[$product->id]) && $i <= $vote_products[$product->id])
	                        <li class="active item-star" data-star="{{ $i }}">
	                           <svg width="24" height="24" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z" fill="#FDA005"/></svg>
	                        </li>
	                    @else
	                         <li class="active item-star" data-star="{{ $i }}">
	                           <svg width="24" height="24" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z" fill="#959595"/></svg>
	                        </li>
	                    @endif
	                @endfor
	            </ul>
	            <p class="fs-14 lh-20"><span class="count_comment">{{ $count_comment }} </span>đánh giá</p>
	        </div>
	    </div>
	    <div class="votes_form flex">
	        <div class="votes_form__star">
	            <div class="satisfied flex mb-8">
	                <p class="satisfied_star lh-0">
	                    <svg width="14" height="14" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z" fill="#FDA005"/></svg>
	                    <svg width="14" height="14" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z" fill="#FDA005"/></svg>
	                    <svg width="14" height="14" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z" fill="#FDA005"/></svg>
	                    <svg width="14" height="14" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z" fill="#FDA005"/></svg>
	                    <svg width="14" height="14" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z" fill="#FDA005"/></svg>
	                </p>
	                <p class="satisfied_bgk"><span style="width: {{ $fiveStar??0 }}%"></span></p>
	                <p class="satisfied_value fs-13">{{ $fiveStar??0 }}%</p>
	            </div>
	            <div class="satisfied flex mb-8">
	                <p class="satisfied_star">
	                    <svg width="14" height="14" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z" fill="#959595"/></svg>
	                    <svg width="14" height="14" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z" fill="#FDA005"/></svg>
	                    <svg width="14" height="14" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z" fill="#FDA005"/></svg>
	                    <svg width="14" height="14" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z" fill="#FDA005"/></svg>
	                    <svg width="14" height="14" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z" fill="#FDA005"/></svg>
	                </p>
	                <p class="satisfied_bgk"><span style="width: {{ $fourStar??0 }}%;"></span></p>
	                <p class="satisfied_value fs-13">{{ $fourStar??0 }}%</p>
	            </div>
	            <div class="satisfied flex mb-8">
	                <p class="satisfied_star">
	                    <svg width="14" height="14" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z" fill="#959595"/></svg>
	                    <svg width="14" height="14" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z" fill="#959595"/></svg>
	                    <svg width="14" height="14" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z" fill="#FDA005"/></svg>
	                    <svg width="14" height="14" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z" fill="#FDA005"/></svg>
	                    <svg width="14" height="14" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z" fill="#FDA005"/></svg>
	                </p>
	                <p class="satisfied_bgk"><span style="width: {{ $threeStar??0 }}%;"></span></p>
	                <p class="satisfied_value fs-13">{{ $threeStar??0 }}%</p>
	            </div>
	            <div class="satisfied flex mb-8">
	                <p class="satisfied_star">
	                    <svg width="14" height="14" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z" fill="#959595"/></svg>
	                    <svg width="14" height="14" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z" fill="#959595"/></svg>
	                    <svg width="14" height="14" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z" fill="#959595"/></svg>
	                    <svg width="14" height="14" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z" fill="#FDA005"/></svg>
	                    <svg width="14" height="14" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z" fill="#FDA005"/></svg>
	                </p>
	                <p class="satisfied_bgk"><span style="width: {{ $twoSta??0 }}%;"></span></p>
	                <p class="satisfied_value fs-13">{{ $twoStar??0 }}%</p>
	            </div>
	            <div class="satisfied flex">
	                <p class="satisfied_star">
	                    <svg width="14" height="14" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z" fill="#959595"/></svg>
	                    <svg width="14" height="14" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z" fill="#959595"/></svg>
	                    <svg width="14" height="14" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z" fill="#959595"/></svg>
	                    <svg width="14" height="14" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z" fill="#959595"/></svg>
	                    <svg width="14" height="14" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z" fill="#FDA005"/></svg>
	                </p>
	                <p class="satisfied_bgk"><span style="width: {{ $oneStar??0 }}%;"></span></p>
	                <p class="satisfied_value fs-13">{{ $oneStar??0 }}%</p>
	            </div>
	        </div>
	        <div class="votes_form__btn btn_rating">
	            <a href="javascript:;" class="fs-14 lh-30 color-white">Gửi đánh giá của bạn</a>
	        </div>
	    </div>
	</div>
	@include('Comment::add')
	<div class="comments-content comments-content_1" id="comment_list">
		@if (count($comment_parents) > 0)
			<div class="page-header__short">
				<select name="sort">
					<option {{ isset($sort) && $sort == 'newest' ? 'selected' : '' }} value="desc">{{ __('Mới nhất') }}</option>
					<option {{ isset($sort) && $sort == 'oldest' ? 'selected' : '' }} value="asc">{{ __('Cũ nhất') }}</option>
				</select>
			</div>
		@endif
		<div class="comments-list">
			@if (count($comment_parents) > 0)
				@include('Comment::item')
			@else
				<span class="fs-18">Chưa có đánh giá !</span>
			@endif
		</div>
		<div class="comments-loadmore" @if ($comment_parents->total() <= config('SudoComment.page_number')) style="display: none;" @endif>
			<button type="button" data-comments_loadmore data-page_cmt="{{$comment_parents->currentPage()}}" data-origin="1">@lang('Xem thêm đánh giá')</button>
		</div>
	</div>
	@php
		$variable = base64_encode(json_encode([
			'page_number' => config('SudoComment.page_number'),
			'upload_image' => config('SudoComment.upload_image'),
			'allowed_size' => config('SudoMedia.allowed_size'),
			'valid_size' => __('Các File phải có kích thước nhỏ hơn'),
			'valid_extention' => __('Định dạng cho phép là'),
			'valid_empty' => __('Bạn cần nhập đấy đủ thông tin.'),
			'valid_format_phone' => __('Định dạng số điện thoại không chính xác.'),
			'valid_format_email' => __('Định dạng Email không chính xác.'),
			'ajax_load_error_text' => __('Có lỗi xảy ra. Vui lòng thử lại!'),
			'ajax_load_url' => route('app.ajax.comments.load_comments'),
			'ajax_add_url' => route('app.ajax.comments.add_comments'),
			'ajax_search_url' => route('app.ajax.comments.search_comments'),
		]));
	@endphp
	<div class="lang_comments" data-value="{{$variable ?? ''}}" ></div>
	<div class="comments-loading"><div class="comments-loading__box"></div></div>
	<section class="comments-popup previews">
		<div class="comments-popup__close" data-comments_close>
			<span>
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg>
			</span>
		</div>
		<div class="comments-popup__dialog">
			<div class="comments-popup__body">
				<img src="{{getImage()}}" alt="">
			</div>
		</div>
	</section>
</div>
@section('footerComment')
	<script defer type="text/javascript" src="{{ asset('platforms/comments/web/resizeImage/jquery.resizeImg.js') }}"></script>
	<script defer type="text/javascript" src="{{ asset('platforms/comments/web/resizeImage/mobileBUGFix.mini.js') }}"></script>
@endsection
