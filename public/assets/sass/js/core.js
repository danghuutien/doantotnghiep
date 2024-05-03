$(document).ready(function() {
// di chuyển lên đầu trang
    // Thẻ có data-gototop khi click vào sẽ luộn lên top
    // eg: <a href="javascript:;" data-gototop>Lên trên top</a>
    $('body').on('click', '*[data-gototop]', function(e){
        e.preventDefault();
        $("html, body").animate({ scrollTop: 0 }, "slow");
    });

// Cuộn chuột
    /*
        Hiệu ứng cuộn xuống 1 id/class duy nhất nào đó trong trang
        data-scroll: id/class box muốn cuộn
        data-top: là một số sẽ đặt một khoảng cách top là giá trị
        eg: <a href="#id" data-scroll="#id" data-top="20">Click cuộn xuống</a>
    */
    $('body').on('click','*[data-scroll]',function(e) {
        e.preventDefault();
        id = $(this).data('scroll');
        offset_top = $(this).data('top');
        if (!checkEmpty(offset_top)) {
            offset_top = $(id).offset().top-offset_top;
        } else {
            offset_top = $(id).offset().top;
        }
        $('html, body').animate({scrollTop: offset_top}, 500);
    });

// Toggle box
    /*
        Khi click vào data-toggle_multi hoặc data-toggle_single thì sẽ tạo hiệu ứng toggle cho data-toggle_box
        data-toggle_multi và data-toggle_single: không giá trị, là nút click box
        data-toggle_wrap: không giá trị, là box cha chứa cả data-toggle_multi và data-toggle_box
        data-toggle_box: không giá trị, là box muốn toggle
        eg:
        <div data-toggle_wrap>
            <div data-toggle_btn></div>
            <div data-toggle_box></div>
        </div>
    */
    $('body').on('click','*[data-toggle_multi]',function(e) {
        e.preventDefault();
        $(this).closest('*[data-toggle_wrap]').find('*[data-toggle_box]').slideToggle();
    });
    $('body').on('click','*[data-toggle_single]',function(e) {
        e.preventDefault();
        $(this).closest('*[data-toggle_wrap]').children('*[data-toggle_box]').slideToggle();
    });
    
// popup
    /* 
        Hiển thị popup
        data-popup: id popup, là id của popup muốn hiển thị
        eg: <a href="#popup" data-popup="#popup">Click hiển thị Popup</a>
    */
    $('body').on('click','*[data-popup]',function(e) {
        e.preventDefault();
        id = $(this).data('popup');
        if ($(id).length > 0) {
            $(id).addClass('open');
            $('body').css('overflow', 'hidden');
        }
    });
    /*
        Đóng popup
        Chú ý: phải được đặt trong div có class là popup
        data-popup_close: không giá trị, click sẽ ẩn Popup
        eg: <div data-popup_close>Đóng Popup</div>
    */
    $('body').on('click','*[data-popup_close]',function(e) {
        e.preventDefault();
        $(this).closest('.popup').removeClass('open');
        $('body').css('overflow', 'auto');
    });
    /*
        Click hiển thị popup và ẩn popup hiện tại
        Chú ý: phải được đặt trong div có class là popup
        data-popup_call: id Popup
        eg: <div data-popup_call="#popup">Mở Popup #popup</div>
    */
    $('body').on('click','*[data-popup_call]',function(e) {
        e.preventDefault();
        id = $(this).data('popup_call');
        $(this).closest('.popup').removeClass('open');
        $('body').css('overflow', 'auto');
        setTimeout(function() {
            $(id).addClass('open');
        },200);
    });
    /*
        popup auto hiện sau X giây
        Chú ý: phải được đặt tại div có class là popup
        data-popup_auto: số, là thời gian hiển thị sau x giây
        eg: <div class="popup" data-popup_auto="1000">Hiển thị sau 1s</div>
    */
    if ($('*[data-popup_auto]').length > 0) {
        $.each($('*[data-popup_auto]'), function() {
            element = $(this);
            time = parseInt($(this).data('popup_auto'));
            setTimeout(function() {
                element.addClass('open');
                $('body').css('overflow', 'hidden');
            }, time);
        })
    }
});