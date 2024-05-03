@if(isset($setting_home['bannerAds']) && !empty($setting_home['bannerAds']))
    <div class="image_relax mt-22">
        @include('Default::general.components.image', [
            'src' => resizeWImage($setting_home['bannerAds'] ?? '', 0),
            'width' => '1140px',
            'height' => '273px',
            'lazy'   => true,
            'title'  => ''
        ])
    </div>
@endif
