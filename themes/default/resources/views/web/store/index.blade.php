@extends('Default::web.layouts.app')
@section('content')
    <div class="system">
        @include('Default::web.layouts.breadcrumb')
        <div class="container">
            <div class="system-content">
                @if(isset($config_general['store_banner']) && !empty($config_general['store_banner']))
                    <div class="system-content__banner">
                        @include('Default::general.components.image', [
                            'src' => $config_general['store_banner']??'',
                            'width' => '1170px',
                            'height' => '400px',
                            'lazy'   => true,
                            'title'  => ''
                        ])
                    </div>
                @endif
                <h1 class="system-content__title mt-37 fs-40 lh-50 f-w-b w-100 text-center">Hệ thống Showroom toàn quốc</h1>
                <div class="system-content__form mt-35" id="listdata">
                    <div class="top">
                        <div class="top-content flex">
                            <div class="top-content__left flex" data-link="{{ route('app.stores.index') }}">
                                <p class="btn-top area active" data-area="1">Miền Bắc ({{ $countStores[1] ?? 0 }})</p>
                                <p class="btn-top area" data-area="2">Miền Trung ({{ $countStores[2] ?? 0 }})</p>
                                <p class="btn-top area" data-area="3">Miền Nam ({{ $countStores[3] ?? 0 }})</p>
                            </div>
                            <div class="top-content__right">
                                <input type="text" id="suggest_shop" class="form-control mr-11" name="keyword" autocomplete="off" placeholder="Tìm cửa hàng"/>
                                <button class="btn btn-search color-white find-store" type="submit" aria-label="Cửa hàng gần bạn" name="btn-search">Cửa hàng gần bạn</button>
                            </div>
                        </div>
                    </div>
                    <div class="list flex list-store">
                        @include('Default::web.store.item', compact('stores'))
                    </div>
                    <div class="perpage flex mb-30">
                        {!! $stores->appends(Request()->all())->links('Default::general.components.pagination') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
