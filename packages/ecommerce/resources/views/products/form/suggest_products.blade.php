<script>
    function formatPrice(number) {
        if (number == '') {
            return '';
        } else if (number == 0) {
            return '0đ';
        } else {
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
    }
</script>
<div class="form-group">
    <div class="col-md-12">
        <label for="" style="text-transform: uppercase; color: #000000;">{{ __($title) }}</label>
    </div>
    <div class="col-md-12 suggest">
        <input type="text" class="form-control sussget_name" autocomplete="off" id="" name="sussget_name" placeholder="{{ __('Tìm theo tên sản phẩm ...') }}" value="">
        <div class="suggest-result"><ul></ul></div> 
    </div>
</div>
<div id="full" class="form-group row">
    <div class="col col-md-12" id="result-full">
        @if(isset($product_sale) && !empty($product_sale) > 0)
            @foreach($product_sale as $key => $value)
               <div class="result-full-item col col-md-12">
                    <a href="javascript:;" class="remove-item" title="remove-item"><i class="fa fa-trash"></i></a>
                    <div class="row">
                        <div class="controls col col-md-6 col-lg-6 col-xs-6 suggest">
                            <input type="hidden" name="sale_product_id[]" value="{{ $value['product_id'] }}">
                            <label for="product_sale_name_{{ $key }}" class="col-lg-12 col-form-label">{{$products_name[$value['product_id'] ?? 0] ?? 0}}</label>
                            <input type="hidden" class="product_id" name="sale[{{ $key }}][product_id]" value="{{ $value['product_id'] }}">
                            <div class="suggest-result"><ul></ul></div>
                        </div>
                        <div class="controls col col-md-6 col-lg-6 col-xs-6">
                            <label for="product_sale_name_{{ $key }}" class="col-lg-12 col-form-label">{{ __('Nhập giá sản phẩm') }}</label>
                            <input  type="number" id="type_{{$key}}" class="combo_price" autocomplete="off" data-max="{{ $product_reguler[$value['product_id'] ?? 0] ?? 0 }}" name="sale[{{$key}}][price]" value="{{$value['price'] ?? 0}}">
                            <span style="margin-left: 10px;" class="price_format">{!!formatPrice($value['price'] ?? 0)!!}</span>
                        </div>

                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="clear"></div>
</div>
<input type="hidden" name="redirect" class="redirect" value="">
<script>

    $(document).ready(function() {
        $('body').on('keyup', '#reguler_price', function() {
            price = $(this).val();
            $('#reguler_price_price').html(formatPrice(price));
        });
        $('#reguler_price').keyup(function(){
            validateInput('#reguler_price', 'Giá bán không được để trống!');            
        })
    });
    // Định dạng giá
    function formatPrice(number) {
        if (number == '') {
            return '';
        } else if (number == 0) {
            return '0đ';
        } else {
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
    }
    $('#result-full').on('click','.remove-item',function() {
        $(this).closest('.result-full-item').fadeOut(500, function() { $(this).remove(); });
    });
    $(document).ready(function() {
        {{-- Nếu giá trị thay đổi --}}
        $('body').on('keyup change', 'input[name="sussget_name"]', function() {
            $( this ).parent().find('.error').remove();
            $( this ).css('border', '1px solid #ced4da');
        });
        {{-- Nếu tìm kiếm tại form --}}
        suggest = null;
        $('body').on('keyup', '.sussget_name', function(e) {
            keyword = $(this).val();
            clearTimeout(suggest);
            e = $(this);
            if (keyword.length > 0) {
                suggest = setTimeout(function() {
                    {{-- Chuẩn hóa data --}}
                    data = {
                        id: 'id',
                        name: 'name',
                        suggest_locale: 'true',
                        lang_locale: '{{ $record_locale ?? \App::getLocale() }}',
                        keyword: keyword
                    };
                    var id_not_where = [];
                    {{-- Không tìm theo sản phẩm đã lấy --}}
                    $('.product_id').each(function(){
                        var id_st_product = parseInt($( this ).val());
                        if(!isNaN(id_st_product)) {
                            id_not_where.push(id_st_product);
                        }
                    })
                    if(!checkEmpty(id_not_where)) {
                        data.id_not_where = id_not_where;
                        // console.log('check'+id_not_where);
                    }
                    console.log(id_not_where);
                    loadAjaxPost('{{ route('admin.ajax.products.suggest_search_one') }}', data, {
                        beforeSend: function(){},
                        success:function(result){
                            if (result.status == 1) {
                                list = '';
                                $.each(result.data, function(index, item) {
                                    list += `<li class="suggest-item" data-suggest_sussget_name data-id="${item.id}" data-reguler_price="${item.reguler_price}" data-sale_price="${item.sale_price}">${item.name}</li>`;
                                });
                                e.closest('.suggest').find('.suggest-result').css('display','block').find('ul').html(list);
                            } else {
                                alertText('@lang('Translate::form.no_data_finding')', 'error');
                            }
                        },
                        error: function (error) {}
                    }, 'progress');
                }, 1000);
            }
        });
        {{-- Nếu click vào item sẽ lấy giá trị tại item đó --}}
        $('body').on('click','*[data-suggest_sussget_name]',function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var text = $(this).text();
            var reguler_price = $( this ).data('reguler_price');
            var sale_price = $( this ).data('sale_price');

            // $(this).closest('.suggest').find('.sussget_name').val(text);
            // $(this).closest('.suggest').find('input.product_id').val(id).change();
            // $(this).closest('.suggest-result').css('display','none').find('ul').empty();
            var d = new Date();
            var n = d.getTime();
            var html = '';
            html = '<div class="result-full-item col col-md-12">'+
                        '<a href="javascript:;" class="remove-item" title="remove-item"><i class="fa fa-trash"></i></a>'+
                        '<div class="row">'+
                            '<div class="controls col col-md-6 col-lg-6 col-xs-6 suggest">'+
                                '<label for="product_sale_name_'+n+'" class="col-lg-12 col-form-label">Sản phẩm</label>'+
                                '<input type="text" class="form-control disable" autocomplete="off" id="product_sale_name_'+n+'_input" disabled="" name="sussget_name" placeholder="Tìm theo tên sản phẩm" value="'+text+'">'+
                                '<input type="hidden" class="product_id" name="sale['+n+'][product_id]" value="'+id+'">'+
                                '<div class="suggest-result"><ul></ul></div>'+
                            '</div>'+
                            '<div class="controls col col-md-6 col-lg-6 col-xs-6">'+
                                '<label for="product_sale_name_'+n+'" class="col-lg-12 col-form-label">Nhập giá sản phẩm</label>'+
                                '<input type="number" class="combo_price" data-max="'+reguler_price+'" id="type_'+n+'" autocomplete="off" name="sale['+n+'][price]" value="0">'+
                                '<span style="margin-left: 10px" class="price_format"></span>'+
                            '</div>'+
                        '</div>'+
                    '</div>';
            $('#result-full').append(html);
            $(this).css('display', 'none');
        });

        // định dạng giá
        $('body').on('keyup', '.combo_price', function(e) {
            var price = $(this).val();
            $(this).parent().find('.price_format').text(formatPrice(price));
            {{--@if(isset($flash_sale))--}}
                var max = $( this ).data('max');
                if(price > max) {
                    $( this ).val(0).change();
                    $(this).parent().find('.price_format').text(formatPrice(0));
                    $(this).css('border', '1px solid red');
                    alertText('Giá nhập vào không thể lớn hơn giá bán là '+formatPrice(max), 'error');
                }
            {{--@endif --}}
        });

        {{-- Nếu click ra vùng bất kỳ thì ẩn box suggest --}}
        $(document).bind('click', function(e) {
            var clicked = $(e.target);
            if (!clicked.parent('ul').parent().hasClass('suggest-result'))
                $('.suggest-result').css('display','none').find('ul').empty();
        });
    });
</script>
<style type="text/css">
    .result-full-item {
        padding: 10px 20px;
        position: relative;
        background-color: #ededed;
        margin-bottom: 5px;
    }
    .result-full-item label {
        padding: 0;
        font-size: 12px;
    }
    #price_txt {
        padding-top: 20px;
    }
    .remove-item {
        display: block;
        width: 30px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        background: #ddd;
        border-radius: 20px;
        font-size: 22px;
        color: red;
        position: absolute;
        top: 15px;
        right: -15px;
    }
    #row_title {
        padding-right: 0;
        border: 1px solid #cccc;
    }
    #row_title a {
        padding: 8px;
        float: right;
    }
    .col-lg-12 {
        padding: 0 10px !important;
    }
    .rate_sale {
        margin-left: 30px;
    }
    .disable {
        border: none;
    }
    .btn-tick {
        cursor: pointer;
    }
</style>