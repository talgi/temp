$(document).ready(function(){
    $('.datepicker').datepicker({
        format: 'dd-mm-yyyy',
        startDate:"0d",
        todayHighlight:true
    })

    $("#lot_form").submit(function (e) {
        e.preventDefault();
        var url = g_url + CMS_NAME + "/lotteries";
        var params = $(this).serialize();
        var xhr = $.ajax({
            url: url,
            type: "post",
            data: params
        })
        xhr.done(function (res) {
            if (res != "0") {
                $(".lotteries_container").append(res);
                alertify.success("Lottery  created. ");
            }
            else {
                alertify.error("Somthing went wrong please try agian");
            }
        })
        xhr.fail(function (jqXHR, textStatus, errorThrown) {

            alertify.error("Somthing went wrong please try agian");
        });
    });

    $(document).on("submit", ".lot_form", function (e) {
        e.preventDefault();
        var params = $(this).serializeObject();
        var url = g_url + CMS_NAME + "/lotteries/" + params.id;
        delete params.id;
        var xhr = $.ajax({
            url: url,
            type: "put",
            data: params
        })
        xhr.done(function (res) {
            if (res != "0") {

                alertify.success("Lottery  updated");

            }
            else {
                alertify.error("Somthing went wrong please try agian");
            }
        })
        xhr.fail(function (jqXHR, textStatus, errorThrown) {

            alertify.error("Somthing went wrong please try agian");
        });
    });

    $(document).on("click", ".lot_form .btn-danger", function (e) {
        e.preventDefault();
        var $this = $(this);
        var url = g_url + CMS_NAME + "/lotteries/" + $this.data("id");


        var xhr = $.ajax({
            url: url,
            type: "DELETE"
        })
        xhr.done(function (res) {
            $this.parents(".lot_form").parent().remove();


        })
        xhr.fail(function (jqXHR, textStatus, errorThrown) {

            alertify.error("Somthing went wrong please try agian");
        });
    });

})