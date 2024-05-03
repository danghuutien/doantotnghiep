<div class="form-group">
    <div class="mb-3 suggest">
        <label >{{$title ?? 'Chọn sản phẩm'}}</label>
        <input type="text" class="form-control sussget_name" autocomplete="off" id="" name="sussget_name" placeholder="Tìm kiếm theo tên sản phẩm" value="">
        <div class="suggest-result"><ul></ul></div> 
    </div>
</div>
<div id="full" class="form-group row">
    <div class="col col-md-12" id="result-full">
        @if(isset($product_sale) && count($product_sale) > 0)
        @foreach($product_sale as $key => $value)
            <div class="result-full-item col col-md-12">
                @if(!$value->quantity_used)
                    <a href="javascript:;" class="remove-item" title="remove-item"><i class="fa fa-trash"></i></a>
                @endif
                @php
                    if(isset($isGoldenTime) && $isGoldenTime){
                        $max = $value->product->getMaxProductHas();
                        $min = 1;
                        if($max == 0 && $value->product->quantity_used > 0) {
                            $max = $value->product->quantity_used;
                            $min = $value->product->quantity_used;
                        }
                    }else{
                        $max = $value->getMaxProductHas();
                        $min = 1;
                        if($max == 0 && $value->quantity_used > 0) {
                            $max = $value->quantity_used;
                            $min = $value->quantity_used;
                        }
                    }
                @endphp
                <div class="mb-3">
                    <label >{{ $value->getName() }} <span style="margin-left: 10px; color: red;">{{ $value->quantity_used > 0 ? 'Đã bán '. $value->quantity_used : '' }}</span></label>
                    <div class="row">
                        <input type="hidden" class="product_id" name="sale[{{ $key }}][product_id]" value="{{ $value->product_id }}">
                        <div class="col-lg-6">
                            <input type="text" class="form-control input-mask-number format-price validate" autocomplete="off" name="sale[{{ $key }}][price]" min="1" id="price" placeholder="Giá bán" value="{{ $value->price }}">
                        </div>
                        <div class="col-lg-6">
                            <input type="number" class="form-control input-mask-number quantity" autocomplete="off" name="sale[{{ $key }}][quantity]" id="quantity" max="{{ $max }}" min="{{ $min }}" placeholder="Số lượng" value="{{ $value->quantity }}">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @endif
    </div>
    <div class="clear"></div>
</div>
<!-- <input type="hidden" name="redirect" class="redirect" value=""> -->
<script>
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
            $(this).parent().find('.error.helper').remove();
            keyword = $(this).val();
            clearTimeout(suggest);
            e = $(this);
            if (keyword.length > 0) {
                suggest = setTimeout(function() {
                    {{-- Chuẩn hóa data --}}
                    data = {
                        table: 'products',
                        id: 'id',
                        name: 'name',
                        suggest_locale: true,
                        lang_locale: '{{ \Request()->lang_locale ?? \App::getLocale() }}',
                        flash_sale_id: '{{ $sale_id ?? 0 }}',
                        keyword: keyword,
                    };
                    var id_not_where = [], variant_not = [];
                    {{-- Không tìm theo sản phẩm đã lấy --}}
                    $('.product_id').each(function(){
                    	var id_st_product = parseInt($( this ).val());
                    	if(!isNaN(id_st_product)) {
                    		id_not_where.push(id_st_product);
                    	}
                    })
                    if(!checkEmpty(id_not_where)) {
                        data.id_not_where = id_not_where;
                    }
                    loadAjaxPost('{{ route('admin.golden_times.suggest_products') }}', data, {
                        beforeSend: function(){},
                        success:function(result){
                            if (result.status == 1) {
                                list = '';
                                $.each(result.data, function(index, item) {
                                    list += `<li class="suggest-item" data-suggest_sussget_name data-id="${item.id}" data-variant_id="${item.variant_id}" data-price="${item.price}" data-quantity="${item.quantity}">${item.name}</li>`;
                                });
                                e.closest('.suggest').find('.suggest-result').css('display','block').find('ul').html(list);
                            } else {
                                alertText('@lang('Translate::form.no_data_finding')', 'error');
                                alert_show('error', '@lang('Translate::form.no_data_finding')');
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
            let id = $(this).data('id');
            let quantity = $(this).data('quantity');
            let quantity_used = 1;
            let text = $(this).text();
            let price = $( this ).data('price');
            let d = new Date();
            let n = d.getTime();
            let html = `<div class="result-full-item col col-md-12">
                        <a href="javascript:;" class="remove-item" title="remove-item"><i class="fa fa-trash"></i></a>
                        <div class="mb-3">
                            <label >${text}</label>
                            <div class="row">
                                <input type="hidden" class="product_id" name="sale[${n}][product_id]" value="${id}">
                                <div class="col-lg-6">
                                    <input type="text" class="form-control input-mask-number format-price validate" autocomplete="off" name="sale[${n}][price]" min="1" id="price" placeholder="Giá bán" value="${format_price(price, 0, ',', ',')}">
                                </div>
                                <div class="col-lg-6">
                                    <input type="number" class="form-control input-mask-number quantity validate" autocomplete="off" name="sale[${n}][quantity]" id="quantity" max="${quantity}" placeholder="Số lượng" value="${quantity_used}">
                                </div>
                            </div>
                        </div>
                    </div>`;
            $('#result-full').append(html);
            $(this).css('display', 'none');
        });

        $('body').on('click', '.form-actions__group button[type="submit"]', function(e) {
            let sale = $('body').find('.result-full-item').length;
            // if(!sale) {
            //     e.preventDefault()
            //     $('.sussget_name').parent().append('<span class="error helper"> Sản phẩm tham gia là bắt buộc </span>')
            // }
            let check = true
            $('body').find('input.validate').each(function(){
                let value = $(this).val()
                if(value == '' || value == null || value == undefined) {
                    $(this).css({'border-color': 'red'})
                    $(this).parent().find('.error').remove()
                    $(this).parent().append(`<span class="error helper"> ${$(this).attr('placeholder')} là bắt buộc</span>`);
                    check = false
                }
            })
            if(!check) {
                e.preventDefault()
            }
        })
        $('body').on('keyup','.format-price', function(){
            $(this).css("cssText", "border: 1px solid #ced4da;");
            $( this ).parent().find('span').remove();
            let number = $(this).val();
            number = format_price(number, 0, ',', ',');
            if(number == 0) number = '';
            $(this).val(number).change();
        });
        $('body').on('keyup change','.quantity', function(){
            $(this).css("cssText", "border: 1px solid #ced4da;");
            $( this ).parent().find('span').remove();
            let max = parseInt($(this).attr('max'))
            let qty = parseInt($(this).val())
            if(qty > max) {
                $(this).val(max)
                $(this).parent().append(`<span class="error helper"> Chỉ còn tối đa ${max} sản phẩm trong kho hàng</span>`);
            }
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
        border-radius: 0;
        font-size: 22px;
        background: red;
        position: absolute;
        top: 0;
        right: 0;
        color: #fff;
    }
    .remove-item i {
        color: #fff;
        font-size: 15px;
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
    .order label {
        padding-left: 0 !important;
    }
    .suggest input {
        background: none !important;
    }
    .order input {
        background: none;
        border: none;
        border-bottom: 1px solid #000;
        color: #495057;
    }
</style>
