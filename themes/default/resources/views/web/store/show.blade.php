@extends('Default::web.layouts.app')
@section('content')
    <div class="shop">
        @include('Default::web.layouts.breadcrumb')
        <div class="shop_top">
            <div class="container">
                <div class="shop-info">
                    <div class="shop-info__image">
                        @include('Default::general.components.image', [
                            'src' => resizeWImage($store->image, 'w700'),
                            'width' => '670px',
                            'height' => '540px',
                            'lazy'   => true,
                            'title'  => $store->name ?? ''
                        ])
                        @if(count($store->getSlides()))
                            @foreach($store->getSlides() as $key => $slide)
                                @include('Default::general.components.image', [
                                    'src' => resizeWImage($slide, 'w700'),
                                    'width' => '660px',
                                    'height' => '660px',
                                    'lazy'   => true,
                                    'title'  => ''
                                ])
                            @endforeach
                        @endif
                    </div>
                    <div class="shop-info__right">
                        @if(checkAgent() == 'mobile')
                            @include('Default::web.store.slide')
                        @endif
                        <div class="map w-100">
                            <div class="grey-section google-map w-100" id="googlemaps">
                                {!! $store->iframe ?? '' !!}
                            </div>
                        </div>
                        <div class="direct mt-14 {{ checkAgent() == 'mobile' ? 'pb-20' : '' }}">
                            <a href="{{ $store->driver_link ?? '/' }}" rel="nofollow" target="_blank">
                                <img src="/assets/images/icon/direct.png" alt="icon direct">
                                Chỉ đường tới đây
                            </a>
                        </div>
                        @if(checkAgent() == 'web')
                            @include('Default::web.store.slide')
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="shop_bottom">
            <div class="container">
                <div class="shop_bottom__content w-100 flex">
                    <div class="contents">
                        <p class="contents_icon">Showroom</p>
                        <h1 class="contents_title fs-40 lh-50 f-w-b mt-16">{{ $store->getName() }}</h1>
                        <ul>
                            <li>
                                <div class="icon">
                                    <svg width="13" height="16" viewBox="0 0 13 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 6.325C0 2.8 2.89792 0 6.5 0C10.1021 0 13 2.8 13 6.325C13 9.275 8.53125 14.275 7.15 15.725C7.01458 15.875 6.79792 16 6.5 16C6.28333 16 5.98542 15.925 5.85 15.725C4.46875 14.25 0 9.325 0 6.325ZM1.43542 6.325C1.43542 8.2 4.03542 11.725 6.5 14.4C8.96458 11.725 11.5646 8.2 11.5646 6.325C11.5646 3.6 9.31667 1.325 6.5 1.325C3.68333 1.325 1.43542 3.525 1.43542 6.325Z" fill="#DE0200"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4 6C4 4.34579 5.34579 3 7 3C8.65421 3 10 4.34579 10 6C10 7.65421 8.65421 9 7 9C5.34579 9 4 7.65421 4 6ZM5.51402 6C5.51402 6.81308 6.18692 7.48598 7 7.48598C7.81308 7.48598 8.48598 6.81308 8.48598 6C8.48598 5.18692 7.81308 4.51402 7 4.51402C6.18692 4.51402 5.51402 5.18692 5.51402 6Z" fill="#DE0200"/>
                                    </svg>
                                </div>
                                <span class="ml-16 fs-20 lh-24 f-w-b">{{ $store->getAddress() }}</span>
                            </li>
                            <li>
                                <div class="icon">
                                    <svg width="24" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <mask id="mask0_0_1451" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="3" width="27" height="27">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 3.0498H26.9559V29.9996H0V3.0498Z" fill="white"></path>
                                        </mask>
                                        <g mask="url(#mask0_0_1451)">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M20.5517 29.9996C20.0472 29.916 19.5394 29.8489 19.039 29.7456C17.7012 29.469 16.4496 28.9469 15.2319 28.3452C10.4088 25.9619 6.54753 22.4805 3.53286 18.0434C2.22421 16.1173 1.17873 14.0551 0.485771 11.8283C0.0826958 10.533 -0.154706 9.21051 0.115177 7.84523C0.242771 7.1995 0.521285 6.63029 0.979003 6.16277C1.76626 5.35878 2.55748 4.55776 3.37022 3.77978C4.38788 2.80579 5.52795 2.80428 6.53861 3.78847C7.72008 4.93897 8.87741 6.11437 10.036 7.28809C10.5525 7.81129 10.886 8.41958 10.772 9.19202C10.6869 9.76742 10.3582 10.2068 9.96283 10.6038C9.30567 11.2637 8.64304 11.9182 7.98413 12.5764C7.64205 12.9181 7.63506 13.0078 7.83012 13.445C8.58017 15.1263 9.72933 16.5252 10.9621 17.8617C12.19 19.193 13.5419 20.3854 15.0792 21.3506C15.6029 21.6794 16.1673 21.9431 16.7125 22.2376C16.9645 22.3737 17.1542 22.2695 17.3326 22.0897C18.0091 21.408 18.6831 20.7237 19.3691 20.0516C19.5752 19.8496 19.7999 19.6561 20.0456 19.5072C20.8266 19.0343 21.6854 19.1091 22.3939 19.6879C22.5363 19.8043 22.6753 19.9264 22.8056 20.0561C23.9055 21.1514 25.0113 22.2408 26.0952 23.3518C26.3615 23.6247 26.6098 23.944 26.7682 24.2873C27.1088 25.0257 26.9767 25.7638 26.4463 26.3483C25.5869 27.2954 24.677 28.1987 23.758 29.0892C23.2525 29.5788 22.6034 29.824 21.9089 29.9383C21.8241 29.9523 21.7413 29.9789 21.6576 29.9996H20.5517Z" fill="#DE0200"></path>
                                        </g>
                                        <mask id="mask1_0_1451" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="15" y="0" width="15" height="15">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15.0173 0.00390625H29.9487V14.223H15.0173V0.00390625Z" fill="white"></path>
                                        </mask>
                                        <g mask="url(#mask1_0_1451)">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M29.9487 13.8152C29.188 13.9491 28.4273 14.0829 27.6309 14.223C27.0536 11.1108 25.6316 8.44977 23.3252 6.25925C21.0165 4.06654 18.255 2.75058 15.0173 2.27312C15.1252 1.51279 15.2318 0.761579 15.3393 0.00390625C16.8025 0.199195 18.191 0.564214 19.527 1.10525C22.0367 2.1215 24.1823 3.64158 25.9637 5.64321C27.6904 7.58364 28.9003 9.79989 29.5893 12.2836C29.7195 12.7529 29.8294 13.2277 29.9487 13.6999V13.8152Z" fill="#DE0200"></path>
                                        </g>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15 8.29561C15.106 7.52553 15.211 6.76226 15.3159 6C19.3113 6.46032 23.2072 9.81499 24 14.6028C23.2533 14.7347 22.506 14.8667 21.7516 15C20.9045 11.2913 18.6695 9.06719 15 8.29561Z" fill="#DE0200"></path>
                                    </svg>
                                </div>
                                <span class="ml-16 fs-20 lh-24 f-w-b">{{ $store->phone }}</span>
                            </li>
                            @if($store->p_driver == 1)
                                <li>
                                    <div class="icon">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <mask id="mask0_0_10756" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="9" y="0" width="9" height="12">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.77441 0.0341797H17.9733V11.9886H9.77441V0.0341797Z" fill="white"/>
                                            </mask>
                                            <g mask="url(#mask0_0_10756)">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.7013 5.41201C13.9028 5.41201 14.0839 5.41679 14.2648 5.41119C15.0453 5.38693 15.6954 4.73035 15.7483 3.9164C15.8019 3.09123 15.2627 2.33452 14.4841 2.22486C14.0365 2.16181 13.5759 2.18337 13.1218 2.19576C12.8677 2.20269 12.6791 2.44525 12.6781 2.72153C12.6745 3.79661 12.6744 4.87172 12.678 5.94684C12.6791 6.25316 12.9046 6.48558 13.1837 6.48867C13.47 6.49183 13.6934 6.25675 13.7006 5.9398C13.7045 5.7732 13.7013 5.60638 13.7013 5.41201ZM17.9733 4.73211C17.9306 4.95317 17.9025 5.17869 17.8428 5.39459C17.3591 7.14483 16.266 8.20772 14.5633 8.57671C14.5083 8.58864 14.4531 8.60031 14.3856 8.61479V11.9887C14.0577 11.8811 13.7383 11.7816 13.4242 11.6663C13.3878 11.653 13.3628 11.5525 13.3625 11.4922C13.3586 10.602 13.3598 9.71175 13.3598 8.82156V8.65988C12.9498 8.51847 12.5443 8.41701 12.1696 8.24286C10.521 7.47659 9.57407 5.64935 9.81028 3.73499C10.0338 1.92332 11.4308 0.41024 13.1646 0.101114C13.2757 0.0813174 13.3859 0.0565988 13.4966 0.0341797H14.2483C14.2859 0.0452456 14.3228 0.0618084 14.3611 0.0664791C16.022 0.270264 17.4161 1.54248 17.8365 3.24533C17.8932 3.47491 17.9282 3.71038 17.9733 3.94313V4.73211Z" fill="#DE0200"/>
                                            </g>
                                            <mask id="mask1_0_10756" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="12" width="16" height="5">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0 12.0107H15.7364V16.4678H0V12.0107Z" fill="white"/>
                                            </mask>
                                            <g mask="url(#mask1_0_10756)">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.24333 16.4652C0.991868 16.4652 0.754007 16.4723 0.516719 16.4633C0.253515 16.4533 0.0145801 16.2467 0.0122176 15.9791C0.00555969 15.2255 -0.0250812 14.4664 0.0464739 13.719C0.137323 12.7707 0.965093 12.0489 1.88436 12.0143C1.94381 12.0121 2.00338 12.0117 2.0629 12.0117C5.5879 12.0116 9.11282 12.0126 12.6378 12.0107C13.3404 12.0103 13.9726 12.2209 14.5333 12.6613C14.5562 12.6792 14.5769 12.7003 14.6216 12.7407C14.5477 12.7467 14.499 12.7508 14.4502 12.7547C14.1586 12.7776 13.9365 13.0228 13.9402 13.3177C13.944 13.6131 14.1703 13.8568 14.4638 13.8653C14.7494 13.8735 15.0355 13.8731 15.3211 13.8648C15.4296 13.8616 15.4905 13.8993 15.5117 14.005C15.5839 14.366 15.673 14.7249 15.7188 15.0897C15.7517 15.3513 15.729 15.6208 15.7253 15.8867C15.7207 16.2262 15.5001 16.4594 15.1767 16.4649C14.8916 16.4698 14.6062 16.466 14.3009 16.466C14.3206 15.4775 13.9822 14.6611 13.226 14.0582C12.7057 13.6434 12.1083 13.469 11.4536 13.4995C10.3023 13.5533 8.8809 14.5847 8.92239 16.4567H6.62801C6.68592 14.5946 5.20578 13.4618 3.88224 13.4926C2.54478 13.5239 1.1847 14.6822 1.24333 16.4652Z" fill="#DE0200"/>
                                            </g>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.75 8.25244V11.25H2.25C2.26565 11.2056 2.27635 11.165 2.29378 11.1274C2.53364 10.6092 2.76714 10.0883 3.01664 9.57437C3.43761 8.70733 4.15662 8.26834 5.15337 8.25382C5.68116 8.24612 6.2092 8.25244 6.75 8.25244Z" fill="#DE0200"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.25 8.25C8.9569 8.28209 9.66366 8.26471 10.3517 8.35947C11.0315 8.45307 11.5465 8.84864 11.8562 9.40741C12.1799 9.99131 12.4523 10.5987 12.7461 11.1962C12.7529 11.2099 12.7485 11.2281 12.7497 11.25H8.25V8.25Z" fill="#DE0200"/>
                                            <mask id="mask2_0_10756" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="2" y="15" width="4" height="3">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.2832 15.0068H5.24407V18.0003H2.2832V15.0068Z" fill="white"/>
                                            </mask>
                                            <g mask="url(#mask2_0_10756)">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.24407 16.5044C5.24374 17.3311 4.57346 18.0043 3.75469 18.0003C2.94508 17.9964 2.28281 17.3223 2.2832 16.5027C2.28363 15.6764 2.95435 15.0028 3.77282 15.0069C4.58338 15.0109 5.2444 15.6837 5.24407 16.5044Z" fill="#DE0200"/>
                                            </g>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.2552 18C10.4335 18.0023 9.75558 17.3327 9.75003 16.5134C9.74446 15.6834 10.4175 15.0021 11.245 15C12.0746 14.9979 12.7514 15.6738 12.75 16.5031C12.7486 17.3249 12.0769 17.9977 11.2552 18Z" fill="#DE0200"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.5 3.00721C13.7865 3.00721 14.0626 2.98826 14.3351 3.01181C14.7082 3.04415 14.9933 3.37287 14.9999 3.73789C15.0067 4.112 14.7182 4.44257 14.3362 4.49336C14.2619 4.50321 14.1856 4.49911 14.1102 4.49936C13.911 4.50006 13.7117 4.49961 13.5 4.49961V3.00721Z" fill="#DE0200"/>
                                        </svg>
                                    </div>
                                    <span class="ml-16 fs-20 lh-24 f-w-b">Có chỗ đậu xe</span>
                                </li>
                            @endif
                        </ul>
                        <div class="contents_desc css-content mt-55">
                            {!! $store->detail !!}
                        </div>
                    </div>
                    <div class="right">
                        @if(count($hotProducts))
                        <div class="feature-product">
                            <div class="feature-product__title">
                                <h2 class="fs-28 lh-50 f-w-b">Sản phẩm nổi bật</h2>
                            </div>
                            <div class="feature-product__list mt-8 flex">
                                @include('Default::web.products.list-item', ['products' => $hotProducts])
                            </div>
                        </div>
                        @endif
                        @if(isset($related_stores) && count($related_stores) > 0)
                        <div class="mt-6 recent_store">
                            <div class="title">
                                <h2 class="fs-28 lh-50 f-w-b">Danh sách cửa hàng gần đây</h2>
                            </div>
                            <div class="recent_store__list list_store flex mt-24">
                                @foreach($related_stores as $k => $related_store)
                                <div class="list_store__item">
                                    <a href="{{ $related_store->getUrl() }}" class="image">
                                        @include('Default::general.components.image', [
                                            'src' => resizeWImage($related_store->image, 'w200'),
                                            'width' => '200px',
                                            'height' => '135px',
                                            'lazy'   => true,
                                            'title'  => $related_store->name ?? ''
                                        ])
                                    </a>
                                    <h3 class="title">
                                        <a href="{{ $related_store->getUrl() }}" class="fs-16 lh-20 f-w-b">{!! $related_store->name ?? '' !!}</a>
                                    </h3>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
