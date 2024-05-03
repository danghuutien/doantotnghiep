$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function() {
    $('body').on('click', '.btn_rating', function(){
        $(this).parents().find('.popup_comment').toggleClass('active');
    });
    $('body').on('click', '.toggleContent', function(){
        $(this).parents().toggleClass('active');
    });
    $('body').on('click', '.showallproduct', function(){
        let href = $('.pagination__numbers .next-page').data('href')
        if(href == undefined || href == '') {
            $(this).remove();
            return;
        }
        loadData(href);
    });
    $('body .list-inline a').hover(function(e){
        let star = $(this).data('point');
        for(var i=1;i<=5;i++){
            if(i<=star){
                $('.list-inline a.star-'+i).addClass('active');
            }else {
                $('.list-inline a.star-'+i).removeClass('active')
            }
        }
    }, function(){
        let current_star = $('.comments-add__vote input[name="rank"]').val();
        for(var i=1;i<=5;i++){
            if(i<=current_star){
                $('.list-inline a.star-'+i).addClass('active');
            }else {
                $('.list-inline a.star-'+i).removeClass('active')
            }
        }
    });
    $('body').on('click', '.list-inline a', function(e){
        e.preventDefault();
        let star = $(this).data('point');
        for(var i=1;i<=5;i++){
            if(i<=star){
                $('.list-inline a.star-'+i).addClass('active');
            }else {
                $('.list-inline a.star-'+i).removeClass('active')
            }
        }
        $('.comments-add__vote input[name="rank"]').val(star).change();
    });
    $('.product_favorite .owl-carousel').owlCarousel({
        loop: true,
        autoplay: false,
        autoplayTimeout: 2500,
        autoplayHoverPause: true,
        margin: 13,
        dots: false,
        nav: true,
        items: 3,
        lazyLoad: true,
        smartSpeed: 1000,
        navText: ['<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 278.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/></svg>',
         '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M342.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L274.7 256 105.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>'],
        responsive: {
            0: {
                items: 1,
            },
            390: {
                items: 1,
            },
            576: {
                items: 2,
            },
            900: {
                items: 2,
            },
            1200: {
                items: 3,
            },
        }
    });
    if($('.product_single').length) {
        $('.venobox').venobox();
        $('.images_list_for').slick({
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.images_list_nav'
        });
        $('.images_list_nav').slick({
            infinite: false,
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.images_list_for',
            dots: false,
            focusOnSelect: true,
            prevArrow: '<button class="nav nav-prev"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="15" height="15"><path d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" fill="#fff"/></svg></button>',
            nextArrow: '<button class="nav nav-next"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" width="15" height="15"><path d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z" fill="#fff"/></svg></button>',
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                    }
                }
            ]
        });
        $('body').on('click', '.view_more span', function(){
            var detail = $(this).parents('.detail_left__show').find('.css-content');
            if(detail.hasClass('active')) {
                $(this).parents('.detail_left__show').find('.css-content').removeClass('active');
                $(this).empty();
                $(this).append('Xem thêm');
            }else {
                $(this).parents('.detail_left__show').find('.css-content').addClass('active');
                $(this).empty();
                $(this).append('Ẩn bớt');
            }
        });
        $('body').on('click', '.specifications', function(){
            $('.specifications_popup').toggleClass('active');
        });
        $('body').on('click', '.specification_close', function(){
            $(this).parents('.specifications_popup').removeClass('active');
        });
    }
    $('body').on('click','.phone_order',function(){
        let phone =$(this).parent().find('input[name="phone"]').val();
        let product_id =$(this).parent().find('input[name="product_id"]').val();
        let _this = $(this);
        if(phone != '' && phone != undefined){
            if (!isPhone(phone)) 
            {
                alert_show(type = 'error', 'Số điện thoại của bạn không đúng định dạng!');
                $('.phone').val('');
            }else{
                loadingBox('open');
                $.ajax({
                    dataType:'json',type:'POST',
                    data:{
                        phone:phone,
                        product_id:product_id
                    },
                    url: '/ajax/phone_order',
                    method: "POST",
                    success:function(data){
                        loadingBox('close');
                        _this.parent().find('input[name="phone"]').val('');
                        alert_show(type='success', 'Thành công! Chúng tôi sẽ gọi lại cho bạn!');
                    },
                    error:function(){
                        loadingBox('close');
                        alert_show(type='error','Có lỗi xảy ra!');
                    }
                })
                $('.phone').val('');
            }
        }else{
            alert_show(type = 'error', 'Bạn chưa điền số điện thoại!');
        }
    })
    if($('.lang_comments').length) {
    	variable = $('.lang_comments').data('value');
    	variable = atob(variable);
    	variable = JSON.parse(variable);
    }
    content = null;
    file_data = null;
    parent_id = null;
     // Thêm bình luận
    $('body').on('click', '.comments *[data-comments_submit]', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        comments = $(this).closest('.comments');
        type = comments.data('type');
        type_id = comments.data('type_id');
        name = $(this).closest('.comments-add').find('*[name=name]').val();
        phone = $(this).closest('.comments-add').find('*[name=phone]').val();
        vote = $(this).closest('.comments-add').find('*[name=rank]').val();
        content = $(this).closest('.comments-add').find('*[name=content]').val();
        parent_id = $(this).data('comment_id');
        if (content == '' || name == '' || phone == '' || content == undefined || name == undefined || phone == undefined ) {
            alertTextCmt(variable.valid_empty);
        } else if (!isPhone(phone)) {
            alertTextCmt(variable.valid_format_phone);
        } else if (vote == '' || vote == undefined) {
            alertTextCmt('Vui lòng chọn số sao đánh giá!');
        } else {
            form_data = new FormData();
            form_data.append('type', type);
            form_data.append('type_id', type_id);
            form_data.append('content', content);
            form_data.append('name', name);
            form_data.append('phone', phone);
            form_data.append('vote', vote);
            form_data.append('parent_id', parent_id);
            $('.comments .comments-add__preview .image').each(function(){
                let input = $(this).find('input');
                form_data.append('files[]', input[0].files[0]);
            });
            commendAdd(type, type_id, $(this), form_data);
        }
    })
    $('body').on('click', '.votes_form__btn' , function(){
        if($(this).hasClass('active')) {
            $(this).find('a').text('Gửi đánh giá của bạn');
        } else {
            $(this).find('a').text('Hủy');
        }
        $(this).toggleClass('active')
        $(this).closest('.comments').find('.comments-add').slideToggle();
    })
    // Popup hình ảnh
    $('body').on('click', '.comments .popup-image', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        src = $(this).data('image');
        $(this).closest('.comments').find('.previews').find('.comments-popup__body').find('img').attr('src', src);
        $(this).closest('.comments').find('.previews').addClass('open');
        $('body').css('overflow', 'hidden');
    });
    // Ảnh preview
    $('body').on('change', 'input[name=comment_file]', function(e) {
        e.preventDefault();
        file = this.files;
        check_extention = 0;
        allowed_size = variable.allowed_size; // Tổng kích thước các file là được dặt trong config
        allowed_extention = ['jpg','jpeg','png']; // Chỉ cho phép upload một số file nhất định
        let item_file = 0 ;
        $(this).closest('.comments-add').find('.comments-add__preview').empty().change();
        $.each(file,function(index,file_data) {
            if (file_data.size > allowed_size) {
                check_size = 1;
            }
            if ($.inArray(file_data.name.split('.').pop().toLowerCase(), allowed_extention) == -1) {
                // TH có ext khác thì k insert
                check_extention = 1;
            }else {
                image_preview = URL.createObjectURL(file_data);
                let html_image = `<div class="image">
                    <img src="${image_preview}">
                    <input type="file" name="image[]" id="upload_${item_file}" style="display: none;">
                </div>`;
                $('.comments-add').find('.comments-add__preview').append(html_image);
                let fileInput = document.querySelector('input#upload_'+item_file);
                let b = new ClipboardEvent("").clipboardData || new DataTransfer();
                // lớn hơn 500kb thì reduce
                if(file_data.size > 512000 || file_data.fileSize > 512000) {
                    resizeImage(file_data, {
                        use_reader: false,
                        mode: 2,
                        val: 400,
                        type: 'image/jpeg',
                        quality: 0.8,
                        callback: function(result) {
                            let myFile = dataURLtoFile(result, file_data.name);
                            b.items.add(myFile)
                            fileInput.files =  b.files;
                        }
                    });
                }else {
                    b.items.add(file_data)
                    fileInput.files =  b.files;
                }
                item_file++;
            }
        });
        if (check_extention == 1) {
            alertTextCmt(variable.valid_extention+' '+allowed_extention.join(', '));
        }
    });

    // load thêm bình luận
    $('body').on('click', '.comments *[data-comments_loadmore]', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        type = $(this).closest('.comments').data('type');
        type_id = $(this).closest('.comments').data('type_id');
        pageCmt = parseInt($(this).data('page_cmt'));
        pageCmt = pageCmt+1;
        commentSearch(type, type_id, null, pageCmt, $('.comments .page-header__short select').val(), $(this), false)
    });
    $('body').on('change', '.comments .page-header__short select', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        type = $(this).closest('.comments').data('type');
        type_id = $(this).closest('.comments').data('type_id');
        pageCmt = 1;
        let sort = $(this).val();
        commentSearch(type, type_id, null, pageCmt, sort, $(this), true)
    });
    // Tì kiếm bình luận
    start = null
	// Trả lời bình luận
	$('body').on('click', '.comments *[data-reply]', function(e) {
		e.preventDefault();
        e.stopImmediatePropagation();
		item = $(this).closest('.item[data-comment_id]');
		tags = $(this).data('reply');
		$('.item-reply').find('.comments-add').css('display', 'none');
		$('.comments-add__moreinfo').css('display', 'none');
		item.find('.item-reply').find('.comments-add').slideDown();
		item.find('.item-reply').find('.comments-add').find('.comments-add__form-field').val(tags);
	});
    // Hiển thị thông tin thêm
    $('body').on('click', '.comments *[data-comments_moreinfo]', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        $(this).closest('.comments').find('.moreinfo').addClass('open');
        $('body').css('overflow', 'hidden');
        content = $(this).closest('.comments-add').find('*[name=content]').val();
        parent_id = $(this).data('comment_id');
        if (variable.upload_image == true) { 
            file_data = $(this).closest('.comments-add').find('*[name=comment_file]').prop("files"); 
        }
	})

	// Đóng popup
	$('body').on('click', '.comments *[data-comments_close]', function(e) {
		e.preventDefault();
        e.stopImmediatePropagation();
		$(this).closest('.comments-popup').removeClass('open');
        $('body').css('overflow', 'auto');
        content = null;
        file_data = null;
        parent_id = null;
	})


});
function dataURLtoFile(dataurl, filename) {
    var arr = dataurl.split(','),
        mime = arr[0].match(/:(.*?);/)[1],
        bstr = atob(arr[1]),
        n = bstr.length,
        u8arr = new Uint8Array(n);

    while(n--){
        u8arr[n] = bstr.charCodeAt(n);
    }
    return new File([u8arr], filename, {type:mime});
}
// Alert
function alertTextCmt(text) {
	alert_show('error', text)
}

