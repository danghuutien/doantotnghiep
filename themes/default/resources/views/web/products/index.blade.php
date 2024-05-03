@extends('Default::web.layouts.app')
@section('content')
@include('Default::web.layouts.breadcrumb', ['breadcrumb' => $breadcrumb])
<div class="product_category">
    @if(!empty($product_categorie->image))
    	<div class="product_category__banner">
    		@include('Default::general.components.image', [
                'src' => resizeWImage($product_categorie->image, 0),
                'width' => '1920px',
                'height' => '550px',
                'lazy'   => true,
                'title'  => $product_categorie->name ?? ''
            ])
    	</div>
    @endif
	<div class="product_category__content mt-50 w-100">
		<div class="container">
			@if(isset($product_favorite) && count($product_favorite) > 0)
            <p class="fs-40 lh-50 product_favorite_title">Sản phẩm được ưa chuộng nhất</p>
			<div class="product_favorite w-100 mb-50 flex-center-left" style="background: {{ $config_product['code_color'] ?? 'linear-gradient(270deg, #E42227 0%, #B80426 72.51%, #C30823 100%)' }};">
                <div class="product_favorite_banner">
                    @include('Default::general.components.image', [
                        'src' => $config_product['product_favorite_bgk'] ?? '',
                        'width' => '300px',
                        'height' => '500px',
                        'lazy'   => true,
                        'title'  => ''
                    ])
                </div>
                <div class="product_favorite_slides">
    				<div class="owl-carousel">
    					@include('Default::web.products.list-item', ['products' => $product_favorite])
    				</div>
                </div>
			</div>
			@endif
			<div class="product_list w-100">
				<div class="product_list_top flex">
					<div class="category_name">
						<h1 class="fs-40 lh-50">{!! $product_categorie->name ?? '' !!}</h1>
					</div>
					<div class="product_short flex">
                        <input type="hidden" id="search_url" value="{{ $product_categorie->getUrl() }}">
						<div class="select mr-20">
							<select name="sort_price" onchange="loadUrl('priceSort', this.value)" class="price_sort">
								<option {{ isset($priceSort) && $priceSort == '0_10' ? 'selected' : '' }} value="0_10">Dưới 10 triệu</option>
								<option {{ isset($priceSort) && $priceSort == '10_20' ? 'selected' : '' }} value="10_20">Từ 10 - 20 triệu</option>
								<option {{ isset($priceSort) && $priceSort == '20_30' ? 'selected' : '' }} value="20_30">Từ 20 - 30 triệu</option>
								<option {{ isset($priceSort) && $priceSort == '30_50' ? 'selected' : '' }} value="30_50">Từ 30 - 50 triệu</option>
								<option {{ isset($priceSort) && $priceSort == '50_70' ? 'selected' : '' }} value="50_70">Từ 50 - 70 triệu</option>
								<option {{ isset($priceSort) && $priceSort == '70_100' ? 'selected' : '' }} value="70_100">Từ 70 - 100 triệu</option>
								<option {{ isset($priceSort) && $priceSort == '100_1000' ? 'selected' : '' }} value="100_1000">Từ 70 - 100 triệu</option>
							</select>
						</div>
						<div class="select">
							<select name="sort"onchange="loadUrl('sort', this.value)">
								<option {{ isset($sort) && $sort == 'default' ? 'selected' : '' }} value="default">{{ __('Mặc định') }}</option>
								<option {{ isset($sort) && $sort == 'newest' ? 'selected' : '' }} value="newest">{{ __('Mới nhất') }}</option>
								<option {{ isset($sort) && $sort == 'oldest' ? 'selected' : '' }} value="oldest">{{ __('Cũ nhất') }}</option>
								<option {{ isset($sort) && $sort == 'low_price' ? 'selected' : '' }} value="low_price">{{ __('Giá thấp đến cao') }}</option>
								<option {{ isset($sort) && $sort == 'high_price' ? 'selected' : '' }} value="high_price">{{ __('Giá cao đến thấp') }}</option>
								<option {{ isset($sort) && $sort == 'asc' ? 'selected' : '' }} value="asc">{{ __('Tên A-Z') }}</option>
								<option {{ isset($sort) && $sort == 'desc' ? 'selected' : '' }} value="desc">{{ __('Tên Z-A') }}</option>
							</select>
						</div>
					</div>
				</div>
				<div class="checkbox-module flex-center-right {{ checkAgent() }}">
					<div id="overlay_filter"></div>
					@foreach($filters ?? [] as $filter)
						<div class="filter-parent flex-center-between">
							<p class="p-5 color-white">{{$filter->display_name ?? ''}}</p>
							<svg xmlns="http://www.w3.org/2000/svg" height=".5em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/></svg>
							<div class="box-filter__detail flex">
								@foreach($filter->filterDetail ?? [] as $filter_detail)
									<div class="box-input">
										<input onclick="loadUrl('filter[{{ $filter->id }}][{{ $filter_detail->id }}]','{{ $filter_detail->id }}')" type="checkbox" name="filter" class="filter-item" id="filter_{{$filter_detail->id}}">
										<label class="icon-check" for="filter_{{$filter_detail->id}}">
											<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>
										</label>
										<label for="filter_{{$filter_detail->id}}">{{ __($filter_detail->name) }}</label>
									</div>
								@endforeach
							</div>
						</div>
					@endforeach
				</div>
				@if(isset($products) && count($products) > 0)
				<div id="listdata">
					<div class="product_list__bottom flex mt-33 w-100">
						@include('Default::web.products.list-item', ['products' => $products])
					</div>
					@if($products->total() > 16)
						<div class="view_more">
							<p class="color-white text-up-16 fw-700 showallproduct">Xem toàn bộ</p>
							<div class="perpage flex d-none">
								{!! $products->appends(Request()->all())->links('Default::general.components.pagination') !!}
							</div>
						</div>
					@endif
				</div>
				@endif
			</div>
			<div class="product_category__detail w-100">
                <p class="name">{{ $product_categorie->name }}</p>
				<div class="css-content">
					{!! $product_categorie->detail ?? '' !!}
				</div>
				<p class="color-main fs-16 lh-24 more open toggleContent"><span class="color-main">Xem thêm</span></p>
                <p class="color-main fs-16 lh-24 more hide toggleContent"><span class="color-main">Thu gọn</span></p>
			</div>
		</div>
	</div>
    @include('Default::general.components.faq')
</div>
@endsection
