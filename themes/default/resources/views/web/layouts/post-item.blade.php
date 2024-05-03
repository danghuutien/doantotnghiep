@foreach($posts as $key => $value)
<div class="post-item">
	<div class="post-item__img">
		<a href="{{ $value->getUrl() }}">
			@include('Default::general.components.image', [
			    'src' => resizeWImage($value->image, 'w300'),
			    'width' => '277px',
			    'height' => '250px',
			    'lazy'   => true,
			    'title'  => $value->name ?? ''
			])
		</a>
	</div>
	<div class="post-item__content">
		<div class="content-top flex mb-10">
			<div class="content-top__cate">
				<a href="{{ $value->postCategoryMap->category->getUrl() }}" class="text-up fs-14">{!! $value->postCategoryMap->category->name ?? '' !!}</a>
			</div>
			<div class="content-top__date flex">
				@include('Default::general.components.image', [
					'src' => resizeWImage('/assets/images/icon/date.png', '0'),
					'width' => '21px',
					'height' => '20px',
					'lazy'   => true,
					'title'  => ''
				])
				<span class="fs-14">{!! formatTime($value->created_at, 'd/m/Y') !!}</span>
			</div>
		</div>
		<div class="content_name mb-10">
			<h3><a href="{{ $value->getUrl() }}" class="fs-18 lh-24 f-w-b">{!! $value->name ?? '' !!}</a></h3>
		</div>
		<div class="content_desc">
			<p>{!! cutString(removeHTML($value->detail), 250) ?? '' !!}</p>
		</div>
	</div>
</div>
@php
	$id = $value->id;
@endphp
@endforeach
@if(isset($count_post) && $count_post > 16)
<div class="btn-view_more more_post_search" id="more_post_search" style="margin: 0 auto;">
	<a href="javascript:;" class="color-white text-up-16 fw-700" data-id="{{ $id ?? 0 }}">Xem thêm</a>
</div>
@endif