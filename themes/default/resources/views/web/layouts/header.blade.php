@php
    $menu_categories = json_decode(@$config_menu['menu_categories'], 1) ?? [];
    $primary_menu = json_decode(@$config_menu['primary_menu'], 1) ?? [];
@endphp
<header class="header {{ checkAgent() }}" id="header">
    @if(checkAgent() == 'web')
        <div class="header-middle sticky-header fix-top sticky-content">
            <div class="container">
                <div class="header-left">
                    <div class="header-left__item showroom">
                        <div class="item-icon">
                            <svg width="25" height="30" viewBox="0 0 25 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.336426 11.952C0.336426 5.46809 5.81719 0.145508 12.4999 0.145508C19.1826 0.145508 24.6633 5.4197 24.6633 11.952C24.6633 17.1294 17.3076 25.7423 14.1345 29.1778C13.7018 29.6616 13.1249 29.9036 12.4999 29.9036C11.8749 29.9036 11.298 29.6616 10.8653 29.1778C7.69219 25.6939 0.336426 17.1294 0.336426 11.952ZM12.1153 28.0165C12.3076 28.2584 12.6441 28.2584 12.8845 28.0165C15.2403 25.4036 22.9807 16.6455 22.9807 11.952C22.9807 6.38744 18.2691 1.83906 12.4999 1.83906C6.73066 1.83906 2.01912 6.33906 2.01912 11.952C2.01912 16.6455 9.7595 25.452 12.1153 28.0165Z" fill="#DE0200"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.30762 12.3391C7.30762 9.43586 9.66339 7.11328 12.4999 7.11328C15.3365 7.11328 17.6922 9.43586 17.6922 12.3391C17.6922 15.2423 15.3845 17.5649 12.4999 17.5649C9.61531 17.5649 7.30762 15.1939 7.30762 12.3391ZM8.99031 12.2907C8.99031 14.2262 10.5768 15.823 12.4999 15.823C14.423 15.823 16.0095 14.2262 16.0095 12.2907C16.0095 10.3552 14.423 8.75844 12.4999 8.75844C10.5768 8.75844 8.99031 10.3552 8.99031 12.2907Z" fill="#DE0200"/>
                            </svg>
                        </div>
                        <a class="item-content ml-10" href="{!! route('app.stores.index') !!}">
                            <p class="fs-14 lh-18 color-white">Hệ thống</p>
                            <p class="fs-14 lh-18 color-white">Showroom</p>
                        </a>
                    </div>
                    <div class="header-left__item phone_ord">
                        <div class="item-icon">
                            <svg width="24" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <mask id="mask0_0_1451" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="3" width="27" height="27">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 3.0498H26.9559V29.9996H0V3.0498Z" fill="white"/>
                                </mask>
                                <g mask="url(#mask0_0_1451)">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M20.5517 29.9996C20.0472 29.916 19.5394 29.8489 19.039 29.7456C17.7012 29.469 16.4496 28.9469 15.2319 28.3452C10.4088 25.9619 6.54753 22.4805 3.53286 18.0434C2.22421 16.1173 1.17873 14.0551 0.485771 11.8283C0.0826958 10.533 -0.154706 9.21051 0.115177 7.84523C0.242771 7.1995 0.521285 6.63029 0.979003 6.16277C1.76626 5.35878 2.55748 4.55776 3.37022 3.77978C4.38788 2.80579 5.52795 2.80428 6.53861 3.78847C7.72008 4.93897 8.87741 6.11437 10.036 7.28809C10.5525 7.81129 10.886 8.41958 10.772 9.19202C10.6869 9.76742 10.3582 10.2068 9.96283 10.6038C9.30567 11.2637 8.64304 11.9182 7.98413 12.5764C7.64205 12.9181 7.63506 13.0078 7.83012 13.445C8.58017 15.1263 9.72933 16.5252 10.9621 17.8617C12.19 19.193 13.5419 20.3854 15.0792 21.3506C15.6029 21.6794 16.1673 21.9431 16.7125 22.2376C16.9645 22.3737 17.1542 22.2695 17.3326 22.0897C18.0091 21.408 18.6831 20.7237 19.3691 20.0516C19.5752 19.8496 19.7999 19.6561 20.0456 19.5072C20.8266 19.0343 21.6854 19.1091 22.3939 19.6879C22.5363 19.8043 22.6753 19.9264 22.8056 20.0561C23.9055 21.1514 25.0113 22.2408 26.0952 23.3518C26.3615 23.6247 26.6098 23.944 26.7682 24.2873C27.1088 25.0257 26.9767 25.7638 26.4463 26.3483C25.5869 27.2954 24.677 28.1987 23.758 29.0892C23.2525 29.5788 22.6034 29.824 21.9089 29.9383C21.8241 29.9523 21.7413 29.9789 21.6576 29.9996H20.5517Z" fill="#DE0200"/>
                                </g>
                                <mask id="mask1_0_1451" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="15" y="0" width="15" height="15">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.0173 0.00390625H29.9487V14.223H15.0173V0.00390625Z" fill="white"/>
                                </mask>
                                <g mask="url(#mask1_0_1451)">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M29.9487 13.8152C29.188 13.9491 28.4273 14.0829 27.6309 14.223C27.0536 11.1108 25.6316 8.44977 23.3252 6.25925C21.0165 4.06654 18.255 2.75058 15.0173 2.27312C15.1252 1.51279 15.2318 0.761579 15.3393 0.00390625C16.8025 0.199195 18.191 0.564214 19.527 1.10525C22.0367 2.1215 24.1823 3.64158 25.9637 5.64321C27.6904 7.58364 28.9003 9.79989 29.5893 12.2836C29.7195 12.7529 29.8294 13.2277 29.9487 13.6999V13.8152Z" fill="#DE0200"/>
                                </g>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15 8.29561C15.106 7.52553 15.211 6.76226 15.3159 6C19.3113 6.46032 23.2072 9.81499 24 14.6028C23.2533 14.7347 22.506 14.8667 21.7516 15C20.9045 11.2913 18.6695 9.06719 15 8.29561Z" fill="#DE0200"/>
                            </svg>
                        </div>
                        <div class="item-content ml-10">
                            <p class="fs-14 lh-18 color-white">Đặt hàng</p>
                            <a href="tel:{!! $config_general['hotline'] ?? '19001891' !!}" class="fs-14 lh-18 color-white">{{ $config_general['hotline'] ?? '19001891' }}</a>
                        </div>
                    </div>
                    <div class="header-left__item phone_insurance">
                        <div class="item-icon">
                            <svg width="24" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <mask id="mask0_0_1451" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="3" width="27" height="27">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 3.0498H26.9559V29.9996H0V3.0498Z" fill="white"/>
                                </mask>
                                <g mask="url(#mask0_0_1451)">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M20.5517 29.9996C20.0472 29.916 19.5394 29.8489 19.039 29.7456C17.7012 29.469 16.4496 28.9469 15.2319 28.3452C10.4088 25.9619 6.54753 22.4805 3.53286 18.0434C2.22421 16.1173 1.17873 14.0551 0.485771 11.8283C0.0826958 10.533 -0.154706 9.21051 0.115177 7.84523C0.242771 7.1995 0.521285 6.63029 0.979003 6.16277C1.76626 5.35878 2.55748 4.55776 3.37022 3.77978C4.38788 2.80579 5.52795 2.80428 6.53861 3.78847C7.72008 4.93897 8.87741 6.11437 10.036 7.28809C10.5525 7.81129 10.886 8.41958 10.772 9.19202C10.6869 9.76742 10.3582 10.2068 9.96283 10.6038C9.30567 11.2637 8.64304 11.9182 7.98413 12.5764C7.64205 12.9181 7.63506 13.0078 7.83012 13.445C8.58017 15.1263 9.72933 16.5252 10.9621 17.8617C12.19 19.193 13.5419 20.3854 15.0792 21.3506C15.6029 21.6794 16.1673 21.9431 16.7125 22.2376C16.9645 22.3737 17.1542 22.2695 17.3326 22.0897C18.0091 21.408 18.6831 20.7237 19.3691 20.0516C19.5752 19.8496 19.7999 19.6561 20.0456 19.5072C20.8266 19.0343 21.6854 19.1091 22.3939 19.6879C22.5363 19.8043 22.6753 19.9264 22.8056 20.0561C23.9055 21.1514 25.0113 22.2408 26.0952 23.3518C26.3615 23.6247 26.6098 23.944 26.7682 24.2873C27.1088 25.0257 26.9767 25.7638 26.4463 26.3483C25.5869 27.2954 24.677 28.1987 23.758 29.0892C23.2525 29.5788 22.6034 29.824 21.9089 29.9383C21.8241 29.9523 21.7413 29.9789 21.6576 29.9996H20.5517Z" fill="#DE0200"/>
                                </g>
                                <mask id="mask1_0_1451" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="15" y="0" width="15" height="15">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.0173 0.00390625H29.9487V14.223H15.0173V0.00390625Z" fill="white"/>
                                </mask>
                                <g mask="url(#mask1_0_1451)">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M29.9487 13.8152C29.188 13.9491 28.4273 14.0829 27.6309 14.223C27.0536 11.1108 25.6316 8.44977 23.3252 6.25925C21.0165 4.06654 18.255 2.75058 15.0173 2.27312C15.1252 1.51279 15.2318 0.761579 15.3393 0.00390625C16.8025 0.199195 18.191 0.564214 19.527 1.10525C22.0367 2.1215 24.1823 3.64158 25.9637 5.64321C27.6904 7.58364 28.9003 9.79989 29.5893 12.2836C29.7195 12.7529 29.8294 13.2277 29.9487 13.6999V13.8152Z" fill="#DE0200"/>
                                </g>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15 8.29561C15.106 7.52553 15.211 6.76226 15.3159 6C19.3113 6.46032 23.2072 9.81499 24 14.6028C23.2533 14.7347 22.506 14.8667 21.7516 15C20.9045 11.2913 18.6695 9.06719 15 8.29561Z" fill="#DE0200"/>
                            </svg>
                        </div>
                        <div class="item-content ml-10">
                            <p class="fs-14 lh-18 color-white">Bảo hành</p>
                            <a href="tel:{!! $config_general['hotline_complain'] ?? '1800 558879' !!}" class="fs-14 lh-18 color-white">{!! $config_general['hotline_complain'] ?? '1800 558879' !!}</a>
                        </div>
                    </div>
                </div>
                <div class="header-logo">
                    <a href="/" class="logo">
                        @include('Default::general.components.image', [
                            'src' => resizeWImage($config_general['logo_header']??'', 0),
                            'width' => '170px',
                            'height' => '55px',
                            'lazy'   => true,
                            'title'  => ''
                        ])
                    </a>
                </div>
                <div class="header-right flex w-100">
                    <div class="header-search">
                        <form action="{{ route('app.search.index') }}" class="input-wrapper flex" method="get">
                            <input type="text" id="suggest_products" class="form-control" name="keyword" value="{{ $keword ?? '' }}" autocomplete="off"
                                placeholder="Tìm kiếm sản phẩm" required />
                            <button class="btn btn-search" type="submit" aria-label="btn-search">
                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.6575 11.723L16.8063 15.8717C17.0645 16.1298 17.0645 16.5483 16.8064 16.8064C16.6773 16.9355 16.5081 17 16.339 17C16.1699 17 16.0007 16.9355 15.8717 16.8064L11.7228 12.6576C10.4826 13.6888 8.89011 14.31 7.15507 14.31C3.20974 14.31 0 11.1004 0 7.15527C0 3.20984 3.20974 0 7.15507 0C11.1003 0 14.3101 3.20984 14.3101 7.15527C14.3101 8.8904 13.6888 10.4829 12.6575 11.723ZM7.15508 1.3219C3.93864 1.3219 1.3219 3.93874 1.3219 7.15527C1.3219 10.3715 3.93864 12.9881 7.15508 12.9881C10.3714 12.9881 12.9881 10.3715 12.9881 7.15527C12.9881 3.93874 10.3714 1.3219 7.15508 1.3219Z" fill="white"/>
                                </svg>
                            </button>
                        </form>
                        <div class="suggest-search">
                            @foreach($parentCatesProducts as $parentCatesProduct)
                                <div class="suggest-search__item"><a class="text" href="{{$parentCatesProduct->getUrl() ?? 'javascript:;'}}">{{$parentCatesProduct->name}}</a></div>
                                @if(count($parentCatesProduct->childrenCates) > 0)
                                @foreach($parentCatesProduct->childrenCates as $categoryChild)
                                    <div class="suggest-search__item"><a class="text" href="{{$categoryChild->getUrl() ?? 'javascript:;'}}">&nbsp;---&nbsp;{{$categoryChild->name}}</a></div>
                                @endforeach
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="header-cart flex">
                        <a href="{{ route('app.sale.index') }}" class="header-cart__icon w-100 flex">
                            <svg width="30" height="31" viewBox="0 0 30 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.5998 21.1165C19.0408 21.1165 20.4818 21.1186 21.9226 21.1154C22.469 21.1142 22.8587 20.7496 22.8647 20.2486C22.8709 19.7371 22.4747 19.3666 21.913 19.3623C21.5527 19.3596 21.1925 19.3618 20.8323 19.3618C18.3301 19.3618 15.8279 19.3637 13.3258 19.3598C12.931 19.3591 12.6192 19.4914 12.4362 19.8516C12.1306 20.4531 12.5673 21.1126 13.277 21.115C14.7179 21.12 16.1588 21.1165 17.5998 21.1165ZM17.6326 15.8522C15.5874 15.8522 13.5423 15.8502 11.4972 15.8537C11.0127 15.8545 10.6416 16.1823 10.5892 16.6333C10.5385 17.0695 10.8339 17.4844 11.2784 17.5829C11.4 17.6099 11.5297 17.606 11.6558 17.606C14.6553 17.6071 17.6548 17.6069 20.6543 17.6069C21.6672 17.6069 22.68 17.6072 23.6928 17.6067C24.0924 17.6064 24.3899 17.4311 24.5488 17.0632C24.8053 16.4695 24.3643 15.8547 23.6803 15.8535C21.6644 15.8498 19.6484 15.8521 17.6326 15.8522ZM29.9426 9.94417C29.7278 10.6485 29.5056 11.3506 29.2995 12.0574C28.3243 15.4009 27.3538 18.7459 26.381 22.0902C26.2131 22.6678 25.9445 22.871 25.3469 22.8711C20.1824 22.8716 15.018 22.8716 9.85344 22.8711C9.25795 22.871 8.98502 22.6625 8.82454 22.0853C7.46182 17.1831 6.09969 12.2807 4.73721 7.37835C4.71137 7.28554 4.68272 7.19349 4.64856 7.07794H4.32981C3.20926 7.07794 2.08866 7.07952 0.968051 7.07724C0.399106 7.07606 0.00348107 6.71659 2.4036e-05 6.20583C-0.00355018 5.69349 0.39184 5.32487 0.95686 5.32394C2.37952 5.32165 3.80223 5.32177 5.22489 5.32394C5.75809 5.3247 6.04954 5.55081 6.19608 6.0723C6.43022 6.90585 6.6609 7.7404 6.89364 8.57437C6.91678 8.65728 6.94432 8.7389 6.97344 8.83276C8.2403 8.83276 9.49672 8.84009 10.7529 8.82644C10.9978 8.8238 11.0975 8.90425 11.1876 9.1286C12.4413 12.2504 15.4502 14.2609 18.8076 14.076C22.1345 13.8928 24.4421 12.153 25.7752 9.11437C25.8681 8.90261 25.9562 8.82198 26.1918 8.82638C27.0587 8.84249 27.9268 8.85345 28.7931 8.82521C29.3304 8.80763 29.7169 8.9806 29.9426 9.47618V9.94417Z" fill="#DE0200"/>
                                <mask id="mask0_0_1435" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="9" y="24" width="6" height="6">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.70898 24.626H14.9692V29.949H9.70898V24.626Z" fill="white"/>
                                </mask>
                                <g mask="url(#mask0_0_1435)">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9881 29.949C11.327 29.7944 10.7502 29.5003 10.3147 28.9605C9.55953 28.0245 9.5041 26.7189 10.1843 25.752C10.8593 24.7924 12.0863 24.3892 13.1858 24.7656C14.2996 25.1468 15.0226 26.2195 14.9661 27.4065C14.9093 28.5993 14.0201 29.6445 12.8518 29.8938C12.7964 29.9055 12.7438 29.9303 12.6898 29.949H11.9881Z" fill="#DE0200"/>
                                </g>
                                <mask id="mask1_0_1435" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="20" y="24" width="6" height="6">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M20.2358 24.626H25.4961V29.9489H20.2358V24.626Z" fill="white"/>
                                </mask>
                                <g mask="url(#mask1_0_1435)">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M22.5153 29.949C21.8327 29.7908 21.2438 29.4806 20.8063 28.9142C20.0765 27.9697 20.0429 26.6836 20.7287 25.7286C21.406 24.7855 22.6237 24.3925 23.7129 24.7655C24.8168 25.1434 25.5375 26.2001 25.4943 27.3771C25.45 28.5817 24.5579 29.6423 23.3791 29.8937C23.3237 29.9055 23.2711 29.9303 23.2171 29.949H22.5153Z" fill="#DE0200"/>
                                </g>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.6613 5.32272C17.3505 5.32272 17.0876 5.31932 16.8248 5.32342C16.3022 5.33168 15.9148 5.6983 15.9076 6.18656C15.9002 6.68748 16.2913 7.06799 16.8275 7.07655C17.0973 7.08088 17.3672 7.07731 17.6611 7.07731C17.6611 7.3599 17.6597 7.61115 17.6614 7.86235C17.6652 8.43217 18.0214 8.82762 18.5323 8.83119C19.044 8.83477 19.4101 8.43914 19.4151 7.87418C19.4176 7.61479 19.4155 7.35533 19.4155 7.07737C19.7045 7.07737 19.9563 7.07918 20.2081 7.07701C20.7748 7.07227 21.1697 6.70992 21.1687 6.19781C21.1678 5.68641 20.7722 5.32682 20.2042 5.32295C19.9457 5.32119 19.6871 5.32266 19.4154 5.32266C19.4154 5.01744 19.4188 4.755 19.4148 4.49274C19.4064 3.95338 19.0304 3.56332 18.529 3.5686C18.0392 3.57381 17.6708 3.95948 17.6621 4.48207C17.6576 4.75248 17.6613 5.02301 17.6613 5.32272ZM18.4859 12.3417C15.1071 12.3444 12.3456 9.59215 12.3394 6.21574C12.3329 2.81074 15.1039 0.00287339 18.4733 2.29511e-06C21.8453 -0.00292739 24.6221 2.79932 24.6203 6.20321C24.6185 9.58272 21.8641 12.3389 18.4859 12.3417Z" fill="#DE0200"/>
                            </svg>
                            <span class="color-white">Giỏ hàng</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <div class="header-left">
                    <nav class="main-nav">
                        <ul class="menu">
                            <li class="menu_level1 menu_cate  {{ \Auth::guard('admin')->check() ? 'logined' : '' }}">
                                <a class="menu-lv1 color-white text-up fs-16 lh-19" rel="" href="javascript:;" target="_self">
                                    Danh mục sản phẩm
                                    @if(count($menu_categories) > 0)
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="14px" height="14px">
                                            <path d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z"/>
                                        </svg>
                                    @endif
                                 </a>
                               {{--  @if((Route::getCurrentRoute() != null) && (Route::getCurrentRoute()->uri() != '/') && (count($menu_categories) > 0)) --}}
                                    <ul class="submenu {{ Route::getCurrentRoute()->uri() == '/' ? 'none menu_home' : ''}}">
                                        @foreach($menu_categories as $menu_lv1)
                                        <li class="submenu_item flex">
                                            <a class="menu-lv2 fs-16 lh-19 @if(isset($menu_lv1['children']) && count($menu_lv1['children'])> 0) has_child @endif" rel="{{ $menu_lv1['rel'] ?? '' }}" href="{{ $menu_lv1['link'] ?? '' }}" target="{{ $menu_lv1['target'] == '_blank' ? 'blank' : '_self' }}">
                                                @include('Default::general.components.image', [
                                                    'src' => resizeWImage($menu_lv1['thumbnail'] ?? '', 0),
                                                    'width' => '20px',
                                                    'height' => '20px',
                                                    'lazy'   => true,
                                                    'title'  => $menu_lv1['name'] ?? ''
                                                ])
                                                {{ $menu_lv1['name'] ?? '' }}
                                            </a>
                                            @if(isset($menu_lv1['children']) && count($menu_lv1['children'])> 0)
                                                <ul class="submenu_item_child">
                                                    @foreach($menu_lv1['children'] as $menu_lv2)
                                                        <li class="item">
                                                            <a class="menu_item" href="{{ $menu_lv2['link'] ?? '' }}" rel="{{ $menu_lv2['rel'] ?? '' }}" target="{{ $menu_lv2['target'] == '_blank' ? 'blank' : '_self' }}">{!! $menu_lv2['name'] ?? '' !!}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                {{-- @endif --}}
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="header-right">
                    @if(count($primary_menu))
                        @foreach($primary_menu as $menu_lv1)
                            <div class="header-right__item">
                                <a rel="{{ $menu_lv1['rel'] ?? '' }}" href="{{ $menu_lv1['link'] ?? '' }}" target="{{ $menu_lv1['target'] == '_blank' ? 'blank' : '_self' }}" class="header-right__item--title fs-16 lh-19 color-white text-up flex">
                                    @if(!empty($menu_lv1['thumbnail'] ?? ''))
                                        @include('Default::general.components.image', [
                                            'src' => resizeWImage($menu_lv1['thumbnail'] ?? '', 0),
                                            'width' => '20px',
                                            'height' => '20px',
                                            'lazy'   => true,
                                            'title'  => $menu_lv1['name'] ?? ''
                                        ])
                                    @endif
                                    {{ $menu_lv1['name'] ?? '' }}
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    @else
        <div id="overlay-menu-mobile"></div>
        <div class="header_mobile">
            <div class="header_mobile__top">
                <div class="container">
                    <div class="head flex-center-between w-100">
                        <div class="logo">
                            <a href="/">
                                @include('Default::general.components.image', [
                                    'src' => resizeWImage($config_general['logo_header_mobile']??'', 0),
                                    'width' => '250px',
                                    'height' => '50px',
                                    'lazy'   => true,
                                    'title'  => ''
                                ])
                            </a>
                        </div>
                        <div class="menu-search">
                            <form method="GET" action="{{ route('app.search.index') }}" class="heade-search__form flex-center-between w-100">
                                <input for="keyword" type="text" id="keyword" name="keyword" autocomplete="off" value="{{ $keyword ?? '' }}" placeholder="Tìm kiếm sản phẩm">
                                <button class="search-btn" name="btn-search" aria-label="btn-search">
                                    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12.6575 11.723L16.8063 15.8717C17.0645 16.1298 17.0645 16.5483 16.8064 16.8064C16.6773 16.9355 16.5081 17 16.339 17C16.1699 17 16.0007 16.9355 15.8717 16.8064L11.7228 12.6576C10.4826 13.6888 8.89011 14.31 7.15507 14.31C3.20974 14.31 0 11.1004 0 7.15527C0 3.20984 3.20974 0 7.15507 0C11.1003 0 14.3101 3.20984 14.3101 7.15527C14.3101 8.8904 13.6888 10.4829 12.6575 11.723ZM7.15508 1.3219C3.93864 1.3219 1.3219 3.93874 1.3219 7.15527C1.3219 10.3715 3.93864 12.9881 7.15508 12.9881C10.3714 12.9881 12.9881 10.3715 12.9881 7.15527C12.9881 3.93874 10.3714 1.3219 7.15508 1.3219Z" fill="white"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                        <div class="menu-icon">
                            <svg fill="#db0b07" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="30" height="30"><path d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"/></svg>
                        </div>
                        
                        {{--<div class="cart-icon">
                            <a href="{{ route('app.sale.index') }}" class="header-cart__icon w-100 flex">
                                <svg width="30" height="31" viewBox="0 0 30 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.5998 21.1165C19.0408 21.1165 20.4818 21.1186 21.9226 21.1154C22.469 21.1142 22.8587 20.7496 22.8647 20.2486C22.8709 19.7371 22.4747 19.3666 21.913 19.3623C21.5527 19.3596 21.1925 19.3618 20.8323 19.3618C18.3301 19.3618 15.8279 19.3637 13.3258 19.3598C12.931 19.3591 12.6192 19.4914 12.4362 19.8516C12.1306 20.4531 12.5673 21.1126 13.277 21.115C14.7179 21.12 16.1588 21.1165 17.5998 21.1165ZM17.6326 15.8522C15.5874 15.8522 13.5423 15.8502 11.4972 15.8537C11.0127 15.8545 10.6416 16.1823 10.5892 16.6333C10.5385 17.0695 10.8339 17.4844 11.2784 17.5829C11.4 17.6099 11.5297 17.606 11.6558 17.606C14.6553 17.6071 17.6548 17.6069 20.6543 17.6069C21.6672 17.6069 22.68 17.6072 23.6928 17.6067C24.0924 17.6064 24.3899 17.4311 24.5488 17.0632C24.8053 16.4695 24.3643 15.8547 23.6803 15.8535C21.6644 15.8498 19.6484 15.8521 17.6326 15.8522ZM29.9426 9.94417C29.7278 10.6485 29.5056 11.3506 29.2995 12.0574C28.3243 15.4009 27.3538 18.7459 26.381 22.0902C26.2131 22.6678 25.9445 22.871 25.3469 22.8711C20.1824 22.8716 15.018 22.8716 9.85344 22.8711C9.25795 22.871 8.98502 22.6625 8.82454 22.0853C7.46182 17.1831 6.09969 12.2807 4.73721 7.37835C4.71137 7.28554 4.68272 7.19349 4.64856 7.07794H4.32981C3.20926 7.07794 2.08866 7.07952 0.968051 7.07724C0.399106 7.07606 0.00348107 6.71659 2.4036e-05 6.20583C-0.00355018 5.69349 0.39184 5.32487 0.95686 5.32394C2.37952 5.32165 3.80223 5.32177 5.22489 5.32394C5.75809 5.3247 6.04954 5.55081 6.19608 6.0723C6.43022 6.90585 6.6609 7.7404 6.89364 8.57437C6.91678 8.65728 6.94432 8.7389 6.97344 8.83276C8.2403 8.83276 9.49672 8.84009 10.7529 8.82644C10.9978 8.8238 11.0975 8.90425 11.1876 9.1286C12.4413 12.2504 15.4502 14.2609 18.8076 14.076C22.1345 13.8928 24.4421 12.153 25.7752 9.11437C25.8681 8.90261 25.9562 8.82198 26.1918 8.82638C27.0587 8.84249 27.9268 8.85345 28.7931 8.82521C29.3304 8.80763 29.7169 8.9806 29.9426 9.47618V9.94417Z" fill="#DE0200"/>
                                    <mask id="mask0_0_1435" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="9" y="24" width="6" height="6">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.70898 24.626H14.9692V29.949H9.70898V24.626Z" fill="white"/>
                                    </mask>
                                    <g mask="url(#mask0_0_1435)">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9881 29.949C11.327 29.7944 10.7502 29.5003 10.3147 28.9605C9.55953 28.0245 9.5041 26.7189 10.1843 25.752C10.8593 24.7924 12.0863 24.3892 13.1858 24.7656C14.2996 25.1468 15.0226 26.2195 14.9661 27.4065C14.9093 28.5993 14.0201 29.6445 12.8518 29.8938C12.7964 29.9055 12.7438 29.9303 12.6898 29.949H11.9881Z" fill="#DE0200"/>
                                    </g>
                                    <mask id="mask1_0_1435" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="20" y="24" width="6" height="6">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M20.2358 24.626H25.4961V29.9489H20.2358V24.626Z" fill="white"/>
                                    </mask>
                                    <g mask="url(#mask1_0_1435)">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M22.5153 29.949C21.8327 29.7908 21.2438 29.4806 20.8063 28.9142C20.0765 27.9697 20.0429 26.6836 20.7287 25.7286C21.406 24.7855 22.6237 24.3925 23.7129 24.7655C24.8168 25.1434 25.5375 26.2001 25.4943 27.3771C25.45 28.5817 24.5579 29.6423 23.3791 29.8937C23.3237 29.9055 23.2711 29.9303 23.2171 29.949H22.5153Z" fill="#DE0200"/>
                                    </g>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.6613 5.32272C17.3505 5.32272 17.0876 5.31932 16.8248 5.32342C16.3022 5.33168 15.9148 5.6983 15.9076 6.18656C15.9002 6.68748 16.2913 7.06799 16.8275 7.07655C17.0973 7.08088 17.3672 7.07731 17.6611 7.07731C17.6611 7.3599 17.6597 7.61115 17.6614 7.86235C17.6652 8.43217 18.0214 8.82762 18.5323 8.83119C19.044 8.83477 19.4101 8.43914 19.4151 7.87418C19.4176 7.61479 19.4155 7.35533 19.4155 7.07737C19.7045 7.07737 19.9563 7.07918 20.2081 7.07701C20.7748 7.07227 21.1697 6.70992 21.1687 6.19781C21.1678 5.68641 20.7722 5.32682 20.2042 5.32295C19.9457 5.32119 19.6871 5.32266 19.4154 5.32266C19.4154 5.01744 19.4188 4.755 19.4148 4.49274C19.4064 3.95338 19.0304 3.56332 18.529 3.5686C18.0392 3.57381 17.6708 3.95948 17.6621 4.48207C17.6576 4.75248 17.6613 5.02301 17.6613 5.32272ZM18.4859 12.3417C15.1071 12.3444 12.3456 9.59215 12.3394 6.21574C12.3329 2.81074 15.1039 0.00287339 18.4733 2.29511e-06C21.8453 -0.00292739 24.6221 2.79932 24.6203 6.20321C24.6185 9.58272 21.8641 12.3389 18.4859 12.3417Z" fill="#DE0200"/>
                                </svg>
                            </a>
                        </div>--}}
                    </div>
                </div>
            </div>
            <div class="header_mobile__menu">
                <div class="head flex-center-between w-100">
                    <a href="/">
                        @include('Default::general.components.image', [
                            'src' => resizeWImage($config_general['logo_header_mobile']??'', 0),
                            'width' => '250px',
                            'height' => '50px',
                            'lazy'   => true,
                            'title'  => ''
                        ])
                    </a>
                    <span class="menu-close">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg>
                    </span>
                </div>
                <div class="container">
                    <div class="menu-content w-100">
                        <ul class="menu-content__top w-100">
                            @if(count($primary_menu))
                                @foreach($primary_menu as $menu_lv1)
                                    <li class="menu_item flex">
                                        <a rel="{{ $menu_lv1['rel'] ?? '' }}" href="{{ $menu_lv1['link'] ?? '' }}" target="{{ $menu_lv1['target'] == '_blank' ? 'blank' : '_self' }}">
                                            @if(!empty($menu_lv1['thumbnail'] ?? ''))
                                                @include('Default::general.components.image', [
                                                    'src' => resizeWImage($menu_lv1['thumbnail'] ?? '', 0),
                                                    'width' => '20px',
                                                    'height' => '20px',
                                                    'lazy'   => true,
                                                    'title'  => $menu_lv1['name'] ?? ''
                                                ])
                                            @endif
                                            {{ $menu_lv1['name'] ?? '' }}
                                        </a>
                                        @if(isset($menu_lv1['children']) && count($menu_lv1['children']) > 0)
                                        <span class="icon-down">&nbsp</span>
                                        @endif
                                        @if(isset($menu_lv1['children']) && count($menu_lv1['children'])> 0)
                                            <ul class="list_child3">
                                                @foreach($menu_lv1['children'] as $menu_lv2)
                                                    <li class="list_child3__item">
                                                        <a class="menu_item" href="{{ $menu_lv2['link'] ?? '' }}" rel="{{ $menu_lv2['rel'] ?? '' }}" target="{{ $menu_lv2['target'] == '_blank' ? 'blank' : '_self' }}">{!! $menu_lv2['name'] ?? '' !!}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach           
                            @endif
                            @if(isset($menu_categories) && count($menu_categories) > 0)
                                <li class="menu_item flex">
                                    <a href="javascript:;">Danh mục sản phẩm</a>
                                    <span class="icon-down icon-down-lv1">&nbsp</span>
                                    <ul class="list_child2">
                                        @foreach($menu_categories as $m => $menu_lv1)
                                            <li class="list_child2__item flex menu-item">
                                                <a href="{{ $menu_lv1['link']?? '/' }}">
                                                    @if(!empty($menu_lv1['thumbnail'] ?? ''))
                                                        @include('Default::general.components.image', [
                                                            'src' => resizeWImage($menu_lv1['thumbnail'] ?? '', 0),
                                                            'width' => '20px',
                                                            'height' => '20px',
                                                            'lazy'   => true,
                                                            'title'  => $menu_lv1['name'] ?? ''
                                                        ])
                                                    @endif
                                                    {!! $menu_lv1['name'] !!}
                                                </a>
                                                @if(isset($menu_lv1['children']) && count($menu_lv1['children']) > 0)
                                                <span class="icon-down">&nbsp</span>
                                                @endif
                                                @if(isset($menu_lv1['children']) && count($menu_lv1['children'])> 0)
                                                    <ul class="list_child3">
                                                        @foreach($menu_lv1['children'] as $menu_lv2)
                                                            <li class="list_child3__item">
                                                                <a class="menu_item" href="{{ $menu_lv2['link'] ?? '' }}" rel="{{ $menu_lv2['rel'] ?? '' }}" target="{{ $menu_lv2['target'] == '_blank' ? 'blank' : '_self' }}">{!! $menu_lv2['name'] ?? '' !!}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        </ul>
                        <div class="menu-content__info">
                            <div class="item w-100 mb-10 fs-20 lh-26 flex-center-left">
                                <svg width="24" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <mask id="mask0_0_1451" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="3" width="27" height="27">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 3.0498H26.9559V29.9996H0V3.0498Z" fill="white"/>
                                    </mask>
                                    <g mask="url(#mask0_0_1451)">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M20.5517 29.9996C20.0472 29.916 19.5394 29.8489 19.039 29.7456C17.7012 29.469 16.4496 28.9469 15.2319 28.3452C10.4088 25.9619 6.54753 22.4805 3.53286 18.0434C2.22421 16.1173 1.17873 14.0551 0.485771 11.8283C0.0826958 10.533 -0.154706 9.21051 0.115177 7.84523C0.242771 7.1995 0.521285 6.63029 0.979003 6.16277C1.76626 5.35878 2.55748 4.55776 3.37022 3.77978C4.38788 2.80579 5.52795 2.80428 6.53861 3.78847C7.72008 4.93897 8.87741 6.11437 10.036 7.28809C10.5525 7.81129 10.886 8.41958 10.772 9.19202C10.6869 9.76742 10.3582 10.2068 9.96283 10.6038C9.30567 11.2637 8.64304 11.9182 7.98413 12.5764C7.64205 12.9181 7.63506 13.0078 7.83012 13.445C8.58017 15.1263 9.72933 16.5252 10.9621 17.8617C12.19 19.193 13.5419 20.3854 15.0792 21.3506C15.6029 21.6794 16.1673 21.9431 16.7125 22.2376C16.9645 22.3737 17.1542 22.2695 17.3326 22.0897C18.0091 21.408 18.6831 20.7237 19.3691 20.0516C19.5752 19.8496 19.7999 19.6561 20.0456 19.5072C20.8266 19.0343 21.6854 19.1091 22.3939 19.6879C22.5363 19.8043 22.6753 19.9264 22.8056 20.0561C23.9055 21.1514 25.0113 22.2408 26.0952 23.3518C26.3615 23.6247 26.6098 23.944 26.7682 24.2873C27.1088 25.0257 26.9767 25.7638 26.4463 26.3483C25.5869 27.2954 24.677 28.1987 23.758 29.0892C23.2525 29.5788 22.6034 29.824 21.9089 29.9383C21.8241 29.9523 21.7413 29.9789 21.6576 29.9996H20.5517Z" fill="#DE0200"/>
                                    </g>
                                    <mask id="mask1_0_1451" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="15" y="0" width="15" height="15">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.0173 0.00390625H29.9487V14.223H15.0173V0.00390625Z" fill="white"/>
                                    </mask>
                                    <g mask="url(#mask1_0_1451)">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M29.9487 13.8152C29.188 13.9491 28.4273 14.0829 27.6309 14.223C27.0536 11.1108 25.6316 8.44977 23.3252 6.25925C21.0165 4.06654 18.255 2.75058 15.0173 2.27312C15.1252 1.51279 15.2318 0.761579 15.3393 0.00390625C16.8025 0.199195 18.191 0.564214 19.527 1.10525C22.0367 2.1215 24.1823 3.64158 25.9637 5.64321C27.6904 7.58364 28.9003 9.79989 29.5893 12.2836C29.7195 12.7529 29.8294 13.2277 29.9487 13.6999V13.8152Z" fill="#DE0200"/>
                                    </g>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15 8.29561C15.106 7.52553 15.211 6.76226 15.3159 6C19.3113 6.46032 23.2072 9.81499 24 14.6028C23.2533 14.7347 22.506 14.8667 21.7516 15C20.9045 11.2913 18.6695 9.06719 15 8.29561Z" fill="#DE0200"/>
                                </svg>
                                <span>
                                    Đặt hàng: <a class="phone-number" href="tel:{{ $config_general['hotline'] ?? '19001891' }}">{!! $config_general['hotline'] ?? '19001891' !!}</a>
                                </span>
                            </div>
                            <div class="item w-100 mb-10 fs-20 lh-26 flex-center-left">
                                <svg width="24" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <mask id="mask0_0_1451" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="3" width="27" height="27">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 3.0498H26.9559V29.9996H0V3.0498Z" fill="white"/>
                                    </mask>
                                    <g mask="url(#mask0_0_1451)">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M20.5517 29.9996C20.0472 29.916 19.5394 29.8489 19.039 29.7456C17.7012 29.469 16.4496 28.9469 15.2319 28.3452C10.4088 25.9619 6.54753 22.4805 3.53286 18.0434C2.22421 16.1173 1.17873 14.0551 0.485771 11.8283C0.0826958 10.533 -0.154706 9.21051 0.115177 7.84523C0.242771 7.1995 0.521285 6.63029 0.979003 6.16277C1.76626 5.35878 2.55748 4.55776 3.37022 3.77978C4.38788 2.80579 5.52795 2.80428 6.53861 3.78847C7.72008 4.93897 8.87741 6.11437 10.036 7.28809C10.5525 7.81129 10.886 8.41958 10.772 9.19202C10.6869 9.76742 10.3582 10.2068 9.96283 10.6038C9.30567 11.2637 8.64304 11.9182 7.98413 12.5764C7.64205 12.9181 7.63506 13.0078 7.83012 13.445C8.58017 15.1263 9.72933 16.5252 10.9621 17.8617C12.19 19.193 13.5419 20.3854 15.0792 21.3506C15.6029 21.6794 16.1673 21.9431 16.7125 22.2376C16.9645 22.3737 17.1542 22.2695 17.3326 22.0897C18.0091 21.408 18.6831 20.7237 19.3691 20.0516C19.5752 19.8496 19.7999 19.6561 20.0456 19.5072C20.8266 19.0343 21.6854 19.1091 22.3939 19.6879C22.5363 19.8043 22.6753 19.9264 22.8056 20.0561C23.9055 21.1514 25.0113 22.2408 26.0952 23.3518C26.3615 23.6247 26.6098 23.944 26.7682 24.2873C27.1088 25.0257 26.9767 25.7638 26.4463 26.3483C25.5869 27.2954 24.677 28.1987 23.758 29.0892C23.2525 29.5788 22.6034 29.824 21.9089 29.9383C21.8241 29.9523 21.7413 29.9789 21.6576 29.9996H20.5517Z" fill="#DE0200"/>
                                    </g>
                                    <mask id="mask1_0_1451" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="15" y="0" width="15" height="15">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.0173 0.00390625H29.9487V14.223H15.0173V0.00390625Z" fill="white"/>
                                    </mask>
                                    <g mask="url(#mask1_0_1451)">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M29.9487 13.8152C29.188 13.9491 28.4273 14.0829 27.6309 14.223C27.0536 11.1108 25.6316 8.44977 23.3252 6.25925C21.0165 4.06654 18.255 2.75058 15.0173 2.27312C15.1252 1.51279 15.2318 0.761579 15.3393 0.00390625C16.8025 0.199195 18.191 0.564214 19.527 1.10525C22.0367 2.1215 24.1823 3.64158 25.9637 5.64321C27.6904 7.58364 28.9003 9.79989 29.5893 12.2836C29.7195 12.7529 29.8294 13.2277 29.9487 13.6999V13.8152Z" fill="#DE0200"/>
                                    </g>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15 8.29561C15.106 7.52553 15.211 6.76226 15.3159 6C19.3113 6.46032 23.2072 9.81499 24 14.6028C23.2533 14.7347 22.506 14.8667 21.7516 15C20.9045 11.2913 18.6695 9.06719 15 8.29561Z" fill="#DE0200"/>
                                </svg>
                                <span>
                                    Bảo hành: <a class="phone-number" href="tel:{{ $config_general['hotline_complain'] ?? '1800 558879' }}">{!! $config_general['hotline_complain'] ?? '1800 558879' !!}</a>
                                </span>
                            </div>
                            <div class="item fs-20 lh-26">{!! $config_general['time_work'] ?? '' !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if((Route::getCurrentRoute() != null) && (Route::getCurrentRoute()->uri() === '/'))
        <div class="banner pb-63 {{ checkAgent() }}">
            <div class="container">
                <div class="contents">
                    @if(checkAgent() == 'web')
                        <div class="category-product mr-11">
                            <ul class="category-product__list">
                                @foreach($menu_categories as $menu_lv1)
                                    <li class="item_cate__name item_cate flex">
                                        <a class="fs-16 lh-19 @if(isset($menu_lv1['children']) && count($menu_lv1['children'])> 0) has_child @endif" rel="{{ $menu_lv1['rel'] ?? '' }}" href="{{ $menu_lv1['link'] ?? '' }}" target="{{ $menu_lv1['target'] == '_blank' ? 'blank' : '_self' }}">
                                            @include('Default::general.components.image', [
                                                'src' => resizeWImage($menu_lv1['thumbnail'] ?? '', 0),
                                                'width' => '20px',
                                                'height' => '20px',
                                                'lazy'   => true,
                                                'title'  => $menu_lv1['name'] ?? ''
                                            ])
                                            {{ $menu_lv1['name'] ?? '' }}
                                        </a>
                                        @if(isset($menu_lv1['children']) && count($menu_lv1['children'])> 0)
                                            <ul class="item_cate_child">
                                                @foreach($menu_lv1['children'] as $menu_lv2)
                                                    <li class="item">
                                                        <a class="menu_item" href="{{ $menu_lv2['link'] ?? '' }}" rel="{{ $menu_lv2['rel'] ?? '' }}" target="{{ $menu_lv2['target'] == '_blank' ? 'blank' : '_self' }}">{!! $menu_lv2['name'] ?? '' !!}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(isset($slides) && count($slides))
                        <div class="banner-slide mt-13">
                            <div class="banner-slide__list owl-carousel">
                                @foreach ($slides as $key=>$slide)
                                <div class="item">
                                    <a href="{{ $slide->link }}">
                                        @if($key == 0)
                                            @include('Default::general.components.image', [
                                                'src' => resizeWImage($slide->image ?? '', 0),
                                                'width' => '895px',
                                                'height' => '370px',
                                                'lazy'   => false,
                                                'title'  => $slide->name ?? ''
                                            ])
                                        @else
                                            @include('Default::general.components.image', [
                                                'src' => resizeWImage($slide->image ?? '', 0),
                                                'width' => '895px',
                                                'height' => '370px',
                                                'lazy'   => true,
                                                'title'  => $slide->name ?? ''
                                            ])
                                        @endif
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                @php
                    $afterSlides = $setting_home['afterSlides'] ?? [];
                    $afterSlidesImage = $afterSlides['image'] ?? [];
                    $afterSlidesLink = $afterSlides['link'] ?? [];
                @endphp
                @if(count($afterSlidesImage))
                    <div class="mt-12 banner-list flex w-100">
                        @foreach ($afterSlidesImage as $itemKey => $item)
                            @if($itemKey < 2)
                                <div class="banner-list__item">
                                    <a href="{{ $afterSlidesLink[$itemKey] ?? 'javascript:;' }}">
                                        @include('Default::general.components.image', [
                                            'src' => resizeWImage($item, 0),
                                            'width' => '558px',
                                            'height' => '223px',
                                            'lazy'   => true,
                                            'title'  => $menu_lv1['name'] ?? ''
                                        ])
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    @endif
</header>
