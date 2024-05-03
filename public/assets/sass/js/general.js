$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function(){
    if($('.adminbar').length > 0){
        var height_adminbar = $('.adminbar').height();
    } else{
        var height_adminbar = 0;
    }
    $(window).scroll(function(){
        if($(this).scrollTop() > 100) {
            var height_menu = $('.header-bottom').height();
            var height_menu = $('.header-bottom').height();
            $('.header-bottom').addClass('menu_fixel');
            $('.menu_home').removeClass('none');
            $('.menu_level1').addClass('scroll_menu');
        } else {
            // $('.header').css('top',height_adminbar);
            $('.header-bottom').removeClass('menu_fixel');
            $('.menu_home').addClass('none');
            $('.menu_level1').removeClass('scroll_menu');
        }
    });
	//faq
    $('body').on('click', '.faq_item .faq_item__qs', function(){
        $(this).parent().toggleClass('active');
    });
    $('body').on('click', '#compare-close', function(e){
        $('#show_compare').css('display', 'none');
    });
    $('body').on('click','.questions-content__list .item',function() {
        console.log('a')
        if($(this).hasClass('active')) {
            $('.questions-content__list .item').removeClass('active');
        } else {
            $('.questions-content__list .item').removeClass('active');
            $(this).addClass('active');
        }
    });
    // Load phân trang tại listdata
    $('body').on('click', '.pagination__numbers .page-link', function(e) {
        e.preventDefault();
        let href = $(this).attr('data-href');
        loadData(href);
        $("html, body").stop().animate({
            scrollTop: $('#listdata').position().top
        }, 1)
    });
    $('body').on('click', '.menu-icon', function() {
        $('#overlay-menu-mobile').addClass('active')
        $(this).closest('.header_mobile').find('.header_mobile__menu').addClass('active');
    })
    $('body').on('click', '.menu-close', function() {
        $('#overlay-menu-mobile').removeClass('active')
        $(this).closest('.header_mobile').find('.header_mobile__menu').removeClass('active');
    })
    $('body').on('click', '#overlay-menu-mobile', function() {
        $(this).removeClass('active')
        $('.header_mobile .header_mobile__menu').removeClass('active');
    })
    $('body').on('click', '.menu_item .icon-down.icon-down-lv1', function(){
        $(this).toggleClass('active');
        $(this).parent().find('.list_child2').slideToggle()
    });
    $('body').on('click', '.menu_item .list_child2 .icon-down', function(){
        $(this).toggleClass('active');
        $(this).parent().find('.list_child3').slideToggle()
    });

    // hover submenu
    $('body.page-view .menu_level1').hover(function(){
        $(this).addClass('active');
    }, function(){
        $(this).removeClass('active');
    });
    $( "body .menu_level1 .submenu" ).mouseover(function() {
        $(this).closest('li').addClass('active')
    });
    $( "body .menu_level1 .submenu" ).mouseleave(function() {
        $(this).closest('li').removeClass('active')
    });
    $( "body" ).on('click', '.find-store', function() {
        filTXT()
        $(this).parent().find('input').val('');
    });
    $('.form-control').on('click keyup', function(e){
        $( this ).css({'border':'1px solid #B6B6B6'}).css({'visibility':'visible'});
        $(this).parent().find('.err_show').removeClass('active');
    });
    // them gio hang
    $("body").on("click", ".add-to-cart",function(e){
        if($(this).hasClass('noClick')) {
            alert_show('error', 'Xin lỗi, Sản phẩm tạm hết hàng!');
            return false;
        }
        let productId = $(this).data("productid");
        let type = $(this).data("type");
        loadingBox('open');
        $.ajax({
            type:'post',
            url:'/ajax/add-to-cart',
            data:{
                'productId':productId,
                'type':type
            },
            success:function(result){
                $('.cart-count').text(result.count);
                $('.cart-price').text(result.price);
                alert_show(result.type, result.message)
                loadingBox('close');
                if(result.redirect && result.redirect != '') {
                    setTimeout(function(){
                        window.location.href = result.redirect;
                    }, 500)
                }
            },
            error: function (error) {
                loadingBox('close');
                alert_show('error', 'Có lỗi xảy ra vui lòng thử lại!');
            }
        });
    });
    //xem thêm bài tin tìm kiếm
    $('body').on('click', '#more_post_search a', function(){
        var id = $(this).data('id');
        var data = {
            id: id, 
        }
        $.ajax({
            method: 'POST',
            url: '/ajax/load_post_search',
            dataType:'json',
            data : data,
            beforeSend: function(){
                loadingBox('open');
            },
            success: function(data){
                setTimeout(function() {
                    loadingBox('close');
                }, 800);
                if(data.status == '1'){
                    // setTimeout(function() {
                        $("#more_post_search").remove();
                        $(".search_posts__list").append(data.html);
                    // }, 1000);
                        // lazyload();
                }
            },
            error: function(error) {
                /* Act on the event */
                loadingBox('close');
                alert_show(type='error','Có lỗi xảy ra, vui lòng thử lại !');
            },
        });
    });
});
// check validate order
function validForm(form) {
    var check = true;
    $('.err_show').removeClass('active');
    $('#'+form+' .form-control').each(function(){
        var name = $( this ).attr('name');
        $( this ).css({'border':'1px solid #d5d5d5'}).css({'visibility':'visible'});
        if($( this ).val() == '') {
            $( this ).focus();
            $( this ).parent().find('.err_show.null').addClass('active');
            $( this ).css({'border':'2px solid #dc1f26'}).css({'visibility':'visible'});
            check = false;
        }
        if($( this ).val() != '' && $( this ).attr('name') == 'email' && !isEmail($( this ).val())) {
            $( this ).parent().find('.err_show.email').addClass('active');
            $( this ).css({'border':'2px solid #dc1f26'}).css({'visibility':'visible'});
            check = false;
        }
        if($( this ).val() != '' && $( this ).attr('name') == 'phone' && !isPhone($( this ).val())) {
            $( this ).parent().find('.err_show.phone').addClass('active');
            $( this ).css({'border':'2px solid #dc1f26'}).css({'visibility':'visible'});
            check = false;
        }
        if($( this ).val() == 0 && $( this ).attr('name') == 'product_name') {
            $( this ).parent().find('.err_show').addClass('active');
            $( this ).css({'border':'2px solid #dc1f26'}).css({'visibility':'visible'});
            check = false;
        }
        // if(check == false){
        //     // console.log($('#'+form+' .form-control:first-child .err_show.active'))
        //     var t = $('#'+form).position().top - 100;
        //     $("html, body").animate({ scrollTop: t }, "slow");
        // }
    });
    return check;
}
function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
};
function isPhone(phone) {
    var regex = /((09|03|07|08|05)+([0-9]{8})\b)/g;
    return regex.test(phone);
}; 
// LoadingBox
function loadingBox(type='open') {
    if (type == 'open') {
        $("#loading_box").css({visibility:"visible", opacity: 0.0}).animate({opacity: 1.0},200);
    } else {
        $("#loading_box").animate({opacity: 0.0}, 200, function(){
            $("#loading_box").css("visibility","hidden");
        });
    }
}
function alert_show(type='success',message='') {
    $('#toast-container .toast').addClass('toast-'+type);
    $('#toast-container .toast div').text(message);
    $('#toast-container').css('display','block');
    setTimeout(function() {
        $('#toast-container').css('display','none');
        $('#toast-container .toast').removeClass('toast-'+type);
        $('#toast-container .toast div').text('');
    }, 2000);
}
function contact(form,type) {
    if(validForm(form) == true) {
        var name = $('#'+form+' input[name="name"]').val(); 
        var phone = $('#'+form+' input[name="phone"]').val();
        var email = $('#'+form+' input[name="email"]').val();
        var content = $('#'+form+' textarea[name="content"]').val(); 
        // console.log(name, email, phone, content);
        $.ajax({
            url: '/ajax/contact',
            method: "POST",
            data: {
                name:name,
                phone:phone,
                email:email,
                content:content,
                type:type
            },
            beforeSend: function () {
                loadingBox('open');
            },
            success: function (data) {
                $('#'+form + ' .form-control').val('');
                $('#'+form + ' input[name=email').val(''); 
                if(data.status == 1){
                    setTimeout(function(){
                        loadingBox('close');
                        alert_show('success',data.message);
                    },3000);
                }
            },
            error: function (error) {
                loadingBox('close');
                alert_show('error', $('#loading_box').data('error'));
            }
        });
    }
}

