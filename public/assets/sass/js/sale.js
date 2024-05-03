$(document).ready(function(){
    // nút cộng sản phẩm trang giỏ hàng
    $("body").on("click",".action_cart",function(e){
        var _this = $(this);
        var rowId = _this.data('id');
        var combo_id = _this.data('combo_id');
        var listRowId= []
        $('.action_cart-combo').each(function(index, element){
            if($(element).data('combo_id') == combo_id){
                listRowId = [...listRowId, $(element).data('id')]
            }
        })
        var type = _this.data('type');
        loadingBox();
        $.ajax({
            type: 'post',
            dataType: 'json',
            data: {rowId:rowId,type:type, listRowId:listRowId},
            url: '/ajax/edit-cart',
            success:function(data){
                $('.sale_content_table').empty();
                $('.cart-count').text(data.count);
                $('.summary-total-price').text(data.totalcart);
                $('.subTotalcart').text(data.totalcart);
                $('.sale_content_table').append(data.html);
                loadingBox('close');
                if(data.redirect) {
                    alert_show('success', 'Giỏ hàng của bạn đang trống!');
                    setTimeout(function(){
                        window.location.href = data.redirect;
                    }, 1000)
                } else {
                    alert_show('success', 'Cập nhật giỏ hàng thành công!');
                }
                lazyload()
            }, error:function(e){
                loadingBox('close');
                alert_show('error', 'Có lỗi xảy ra vui lòng thử lại!');
            }
        });
    });

    // voucher_apply áp dụng mã GG
    $("body").on("click","#voucher_apply",function(e){
        let _this = $(this);
        let code = _this.parent().find('#coupon_code').val();
        if(code == '') {
            alert_show('error', 'Mã giảm giá không được để trống!');
            return false;
        }
        applyCoupon(code)
    });
    $("body").on("click",".item_apply button.apply",function(e){
        let code = $(this).data('code');
        applyCoupon(code)
    });
    $('body').on('click', '.form-control', function(e) {
        $(this).parent().find('.err_show').removeClass('active')
    })
    // 
    $('body').on('click', '.total_item_name .voucher_title', function(e) {
        $(this).parent().find('.voucher_list').toggleClass('active')
    })
    $('input[name="shipping_method"]').on('change', function() {
        const selectedValue = $('input[name="shipping_method"]:checked').val();
    });
    // đặt hàng
    $("body").on("click",".choose-type-payment",function(e){
        e.preventDefault();
        $(this).closest('.step-one').css('display', 'none')
        $('.step-two').css('display', 'flex')
    });
    $("body").on("click",".button_order",function(e){
        e.preventDefault();
        $('#payment_method').val($(this).attr('value')).change();
        let payment_shiping = $('input[name="shipping_method"]:checked').val();
        if(payment_shiping == 2) {
            $('input[name="address"]').removeClass('form-control');
        }
        if(validForm('form_checkout') == true){
            loadingBox('open');
            $(this).closest('form').submit();
        }
    });
});
function applyCoupon(code) {
    loadingBox();
    $.ajax({
        type: 'post',
        dataType: 'json',
        data: {voucher: code},
        url: '/vouchers/price-after-voucher',
        success:function(data){
            if(data.status == 1) {
                $('.total_item_value.finally').text(data.data['price_after_sale_format']);
                $('#price_sale').text(data.data['sale_price_format']);
                $('.total_item.sale').show();
                alert_show('success', data.message);
            } else {
                alert_show('error', data.message);
            }
            $('#coupon_code').val('');
            loadingBox('close');
        }, error:function(e){
            loadingBox('close');
            alert_show('error', 'Có lỗi xảy ra vui lòng thử lại!');
        }
    });
}
