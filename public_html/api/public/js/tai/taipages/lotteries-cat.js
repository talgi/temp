
$("#lot_form").submit(function (e) {
    e.preventDefault();
    var url = g_url + CMS_NAME + "/lotteries-cat";
    var params = $(this).serialize();
    var xhr = $.ajax({
        url: url,
        type: "post",
        data: params
    })
    xhr.done(function (res) {
        if (res != "0") {
            $(".lot_container").append(res);
            alertify.success("Lottery category created. ");
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
    var url = g_url + CMS_NAME + "/lotteries-cat/" + params.id;
    delete params.id;
    var xhr = $.ajax({
        url: url,
        type: "put",
        data: params
    })
    xhr.done(function (res) {
        if (res != "0") {

            alertify.success("Lottery category updated");

        }
        else {
            alertify.error("Somthing went wrong please try agian");
        }
    })
    xhr.fail(function (jqXHR, textStatus, errorThrown) {

        alertify.error("Somthing went wrong please try agian");
    });
});