function update_url(url_page) {
    history.pushState(null, null, url_page);
}
// truyền param lên url
// param_obj: là một obj có dạng {key:value,key1:value2}
function pushOrUpdate(param_obj) {
    var url = new URL(window.location.href);
    $.each(param_obj, function(key, value) {
        url.searchParams.set(key, value);
    })
    var newUrl = url.href;
    update_url(newUrl);
}
// Lấy gái trị param tại Url
function getUrlParameter(url, name) {
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(url);
    if (results==null) {
       return null;
    }
    return decodeURI(results[1]) || null;
}
function checkEmpty(value) {
    if (value == null) {
        return true;
    } else if (value == 'null') { 
        return true;
    } else if (value == undefined) { 
        return true;
    } else if (value == '') { 
        return true;
    } else if(value == []) {
        return true;
    } else {
        return false;
    }
}
function loadAjaxGetPaginate(url, option, type){
    if (checkEmpty(type)) { type = 'progress'; }
    var _option = {
        beforeSend:function(){},
        success:function(result){},
        error:function(error){}
    }
    $.extend(_option,option);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: url,
        beforeSend: function(){
            loadingBox('open');
        },
        success:function(result){
            loadingBox('close');
            _option.success(result);
        },
        error: function (error) {
           /* Có lỗi sẽ ân Module Loading và thông báo */
            loadingBox('close');
            alert('Có lỗi xảy ra. Vui lòng thử lại!', 'error')
            _option.error(error);
        }
    })
}
// Load Dữ liệu ListData
// animate: progress | loading | no_action
function loadData(link = null, animate='progress') {
    if(link  === null ) link = window.location.href
    loadAjaxGetPaginate(link, {
        beforeSend: function(){},
        success:function(result){
            if(result.type === 'append') {
                $('#listdata .product_list__bottom').append(result.html);
            } else {
                $('#listdata .product_list__bottom').empty()
                $('#listdata .product_list__bottom').append(result.html);
            }
            $('#listdata .list-order').empty();
            $('#listdata .list-order').append(result.html);

            $('#listdata .list').empty();
            $('#listdata .list').append(result.html);

            $('.filter-result').empty();
            $('.filter-result').append(result.html_result);            
            
            $('.filter-list__item').removeClass('show')

            $('.perpage').empty(); 
            $('.perpage').append(result.pagination);
        },
        error: function (error) {}
    }, animate);
}
function loadUrl(name, value) {
    var url = $('#search_url').val()
    string = name+'='+value;
    var newurl = '', loadHref = '';
    if (url.lastIndexOf(name) != -1) {
        if (url.lastIndexOf(string) != -1 && (name == 'priceSort' || name == 'sort') || name.includes('filter')) {
            newurl = url.replace("?" + string + '&', "?"),
            newurl = newurl.replace("&" + string, ""),
            newurl = newurl.replace("?" + string, "");
            loadHref = newurl;
        }else {
            newurl = url.split(name);
            var after_url = newurl[1].split('&');
            if(after_url[1] != undefined)
            {
                loadHref = newurl[0]+string+'&'+after_url[1];
            } else {
                loadHref = newurl[0]+string;
            }
        }
    } else {
        if (url.lastIndexOf('?') != -1) {
            loadHref = url+'&'+string;
        } else {
            loadHref = url+'?'+string;
        }
    }
    $('#search_url').val(loadHref)
    loadData(loadHref);
}
function loadDestination(select, url, result, message, type) {
    loadingBox('open');
    var id = $(select).val();
    if(id == '') {
        loadingBox('close');
        alert_show('error',message);
    } else {
        $.ajax({
            type: 'POST',
            cache: false,
            url: url,
            data: {
                'id': id,
                'type' : type
            },
            success: function(data){
                $(result).empty();
                $(result).html(data);
                loadingBox('close');
                if(select == '#district_id' && $('#payment_cart').length > 0) {
                    shippingFee();
                }
            },
            error: function(data) {
                loadingBox('close');
                alert_show('error', $('#loading_box').data('error'));
            },
        });
    }
}

