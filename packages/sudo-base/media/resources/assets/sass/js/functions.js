// thêm cookie
function setCookie(key, value, day) {
    var expires = new Date();
    expires.setTime(expires.getTime() + (day * 24 * 60 * 60 * 1000));
    document.cookie = key + '=' + value + ';path=/;expires=' + expires.toUTCString();
}
function setCookieWithPath(key, path ,value, day) {
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
function deleteCookie(key,path) {
    var expires = new Date();
    expires.setTime(expires.getTime()-1);
    document.cookie = key + '=; path='+path+'; expires=' + expires.toUTCString();
}
// Thêm/Sửa localstorage
function setLocalStorage(key,value) {
    localStorage.setItem(key,value);
}
function getLocalStorage(key) {
    return localStorage.getItem(key);
}
// Lấy gái trị param tại Url
var getUrlParameter = function(url,name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(url);
    if (results==null) {
       return null;
    }
    return decodeURI(results[1]) || 0;
}
// format định dạng kích thước
function formatSizeUnits(bytes){
    if      (bytes >= 1073741824) { bytes = (bytes / 1073741824).toFixed(2) + " GB"; }
    else if (bytes >= 1048576)    { bytes = (bytes / 1048576).toFixed(2) + " MB"; }
    else if (bytes >= 1024)       { bytes = (bytes / 1024).toFixed(2) + " KB"; }
    else if (bytes > 1)           { bytes = bytes + " bytes"; }
    else if (bytes == 1)          { bytes = bytes + " byte"; }
    else                          { bytes = "0 bytes"; }
    return bytes;
}
// rewrite url: thêm trên url không load lại trang
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
// Lấy ngày giờ hiện tại
function getCurentTime() {
    var date = new Date();
    hour = date.getHours();
    minute = date.getMinutes();
    second = date.getSeconds();
    day = date.getDate();
    if (day < 10) {
        day = '0'+day;
    }
    month = date.getMonth()+1;
    if (month < 10) {
        month = '0'+month;
    }
    year = date.getFullYear();
    path = hour+':'+minute+':'+second+' '+day+'/'+month+'/'+year;
    return path;
}
// load ajax loading
function LoadAjaxPost(url,params,option){
    var _option = {
        beforeSend:function(){},
        success:function(){}
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
            $("#loading-box").css({visibility:"visible", opacity: 0.0}).animate({opacity: 1.0},200);
            _option.beforeSend();
        },
        success:function(result){
            $("#loading-box").animate({opacity: 0.0}, 200, function(){
                $("#loading-box").css("visibility","hidden");
            });
            _option.success(result);
        },
        error: function (error) {
            /* Có lỗi sẽ ân Module Loading và thông báo */
            $("#loading-box").animate({opacity: 0.0}, 200, function(){
                $("#loading-box").css("visibility","hidden");
            });
            alert('Có lỗi xảy ra!');
        }
    })
}
function loadAjaxGet(url,option){
    var _option = {
        beforeSend:function(){},
        success:function(){}
    }
    $.extend(_option,option);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'GET',
        url: url,
        beforeSend: function(){
            $("#loading-box").css({visibility:"visible", opacity: 0.0}).animate({opacity: 1.0},200);
            _option.beforeSend();
        },
        success:function(result){
            $("#loading-box").animate({opacity: 0.0}, 200, function(){
                $("#loading-box").css("visibility","hidden");
            });
            _option.success(result);
        },
        error: function (error) {
            /* Có lỗi sẽ ân Module Loading và thông báo */
            $("#loading-box").animate({opacity: 0.0}, 200, function(){
                $("#loading-box").css("visibility","hidden");
            });
            alert('Có lỗi xảy ra!');
        }
    })
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
    } else {
        return false;
    }
}
// Check phần tử có trong mảng hay ko
function checkValueArr(value,arr){
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
function setTheme() {
    // Lấy giao diện mặc định: light | dark
    if (checkEmpty(getLocalStorage('tubo_media_theme'))) {
        theme = 'light';
        $('body').attr('data-theme',theme);
        $('body').data('theme',theme);
        setLocalStorage('tubo_media_theme',theme);
    } else {
        theme = getLocalStorage('tubo_media_theme');
        if (theme == 'dark') {
            $('body').attr('data-theme',theme);
            $('body').data('theme',theme);
            $('*[data-toggle_theme]').find('i').removeClass('fa-moon-o').addClass('fa-sun-o');
        } else {
            $('body').attr('data-theme','light');
            $('body').data('theme','light');
            $('*[data-toggle_theme]').find('i').removeClass('fa-sun-o').addClass('fa-moon-o');
        }
    }
}
// Set lại cách hiển thị danh sách ảnh
function setViewImage() {
    if (checkEmpty(getLocalStorage('tubo_media_view'))) {
        view = 'burger';
        $('.media-content__main-list').removeClass('list').addClass(view);
        setLocalStorage('tubo_media_view',view);
    } else {
        view = getLocalStorage('tubo_media_view');
        if (view == 'burger') {
            $('*[data-view_type]').removeClass('active');
            $('*[data-view_type='+view+']').addClass('active');
            $('.media-content__main-list').removeClass('list').addClass(view);
        } else if (view == 'list') {
            $('*[data-view_type]').removeClass('active');
            $('*[data-view_type='+view+']').addClass('active');
            $('.media-content__main-list').removeClass('burger').addClass(view);
        }
    }
}