@extends('Default::web.layouts.app')
@section('content')
<div class="compare-main">
    <div class="container">
        <div class="title">So sánh sản phẩm</div>
        <div class="compare-main__product">
            @php
                $specifications = [];
                $dataSpe = [];
            @endphp
            @foreach($products as $product)
                @php
                    $sp = json_decode(base64_decode($product->specifications), 1) ?? [];
                    $spTitles = $sp['title'] ?? [];
                    $listSps = [];
                    foreach ($spTitles as $key => $value) {
                        $listSps[$value] = $sp['value'][$key] ?? '';
                    }
                    $dataSpe[] = $listSps;
                    $specifications = array_merge($specifications, $spTitles);
                    $price = priceProduct($product);
                @endphp
                <div class="item" data-compare_product="{{ $product->id }}">
                    <span class="item-remove compare-delete-btn" onclick="removeCompare('{{ $product->id }}', 'compare')" data-compare_product_delete="{{ $product->id }}"><svg xmlns="http://www.w3.org/2000/svg" height="14" viewBox="0 0 320 512"><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg></span>
                    <div class="item-image">
                        <img src="{{ resizeWImage($product->image, $w ?? 'w300') }}" alt="{{ $product->getAlt() }}">
                    </div>
                    <div class="item-title">{{ $product->name }}</div>
                    <div class="item-price"><span>{!! $price['price_format'] !!}</span></div>
                    <div class="item-maskup">
                        <a href="{{ $product->getUrl() }}">Xem chi tiết</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="compare-main__option">
            <div class="compare-main__option-title">Thông tin sản phẩm</div>
            <div class="compare-main__option-table">
                <table>
                    <tbody>
                        <tr>
                            <td colspan="4">Thông tin chung</td>
                        </tr>
                        <tr>
                            <td>Bảo hành</td>
                            @foreach($products as $product)
                                <td>{{ $product->insurance ?? '' }}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <td >Cho phép trả góp</td>
                            @foreach($products as $product)
                                <td>{{ $product->compare === 1 ? 'Có' : 'Không' }}</td>
                            @endforeach
                        </tr>
                        @php
                            $specifications = array_unique($specifications);
                        @endphp
                        <tr>
                            <td colspan="4">Thông số kỹ thuật</td>
                        </tr>
                        <tr>
                            <td>Tên sản phẩm</td>
                            @foreach($products as $product)
                                <td class="text-center">{{ $product->name }}</td>
                            @endforeach
                        </tr>
                        @foreach($specifications as $keySp)
                            <tr>
                                <td>{{ $keySp }}</td>
                                @foreach ($dataSpe as $element)
                                    @if(isset($element[$keySp]))
                                        <td>{{ $element[$keySp] }}</td>
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
