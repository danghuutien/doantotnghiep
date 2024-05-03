@if($firtCate && count($firtCate->products))
    {{--
        <div class="home-product__title flex w-100">
            <a href="{{ $firtCate->getUrl() }}"><h2 class="f-w-b">{{ $firtCate->getName() }}</h2></a>
        </div>
    --}}
    <div class="home-product__list owl-carousel flex">
        @foreach($firtCate->products->chunk(5) as $items)
            @php
                $leftItem = $items->first();
                $price = priceProduct($leftItem);
                $rightItem = $items->where('id', '<>', $leftItem->id);
            @endphp
            <div class="contents flex">
                <div class="left">
                    @include('Default::web.products.product_item', ['item' => $leftItem, 'w' => 'w450', 'wS' => '450', 'hs' => 450, 'hasBtn' => true])
                </div>
                <div class="right">
                    @include('Default::web.products.list-item', ['products' => $rightItem ])
                </div>
            </div>
        @endforeach
    </div>
@endif