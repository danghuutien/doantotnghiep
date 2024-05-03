$(document).ready(function() {

    $('.system-content__form .top .top-content .top-content__left .btn-top').on('click',function(){
        $(this).parent().find('.btn-top').removeClass('active')
        $(this).addClass('active');
        let href = $(this).parent().data('link');
        let id = $(this).data('area');
        href = href + '?area='+id;
        loadData(href);
    });
    $('.showroom-system__content .top .top-left .btn-top').on('click',function(){
        $(this).parent().find('.btn-top').removeClass('active')
        $(this).addClass('active');
    });
    $('body').on('click', '.system-content__form .gallery_item',function(){
        let src = $(this).data('src');
        $(this).closest('.list-item__image').find('a img').attr('src', src)
    });
    if($('.shop_gallery .gallery-list').length) {
        $('.shop-info__image').slick({
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.shop_gallery .gallery-list'
        });
        $('.shop_gallery .gallery-list').slick({
            infinite: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            asNavFor: '.shop-info__image',
            dots: false,
            arrows: true,
            focusOnSelect: true,
            prevArrow: $('.slick-prev'),
            nextArrow: $('.slick-next')
        });
    }
});
