<div class="shop_gallery gallery mt-20 pb-23">
    <div class="gallery-list">
        @include('Default::general.components.image', [
            'src' => resizeWImage($store->image, 'w150'),
            'width' => '150px',
            'height' => '150px',
            'lazy'   => true,
            'title'  => $store->name ?? ''
        ])
        @if(count($store->getSlides()))
            @foreach($store->getSlides() as $key => $slide)
                @include('Default::general.components.image', [
                    'src' => resizeWImage($slide, 'w150'),
                    'width' => '150px',
                    'height' => '150px',
                    'lazy'   => true,
                    'title'  => ''
                ])
            @endforeach
        @endif
    </div>
    <div class="slick-nav">
        <div class="slick-prev"><img src="/assets/images/icon/icon_prev.png" class="slick-arrow" aria-disabled="false" style=""></div>
        <div class="slick-next"><img src="/assets/images/icon/icon_next.png" class="slick-arrow slick-disabled" style="" aria-disabled="true"></div>
    </div>
</div>