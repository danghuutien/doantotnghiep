@extends('Default::web.layouts.app')
@section('head')
 	<script type="application/ld+json"> 
	    { 
	        "@context": "https://schema.org/", 
	        "@type": "CreativeWorkSeries", 
	        "name": "{{ $post->name ?? '' }}", 
	        "aggregateRating": { 
	            "@type": "AggregateRating", 
	            "ratingValue": "5", 
	            "ratingCount": "10", 
	            "bestRating": "5", 
	            "worstRating": "1" 
	        } 
	    }
    </script>
    <script type="application/ld+json">
    { 
        "@context": "https://schema.org", 
        "@type": "Article",
        "headline": "{!! str_replace(['"','“','”'], '', $post->name) ?? '' !!}",
        "alternativeHeadline": "{!! str_replace(['"','“','”'], '', $post->name) ?? '' !!}",
        "image": "{!! $post->getImage() !!}",
        "author": [
            {
            "@type": "Person",
            "name": "{!! $post->adminUser->display_name ?? ($post->adminUser->name ?? '') !!}",
            "url": "{{ route('app.home') }}"
        	}
        ],
        "genre": "Toshiko",
        "wordcount": "{!! mb_strlen($post->detail, 'UTF-8'); !!}",
        "publisher": {
            "@type": "Organization",
            "name": "Toshiko",
            "logo": {
                "@type": "ImageObject",
                "url": "{{ $config_general['logo_header_desktop'] ?? '' }}"
            }
        },
        "url": "{{ $post->getUrl() }}",
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "{{ $post->getUrl() }}"
        },
        "datePublished": "{!! date( DateTime::ISO8601, strtotime($post->created_at ))  !!}",
        "dateModified": "{!! date( DateTime::ISO8601, strtotime($post->updated_at )) !!}",
        "description": "{!! cutString(strip_tags(str_replace(['"','“','”'], '', $post->detail)), 200) !!}",
        "articleBody": "{!! cutString(strip_tags(str_replace(['"','“','”'], '', $post->detail)), 200) !!}"
    }
    </script>
@endsection
@section('content')
@include('Default::web.layouts.breadcrumb', ['breadcrumb' => $breadcrumb])
<div class="container">
	<div class="post_show mt-25 flex w-100">
		<div class="post_show__detail">
			<div class="post_show__name mb-13">
				<h1 class="fs-40 lh-50">{!! $post->name ?? '' !!}</h1>
			</div>
			<div class="post_show__time flex">
				<div class="date flex mr-60 time_item">
					<img src="/assets/images/icon/date.png" alt="icon time" class="mr-10">
					<span>{!! formatTime($post->created_at, 'd/m/Y') !!}</span>
				</div>
				<div class="post_cate flex time_item">
					<img src="/assets/images/icon/ghim.png" alt="icon time" class="mr-10">
					<a href="{{$category->getUrl() ?? 'javascript:;'}}">
						<span class="color-main">{!! $category->name ?? '' !!}</span>
					</a>
				</div>
			</div>
			<div class="post_detail mt-25">
				<div class="css-content">
					{!! $post->detail ?? ' ' !!}
				</div>
			</div>
            @if(isset($morePosts) && count($morePosts) > 0)
                <div class="post_more">
                    <p class="post_more_title fs-18 lh-24 f-w-b">Xem thêm</p>
                    <ul>
                        @foreach ($morePosts as $morePost)
                            <li>
                                <a href="{{ $morePost->getUrl() }}">{{ $morePost->getName() }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
			@if(isset($tag_posts) && count($tag_posts) > 0)
			<div class="post_tag flex mt-22">
				 <div class="post_tag__title">
				 	<span class="f-w-b text-up">Tags: </span>
				 </div>
				 <div class="post_tag__content flex ml-15">
				 	@foreach($tag_posts as $k => $tag)
				 	<div class="tag_item">
				 		<a href="{{ $tag->getUrl() }}" class="fs-14 lh-22">{!! $tag->name ?? '' !!}</a>
				 	</div>
				 	@endforeach
				 </div>
			</div>
			@endif
			@if(isset($related_posts) && count($related_posts) > 0)
			<div class="post_related mt-55 mb-55 w-100">
				<h2 class="fs-28 lh-24"> Bài viết liên quan</h2>
				<div class="post_related__list pt-25 w-100">
					<div class="owl-carousel">
						@foreach($related_posts as $k => $related)
						<div class="item">
							<div class="item_img mb-12">
								<a href="{{ $related->getUrl() }}">
									<img loading="lazy" src="{{ resizeWImage($related->image, 'w250') }}" alt="{{ $related->getAlt() ?? '' }}" width="250" height="160">
								</a>
							</div>
							<div class="item_name">
								<h3><a href="{{ $related->getUrl() }}" class="fs-16 lh-26">{!! $related->name ?? '' !!}</a></h3>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
			@endif
		</div>
		<div class="post_show__sitebar">
			@include('Default::web.post.category', ['sitebar_title' => 'Danh mục tin tức', 'sitebar_content' => $post_categories])
			@if(isset($post_news) && count($post_news) > 0)
			<div class="post_news mt-55 mb-45">
				<h2 class="fs-28 lh-24">Bài viết mới nhất</h2>
				@foreach($post_news as $key => $item)
				<div class="post_news__item flex mt-15">
					<div class="new_image mr-15">
						<a href="{{ $item->getUrl() }}">
							<img loading="lazy" src="{{ resizeWImage($item->image, 'w150') }}" alt="{{ $item->getAlt() ?? '' }}" width="150" height="100">
						</a>
					</div>
					<div class="new_content">
						<div class="date flex mb-12">
							<img src="/assets/images/icon/date.png" alt="icon time" class="mr-10">
							<span>{!! formatTime($item->created_at, 'd/m/Y') !!}</span>
						</div>
						<div class="new_content__name">
							<h3><a href="{{ $item->getUrl() }}" class="fs-18 lh-26 fw-400">
								{!! $item->name ?? '' !!}
							</a></h3>
						</div>
					</div>
				</div>
				@endforeach
			</div>
			@endif
			@include('Default::web.layouts.ads_sitebar')
		</div>
	</div>
</div>
@endsection
@section('foot')
<script type="text/javascript" defer>
	document.addEventListener("DOMContentLoaded", function(event) {
		$(document).ready(function(){
			$('.post_related__list .owl-carousel').owlCarousel({
		        loop: false,
		        autoplay: true,
		        autoplayTimeout: 3000,
		        autoplayHoverPause: true,
		        navText: ['<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="15" height="15"><path d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" fill="#fff"/></svg>', '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="15" height="15"><path d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z" fill="#fff"/></svg>'],
		        margin: 16,
		        dots: false,
		        nav: true,
		        items: 1,
		        responsive: {
		            '0': {
		                'items': 1
		            },
		            '390': {
		                'items': 2
		            },
		            '768': {
		                'items': 2
		            },
		            '992': {
		                'items': 3,
		            },
		            '1300': {
		                'items': 3,
		            },
		        }
		    }); 
		});
	});
</script>
@endsection
