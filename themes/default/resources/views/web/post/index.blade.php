@extends('Default::web.layouts.app')
@section('content')
@include('Default::web.layouts.breadcrumb', ['breadcrumb' => $breadcrumb])
<div class="post_category">
	<div class="container">
        @if(!empty($banner))
    		<div class="post_category__banner">
    			<img loading="lazy" src="{{ $banner }}" alt="{{ getAlt($banner) ?? '' }}" width="1170" height="750">
    		</div>
        @endif
		<div class="post_category__content flex mt-30">
			@include('Default::web.layouts.sitebar', ['sitebar_title' => 'Danh mục tin tức', 'sitebar_content' => $post_categories])
			<div class="list_post">
				<h1 class="fs-40 lh-50 mb-27">{!! $title ?? '' !!}</h1>
				@if(isset($post_news) && count($post_news) > 0)
				<div class="list_post__news flex">
					@foreach($post_news as $key => $post_new)
					@php
						$w = 250;
						if($key === 0) $w = 600;
					@endphp
					<div class="post_new">
						<div class="post_new__img">
							<a href="{{ $post_new->getUrl() }}">
								@include('Default::general.components.image', [
								    'src' => resizeWImage($post_new->image, 'w'.$w),
								    'width' => $w.'px',
								    'height' => $w.'px',
								    'lazy'   => true,
								    'title'  => $post_new->name ?? ''
								])
							</a>
						</div>
						<div class="post_new__detail">
							<div class="category mb-17">
								<a href="{{ $post_new->postCategoryMap->category->getUrl() }}" class="color-white text-up fw-600 fs-12">{!! $post_new->postCategoryMap->category->name ?? '' !!}</a>
							</div>
							<div class="post_name">
								<h3><a href="{{ $post_new->getUrl() }}" class="fs-18 fw-600 color-white">
									{!! $post_new->name ?? '' !!}
								</a></h3>
							</div>
						</div>
					</div>
					@endforeach
				</div>
				@endif
				@if(isset($posts) && count($posts) > 0)
				<div class="list_post__content mt-30" id="listdata">
					<div class="list-posts list flex">
						@include('Default::web.layouts.post-item',['posts'=>$posts])
					</div>
					<div class="perpage flex">
						{!! $posts->appends(Request()->all())->links('Default::general.components.pagination') !!}
					</div>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection
