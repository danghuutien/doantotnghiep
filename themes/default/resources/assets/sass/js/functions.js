// load ajax
/**
 * Dùng để load ajax post
 * @param string            url: link xử lý ajax
 * @param object            params: Giá trị truyền lên để xử lý
 * @param function          option: Hàm xử lý thêm [beforeSend | success | error]
 * @param string            type: Loại xử lý [ progress | loading ]
 * Demo cách code
    loadAjaxPost(url, params, {
        beforeSend: function(){},
        success:function(result){},
        error: function (error) {}
    }, 'progress');
 */
function loadAjaxPost(url, params, option, type){
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
        data: params,
        beforeSend: function(){
            switch (type) {
                case 'progress': activeProgress(0, 'open'); break;
                case 'loading': loadingBox('open'); break;
            }
            _option.beforeSend();
        },
        success:function(result){
            switch (type) {
                case 'progress': activeProgress(99, 'close'); break;
                case 'loading': loadingBox('close'); break;
            }
            _option.success(result);
        },
        error: function (error) {
            /* Có lỗi sẽ ân Module Loading và thông báo */
            switch (type) {
                case 'progress': activeProgress(99, 'close'); break;
                case 'loading': loadingBox('close'); break;
            }
            alertText('Có lỗi xảy ra. Vui lòng thử lại!', 'error')
            _option.error(error);
        }
    })
}
/**
 * Dùng để load ajax get
 * @param string            url: link xử lý ajax
 * @param function          option: Hàm xử lý thêm [beforeSend | success | error]
 * @param string            type: Loại xử lý [ progress | loading ]
 * Demo cách code
 * 
    loadAjaxGet(url, {
        beforeSend: function(){},
        success:function(result){},
        error: function (error) {}
    }, 'progress');
 */
function loadAjaxGet(url, option, type){
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
        type: 'GET',
        url: url,
        beforeSend: function(){
            switch (type) {
                case 'progress': activeProgress(0, 'open'); break;
                case 'loading': loadingBox('open'); break;
            }
            _option.beforeSend();
        },
        success:function(result){
            switch (type) {
                case 'progress': activeProgress(99, 'close'); break;
                case 'loading': loadingBox('close'); break;
            }
            _option.success(result);
        },
        error: function (error) {
            /* Có lỗi sẽ ân Module Loading và thông báo */
            switch (type) {
                case 'progress': activeProgress(99, 'close'); break;
                case 'loading': loadingBox('close'); break;
            }
            alertText('Có lỗi xảy ra. Vui lòng thử lại!', 'error')
            _option.error(error);
        }
    })
}
// LoadingBox
function loadingBox(type) {
    if (type == 'open') {
        $("#loading_box").css({visibility:"visible", opacity: 0.0}).animate({opacity: 1.0},200);
    } else {
        $("#loading_box").animate({opacity: 0.0}, 200, function(){
            $("#loading_box").css("visibility","hidden");
        });
    }
}
// LoadProgessBar
var progress = null;
function activeProgress(number, type) {
    clearInterval(progress);
    $('.progress-box').css('display', 'block');
    $('.progress-run').css('width', number+'%');
    progress = setInterval(function() {
        if (number <= 100) {
            $('.progress-run').css('width', number+'%');
            number = number + 1;
        } else {
            clearInterval(progress);
        }
    }, 100);
    if (type == 'close') {
        setTimeout(function() {
            $('.progress-run').css('width', '0%');
            $('.progress-box').css('display', 'none');
        }, 1000);
    }
}
function alertText(text, type) {
    switch (type) {
        case 'success': 
            
        break;
        case 'info': 
            
        break;
        case 'error': 
            
        break;
        case 'warning': 
            
        break;
    }
}

// check định dạng email
function validateEmail(email) {
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(String(email).toLowerCase());
}

// check định dạng số điện thoại
function validatePhone(phone) {
	var flag = false;
	phone = phone.trim();
    phone = phone.replace('(+84)', '0');
    phone = phone.replace('+84', '0');
    phone = phone.replace('0084', '0');
    phone = phone.replace(/ /g, '');
    if (phone != '') {
        if (phone.length >= 9 && phone.length <=11) {
        	flag = true;
        } else {
        	flag = false;
        }
    }
    return flag;
}

// thêm cookie
function setCookie(key, value, day) {
    var expires = new Date();
    expires.setTime(expires.getTime() + (day * 24 * 60 * 60 * 1000));
    document.cookie = key + '=' + value + ';path=/;expires=' + expires.toUTCString();
}
function setCookieWithPath(key, path ,value) {
	var expires = new Date();
    expires.setTime(expires.getTime() + (day * 24 * 60 * 60 * 1000));
    document.cookie = key + '=' + value + ';path='+path+';expires=' + expires.toUTCString();
}
// lấy cookie
function getCookie(key) {
    var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
    return keyValue ? keyValue[2] : null;
}
// Xóa cookie
function deleteCookie(key, path) {
	var expires = new Date();
    expires.setTime(expires.getTime()-1);
    document.cookie = key + '=; path='+path+'; expires=' + expires.toUTCString();
}

/**
 * rewrite url: thêm trên url không load lại trang
 * @param string            url_page: link dùng để cập nhật lên thanh url đã qua xử lý
 */
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
// Check giá trị tồn tại trong mảng
function checkValueInArray(value, arr){
	var status = false;
	for(var i=0; i<arr.length; i++){
		var name = arr[i];
		if(name == value){
		  	status = true;
		  	break;
		}
	}
	return status;
}

// Trả về true nếu rỗng
function checkEmpty(value) {
	if (value == null) { 
		return true;
	} else if (value == 'null') { 
		return true;
	} else if (value == undefined) { 
		return true;
	} else if (value == '') { 
		return true;
	} else {
		return false;
	}
}

// format định dạng kích thước
function formatSizeUnits(bytes){
    if      (bytes >= 1073741824) { bytes = (bytes / 1073741824).toFixed(0) + "GB"; }
    else if (bytes >= 1048576)    { bytes = (bytes / 1048576).toFixed(0) + "MB"; }
    else if (bytes >= 1024)       { bytes = (bytes / 1024).toFixed(0) + "KB"; }
    else if (bytes > 1)           { bytes = bytes + " bytes"; }
    else if (bytes == 1)          { bytes = bytes + " byte"; }
    else                          { bytes = "0 bytes"; }
    return bytes;
}

// lưu html 1 thẻ vào clipboard và copy
// Lấy copy trên iphone, ipad
window.Clipboard = (function(window, document, navigator) {
    var textArea,
        copy;
    function isOS() {
        return navigator.userAgent.match(/ipad|iphone/i);
    }
    function createTextArea(text) {
        textArea = document.createElement('textArea');
        textArea.value = text;
        document.body.appendChild(textArea);
    }
    function selectText() {
        var range,
            selection;
        if (isOS()) {
            range = document.createRange();
            range.selectNodeContents(textArea);
            selection = window.getSelection();
            selection.removeAllRanges();
            selection.addRange(range);
            textArea.setSelectionRange(0, 999999);
        } else {
            textArea.select();
        }
    }
    function copyToClipboard() {        
        document.execCommand('copy');
        document.body.removeChild(textArea);
    }
    copy = function(text) {
        createTextArea(text);
        selectText();
        copyToClipboard();
    };
    return {
        copy: copy
    };
})(window, document, navigator);
// Copy text
function copyText(text) {
    if(document.execCommand('copy')) {
        $('#copy-input').val(text).select();
        document.execCommand("copy");
    } else {
        Clipboard.copy(text);
    }
}

// Chuyển chuỗi sang dạng slug
function convertToSlug(str) {
    //Đổi chữ hoa thành chữ thường
    slug = str.toLowerCase();
    //Đổi ký tự có dấu thành không dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    //Xóa các ký tự đặt biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    //Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, "-");
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    //In slug ra textbox có id “slug”
    return slug
}

// Tabs FadeIn
// menu: class của menu có cấu trúc ul[class=menu]>li>a[href="#content_id_name"]
// content: class của thẻ bao nội dung VD: div[class=content,id=content_id_name]
// active: tên class khi active content
function tabs(menu, content, active) {
    // Ẩn toàn bộ nội dung trong content
    $("."+content).hide();
    // Hiển thị và đánh active cho thẻ li và content đầu tiên
    $("ul."+menu+" li:first").addClass('active').fadeIn();
    $("."+content+":first").fadeIn();
    // khi thẻ li được click
    $("ul."+menu+" li").on('click',function(e){
        e.preventDefault();
        // bỏ toàn bộ active cho các thẻ li trước đó
        $("ul."+menu+" li").removeClass('active');
        // Đánh lại active cho thẻ li này
        $(this).addClass('active');
        var activeTab = $(this).find('a').attr('href');
        $("."+content).hide();
        $(activeTab).fadeIn();
    });
}

// Định dạng giá
function format_price(number) {
    if (number == 0) {
        return 'Miễn phí';
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