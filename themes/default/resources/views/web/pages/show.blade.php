@extends('Default::web.layouts.app')
@section('content')
	<div id="pages" class="page mb-102">
		@include('Default::web.layouts.breadcrumb')
		<div class="container">
			<div class="page-content flex mt-18">
				<div class="page-content__left">
					<div class="sidebar">
						<div class="sidebar-content__title">
							<img src="/assets/images/icon/icon-menu.png" alt="">
							<span class="fs-18 lh-24 f-w-b color-white ml-10">Điều khoản & Chính sách</span>
						</div>
						<ul class="sidebar-content__list">
							@foreach($list_page as $key => $value)
							<li class="menu-item {{ menuActive($value->getUrl() ?? '') }}">
								<a href="{{ $value->getUrl() ?? '' }}" class="fs-16 lh-19">
									{{ $value->name ?? '' }}
									<svg width="11" height="6" viewBox="0 0 11 6" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M5.92246 5.23422L10.2275 1.23757C10.3684 1.10663 10.3682 0.894622 10.2267 0.763896C10.0853 0.633271 9.85617 0.633609 9.7151 0.764571L5.66632 4.52333L1.61757 0.764436C1.47647 0.633491 1.2475 0.633153 1.10604 0.763761C1.03513 0.829293 0.999675 0.915144 0.999675 1.001C0.999675 1.08663 1.03489 1.17214 1.10531 1.23756L5.4102 5.23422C5.47798 5.29729 5.57022 5.33268 5.66632 5.33268C5.76243 5.33268 5.85456 5.29719 5.92246 5.23422Z" fill="#1C2E3D" stroke="#1C2E3D"/>
									</svg>
								</a>
							</li>
							@endforeach
						</ul>
					</div>
					@include('Default::web.layouts.image-ads')
				</div>
				<div class="page-content__right">
					<h1 class="title_page fs-40 lh-50 f-w-b">{{ $page->name ?? '' }}</h1>
					<div class="css-content mt-26 fs-16 lh-24">
						{!! $page->detail ?? '' !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
