@if(count($carts))
    <div class="list w-100">
        @php $totalPrice = 0; @endphp
        @foreach ($carts as $item)
            @if($item->options->type == 2)
                @php
                    $date = date('Y-m-d H:i:s');
                    $golden_time = \Sudo\GoldenTime\Models\GoldenTime::where('start_time', '<=', $date)
                    ->Where('end_time', '>=', $date)
                    ->where('status', 1)
                    ->orderBy('id', 'desc')->first();
                    if($golden_time){
                        $goldenTimeProduct = $golden_time->goldenTimeProduct->where('product_id', $item->id)->first();
                    }
                    $product = $item->options->product ?? '';
                    $price = $item->price;
                    $totalPrice += $price * $item->qty;
                    $checkStock = $goldenTimeProduct->checkStockOrder($item->qty);
                    
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
                        <a class="name" href="{{ $product->getUrl() }}">{{ $product->getName() }} {{ $variant_name ?? '' }}</a>
                        @if(!$checkStock)
                            <p class="warning">Sản phẩm tạm hết hàng!</p>
                        @endif
                        <p class="mb-10">Mua giờ vàng</p>
                        @if(isset($item->options['product_gifts']) && !empty($item->options['product_gifts']))
                            <p class="pb-10">Quà tặng:
                                {{ $item->options['product_gifts'] }}
                            </p>
                        @endif
                        @if(isset($item->options['product_gift_texts']) && !empty($item->options['product_gift_texts']))
                            @php
                                $product_gift_texts = json_decode(base64_decode($item->options['product_gift_texts'] ?? ''), 1);
                            @endphp
                            @if(isset($product_gift_texts['image']) && count($product_gift_texts['image']) > 0) 
                                @foreach($product_gift_texts['image']?? [] as $key => $value)
                                    <div class="flex-center-left">
                                        <p>
                                            @include('Default::general.components.image', [
                                                'src' => resizeWImage($value, 'w100'),
                                                'width' => '50px',
                                                'height' => '50px',
                                                'lazy'   => true,
                                                'title' => getAlt($value),
                                                'alt' => getAlt($value),
                                            ])
                                        </p>
                                        <p class="ml-15">
                                            {{ $product_gift_texts['name'][$key] ?? '' }}. Trị giá: {{ formatPrice($product_gift_texts['price'][$key] ?? '') }}
                                        </p>

                                    </div>
                                @endforeach
                            @endif
                        @endif
                    </div>
                    <div class="list_item_qty">
                        <div class="flex-center-between">
                            <button class="quantity-minus wrap_qty_minus action_cart" data-type="sub" title="Xóa bớt" data-id="{{ $item->rowId }}">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <mask id="mask0_0_8884" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="30" height="30">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0H30V30H0V0Z" fill="white"/>
                                    </mask>
                                    <g mask="url(#mask0_0_8884)">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.0135 2.32986C8.03918 2.31217 2.35729 7.97871 2.32986 14.9791C2.30262 21.9456 7.96816 27.6332 14.9719 27.6702C21.9442 27.707 27.662 22.0046 27.6701 15.0063C27.6783 8.02242 22.0123 2.34768 15.0135 2.32986ZM14.1211 0H15.8789C15.9543 0.016582 16.0289 0.0428906 16.105 0.0482812C18.4514 0.214102 20.6463 0.885 22.6494 2.1123C26.5358 4.49367 28.9259 7.92809 29.7664 12.4192C29.8716 12.9814 29.9234 13.5536 30 14.1211V15.8789C29.976 16.0897 29.9517 16.3004 29.9282 16.5112C29.5695 19.7392 28.3356 22.5863 26.1606 25.0006C23.8512 27.5641 20.989 29.164 17.5837 29.7667C17.0194 29.8666 16.4474 29.9234 15.8789 30H14.1211C14.0457 29.9835 13.9711 29.9572 13.895 29.9518C11.5486 29.786 9.3535 29.1153 7.35064 27.8877C3.46488 25.5059 1.07262 22.073 0.233555 17.5808C0.128555 17.0186 0.076582 16.4464 0 15.8789V14.1211C0.0239648 13.9103 0.0483398 13.6996 0.0717773 13.4888C0.430723 10.2609 1.66354 7.41357 3.83924 4.99939C6.14912 2.43627 9.01102 0.836016 12.4163 0.23332C12.9806 0.133418 13.5526 0.0766992 14.1211 0Z" fill="#8C8C8C"/>
                                    </g>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.1505 13.8467H16.5296C17.8806 13.8467 19.2314 13.8485 20.5824 13.8457C21.0446 13.8448 21.444 13.9758 21.7012 14.3834C21.9355 14.7544 21.956 15.149 21.7466 15.5395C21.5318 15.9403 21.1847 16.1451 20.7335 16.1469C19.3248 16.1525 17.9159 16.1494 16.5072 16.1497C16.4022 16.1497 16.2972 16.1497 16.1505 16.1497C16.1505 16.2685 13.8442 16.1497 13.8442 16.1497C13.712 16.1497 13.6086 16.1497 13.5052 16.1497C12.0867 16.1493 10.6682 16.1549 9.24978 16.1458C8.65526 16.142 8.19799 15.723 8.11772 15.1465C8.04451 14.6208 8.36804 14.0855 8.88322 13.9256C9.07261 13.8669 9.2814 13.8509 9.48151 13.85C10.8131 13.8436 12.1447 13.8467 13.4763 13.8467H13.8442" fill="#8C8C8C"/>
                                </svg>
                            </button>
                            <input class="form-control" name="quantity" type="text" disabled="" value="{{ $item->qty }}">
                            <button title="Cộng thêm" class="quantity-plus action_cart" data-type="add" data-id="{{ $item->rowId }}">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <mask id="mask0_0_8870" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="30" height="30">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0H30V30H0V0Z" fill="white"/>
                                    </mask>
                                    <g mask="url(#mask0_0_8870)">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15.0135 2.32986C8.03918 2.31217 2.35729 7.97871 2.32986 14.9791C2.30262 21.9456 7.96816 27.6332 14.9719 27.6702C21.9442 27.707 27.662 22.0046 27.6701 15.0063C27.6783 8.02242 22.0123 2.34768 15.0135 2.32986ZM14.1211 0H15.8789C15.9543 0.016582 16.0289 0.0428906 16.105 0.0482812C18.4514 0.214102 20.6463 0.885 22.6494 2.1123C26.5358 4.49367 28.9259 7.92809 29.7664 12.4192C29.8716 12.9814 29.9234 13.5536 30 14.1211V15.8789C29.976 16.0897 29.9517 16.3004 29.9282 16.5112C29.5695 19.7392 28.3356 22.5863 26.1606 25.0006C23.8512 27.5641 20.989 29.164 17.5837 29.7667C17.0194 29.8666 16.4474 29.9234 15.8789 30H14.1211C14.0457 29.9835 13.9711 29.9572 13.895 29.9518C11.5486 29.786 9.3535 29.1153 7.35064 27.8877C3.46488 25.5059 1.07262 22.073 0.233555 17.5808C0.128555 17.0186 0.076582 16.4464 0 15.8789V14.1211C0.0239648 13.9103 0.0483398 13.6996 0.0717773 13.4888C0.430723 10.2609 1.66354 7.41357 3.83924 4.99939C6.14912 2.43627 9.01102 0.836016 12.4163 0.23332C12.9806 0.133418 13.5526 0.0766992 14.1211 0Z" fill="#8C8C8C"/>
                                    </g>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.1505 13.8465H16.5296C17.8806 13.8465 19.2314 13.8484 20.5824 13.8455C21.0446 13.8446 21.444 13.9756 21.7012 14.3832C21.9355 14.7542 21.956 15.1488 21.7466 15.5393C21.5318 15.9401 21.1847 16.1449 20.7335 16.1467C19.3248 16.1523 17.9159 16.1492 16.5072 16.1495C16.4022 16.1495 16.2972 16.1495 16.1505 16.1495C16.1505 16.2683 16.1505 16.3699 16.1505 16.4717C16.1505 17.8628 16.1537 19.2537 16.149 20.6448C16.1466 21.3622 15.6923 21.8695 15.0496 21.8914C14.3551 21.915 13.8497 21.4086 13.8462 20.6624C13.8397 19.2714 13.8443 17.8803 13.8442 16.4893V16.1495C13.712 16.1495 13.6086 16.1495 13.5052 16.1495C12.0867 16.1491 10.6682 16.1547 9.24978 16.1456C8.65526 16.1418 8.19799 15.7228 8.11772 15.1463C8.04451 14.6206 8.36804 14.0853 8.88322 13.9254C9.07261 13.8667 9.2814 13.8507 9.48151 13.8498C10.8131 13.8434 12.1447 13.8465 13.4763 13.8465H13.8442V13.5028C13.8442 12.1214 13.8416 10.74 13.8455 9.35872C13.8472 8.73298 14.1821 8.27522 14.717 8.14447C15.4684 7.96084 16.1396 8.49781 16.1473 9.3121C16.1585 10.4905 16.1504 11.6691 16.1505 12.8476C16.1505 13.1652 16.1505 13.4827 16.1505 13.8465Z" fill="#8C8C8C"/>
                                </svg>
                            </button>
                        </div>
                        <a href="javascript:;" class="remove action_cart" data-type="remove" data-id="{{ $item->rowId }}" title="Xóa sản phẩm khỏi giỏ hàng">
                            <span>Xóa</span>
                        </a>
                    </div>
                    <div class="list_item_price">
                        <p>{!! formatPrice($price) !!}</p>
                    </div>
                </div>
            @else
                @if($item->options->type == 3)
                    @php
                        $product = $item->options->product ?? '';
                        $price = $item->price;
                        $totalPrice += $price * $item->qty;
                        $checkStock = $product->checkStockOrder($item->qty);
                        $combo_single_prd = $item->options->combo_single_prd;
                        $main_prd_id = $item->options->main_prd_id;
                        $combo_id = $item->options->combo_id;
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
                            <a class="name" href="{{ $product->getUrl() }}">{{ $product->getName() }} {{ $variant_name ?? '' }}</a>
                            <p class="cart__name--gift">Mua theo CTKM mua combo</p>
                            @if(!$checkStock)
                                <p class="warning">Sản phẩm tạm hết hàng!</p>
                            @endif
                        </div>
                        <div class="list_item_qty">
                            <div class="flex-center-between">
                                <button {{ $combo_single_prd == 0 ? 'disabled' : '' }} class="quantity-minus wrap_qty_minus action_cart {{ $combo_single_prd == 0 ? 'cursor-not-allow' : '' }}" data-type="sub" title="Xóa bớt" data-id="{{ $item->rowId }}">
                                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <mask id="mask0_0_8884" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="30" height="30">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0H30V30H0V0Z" fill="white"/>
                                        </mask>
                                        <g mask="url(#mask0_0_8884)">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15.0135 2.32986C8.03918 2.31217 2.35729 7.97871 2.32986 14.9791C2.30262 21.9456 7.96816 27.6332 14.9719 27.6702C21.9442 27.707 27.662 22.0046 27.6701 15.0063C27.6783 8.02242 22.0123 2.34768 15.0135 2.32986ZM14.1211 0H15.8789C15.9543 0.016582 16.0289 0.0428906 16.105 0.0482812C18.4514 0.214102 20.6463 0.885 22.6494 2.1123C26.5358 4.49367 28.9259 7.92809 29.7664 12.4192C29.8716 12.9814 29.9234 13.5536 30 14.1211V15.8789C29.976 16.0897 29.9517 16.3004 29.9282 16.5112C29.5695 19.7392 28.3356 22.5863 26.1606 25.0006C23.8512 27.5641 20.989 29.164 17.5837 29.7667C17.0194 29.8666 16.4474 29.9234 15.8789 30H14.1211C14.0457 29.9835 13.9711 29.9572 13.895 29.9518C11.5486 29.786 9.3535 29.1153 7.35064 27.8877C3.46488 25.5059 1.07262 22.073 0.233555 17.5808C0.128555 17.0186 0.076582 16.4464 0 15.8789V14.1211C0.0239648 13.9103 0.0483398 13.6996 0.0717773 13.4888C0.430723 10.2609 1.66354 7.41357 3.83924 4.99939C6.14912 2.43627 9.01102 0.836016 12.4163 0.23332C12.9806 0.133418 13.5526 0.0766992 14.1211 0Z" fill="#8C8C8C"/>
                                        </g>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.1505 13.8467H16.5296C17.8806 13.8467 19.2314 13.8485 20.5824 13.8457C21.0446 13.8448 21.444 13.9758 21.7012 14.3834C21.9355 14.7544 21.956 15.149 21.7466 15.5395C21.5318 15.9403 21.1847 16.1451 20.7335 16.1469C19.3248 16.1525 17.9159 16.1494 16.5072 16.1497C16.4022 16.1497 16.2972 16.1497 16.1505 16.1497C16.1505 16.2685 13.8442 16.1497 13.8442 16.1497C13.712 16.1497 13.6086 16.1497 13.5052 16.1497C12.0867 16.1493 10.6682 16.1549 9.24978 16.1458C8.65526 16.142 8.19799 15.723 8.11772 15.1465C8.04451 14.6208 8.36804 14.0855 8.88322 13.9256C9.07261 13.8669 9.2814 13.8509 9.48151 13.85C10.8131 13.8436 12.1447 13.8467 13.4763 13.8467H13.8442" fill="#8C8C8C"/>
                                    </svg>
                                </button>
                                <input class="form-control" name="quantity" type="text" disabled="" value="{{ $item->qty }}">
                                <button {{ $combo_single_prd == 0 ? 'disabled' : '' }} title="Cộng thêm" class="quantity-plus action_cart {{ $combo_single_prd == 0 ? 'cursor-not-allow' : '' }}" data-type="add" data-id="{{ $item->rowId }}">
                                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <mask id="mask0_0_8870" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="30" height="30">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0H30V30H0V0Z" fill="white"/>
                                        </mask>
                                        <g mask="url(#mask0_0_8870)">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15.0135 2.32986C8.03918 2.31217 2.35729 7.97871 2.32986 14.9791C2.30262 21.9456 7.96816 27.6332 14.9719 27.6702C21.9442 27.707 27.662 22.0046 27.6701 15.0063C27.6783 8.02242 22.0123 2.34768 15.0135 2.32986ZM14.1211 0H15.8789C15.9543 0.016582 16.0289 0.0428906 16.105 0.0482812C18.4514 0.214102 20.6463 0.885 22.6494 2.1123C26.5358 4.49367 28.9259 7.92809 29.7664 12.4192C29.8716 12.9814 29.9234 13.5536 30 14.1211V15.8789C29.976 16.0897 29.9517 16.3004 29.9282 16.5112C29.5695 19.7392 28.3356 22.5863 26.1606 25.0006C23.8512 27.5641 20.989 29.164 17.5837 29.7667C17.0194 29.8666 16.4474 29.9234 15.8789 30H14.1211C14.0457 29.9835 13.9711 29.9572 13.895 29.9518C11.5486 29.786 9.3535 29.1153 7.35064 27.8877C3.46488 25.5059 1.07262 22.073 0.233555 17.5808C0.128555 17.0186 0.076582 16.4464 0 15.8789V14.1211C0.0239648 13.9103 0.0483398 13.6996 0.0717773 13.4888C0.430723 10.2609 1.66354 7.41357 3.83924 4.99939C6.14912 2.43627 9.01102 0.836016 12.4163 0.23332C12.9806 0.133418 13.5526 0.0766992 14.1211 0Z" fill="#8C8C8C"/>
                                        </g>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.1505 13.8465H16.5296C17.8806 13.8465 19.2314 13.8484 20.5824 13.8455C21.0446 13.8446 21.444 13.9756 21.7012 14.3832C21.9355 14.7542 21.956 15.1488 21.7466 15.5393C21.5318 15.9401 21.1847 16.1449 20.7335 16.1467C19.3248 16.1523 17.9159 16.1492 16.5072 16.1495C16.4022 16.1495 16.2972 16.1495 16.1505 16.1495C16.1505 16.2683 16.1505 16.3699 16.1505 16.4717C16.1505 17.8628 16.1537 19.2537 16.149 20.6448C16.1466 21.3622 15.6923 21.8695 15.0496 21.8914C14.3551 21.915 13.8497 21.4086 13.8462 20.6624C13.8397 19.2714 13.8443 17.8803 13.8442 16.4893V16.1495C13.712 16.1495 13.6086 16.1495 13.5052 16.1495C12.0867 16.1491 10.6682 16.1547 9.24978 16.1456C8.65526 16.1418 8.19799 15.7228 8.11772 15.1463C8.04451 14.6206 8.36804 14.0853 8.88322 13.9254C9.07261 13.8667 9.2814 13.8507 9.48151 13.8498C10.8131 13.8434 12.1447 13.8465 13.4763 13.8465H13.8442V13.5028C13.8442 12.1214 13.8416 10.74 13.8455 9.35872C13.8472 8.73298 14.1821 8.27522 14.717 8.14447C15.4684 7.96084 16.1396 8.49781 16.1473 9.3121C16.1585 10.4905 16.1504 11.6691 16.1505 12.8476C16.1505 13.1652 16.1505 13.4827 16.1505 13.8465Z" fill="#8C8C8C"/>
                                    </svg>
                                </button>
                            </div>
                            @if($main_prd_id != 0)
                                <a href="javascript:;" class="remove action_cart action_cart-combo" data-combo_id="{{ $combo_id }}" data-type="remove" data-id="{{ $item->rowId }}" title="Xóa sản phẩm khỏi giỏ hàng">
                                    <span>Xóa</span>
                                </a>
                            @else
                                <a style="display:none;" href="javascript:;" class="remove action_cart action_cart-combo" data-combo_id="{{ $combo_id }}" data-type="remove" data-id="{{ $item->rowId }}" title="Xóa sản phẩm khỏi giỏ hàng">
                                    <span>Xóa</span>
                                </a>
                            @endif
                        </div>
                        <div class="list_item_price">
                            <p>{!! formatPrice($price) !!}</p>
                        </div>
                    </div>
                @else
                @php
                    $product = $item->options->product ?? '';
                    $price = $item->price;
                    $totalPrice += $price * $item->qty;
                    $checkStock = $product->checkStockOrder($item->qty);
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
                            <a class="name" href="{{ $product->getUrl() }}">{{ $product->getName() }} {{ $variant_name ?? '' }}</a>
                            @if(!$checkStock)
                                <p class="warning">Sản phẩm tạm hết hàng!</p>
                            @endif
                           
                        </div>
                        <div class="list_item_qty">
                            <div class="flex-center-between">
                                <button class="quantity-minus wrap_qty_minus action_cart" data-type="sub" title="Xóa bớt" data-id="{{ $item->rowId }}">
                                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <mask id="mask0_0_8884" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="30" height="30">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0H30V30H0V0Z" fill="white"/>
                                        </mask>
                                        <g mask="url(#mask0_0_8884)">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15.0135 2.32986C8.03918 2.31217 2.35729 7.97871 2.32986 14.9791C2.30262 21.9456 7.96816 27.6332 14.9719 27.6702C21.9442 27.707 27.662 22.0046 27.6701 15.0063C27.6783 8.02242 22.0123 2.34768 15.0135 2.32986ZM14.1211 0H15.8789C15.9543 0.016582 16.0289 0.0428906 16.105 0.0482812C18.4514 0.214102 20.6463 0.885 22.6494 2.1123C26.5358 4.49367 28.9259 7.92809 29.7664 12.4192C29.8716 12.9814 29.9234 13.5536 30 14.1211V15.8789C29.976 16.0897 29.9517 16.3004 29.9282 16.5112C29.5695 19.7392 28.3356 22.5863 26.1606 25.0006C23.8512 27.5641 20.989 29.164 17.5837 29.7667C17.0194 29.8666 16.4474 29.9234 15.8789 30H14.1211C14.0457 29.9835 13.9711 29.9572 13.895 29.9518C11.5486 29.786 9.3535 29.1153 7.35064 27.8877C3.46488 25.5059 1.07262 22.073 0.233555 17.5808C0.128555 17.0186 0.076582 16.4464 0 15.8789V14.1211C0.0239648 13.9103 0.0483398 13.6996 0.0717773 13.4888C0.430723 10.2609 1.66354 7.41357 3.83924 4.99939C6.14912 2.43627 9.01102 0.836016 12.4163 0.23332C12.9806 0.133418 13.5526 0.0766992 14.1211 0Z" fill="#8C8C8C"/>
                                        </g>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.1505 13.8467H16.5296C17.8806 13.8467 19.2314 13.8485 20.5824 13.8457C21.0446 13.8448 21.444 13.9758 21.7012 14.3834C21.9355 14.7544 21.956 15.149 21.7466 15.5395C21.5318 15.9403 21.1847 16.1451 20.7335 16.1469C19.3248 16.1525 17.9159 16.1494 16.5072 16.1497C16.4022 16.1497 16.2972 16.1497 16.1505 16.1497C16.1505 16.2685 13.8442 16.1497 13.8442 16.1497C13.712 16.1497 13.6086 16.1497 13.5052 16.1497C12.0867 16.1493 10.6682 16.1549 9.24978 16.1458C8.65526 16.142 8.19799 15.723 8.11772 15.1465C8.04451 14.6208 8.36804 14.0855 8.88322 13.9256C9.07261 13.8669 9.2814 13.8509 9.48151 13.85C10.8131 13.8436 12.1447 13.8467 13.4763 13.8467H13.8442" fill="#8C8C8C"/>
                                    </svg>
                                </button>
                                <input class="form-control" name="quantity" type="text" disabled="" value="{{ $item->qty }}">
                                <button title="Cộng thêm" class="quantity-plus action_cart" data-type="add" data-id="{{ $item->rowId }}">
                                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <mask id="mask0_0_8870" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="30" height="30">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0H30V30H0V0Z" fill="white"/>
                                        </mask>
                                        <g mask="url(#mask0_0_8870)">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15.0135 2.32986C8.03918 2.31217 2.35729 7.97871 2.32986 14.9791C2.30262 21.9456 7.96816 27.6332 14.9719 27.6702C21.9442 27.707 27.662 22.0046 27.6701 15.0063C27.6783 8.02242 22.0123 2.34768 15.0135 2.32986ZM14.1211 0H15.8789C15.9543 0.016582 16.0289 0.0428906 16.105 0.0482812C18.4514 0.214102 20.6463 0.885 22.6494 2.1123C26.5358 4.49367 28.9259 7.92809 29.7664 12.4192C29.8716 12.9814 29.9234 13.5536 30 14.1211V15.8789C29.976 16.0897 29.9517 16.3004 29.9282 16.5112C29.5695 19.7392 28.3356 22.5863 26.1606 25.0006C23.8512 27.5641 20.989 29.164 17.5837 29.7667C17.0194 29.8666 16.4474 29.9234 15.8789 30H14.1211C14.0457 29.9835 13.9711 29.9572 13.895 29.9518C11.5486 29.786 9.3535 29.1153 7.35064 27.8877C3.46488 25.5059 1.07262 22.073 0.233555 17.5808C0.128555 17.0186 0.076582 16.4464 0 15.8789V14.1211C0.0239648 13.9103 0.0483398 13.6996 0.0717773 13.4888C0.430723 10.2609 1.66354 7.41357 3.83924 4.99939C6.14912 2.43627 9.01102 0.836016 12.4163 0.23332C12.9806 0.133418 13.5526 0.0766992 14.1211 0Z" fill="#8C8C8C"/>
                                        </g>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.1505 13.8465H16.5296C17.8806 13.8465 19.2314 13.8484 20.5824 13.8455C21.0446 13.8446 21.444 13.9756 21.7012 14.3832C21.9355 14.7542 21.956 15.1488 21.7466 15.5393C21.5318 15.9401 21.1847 16.1449 20.7335 16.1467C19.3248 16.1523 17.9159 16.1492 16.5072 16.1495C16.4022 16.1495 16.2972 16.1495 16.1505 16.1495C16.1505 16.2683 16.1505 16.3699 16.1505 16.4717C16.1505 17.8628 16.1537 19.2537 16.149 20.6448C16.1466 21.3622 15.6923 21.8695 15.0496 21.8914C14.3551 21.915 13.8497 21.4086 13.8462 20.6624C13.8397 19.2714 13.8443 17.8803 13.8442 16.4893V16.1495C13.712 16.1495 13.6086 16.1495 13.5052 16.1495C12.0867 16.1491 10.6682 16.1547 9.24978 16.1456C8.65526 16.1418 8.19799 15.7228 8.11772 15.1463C8.04451 14.6206 8.36804 14.0853 8.88322 13.9254C9.07261 13.8667 9.2814 13.8507 9.48151 13.8498C10.8131 13.8434 12.1447 13.8465 13.4763 13.8465H13.8442V13.5028C13.8442 12.1214 13.8416 10.74 13.8455 9.35872C13.8472 8.73298 14.1821 8.27522 14.717 8.14447C15.4684 7.96084 16.1396 8.49781 16.1473 9.3121C16.1585 10.4905 16.1504 11.6691 16.1505 12.8476C16.1505 13.1652 16.1505 13.4827 16.1505 13.8465Z" fill="#8C8C8C"/>
                                    </svg>
                                </button>
                            </div>
                            <a href="javascript:;" class="remove action_cart" data-type="remove" data-id="{{ $item->rowId }}" title="Xóa sản phẩm khỏi giỏ hàng">
                                <span>Xóa</span>
                            </a>
                        </div>
                        <div class="list_item_price">
                            <p>{!! formatPrice($price) !!}</p>
                        </div>
                    </div>
                @endif
            @endif
        @endforeach
    </div>
    <div class="total">
        <div class="total_item flex-center-between">
            <p class="total_item_name">Tạm tính</p>
            <p class="total_item_value">{{ formatPrice($totalPrice) }}</p>
        </div>
        <div class="total_item flex-center-between">
            <div class="total_item_name flex-center-left mr-5">
                <p>Khuyến mại</p>
                @if(count($vouchers))
                    <div class="voucher">
                        <p class="voucher_title flex-center-left">
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="#0066C2" xmlns="http://www.w3.org/2000/svg">
                                <mask id="mask0_0_9373" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="17" height="17">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0H17V17H0V0Z" fill="white"/>
                                </mask>
                                <g mask="url(#mask0_0_9373)">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.33054 4.16397C7.33337 4.40939 7.36503 4.59793 7.4407 4.77641C7.57939 5.1035 7.80522 5.33774 8.1638 5.41232C8.74481 5.53321 9.34397 5.20982 9.5661 4.65036C9.7333 4.22912 9.72283 3.80693 9.46072 3.4296C9.04318 2.82868 8.17938 2.86694 7.74963 3.23733C7.45295 3.493 7.34368 3.8353 7.33054 4.16397ZM6.69 7.97065C6.69956 7.96591 6.70596 7.96459 6.70965 7.96072C6.89858 7.76001 7.14003 7.66487 7.40372 7.61244C7.5393 7.58548 7.60777 7.62075 7.62464 7.75843C7.63981 7.88216 7.64305 8.01 7.63071 8.13397C7.58442 8.59684 7.48889 9.05156 7.38917 9.50537C7.22521 10.252 7.05855 10.998 6.90357 11.7464C6.82728 12.1147 6.78744 12.4889 6.82583 12.8665C6.8717 13.318 7.0913 13.6507 7.51333 13.831C8.01929 14.0472 8.54046 14.0927 9.07492 13.9441C9.46737 13.835 9.81698 13.6549 10.0911 13.346C10.2554 13.1607 10.3786 12.9476 10.5 12.7338C10.583 12.5878 10.6582 12.4374 10.7387 12.2856C10.5713 12.1649 10.4107 12.0491 10.2446 11.9293C10.2263 11.9761 10.2118 12.0136 10.1969 12.051C10.0752 12.3586 9.93216 12.6538 9.70483 12.9002C9.60179 13.0118 9.48308 13.0987 9.33549 13.1422C9.17847 13.1884 9.09433 13.1445 9.03728 12.9917C8.94603 12.7472 8.91313 12.4933 8.90706 12.2343C8.89904 11.8889 8.95987 11.552 9.03117 11.2165C9.18167 10.5085 9.3332 9.80089 9.48412 9.09307C9.56472 8.71528 9.61953 8.33609 9.59668 7.94693C9.56497 7.4067 9.36827 6.94001 9.00337 6.54308C8.77202 6.29139 8.48486 6.17249 8.14236 6.18744C7.85687 6.19995 7.6022 6.30028 7.36948 6.45982C7.02369 6.69688 6.72964 6.99099 6.45154 7.30205C6.38872 7.3723 6.32867 7.44501 6.26523 7.519C6.41003 7.67293 6.55026 7.82208 6.69 7.97065ZM8.50473 0C13.205 8.30925e-05 17.009 3.81116 17 8.52642C16.991 13.213 13.1829 17.0158 8.47024 16.9999C3.77643 16.9841 -0.018315 13.1713 0.000133481 8.46572C0.0184158 3.78806 3.81079 0.00220195 8.50473 0Z" fill="#0066C2"/>
                                </g>
                            </svg>
                            <span>Ưu đãi dành cho bạn</span>
                        </p>
                        <div class="voucher_list {{ checkAgent() }}">
                            <p class="voucher_list_title">Danh sách mã giảm giá</p>
                            <div class="voucher_list_content">
                                @foreach($vouchers as $voucherItem)
                                    <div class="item flex-center-between">
                                        <div class="item_logo flex-center">
                                            @include('Default::general.components.image', [
                                                'src' => '/assets/images/logo-voucher.png',
                                                'width' => '60px',
                                                'height' => '20px',
                                                'lazy'   => true,
                                                'title' => $voucherItem->getName(),
                                                'alt' => $voucherItem->getName(),
                                            ])
                                        </div>
                                        <div class="item_info">
                                            <p class="item_info_per">Giảm {{ $voucherItem->getSale() }}</p>
                                            @if($voucherItem->min_order)
                                                <p class="item_info_min">Cho đơn hàng từ <br/>{{ formatPrice($voucherItem->min_order) }}</p>
                                            @endif
                                            <p class="item_info_ex">HSD: {{ date('d/m/Y', strtotime($voucherItem->end_time)) }}</p>
                                        </div>
                                        <div class="item_apply">
                                            @if(isset($voucherActive->id) && $voucherActive->id === $voucherItem->id)
                                                <button class="active">Đã áp dụng</button>
                                            @else
                                                <button class="apply" data-code="{{ $voucherItem->code }}">Áp dụng</button>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="total_item_value coupon flex-center-right">
                <input type="text" name="coupon_code" id="coupon_code" value="" placeholder="Nhập mã giảm giá">
                <button type="submit" class="btn btn-dark" id="voucher_apply">Áp dụng</button>
            </div>
        </div>
        <div class="total_item sale flex-center-between" @if($price_sale == 0) style="display: none" @endif>
            <p class="total_item_name">Giảm giá</p>
            <p class="total_item_value" id="price_sale">{{ $price_sale }}</p>
        </div>
        <div class="total_item flex-center-between">
            <p class="total_item_name">Tổng tiền</p>
            <p class="total_item_value finally">{{ formatPrice(totalCart()) }}</p>
        </div>
    </div>
@else
    <div class="alert_none">
        <p>Giỏ hàng của bạn đang trống!</p>
        <a href="{{ route('app.home') }}" >Tiếp tục mua hàng</a>
    </div>
@endif
