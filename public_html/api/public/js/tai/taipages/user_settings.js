$(document).ready(function(){

    $("#user_settings").submit(function(e){

        e.preventDefault();
        var url = window.location.href;
        var params = $(this).serialize();
        var xhr = $.ajax({
            url:url,
            type:"post",
            data:params
        })

        xhr.success(function (res) {
            if (res.status == true) {
                alertify.set('notifier', 'position', 'top-left');
                alertify.success(' Saved Successfully');
            } else {
                alertify.set('notifier', 'position', 'top-left');
                alertify.error(res.error);
            }
        });

        xhr.error(function(res) {
            alertify.set('notifier', 'position', 'top-left');
            alertify.error('Internal Error');

        });

    });


});