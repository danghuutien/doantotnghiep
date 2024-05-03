@php
    $serviceFooter = $setting_home['services'] ?? [];
    $serviceFooterImage = $serviceFooter['image'] ?? [];
    $serviceFooterName = $serviceFooter['name'] ?? [];
    $serviceFooterDesc = $serviceFooter['desc'] ?? [];
@endphp

<div class="famous-brand">
    <div class="famous-brand__bg">
        @include('Default::general.components.image', [
            'src' => resizeWImage($config_general['brand'] ?? '/assets/images/background-thnt.png', 0),
            'width' => '100%',
            'height' => '100%',
            'lazy'   => true,
            'title'  => ''
        ])
    </div>
    <div class="container">
        <h2 class="famous-brand__title f-w-b w-100 color-white text-center">{{ $setting_home['serviceTitle'] ?? 'Toshiko thương hiệu nổi tiếng Châu Á"' }}</h2>
        <div class="famous-brand__desc fs-16 lh-24 color-white mt-25 text-center">
            {{ $setting_home['serviceDesc'] ?? 'Hiểu được tầm quan trọng của sức khỏe, Toshiko Việt Nam muốn cùng bạn tạo ra giá trị bền vững. Các sản phẩm của Toshiko đều  tập trung vào chất lượng sản phẩm, lấy khách hàng là yếu tố cốt lõi để phát triển. Những chính sách hậu mãi cũng là điều Toshiko chú trọng để khách hàng luôn cảm thấy yên tâm, thoải mái.'}}
        </div>
        @if(count($serviceFooterImage))
            <div class="famous-brand__content flex mt-53">
                @foreach($serviceFooterImage as $kService => $imageService)
                    <div class="item">
                        <div class="thumbnail">
                            @include('Default::general.components.image', [
                                'src' => resizeWImage($imageService, 'w50'),
                                'width' => '50px',
                                'height' => '50px',
                                'lazy'   => true,
                                'title'  => ''
                            ])
                        </div>
                        <p class="item-title fs-20 mt-28 lh-24 f-w-b color-white">{{  $serviceFooterName[$kService] ?? '' }}</p>
                        <p class="item-desc fs-16 lh-19 mt-8 color-white">{{  $serviceFooterDesc      [$kService] ?? '' }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
