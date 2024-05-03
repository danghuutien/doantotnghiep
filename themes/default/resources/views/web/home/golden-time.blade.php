@if(count($products))
<div class="golden-time">
    <div class="container">
        <div class="golden-time__content">
            <div class="flex flex-center-between pt-10 pl-10 pr-10">
                <div class="left col-md-5 flex">
                    <div class="thumbnail col-md-2">
                        @include('Default::general.components.image', [
                            'src' => '/assets/images/golden-time.png',
                            'width' => '77',
                            'height' => '133',
                            'lazy'   => true,
                            'title'  => ''
                        ])
                    </div>
                    <div class="left-content">
                        <div class="title">
                            <h2 class="text-title text-up f-w-b">
                                gIỜ VÀNG DEAL <br> sốc
                            </h2>
                        </div>
                        <div class="flex-center-left count-time color-white">
                            <p class="end-time color-white">
                                Kết thúc trong
                            </p>
                            @php
                                $end_sale = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $golden_time->end_time);
                                $start_sale = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $golden_time->start_time);
                            @endphp
                            <ul class="flex-center-left countdown-data" data-end="{{$end_sale->getTimestamp()}}">
                                <li class="time hours color-white"></li>:
                                <li class="time minutes color-white"></li>:
                                <li class="time seconds color-white"></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="time_start color-white right">
                    <p class="color-white text-center pb-5">Đang diễn ra</p>
                    <div class="flex-center-right">
                        <p class="color-white">{{$start_sale->format('H:i')}}</p> &nbsp; -  &nbsp;<p class="color-white">{{$end_sale->format('H:i')}}</p>
                    </div>
                </div>
            </div>
            <div class="bestseller-content__product owl-carousel flex">
                @foreach($products ?? [] as $k => $item)
                    @include('GoldenTime::products.product_item', compact('item'))
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif
