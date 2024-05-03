@foreach ($comment_parents as $parent)
	<div class="item" data-comment_id="{{$parent->id}}">
		<div class="item-author w-100 flex">
			<div class="item-author__avatar">{{ getNameKey($parent->getName()) }}</div>
			<div class="item-author__info">
				<div class="item-author__name flex">
					<span class="fs-18 lh-20 fw-600">
						{{ $parent->getName() }}
					</span>
					{{-- @if($parent->buy_toshiko == 1) --}}
						<div class="buy_toshiko flex ml-17">
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><rect width="18" height="18" rx="10" fill="#23A54B"/>
							<path d="M15.9166 6.10599C15.7802 5.96467 15.5657 5.96467 15.4292 6.10599L8.31338 13.253C8.25489 13.3136 8.17691 13.3136 8.11842 13.253L4.58974 9.69968C4.45327 9.55836 4.23882 9.55836 4.10235 9.69968C3.96588 9.84101 3.96588 10.0631 4.10235 10.2044L7.63104 13.7577C7.787 13.9192 8.00145 14 8.1964 14C8.41086 14 8.60581 13.9192 8.76177 13.7577L15.8776 6.61073C16.0336 6.4694 16.0336 6.24732 15.9166 6.10599Z" fill="white" stroke="white" stroke-width="0.5"/>
							</svg>
							<span class="fs-14 fw-600 ml-7">Đã mua hàng tại Toshiko</span>
						</div>
					{{-- @endif --}}
					@if ($parent->admin_id != 0)
						<div class="item-author__role flex">
							<p>@lang('Quản trị viên')</p>
						</div>
					@endif
				</div>
				<div class="item-author__time flex">
					<ul class="list-inline flex">
						@for($i=1; $i <= 5; $i++)							
							@if($parent->vote < $i)
							<svg width="17" height="17" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z" fill="#959595"/></svg>
							@else
							<svg width="17" height="17" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.625 12.8589L15.0325 16L13.5975 10.08L18.375 6.09684L12.0838 5.58316L9.625 0L7.16625 5.58316L0.875 6.09684L5.6525 10.08L4.2175 16L9.625 12.8589Z" fill="#FDA005"/></svg>
							@endif
						@endfor
					</ul>
					<div class="time ml-12">
						<span class="fs-14 lh-22">{{$parent->getTime()}}</span>
					</div>
				</div>
			</div>
		</div>
		<div class="item-content">{{ $parent->content }}</div>
		@if (!empty($parent->image))
			@php
				$parent_image = explode(',', $parent->image);
			@endphp
			<div class="item-gallery flex">
				@foreach ($parent_image as $image)
					<div class="item-image popup-image" data-image="{{getImage($image)}}">
						<img src="{{ getImage($image, 'tiny') }}" loading="lazy" width="100" height="100" alt="{{ getAlt($image) }}">
					</div>
				@endforeach
			</div>
		@endif
		{{-- <div class="item-action flex">
			<div class="item-action__reply" data-reply="{{ '@'.$parent->getName().': ' }}">
				<span>@lang('Trả lời')</span>
			</div>
		</div> --}}
		@php
			$childs = $comment_childs->where('parent_id', $parent->id);
		@endphp
		@if (isset($childs) && count($childs) > 0)
			<div class="item-child">
				@foreach ($childs as $child)
					<div class="item">
						<div class="item-author">
							<div class="item-author__avatar">{{ getNameKey($child->getName()) }}</div>
							<div class="item-author__info">
								<div class="item-author__name">{{ $child->getName() }}</div>
								@if ($child->admin_id != 0)
									<div class="item-author__role flex">
										<p>@lang('Quản trị viên')</p>
									</div>
								@endif
								{{-- <div class="time">
									<span>{{$child->getTime()}}</span>
								</div> --}}
								<div class="item-content">{{ $child->content }}</div>
								@if (!empty($child->image))
									@php
										$parent_image = explode(',', $child->image);
									@endphp
									<div class="item-gallery">
										@foreach ($parent_image as $image)
											<div class="item-image popup-image" data-image="{{getImage($image)}}">
												<img src="{{getImage($image, 'tiny')}}" alt="">
											</div>
										@endforeach
									</div>
								@endif
								<div class="item-action flex">
									<div class="item-action__reply" data-reply="{{ '@'.$child->getName().': ' }}"><span>@lang('Trả lời')</span></div>
									<div class="item-action__time fs-13 lh-20 ml-6"><span>- {{ $child->timeComment($child->time ?? '') }}</span></div>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		@endif
		{{-- <div class="item-reply">
			@include('Comment::add', [
				'type' => 'reply',
				'parent_id' => $parent->id,
				'type_origin' => $type_origin ?? 1,
			])
		</div> --}}
	</div>
@endforeach
