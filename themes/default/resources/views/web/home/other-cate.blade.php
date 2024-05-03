@if(count($otherCates))
    @foreach ($otherCates as $otherCate)
        <div class="category-block mt-49">
            @include('Default::web.layouts.image-toshiko', ['name' => $otherCate->getName(), 'url' => $otherCate->getUrl()])
            {{--
                <div class="category-block__title">
                    <a href="{{ $otherCate->getUrl() }}"><h2 class="f-w-b">{{ $otherCate->getName() }}</h2></a>
                </div>
            --}}
            <div class="category-block__content owl-carousel mt-37">
                @include('Default::web.products.list-item',  ['products' => $otherCate->products])
            </div>
        </div>
    @endforeach
@endif