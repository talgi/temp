/**
 * Created by amit on 27/05/2015.
 */
$(document).ready(function(){

    $("#categories_form").submit(function(e){

        e.preventDefault();
        var url =  window.location.href+"?lang="+current_lang;
        var params = $(this).serialize();
        var xhr = $.ajax({
            url:url,
            type:"post",
            data:params
        })
        xhr.done(function(res){
            $("#category-holder").html(res);
            alertify.success("a new categroy has been add");
        })
        xhr.fail(function( jqXHR, textStatus, errorThrown ) {
            alertify.error("Somthing went wrong please try agian");

        });

    });
    $("#categories_update_form").submit(function(e){

        e.preventDefault();
        var url = window.location.href+"?lang="+current_lang;
        var params = $(this).serialize();
        var xhr = $.ajax({
            url:url,
            type:"put",
            data:params
        })
        xhr.done(function(res){

            alertify.success(" Categroy updated");
        })
        xhr.fail(function( jqXHR, textStatus, errorThrown ) {
            alertify.error("Somthing went wrong please try agian");

        });

    });

    $("#tags_form").submit(function(e){

        e.preventDefault();
        var url = g_url+CMS_NAME+"/tags?lang="+current_lang;
        var params = $(this).serialize();
        var xhr = $.ajax({
            url:url,
            type:"post",
            data:params
        })
        xhr.done(function(res){
            $("#tags-holder").html(res);
            alertify.success("a new tag has been add");
        })
        xhr.fail(function( jqXHR, textStatus, errorThrown ) {
            alertify.error("Somthing went wrong please try agian");

        });

    });

    $("#tags_update_form").submit(function(e){

        e.preventDefault();
        var tagId = $("#tag_lang_id").val();

        var url = g_url+CMS_NAME+"/tags/"+tagId;
        var params = $(this).serialize();
        var xhr = $.ajax({
            url:url,
            type:"put",
            data:params
        })
        xhr.done(function(res){

            alertify.success("Tag Updated");
        })
        xhr.fail(function( jqXHR, textStatus, errorThrown ) {
            alertify.error("Somthing went wrong please try agian");

        });

    });

    $("#booklet_form").submit(function(e){
        e.preventDefault();
        var url = g_url+CMS_NAME+"/booklets";
        var params = $(this).serialize();
        var xhr = $.ajax({
            url:url,
            type:"post",
            data:params
        })
        xhr.done(function(res){
            if(res != "0"){
                $("#booklets-holder").html(res);
                alertify.success("Booklet created");

            }
            else{
                alertify.error("Somthing went wrong please try agian");
            }
        })
        xhr.fail(function( jqXHR, textStatus, errorThrown ) {

            alertify.error("Somthing went wrong please try agian");
        });
    });

    $("#booklet_update_form").submit(function (e) {
        e.preventDefault();
        var params = $(this).serializeObject();
        var url = g_url + CMS_NAME + "/booklets/" + params.booklets_id;
        delete params.booklets_id;
        var xhr = $.ajax({
            url: url,
            type: "put",
            data: params
        })
        xhr.done(function (res) {
            alertify.success("Success");

        })
        xhr.fail(function (jqXHR, textStatus, errorThrown) {

            alertify.error("Somthing went wrong please try agian");
        });
    });

    $("#groups_form").submit(function (e) {
        e.preventDefault();
        var url = g_url + CMS_NAME + "/groups";
        var params = $(this).serialize();
        var xhr = $.ajax({
            url: url,
            type: "post",
            data: params
        })
        xhr.done(function (res) {
            if (res != "0") {
                $(".groups_container").append(res);
                alertify.success("Group created. you need to refresh the page in order to use it on the table");

            }
            else {
                alertify.error("Page number must be unique");
            }
        })
        xhr.fail(function (jqXHR, textStatus, errorThrown) {

            alertify.error("Somthing went wrong please try agian");
        });
    });

    $(document).on("submit", ".groups_form", function (e) {
        e.preventDefault();
        var params = $(this).serializeObject();
        var url = g_url + CMS_NAME + "/groups/" + params.id;
        delete params.id;
        var xhr = $.ajax({
            url: url,
            type: "put",
            data: params
        })
        xhr.done(function (res) {
            if (res != "0") {

                alertify.success("Group updated");

            }
            else {
                alertify.error("Page number must be unique");
            }
        })
        xhr.fail(function (jqXHR, textStatus, errorThrown) {

            alertify.error("Somthing went wrong please try agian");
        });
    });

    $(document).on("click", ".groups_form .btn-danger", function (e) {
        e.preventDefault();
        var $this = $(this);
        var url = g_url + CMS_NAME + "/groups/" + $this.data("id");


        var xhr = $.ajax({
            url: url,
            type: "DELETE"
        })
        xhr.done(function (res) {
            $this.parents(".groups_form").parent().remove();


        })
        xhr.fail(function (jqXHR, textStatus, errorThrown) {

            alertify.error("Somthing went wrong please try agian");
        });
    });

    $(document).on("change", ".groups_select", function (e) {
        e.preventDefault();
        var $this = $(this);


        var url = g_url + CMS_NAME + "/booklets/" + $this.data("id");


        var xhr = $.ajax({
            url: url,
            type: "put",
            data:{"group_id":$this.val()}
        })
        xhr.done(function (res) {

        })
        xhr.fail(function (jqXHR, textStatus, errorThrown) {

            alertify.error("Somthing went wrong please try agian");
        });
    });



    $("#codes_form").submit(function(e){
        e.preventDefault();
        var id = $("#booklets_id").val();
        var code_date =  $("#code_date").val();
        var url = g_url+CMS_NAME+"/downloadCsv/"+id+"/"+code_date;
        window.location = url;
    });



});