@php
    $partens = collect($setting_home['partens']['image'] ?? []);
@endphp
@if(count($partens))
    <div class="partner mt-75">
        <div class="container">
            <h2 class="partner-title f-w-b">Đối tác</h2>
            <div class="partner-list mt-10 owl-carousel flex">
                @foreach ($partens as $key => $parten)
                    <div class="partner-list__item">
                        <a href="{{ $setting_home['partens']['link'][$key] ?? '/' }}">
                            @include('Default::general.components.image', [
                                'src' => resizeWImage($parten, 'w150'),
                                'width' => '150px',
                                'height' => '150px',
                                'lazy'   => true,
                                'title'  => ''
                            ])
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
