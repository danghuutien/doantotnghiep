setInterval(function(){
    var obj = $('.countdown-data');
    obj.each(function() {
        var end = $(this).data('end');
        var d = new Date();
        var n = Math.floor(d.getTime() / 1000);
        var cd = end - n;
        var days = hours = minutes = seconds = 0;
        if (cd > 0) {
            var sec_num = parseInt(cd, 10);
            hours = Math.floor(sec_num / 3600) % 24;
            minutes = Math.floor(sec_num / 60) % 60;
            seconds = sec_num % 60;
            if (seconds < 10) {
                seconds = '0' + seconds;
            }
            if (minutes < 10) {
                minutes = '0' + minutes;
            }
        }
        $(this).find('.hours').text(hours < 10 ? '0' + hours : hours);
        $(this).find('.minutes').text(minutes);
        $(this).find('.seconds').text(seconds);
    });
}, 1000);