//comment
function formComment(formname){
    if(validForm(formname)) {
        var phone = $('#' + formname+' input[name="phone"]').val();
        var name = $('#' + formname+' input[name="name"]').val();
        var content = $('#' + formname+' textarea[name="content"]').val();
        var type = $('#' + formname+' input[name="type"]').val();
        var type_id = $('#' + formname+' input[name="type_id"]').val();
        var vote = $('#' + formname+' input[name="vote"]').val();
        var data_id = $('#' +formname + ' input[name="data_id"]').val();
        if(vote == 0){
            alert_show(type='error','Chưa chọn số sao đánh giá');
            $('#'+formname).on('submit', function(e){
                e.preventDefault();
            })
            return false;
        }
        var data = {
            name: name, 
            phone: phone, 
            content: content, 
            type_id: type_id, 
            type: type, 
            vote: vote,
            data_id: data_id,
        };       
        $.ajax({
                method: 'POST',
                url: '/ajax/formComment',
                dataType:'json',
                data : data,
            beforeSend: function(){
                loadingBox('open');
            },
            success: function(data){
                setTimeout(function() {
                    loadingBox('close');
                }, 800);
                alert_show(data.type, data.message);
                console.log(data)
                if(data.status == '1'){
                    setTimeout(function() {
                        $(".comments > ul").prepend(data.html);
                        $('.votes_form_button').show();
                        $('.votes .votes_form_add').slideToggle();
                        if(type == 'posts') {
                            $(".comments > ul").show();
                            $('.comments_title').text('Bình luận của người dùng');
                        }
                    }, 1000);
                }
                if(data.status == '2'){
                    setTimeout(function() {
                        $(".comment"+data.parent_id+" .comment-child").prepend(data.html);
                        $('.comments > ul .reply').slideUp('slow');
                    }, 2000);
                }
                setTimeout(function() {
                    $('.'+formname+' input.input_field').val('');
                    $('.'+formname+' textarea.input_field').val('');
                }, 3000);
            },
            error: function(error) {
                /* Act on the event */
                loadingBox('close');
                alert_show(type='error','Có lỗi xảy ra, vui lòng thử lại !');
            },
        });
    }
    $('#'+formname).on('submit', function(e){
        e.preventDefault();
    })
    return false;
}
function addCompare(id, name, image, price, cate_id) {
    $.ajax({
        url: '/ajax/add-compare',
        type: 'POST',
        data: {id: id, name: name, image: image, price: price, cate_id: cate_id},
        beforeSend: function () {
        },
        success: function (data) {
            $('#show_compare').empty();
            $('#show_compare').append(data.html);
            $('#show_compare').css('display', 'block');
            if(data.status == 1){
            } else {
                alert_show(type='error', data.message);
            }
        },
        error: function (error) {

        }
    })
}
function removeCompare(id, page='single') {
    $.ajax({
        url: '/ajax/remove-compare',
        type: 'POST',
        data: {id: id, page: page},
        beforeSend: function () {
        },
        success: function (data) {
            if(page == 'compare') {
                window.location.href = data.link;
            }
            $('#show_compare').empty();
            $('#show_compare').append(data.html);
            $('#show_compare').css('display', 'block');
        },
        error: function (error) {

        }
    })
}
function TextToAlias(n){
    return n?n.replace(/[áàảãạâấầẩẫậăắằẳẵặ]/ig,"a").replace(/[đ]/ig,"d").replace(/[éèẻẽẹêếềểễệ]/ig,"e").replace(/[íìỉĩị]/ig,"i").replace(/[óòỏõọôốồổỗộơớờởỡợ]/ig,"o").replace(/[ýỳỷỹỵ]/ig,"y").replace(/[úùủũụưứừửữự]/ig,"u").replace(/\s+/ig,"-").replace(/[-]+/ig,"-").replace(/^[-]+|[-]+$/ig,"").replace(/[^a-z0-9-]/ig,"").toLowerCase():""
}
function filTXT() {
    $(".store-item").css("display", "block").removeClass('none');
    var n = $.trim($('#suggest_shop').val()).toLowerCase(),
    t = TextToAlias(n);
    n.length > 0 ? ($(".store-item").each(function() {
        var r = $(this),
        i = r.text().toLowerCase();
        i.indexOf(n) != -1 || TextToAlias(i).indexOf(t) != -1 ? $(this).css("display", "block") : $(this).addClass('none').css("display", "none")
    }), $(".view-more-filter-left").hide()) : ($(".filter-group.provinces >.field-check").each(function() {
        $(this).css("display", "")
    }), $(".view-more-filter-left").show())
    $('.list-store').each(function(){
        let html = '';
        $(this).find('.store-item.none').each(function(){
            let map = $(this).data('map');
            html += `<div class="list-item bottom-list__item store-item none" style="display: none;" data-map='`+map+ `/'` + $(this).html() + `</div>`;
        })
        $(this).find('.store-item.none').remove();
        $(this).append(html);
    })
}

if($('.css-content .mce-toc >h2 img').length > 0){
    $('body').on('click','.css-content .mce-toc >h2 img', function(){
        $(this).parent().parent().find('>ul').slideToggle();
    })
}else{
    $('body').on('click','.css-content .mce-toc >h2', function(){
        $(this).css('cursor', 'pointer')
        $(this).parent().find('>ul').slideToggle();
    })
}
