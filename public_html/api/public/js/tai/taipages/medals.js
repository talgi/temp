
$("#categories_form").submit(function(e){

    e.preventDefault();
    var url = window.location.href;
    var params = $(this).serialize();
    var xhr = $.ajax({
        url:url,
        type:"post",
        data:params
    })
    xhr.done(function(res){
        $(".right-side").append(res);
        alertify.success("new prize was created")
    })
    xhr.fail(function( jqXHR, textStatus, errorThrown ) {
        alertify.error("Somthing went wrong please try agian");

    });

});


$(".medal_form").submit(function(e){

    e.preventDefault();
    var params = $(this).serializeObject();
    var url = window.location.href+"/"+params.id;
    delete params.id;
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

$(".delete-item").click(function(e){

    e.preventDefault();
    var $parent= $(this).parents(".medal_form").parent().remove();
    var params = $(this).serialize();
    var url = window.location.href+"/"+$(this).data("deleteid");
    var xhr = $.ajax({
        url:url,
        type:"delete"

    })
    xhr.done(function(res){
        $parent.remove();
        alertify.success("Success");
    })
    xhr.fail(function( jqXHR, textStatus, errorThrown ) {
        alertify.error("Somthing went wrong please try agian");

    });

});