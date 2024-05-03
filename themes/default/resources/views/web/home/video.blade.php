@php
    $videos = $setting_home['videos'] ?? [];
    $videoTitles = $videos['name'] ?? [];
    $videoLinks = $videos['link'] ?? [];
    $videoDesc = $videos['desc'] ?? [];
    $videoImage = $videos['image'] ?? [];
@endphp
@if(count($videoTitles))
    <div class="banner_thank thank flex mt-56">
        <div class="banner_thank__left">
            <div class="background1">
                @if(isset($videoImage[0]) && !empty($videoImage[0]))
                    @include('Default::general.components.image', [
                        'src' => resizeWImage($videoImage[0] ?? '', 0),
                        'width' => '1150px',
                        'height' => '810px',
                        'lazy'   => true,
                        'title'  => ''
                    ])
                @else
                    <img src="/assets/images/img-thank-1.png" loading="lazy" alt="Video background" width="1150" height="810">
                @endif
            </div>
            <div class="content">
                <p class="content-title fs-28 lh-38 f-w-b color-white">{{ $videoTitles[0] ?? '' }}</p>
                <p class="content-desc fs-16 lh-24 mt-9 color-white">{{ $videoDesc[0] ?? '' }}</p>
                <a href="{{ $videoLinks[0] ?? '' }}" rel="nofollow" class="fs-16 lh-19 mt-25 f-w-b text-up color-white venobox" data-autoplay="true" data-vbtype="video">
                    <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="17.5" cy="17.5" r="16.5" stroke="white" stroke-width="2"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15 13L24 18L15 23V13V13Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="pl-10">Xem video</span>
                </a>
            </div>
        </div>
        <div class="banner_thank__right">
            <div class="background2">
                @if(isset($setting_home['videoRight']) && !empty($setting_home['videoRight']))
                   {{--  @include('Default::general.components.image', [
                        'src' => resizeWImage($videoImage[1] ?? '', 0),
                        'width' => '750px',
                        'height' => '810px',
                        'lazy'   => true,
                        'title'  => ''
                    ]) --}}
                    <img class="lazy" src="{{ $setting_home['videoRight'] ?? '' }}" alt="{{ getAlt($setting_home['videoRight'] ?? '') ?? '' }}" width="750" height="810">
                @else
                    <img src="/assets/images/img-thank-right.png" loading="lazy" alt="Video background" width="810" height="810">
                @endif
            </div>
            <div class="content">
                <div class="content-title fs-40 lh-54 f-w-b color-white">Người nổi tiếng tin dùng</div>
                <div class="content-list mt-30">
                    @for($i = 1; $i < count($videoTitles); $i++)
                        <div class="content-list__item flex video_item_left video_right" data-image_src="{{ $videoImage[$i] ?? '/assets/images/img-thank-1.png' }}" data-desc="{{ $videoDesc[$i] ?? '' }}" data-link="{{ $videoLinks[$i] ?? '' }}">
                            <p>
                                <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="17.5" cy="17.5" r="16.5" stroke="white" stroke-width="2"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15 13L24 18L15 23V13V13Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </p>
                            <h3 class="fs-18 lh-24 f-w-b ml-34 color-white">
                                <p class="color-white">{{ $videoTitles[$i] ?? '' }}</p>
                            </h3>
                        </div>
                    @endfor
                </div>
                <a href="{{ $setting_home['videoLink'] ?? '/' }}" class="see-more color-white fs-16 lh-19">
                    <span class="pr-5">Xem thêm</span>
                    <svg width="7" height="10" viewBox="0 0 7 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g filter="url(#filter0_d_0_392)">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7 4.5L0 0L0 9L7 4.5Z" fill="white"/>
                        </g>
                        <defs>
                        <filter id="filter0_d_0_392" x="0" y="0" width="7" height="10" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
                        <feOffset dy="1"/>
                        <feColorMatrix type="matrix" values="0 0 0 0 1 0 0 0 0 0.999937 0 0 0 0 1 0 0 0 1 0"/>
                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_0_392"/>
                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_0_392" result="shape"/>
                        </filter>
                        </defs>
                    </svg>
                </a>
            </div>
        </div>
    </div>
@endif
