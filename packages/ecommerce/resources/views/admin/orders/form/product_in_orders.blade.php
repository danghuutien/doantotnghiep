{{-- 
    $form->custom('Order::admin.orders.form.product_in_orders', [
        'name' => 'products',
        'value' => [
            ['product_id' => 1, 'price' => '1000000', 'quantity' => 2],
            ['product_id' => 2, 'price' => '2000000', 'quantity' => 1],
        ],
    ]);
--}}
<div class="row listdata">
    <div class="col-lg-12 suggest">
        <input type="text" class="form-control" id="search_products" autocomplete="off" placeholder="@lang('Tìm sản phẩm thêm vào đơn hàng...')">
        <div class="suggest-result">
            <ul></ul>
        </div>
    </div>
    <div class="col-lg-12" id="choose-products">
        <table class="table table-striped table-bordered mb-0">
            <thead>
                <tr>
                    <th class="text-center">@lang('Ảnh')</th>
                    <th class="text-center">@lang('Tên sản phẩm')</th>
                    <th class="text-center" style="width: 120px;">@lang('Số lượng')</th>
                    <th class="text-center" style="width: 120px;">@lang('Giá')</th>
                    <th class="text-center" style="width: 120px;">@lang('Tổng giá')</th>
                    <th class="text-center">@lang('Xoá')</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total_price = 0;
                @endphp
                @if (isset($orderDetails) && count($orderDetails) > 0)
                    @foreach ($orderDetails as $k => $item)
                        @php
                            $price = $item->price;
                            $quantity = $item->quantity;
                            $total_price = $total_price+($price*$quantity);
                            $product = $item->product;
                        @endphp
                        <tr data-product_item="{{$item->product_id}}">
                            <td class="table-image">
                                <img src="{{ $product->getImage() }}">
                            </td>
                            <td>
                                <a href="{{ $product->getUrl() }}"><strong>{{ $product->getName() }}</strong></a>

                                <input type="hidden" name="products[{{$k}}][id]" value="{{ $item->product_id }}">
                            </td>
                            <td>
                                <input type="number" class="form-control input-sm quantity" name="products[{{$k}}][quantity]" value="{{ $quantity }}">
                            </td>
                            <td>
                                <input type="number" class="form-control input-sm price" name="products[{{$k}}][price]" value="{{ $price }}">
                            </td>
                            <td class="product_item_total_price">{{ formatPrice($quantity*$price, null) }}</td>
                            <td class="text-center table-action">
                                <a class="delete-record" href="javascript:;" data-delete_item data-message="@lang('Translate::table.delete_question')"><i class="fas fa-trash text-red"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center"><strong>@lang('Translate::table.no_record')</strong></td>
                    </tr>
                @endif
            </tbody>
            <tfoot> 
                <tr>
                    <td colspan="4" class="text-right"><strong>@lang('Tổng giá trị đơn')</strong></td>
                    <td colspan="2">
                        <strong id="total_price">{{formatPrice($total_price ?? 0, null)}}</strong>
                        <input type="hidden" name="total_price" value="{{ $total_price ?? 0 }}">
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            $('.listdata').closest('.card').css('marginBottom', '65px');
            // Click xoá sản phẩm
            $('body').on('click', '*[data-delete_item]', function(e) {
                e.preventDefault();
                if ($('*[data-product_item]').length-1 == 0) {
                    $(this).closest('tbody').html(`
                        <tr>
                            <td colspan="6" class="text-center"><strong>@lang('Translate::table.no_record')</strong></td>
                        </tr>
                    `);
                }
                $(this).closest('tr').remove();
                setTotalPrice();
            });
            // Thay đổi số lượng
            $('body').on('keyup change', '.quantity', function() {
                if ($(this).val() <= 0) {
                    $(this).val(1);
                }
                setTotalPrice();
            });
            // Thay đổi giá
            $('body').on('keyup', '.price', function() {
                setTotalPrice();
            });
            // Tìm kiếm sản phẩm
            suggest = null;
            $('body').on('keyup', '#search_products', function(e) {
                e.preventDefault();
                clearTimeout(suggest);
                e = $(this);
                keyword = $(this).val();
                if (keyword.length == 0) {
                    $(this).closest('.suggest').find('.suggest-result').css('display','none').find('ul').empty();
                } else {
                    data = {
                        keyword: keyword,
                        table: 'products',
                        table_field: 'name',
                    };
                    // Không tìm theo sản phẩm đã lấy
                    id_not_where = [];
                    $.each($('*[data-product_item]') ,function() {
                        id_not_where.push($(this).data('product_item'));
                    });
                    if(!checkEmpty(id_not_where)) {
                        data.id_not_where = id_not_where;
                    }
                    suggest = setTimeout(function() {
                        loadAjaxPost('{{ route('admin.ajax.suggest_products') }}', data, {
                            beforeSend: function(){},
                            success:function(result){
                                if (result.status == 1) {
                                    e.closest('.suggest').find('.suggest-result').css('display','block');
                                    e.closest('.suggest').find('.suggest-result').find('ul').html(result.html);
                                } else {
                                    e.closest('.suggest').find('.suggest-result').css('display','none').find('ul').empty();
                                    alertText(result.message, 'error');
                                }
                            },
                            error: function (error) {}
                        });
                    }, 1000);
                }
            });
            // Click vào thẻ li
            $('body').on('click', '*[data-suggest_products]', function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                var date = new Date();
                var time = date.getTime();
                id = $(this).data('id_products');
                variant_id = $(this).data('variant_id_products');
                image = $(this).data('image_products');
                price = $(this).data('price_products');
                name = $(this).data('name_products');
                info = $(this).find('.info').html();
                $(this).closest('.listdata').find('table').find('tbody').append(`
                    <tr data-product_item="${id}">
                        <td class="table-image">
                            <img src="${image}">
                        </td>
                        <td>
                            ${info}
                            <input type="hidden" name="products[${time}][id]" value="${id}">
                        </td>
                        <td>
                            <input type="number" class="form-control input-sm quantity" name="products[${time}][quantity]" value="1">
                        </td>
                        <td>
                            <input type="number" class="form-control input-sm price" name="products[${time}][price]" value="${price}">
                        </td>
                        <td class="product_item_total_price">${formatPrice(price)}</td>
                        <td class="text-center table-action">
                            <a class="delete-record" href="javascript:;" data-delete_item data-message="@lang('Translate::table.delete_question')"><i class="fas fa-trash text-red"></i></a>
                        </td>
                    </tr>
                `);
                $(this).remove();
                setTotalPrice();
            })
            // Nếu click ra vùng bất kỳ thì ẩn box suggest
            $(document).bind('click', function(e) {
                var clicked = $(e.target);
                if (!clicked.parent('ul').parent().hasClass('suggest-result'))
                    $('.suggest-result').css('display','none').find('ul').empty();
            });
        });
        // Lấy tổng giá
        function setTotalPrice() {
            total_price = 0;
            $.each($('tr[data-product_item]'), function() {
                quantity = $(this).find('.quantity').val();
                price = $(this).find('.price').val();
                $(this).find('.product_item_total_price').text(formatPrice(price*quantity));
                total_price = total_price+(price*quantity);
            });
            $('#total_price').text(formatPrice(total_price));
            $('input[name=total_price]').val(total_price);
        }
        // Định dạng giá
        function formatPrice(number) {
            number += '';
            x = number.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + '.' + '$2');
            }
            number = x1 + x2 +"đ";
            return number;
        }
    </script>
</div>
