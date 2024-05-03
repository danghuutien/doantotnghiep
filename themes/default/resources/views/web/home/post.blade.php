@if(isset($posts) && count($posts))
    <div class="mt-65 posts">
        <div class="container">
            <div class="posts-title flex">
                <h2 class="f-w-b"><a href="{{ route('app.post_categories.index') }}">{{__('Tin tức')}}</a>
                </h2>
                @if($postCates)
                    <ul class="orther-postcate flex">
                        @foreach($postCates as $postCate)
                            <li><a href="{{$postCate->getUrl() ?? ''}}">
                                {{$postCate->name ?? ''}}
                            </a></li>
                        @endforeach
                    </ul>
                @endif
                <a href="{{ route('app.post_categories.index') }}" class="see-all fs-16 lh-19">
                    Xem tất cả tin
                    <svg width="7" height="10" viewBox="0 0 7 10" fill="#343A40" xmlns="http://www.w3.org/2000/svg">
                        <g filter="url(#filter0_d_0_392)">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7 4.5L0 0L0 9L7 4.5Z" fill="#343A40"/>
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
            <div class="posts-content mb-15">
                <div class="posts-content__top flex">
                    @php $ids = []; @endphp
                    @foreach ($posts->chunk(2)->first() as $k => $post)
                        @php
                            $w = 300;
                            if($k == 0) $w = 800;
                            $ids[] = $post->id;
                        @endphp
                        <div class="item">
                            <div class="item-image">
                                <a href="{{ $post->getUrl() }}">
                                    @include('Default::general.components.image', [
                                        'src' => resizeWImage($post->image, 'w'.$w),
                                        'width' => $w.'px',
                                        'height' => $w.'px',
                                        'lazy'   => true,
                                        'title'  => $post->name ?? ''
                                    ])
                                </a>
                            </div>
                            <div class="item-content">
                                <h3 class="item-content_category mb-17">
                                    <a href="{{ $post->postCategoryMap->category->getUrl() }}" class="color-white text-up fw-600 fs-12">{!! $post->postCategoryMap->category->name ?? '' !!}</a>
                                </h3>
                                <h3 class="item-content__title mt-11">
                                    <a href="{{ $post->getUrl() }}" class="fs-22-lh-30 f-w-b color-white">{{ $post->getName() }}</a>
                                </h3>
                            </div>
                        </div>
                    @endforeach
                </div>
                @php
                    $lastsPosts = $posts->whereNotIn('id', $ids);
                @endphp
                <div class="posts-content__bottom mt-24 flex">
                    @foreach ($lastsPosts as $last)
                        <div class="item">
                            <div class="item-image">
                                <a href="{{ $last->getUrl() }}">
                                    @include('Default::general.components.image', [
                                        'src' => resizeWImage($last->image, 'w300'),
                                        'width' => '300px',
                                        'height' => '300px',
                                        'lazy'   => true,
                                        'title'  => $last->name ?? ''
                                    ])
                                </a>
                            </div>
                            <div class="item-content">
                                <h3 class="item-content_category mb-17">
                                    <a href="{{ $last->postCategoryMap->category->getUrl() }}" class="color-white text-up fw-600 fs-12">{!! $last->postCategoryMap->category->name ?? '' !!}</a>
                                </h3>
                                <h3 class="item-content__title mt-11">
                                    <a href="{{ $last->getUrl() }}" class="fs-22-lh-30 f-w-b color-white">{{ $last->getName() }}</a>
                                </h3>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif