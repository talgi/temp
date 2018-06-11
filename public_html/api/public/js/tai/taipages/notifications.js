$("#notifications_form").submit(function(e){
    e.preventDefault();
    $this= $(this);
    alertify.confirm("You are about to publish a notifiction to all users. are you sure you want to continue", function (event) {
        if (event) {
            var url = window.location.href;
            var params = $this.serialize();
            var xhr = $.ajax({
                url:url,
                type:"post",
                data:params
            })
            xhr.done(function(res){

                alertify.success("Success");
            })
            xhr.fail(function( jqXHR, textStatus, errorThrown ) {
                alertify.error("Somthing went wrong please try agian");

            });
        }
    });



});

