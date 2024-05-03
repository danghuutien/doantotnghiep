@if(count($products))
<div class="bestseller pt-68 pb-74">
    <div class="container">
        <div class="bestseller-content w-100">
            <div class="bestseller-content__background">
                    @include('Default::general.components.image', [
                        'src' => '/assets/images/bg-1.png',
                        'width' => '1170px',
                        'height' => '500px',
                        'lazy'   => true,
                        'title'  => ''
                    ])
            </div>
            <div class="bestseller-content__header">
                <div class="title text-center flex">
                    @include('Default::general.components.image', [
                        'src' => '/assets/images/percent.png',
                        'width' => '30px',
                        'height' => '30px',
                        'lazy'   => true,
                        'title'  => ''
                    ])
                    <h2 class="color-white fs-36 lh-43 ml-14 f-w-b text-up">Sản phẩm <span>bán chạy</span></h2>
                </div>
            </div>
            <div class="bestseller-content__product owl-carousel flex">
                @include('Default::web.products.list-item', compact('products'))
            </div>
        </div>
    </div>
</div>
@endif
