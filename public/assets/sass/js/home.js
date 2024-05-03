$(document).ready(function() {    
    // banner
    $('.banner-slide .owl-carousel').owlCarousel({
        loop: false,
        autoplay: false,
        autoplayTimeout: 8000,
        autoplayHoverPause: true,
        margin: 20,
        dots: true,
        nav: false,
        lazyLoad: true,
        smartSpeed: 1000,
        items: 1
    });
    // bestseller
    $('.bestseller-content__product.owl-carousel').owlCarousel({
        loop: false,
        autoplay: false,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        margin: 11,
        dots: false,
        nav: true,
        items: 4,
        lazyLoad: true,
        smartSpeed: 1000,
        navText: ['<svg width="10" height="19" viewBox="0 0 10 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.76334 9.51863L9.74478 1.34916C10.0851 1.02118 10.0851 0.544135 9.74478 0.245979C9.40449 -0.0819929 8.90951 -0.0819929 8.60015 0.245979L0.37123 8.62417C-0.123743 9.10122 -0.123743 9.87642 0.37123 10.4429L8.50735 18.7615C8.66203 18.9106 8.90951 19 9.09513 19C9.28074 19 9.49729 18.9106 9.68291 18.7615C10.0232 18.4335 10.0232 17.9565 9.68291 17.6583L1.76334 9.51863Z" fill="white"/></svg>', '<svg width="10" height="19" viewBox="0 0 10 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.23666 9.51863L0.25522 1.34916C-0.0850735 1.02118 -0.0850735 0.544135 0.25522 0.245979C0.595514 -0.0819929 1.09049 -0.0819929 1.39985 0.245979L9.62877 8.62417C10.1237 9.10122 10.1237 9.87642 9.62877 10.4429L1.49265 18.7615C1.33797 18.9106 1.09049 19 0.904872 19C0.719257 19 0.502707 18.9106 0.317092 18.7615C-0.0232019 18.4335 -0.0232019 17.9565 0.317092 17.6583L8.23666 9.51863Z" fill="white"/></svg>'],
        responsive: { 
            0: {
                items: 1,
            },
            430: {
                items: 2,
            },
            576: {
                items: 3,
            },
            1200: {
                items: 4,
            }
        }
    });
    $('.home-product .owl-carousel').owlCarousel({
        loop: false,
        autoplay: false,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        margin: 10,
        dots: false,
        nav: true,
        items: 1,
        lazyLoad: true,
        smartSpeed: 1000,
        navText: ['<svg width="10" height="19" viewBox="0 0 10 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.76334 9.51863L9.74478 1.34916C10.0851 1.02118 10.0851 0.544135 9.74478 0.245979C9.40449 -0.0819929 8.90951 -0.0819929 8.60015 0.245979L0.37123 8.62417C-0.123743 9.10122 -0.123743 9.87642 0.37123 10.4429L8.50735 18.7615C8.66203 18.9106 8.90951 19 9.09513 19C9.28074 19 9.49729 18.9106 9.68291 18.7615C10.0232 18.4335 10.0232 17.9565 9.68291 17.6583L1.76334 9.51863Z" fill="white"/></svg>', '<svg width="10" height="19" viewBox="0 0 10 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.23666 9.51863L0.25522 1.34916C-0.0850735 1.02118 -0.0850735 0.544135 0.25522 0.245979C0.595514 -0.0819929 1.09049 -0.0819929 1.39985 0.245979L9.62877 8.62417C10.1237 9.10122 10.1237 9.87642 9.62877 10.4429L1.49265 18.7615C1.33797 18.9106 1.09049 19 0.904872 19C0.719257 19 0.502707 18.9106 0.317092 18.7615C-0.0232019 18.4335 -0.0232019 17.9565 0.317092 17.6583L8.23666 9.51863Z" fill="white"/></svg>'],
    });

    $('.category-block__content.owl-carousel').owlCarousel({
        loop: false,
        autoplay: false,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        margin: 19,
        dots: false,
        nav: true,
        items: 4,
        lazyLoad: true,
        smartSpeed: 1000,
        navText: ['<svg width="10" height="19" viewBox="0 0 10 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.76334 9.51863L9.74478 1.34916C10.0851 1.02118 10.0851 0.544135 9.74478 0.245979C9.40449 -0.0819929 8.90951 -0.0819929 8.60015 0.245979L0.37123 8.62417C-0.123743 9.10122 -0.123743 9.87642 0.37123 10.4429L8.50735 18.7615C8.66203 18.9106 8.90951 19 9.09513 19C9.28074 19 9.49729 18.9106 9.68291 18.7615C10.0232 18.4335 10.0232 17.9565 9.68291 17.6583L1.76334 9.51863Z" fill="white"/></svg>', '<svg width="10" height="19" viewBox="0 0 10 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.23666 9.51863L0.25522 1.34916C-0.0850735 1.02118 -0.0850735 0.544135 0.25522 0.245979C0.595514 -0.0819929 1.09049 -0.0819929 1.39985 0.245979L9.62877 8.62417C10.1237 9.10122 10.1237 9.87642 9.62877 10.4429L1.49265 18.7615C1.33797 18.9106 1.09049 19 0.904872 19C0.719257 19 0.502707 18.9106 0.317092 18.7615C-0.0232019 18.4335 -0.0232019 17.9565 0.317092 17.6583L8.23666 9.51863Z" fill="white"/></svg>'],
        responsive: { 
            0: {
                items: 2,
            },
            430: {
                items: 2,
            },
            576: {
                items: 3,
            },
            1200: {
                items: 4,
            }
        }
    });
    $('.partner-list.owl-carousel').owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        margin: 89,
        dots: true,
        nav: false,
        items: 5,
        lazyLoad: true,
        smartSpeed: 1000,
        responsive: { 
            0: {
                items: 2,
                margin: 15,
            },
            430: {
                items: 3,
                margin: 15,
            },
            576: {
                items: 4,
                margin: 20,
            },
            1200: {
                items: 5,
            }
        }
    });
    $('body').on('click', '.showroom-system__content .btn-top', function(){
        if($(this).hasClass('active')) {
            $('.showroom-system__content .btn-top').removeClass('active');
        } else {
            $('.showroom-system__content .btn-top').removeClass('active');
            $(this).addClass('active');
        }
        $('.bottom-list').removeClass('active');
        $($(this).data('id')).addClass('active')
    });
    $('body').on('click', '.list-store .store-item', function(){
        let map = $(this).data('map');
        $(this).parents('.bottom').find('.map').empty();
        $(this).parents('.bottom').find('.map').append(map);
        $('.list-store .store-item').removeClass('active');
        $(this).addClass('active');
    });
    $('.video_item_left').hover(function() {
        var src = $(this).data('src');
        let image =  $(this).parents('.banner_thank__right').find('.background2 img');
        image.attr('src', src);
    });
    $('.venobox').venobox();
    $('body').on('click', '.video_right', function(e){
        e.preventDefault()
        let img = $(this).data('image_src');
        let href = $(this).data('link');
        let desc = $(this).data('desc')
        let title = $(this).find('p.color-white').text();
        let leftImage = $('.background1 img').attr('src')
        let leftTitle = $('.banner_thank__left .content-title').text()
        let leftDesc = $('.banner_thank__left .content-desc').text()
        let leftLink = $('.banner_thank__left .venobox').attr('href')
        let replaceCurrent = `
            <div class="content-list__item flex video_item_left video_right" data-link="${leftLink}" data-image_src="${leftImage}" data-desc="${leftDesc}">
                <p>
                    <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="17.5" cy="17.5" r="16.5" stroke="white" stroke-width="2"></circle>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M15 13L24 18L15 23V13V13Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </p>
                <h3 class="fs-18 lh-24 f-w-b ml-34 color-white">
                    <p class="color-white">${leftTitle}</p>
                </h3>
            </div>
        `;
        $(this).before(replaceCurrent)
        $(this).remove()
        $('.background1 img').attr('src', img)
        $('.banner_thank__left .content-title').text(title)
        $('.banner_thank__left .content-desc').text(desc)
        $('.banner_thank__left .venobox').attr('href', href)
    })
});
