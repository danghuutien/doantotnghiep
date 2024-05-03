<div class="sale_content_table">
    <div class="list w-100">
        @php $totalPrice = 0;  @endphp
        @foreach ($order_details as $key => $item)
            @php
                $price = $item['price']*$item['quantity'];
                $totalPrice += $price;
                $product = Sudo\Ecommerce\Models\Product::where('id',$item['product_id'])->where('status',1)->first();
            @endphp
            <div class="list_item box w-100 flex-center-between">
                <div class="list_item_image">
                    <a href="{{ $product->getUrl() }}">
                        @include('Default::general.components.image', [
                            'src' => resizeWImage($product->image, 'w300'),
                            'width' => '240px',
                            'height' => '240px',
                            'lazy'   => true,
                            'title' => $product->getName(),
                            'alt' => $product->getName(),
                        ])
                    </a>
                </div>
                <div class="list_item_content">
                    <a class="name" href="{{ $product->getUrl() }}">{{ $product->getName() }}</a>
                </div>
                <div class="list_item_qty">
                    <div>
                        <p class="text-center" for="">Số lượng</p>
                        <p class="text-center"><b>{{ $item->quantity }}</b></p>
                    </div>
                </div>
                <div class="list_item_price">
                    <p>{!! formatPrice($price) !!}</p>
                </div>
            </div>
        @endforeach
    </div>
    <div class="total">
        @if($order->voucher_value)
            <div class="total_item flex-center-between">
                <p class="total_item_name">Tạm tính</p>
                <p class="total_item_value">{{ formatPrice($totalPrice) }}</p>
            </div>
            <div class="total_item sale flex-center-between">
                <p class="total_item_name">Giảm giá</p>
                <p class="total_item_value" id="price_sale">{{ formatPrice($order->voucher_value) }}</p>
            </div>
        @endif
        <div class="total_item flex-center-between">
            <p class="total_item_name">Tổng tiền</p>
            <p class="total_item_value finally">{{ formatPrice($order->total_price) }}</p>
        </div>
    </div>
</div>
