@extends('Default::web.layouts.app')
@section('content')
@include('Default::web.layouts.breadcrumb', ['breadcrumb' => $breadcrumb])
<div class="product_category">
    @if(!empty($config_general['banner_search'] ?? ''))
        <div class="product_category__banner">
            @include('Default::general.components.image', [
                'src' => $config_general['banner_search'] ?? '',
                'width' => '1920px',
                'height' => '550px',
                'lazy'   => true,
                'title'  => ''
            ])
        </div>
    @endif
    <div class="search_title mb-30">
        <div class="container">
            <h1 class="fs-40 lh-50 w-100">Tìm kiếm <span class="color-main">"{!! $keyword ?? '' !!}"</span></h1>
            <p>Có {{ $products->total() }} sản phẩm và {{ $count_post ?? 0 }} bài viết cho tìm kiếm</p>
        </div>
    </div>
    <div class="product_category__content mt-50 w-100">
        <div class="container">
            <div class="product_list w-100">
                <div class="product_list_top flex">
                    <div class="category_name">
                        {{-- <h1 class="fs-40 lh-50">Tìm kiếm <span class="color-main">"{!! $keyword ?? '' !!}"</span></h1> --}}
                        <h2 class="fs-30 lh-50 text-up">Sản phẩm </h2>
                    </div>
                    <div class="product_short flex">
                        <input type="hidden" id="search_url" value="{{ \Request()->fullUrl() }}">
                        <select name="sort_price" onchange="loadUrl('priceSort', this.value)" class="price_sort mr-20">
                            <option {{ isset($priceSort) && $priceSort == '0_10' ? 'selected' : '' }} value="0_10">Dưới 10 triệu</option>
                            <option {{ isset($priceSort) && $priceSort == '10_20' ? 'selected' : '' }} value="10_20">Từ 10 - 20 triệu</option>
                            <option {{ isset($priceSort) && $priceSort == '20_30' ? 'selected' : '' }} value="20_30">Từ 20 - 30 triệu</option>
                            <option {{ isset($priceSort) && $priceSort == '30_50' ? 'selected' : '' }} value="30_50">Từ 30 - 50 triệu</option>
                            <option {{ isset($priceSort) && $priceSort == '50_70' ? 'selected' : '' }} value="50_70">Từ 50 - 70 triệu</option>
                            <option {{ isset($priceSort) && $priceSort == '70_100' ? 'selected' : '' }} value="70_100">Từ 70 - 100 triệu</option>
                            <option {{ isset($priceSort) && $priceSort == '100_1000' ? 'selected' : '' }} value="100_1000">Từ 70 - 100 triệu</option>
                        </select>
                        <select name="sort" onchange="loadUrl('sort', this.value)">
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
                {{-- <p>Có {{ $products->total() }} sản phẩm và {{ $count_post ?? 0 }} bài viết cho tìm kiếm</p> --}}
                @if(isset($products) && count($products) > 0)
                {{-- <h2 class="fs-22 text-up">Sản phẩm</h2> --}}
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
        </div>
    </div>
    @if(isset($search_posts) && count($search_posts) > 0)
    <div class="search_posts mt-30 mb-50">
        <div class="container">
            <h2 class="fs-30 text-up">Tin tức</h2>
            <div class="search_posts__list pt-20 flex">
                @include('Default::web.layouts.post-item',['posts'=>$search_posts, 'count_post' => $count_post])
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
