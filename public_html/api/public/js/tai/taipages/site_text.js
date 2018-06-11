$(document).ready(function(){

    $("#site_text_form").submit(function(e){

        e.preventDefault();
        var url =window.location.href.replace("show", "update");
        var params = $(this).serialize();
        var xhr = $.ajax({
            url:url,
            type:"put",
            data:params
        })
        xhr.done(function(res){
            alertify.success("All right You just saved your staff")
        })
        xhr.fail(function( jqXHR, textStatus, errorThrown ) {
            alertify.error("Somthing went wrong please try agian");

        });

    });


});