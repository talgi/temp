function startTimer(duration, display) {

    var current_date = new Date().getTime();
    var target_date = new Date("Aug 10, 2015").getTime();
    var timer = duration, days, hours, minutes, seconds;
    setInterval(function () {
        var current_date = new Date().getTime();
        var seconds_left = (target_date - current_date) / 1000;

        days = parseInt(seconds_left / 86400);
        seconds_left = seconds_left % 86400;

        hours = parseInt(seconds_left / 3600);
        seconds_left = seconds_left % 3600;

        minutes = parseInt(seconds_left / 60);
        seconds = parseInt(seconds_left % 60);

        days = days < 10 ? "0" + days : days;
        hours = hours < 10 ? "0" + hours : hours;
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.text(days + ":" + hours + ":" + minutes + ":" + seconds);

        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);

}

jQuery(function ($) {

    var timeToCount = 1,
        display = $('.time-count').fadeIn();
    startTimer(timeToCount, display);
    
});