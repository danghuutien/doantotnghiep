@php
    $certifications = collect($setting_home['certification']['image'] ?? []);
@endphp
@if(count($certifications))
    <div class="certifications mt-76">
        <div class="container">
            <div class="certifications-content flex">
                <div class="certifications-content__left">
                    <h2 class="title f-w-b">{{ $setting_home['certificationTitle'] ?? 'Giải thưởng & Chứng nhận' }}</h2>
                    <p class="desc mt-30 mb-30 fs-16 lh-24">
                        {{ $setting_home['certificationDesc'] ?? 'Với phương châm “Tập trung vào chất lượng sản phẩm, lấy khách hàng là yếu tố cốt lõi để phát triển”, chúng tôi đã và đang tạo dựng được uy tín hàng đầu tại Việt Nam trong lĩnh vực cung cấp thiết bị thể thao & thiết bị chăm sóc sức khỏe thông minh.' }}
                    </p>
                    <a href="{{ $setting_home['certificationLink'] ?? '/' }}" class="see-more fs-16 lh-19 text-up color-white">Xem thêm</a>
                </div>
                <div class="certifications-content__right">
                    @foreach ($certifications->chunk(2) as $images)
                        <div class="list">
                            @foreach ($images as $image)
                                <div class="item">
                                    @include('Default::general.components.image', [
                                        'src' => resizeWImage($image, 0),
                                        'width' => '300px',
                                        'height' => '300px',
                                        'lazy'   => true,
                                        'title'  => ''
                                    ])
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
