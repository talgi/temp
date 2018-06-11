$(document).ready(function(){


    $(".editor").summernote();
    $("#inner_pages_form").submit(function(e){

        e.preventDefault();
        var url = window.location.href;
        var params = $(this).serializeObject();
        params.content = $(".editor").code();
        var xhr = $.ajax({
            url:url,
            type:"put",
            data:params
        })
        xhr.done(function(res){
            alertify.success("Success");
        })
        xhr.fail(function( jqXHR, textStatus, errorThrown ) {
            alertify.error("Somthing went wrong please try agian");

        });

    });

});