function commentLoad(type, type_id, pageCmt, this_element, reload) {
	data = {
		type: type,
		type_id: type_id,
		pageCmt: pageCmt,
	};
	$.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: variable.ajax_load_url,
        data: data,
        beforeSend: function(){
            $(".comments-loading").css({visibility:"visible", opacity: 0.0}).animate({opacity: 1.0},200);
        },
        success:function(result) {
            $(".comments-loading").animate({opacity: 0.0}, 200, function(){
                $(".comments-loading").css("visibility","hidden");
            });
            // Thay đổi số lượng bình luận ở tổng bình luận
            this_element.closest('.comments').find('.total-comment').text(result.comment_totals);

            if (result.has_more == false) {
                // has_more bằng false thì ẩn box xem thêm
            	this_element.closest('.comments').find('.comments-loadmore').css('display', 'none');
            } else {
                // Hiển thị box xem thêm
            	this_element.closest('.comments').find('.comments-loadmore').css('display', 'block');
            }

            // reload là true thì sẽ load lại box bình luận
            if (reload == true) {
                // làm trống danh sách sách và đổ lại
                this_element.closest('.comments').find('.comments-list').empty().append(result.html);
            } else {
                // Đổ tiếp bình luận dưới bình luận hiện có
            	this_element.closest('.comments').find('.comments-list').append(result.html);
            }

            // Set lại giá trị số trang hiện tại ở nút xem thêm
            this_element.closest('.comments').find('*[data-comments_loadmore]').data('page_cmt', pageCmt).attr('data-page_cmt', pageCmt);
            
            // Set lại giá trị ô tìm kiếm vè rỗng
            this_element.closest('.comments').find('.comments-info__filter').find('input[name=keyword]').val('');
        },
        error: function (error) {
            /* Có lỗi sẽ ân Module Loading và thông báo */
            $(".comments-loading").animate({opacity: 0.0}, 200, function(){
                $(".comments-loading").css("visibility","hidden");
            });
            alertTextCmt(variable.ajax_load_error_text);
        }
    })
}
// Thêm bình luận
function commendAdd(type, type_id, this_element, form_data) {
	$.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: variable.ajax_add_url,
        data: form_data,
        enctype: 'multipart/form-data',
        processData: false,
        contentType: false,
        beforeSend: function(){
            loadingBox('open');
        },
        success:function(result){
            loadingBox('close');
            if (result.status == 2) {
            	alertTextCmt(result.message);
            } else {
                // Reload bình luận
            	commentLoad(type, type_id, 1, this_element, true);
                // Set các giá trị tại form về rỗng
                this_element.closest('.comments').find('*[name=content]').val('');
                this_element.closest('.comments').find('*[name=name]').val('');
                this_element.closest('.comments').find('*[name=phone]').val('');
                this_element.closest('.comments').find('*[name=rank]').val('');
                this_element.closest('.comments').find('*[name=parent_id]').val('');
                this_element.closest('.comments').find('*[name=comment_file]').val('');
                // Set lại giá trị số trang hiện tại ở nút xem thêm
                this_element.closest('.comments').find('*[data-page_cmt]').attr('data-page_cmt', 1).data('page_cmt', 1);
                // Làm trống box review ảnh
                this_element.closest('.comments').find('.comments-add__preview').empty();
                // ẩn box thông tin người dùng
                this_element.closest('.comments').find('.moreinfo').removeClass('open');
                $('body').css('overflow', 'auto');
            }
        },
        error: function (error) {
            /* Có lỗi sẽ ân Module Loading và thông báo */
            loadingBox('close');
            alertTextCmt(variable.ajax_load_error_text);
        }
    })
}
function commentSearch(type, type_id, keyword, pageCmt, sort, this_element, reload) {
    data = {
        type: type,
        type_id: type_id,
        keyword: keyword,
        pageCmt: pageCmt,
        sort: sort,
    };
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: variable.ajax_search_url,
        data: data,
        beforeSend: function(){
            loadingBox('open');
        },
        success:function(result) {
            loadingBox('close');

            if (result.has_more == false) {
                // has_more bằng false thì ẩn box xem thêm
                this_element.closest('.comments').find('.comments-loadmore').css('display', 'none');
            } else {
                // Hiển thị box xem thêm
                this_element.closest('.comments').find('.comments-loadmore').css('display', 'block');
            }

            // reload là true thì sẽ load lại box bình luận
            if (reload == true) {
                // làm trống danh sách sách và đổ lại
                this_element.closest('.comments').find('.comments-list').empty().append(result.html);
            } else {
                // Đổ tiếp bình luận dưới bình luận hiện có
                this_element.closest('.comments').find('.comments-list').append(result.html);
            }
            // Set lại giá trị số trang hiện tại ở nút xem thêm
            this_element.closest('.comments').find('*[data-comments_loadmore]').data('page_cmt', pageCmt).attr('data-page_cmt', pageCmt);
        },
        error: function (error) {
            /* Có lỗi sẽ ân Module Loading và thông báo */
            loadingBox('close');
            alertTextCmt(variable.ajax_load_error_text);
        }
    })
}

$('#relate_products .owl-carousel').owlCarousel({
    loop: false,
    autoplay: true,
    autoplayTimeout: 4000,
    autoplayHoverPause: true,
    margin: 13,
    dots: false,
    nav: true,
    items: 3,
    lazyLoad: true,
    smartSpeed: 1000,
    navText: ['<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 278.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/></svg>',
     '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M342.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L274.7 256 105.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>'],
    responsive: {
        0: {
            items: 1,
        },
        390: {
            items: 1,
        },
        576: {
            items: 2,
        },
        900: {
            items: 2,
        },
        1200: {
            items: 3,
        },
    }
});

$('.checkbox-module .filter-parent').click(function(){
    $('.checkbox-module .filter-parent').each(function(index, element){
        $(element).find('.box-filter__detail').removeClass('active')
    })
    $(this).find('.box-filter__detail').addClass('active')
    $(this).parent().find('#overlay_filter').addClass('active')
})
$('.checkbox-module #overlay_filter').click(function(){
    $(this).removeClass('active')
    $(this).parent().find('.box-filter__detail').removeClass('active')
})
