@extends('Default::web.layouts.app')
@section('head')
    <style type="text/css">
        @php
            echo file_get_contents(public_path('assets/css/home.min.css'));
            echo file_get_contents(public_path('assets/libs/venobox/css/venobox.min.css'));
        @endphp
    </style>
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "Trang chủ",
            "url": "{{getUrlLink('current')}}",
            "logo": "{{ $config_general['logo_header'] ?? '' }}",
            "contactPoint": {
                "@type": "ContactPoint",
                "telephone": "{{ $config_general['hotline'] ?? '1900 1891' }}",
                "contactType": "customer service"
            }
        }
    </script>
    {!!$setting_home['html_home'] ?? ''!!}
@endsection
@section('content')
    @if($golden_time)
        @include('Default::web.home.golden-time', ['products' => $product_sale])
    @endif
    @include('Default::web.home.bestseller', ['products' => $bestProducts])
    <div class="container">
        <div class="home-product mt-60">
            @include('Default::web.layouts.image-toshiko', ['name'=>$firtCate->getName(), 'url'=>$firtCate->getUrl()])
            @include('Default::web.home.first-cate')
        </div>
        @include('Default::web.home.banner-ads')
        @include('Default::web.home.other-cate')
    </div>
    @include('Default::web.home.video')
    @include('Default::web.home.post')
    @include('Default::web.home.certification')
    @include('Default::web.home.parten')
    @include('Default::general.components.faq')
    @include('Default::web.home.service')
    @include('Default::web.home.store')
    <div class="consultation">
        <div class="consultation__bg">
            @include('Default::general.components.image', [
                'src' => resizeWImage( '/assets/images/bg-nhan-tu-van-nhanh.png', 0),
                'width' => '100%',
                'height' => '100%',
                'lazy'   => true,
                'title'  => ''
            ])
        </div>
        <div class="container">
            <div class="consultation-content flex">
                <div class="consultation-content__title">
                    <h3 class="color-white fs-26 lh-40 text-up f-w-b">NHẬN TƯ VẤN NHANH TỪ TOSHIKO</h3>
                </div>
                <div class="consultation-content__form mt-17 w-100">
                    <form class="send-request flex" method="POST" action="javascript:;" id="send-request">
                        <input type="hidden" name="_token" value="">
                        <input type="text" name="name" class="fs-16 lh-22 mr-26 form-control" placeholder="Họ và tên">
                        <input type="text" name="phone" class="fs-16 lh-22 mr-26 form-control" placeholder="Số điện thoại">
                        <button class="fs-16 lh-19 color-white text-up send" id="btn" onclick="contact('send-request','register')">
                            Gọi cho tôi
                        </button>
                    </form>
                </div>
                <p class="consultation-content__desc color-white fs-22 lh-26 mt-23">
                    (*) Chúng tôi cam kết không chia sẻ dữ liệu
                </p>
            </div>
        </div>
    </div>
@endsection
