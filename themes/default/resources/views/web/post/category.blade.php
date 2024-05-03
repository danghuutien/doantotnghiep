<div class="sitebar_content">
	<div class="sitebar_content__title flex">
		<img src="/assets/images/icon/menu_cate.png" alt="icon" class="mr-10">
		<span class="f-w-b color-white fs-18">{{ $sitebar_title ?? '' }}</span>
	</div>
 	@if(isset($sitebar_content) && count($sitebar_content) > 0)
 	<ul class="sitebar_content__list">
 		@foreach($sitebar_content as $key => $item)
 		<li class="sitebar_item {{ $url_cate == $item->getUrl() ? 'active' : '' }}">
 			<a href="{{ $item->getUrl() }}">{!! $item->name ?? '' !!}
 			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="15" height="15"><path d="M201.4 374.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 306.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"/></svg>
 			</a>
 		</li>
 		@endforeach
 	</ul>
 	@endif
</div>