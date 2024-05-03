@if(isset($data))
    @foreach($data as $value)
        @if(!in_array($value->id, $id_not_where))
            <li data-suggest_products="" data-id_products="{!! $value->id !!}" data-variant_id_products="0" data-image_products="{!! $value->getImage() !!}" data-price_products="{!! $value->price !!}" data-name_products="{!! $value->name !!}">
                <div class="image">
                    <img src="{!! $value->getImage() !!}" alt="">
                </div>
                <div class="info">
                    <p class="name">{!! $value->name??'' !!}</p>
                    <p class="attribute">Giá: <strong>{!! number_format($value->price??0) !!}</strong></p>
                </div>
            </li>
        @endif
    @endforeach
@endif
