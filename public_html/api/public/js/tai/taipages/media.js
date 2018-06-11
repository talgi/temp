// load dorpzone
Dropzone.autoDiscover = false;
var g_url = typeof (g_url) != "undefined" ? g_url : base_url
$(document).on("ready ajaxComplete", function () {
    if ($("#dropzone").length > 0 && !$(dropzone).hasClass("dz-clickable")) {
        var imageUpload = new Dropzone("#dropzone", {
            maxFilesize: 4,
            //uploadMultiple:true,
            // TODO replace with a good URL
            url: g_url + "/taicontrol/media/upload",

            queuecomplete: function () {
                $.ajax({
                    url: g_url + '/taicontrol/media/show/',
                    success: function (res) {
                        $('.galley-imgs').replaceWith(res);
                        $('.media-tabs #img-gal-tab').tab('show');
                    }
                });


            }
        });
    }

    $("[name='choseTage']").change(function(){
        var xhr = $.ajax({
            url: g_url + '/taicontrol/media/show/',
            type: "get",
            data: {tag_id:$(this).val()}
        })
        xhr.done(function (res) {
            $('.galley-imgs').replaceWith(res);
        })
    })

    $("#media_tags_form").unbind("submit");
    $("#media_tags_form").submit(function (e) {
        e.preventDefault();
        var data = $(this).serialize();


        var xhr = $.ajax({
            url: g_url + '/taicontrol/media/newtag/',
            type: "put",
            data: data
        })
        xhr.done(function (res) {
            if (res == 1) {
                alertify.success("a new tag has been created good job");
            }
            else {
                alertify.error("the tag name is all ready exist");
            }
        })

    });
    $("#media_tags_form_delete").unbind("submit");
    $("#media_tags_form_delete").submit(function (e) {
        e.preventDefault();
        var data = $(this).serialize();
        var $removeElem = $(this).find("select option:selected");

        var xhr = $.ajax({
            url: g_url + '/taicontrol/media/removetag/',
            type: "delete",
            data: data
        })
        xhr.done(function (res) {

            alertify.success("and its gone");
            $removeElem.remove();

        })

    });


    // select image
    $('.galley-imgs .thumbnail').off();
    $('.galley-imgs .thumbnail').on('click', function (e) {
        e.preventDefault();
        jsonFill(".image-details", $(this).data('props'), {
            fullurl: function (json) {
                $('.image-details .img-responsive').attr('src', g_url + "/public/uploads/" + json.url);
            },
            fullurl2: function (json) {
                $('.image-details [name="url"]').val(g_url + "/public/uploads/" + json.url);
            },
            deletebtn: function (json) {
                $('.image-details .btn.btn-danger').data("imgid", json.id);
            },
            savebtn: function (json) {
                $('.image-details form').data("imgid", json.id);
            },
            url: ".filename",
            filesize: '.file-size',
            resulotion: '.dimensions',
            title: '[name="title"]',
            alt_text: '[name="alt"]',
            caption: '[name="caption"]',
            description: '[name="description"]',
            tag_id:'[name="tag_id"]'
        });
        return false;
    });

    $('.galley-imgs .thumbnail').on('dblclick', function (e) {
        $(this).click();
        $('#use-img').click();
    });
// delete image
    $(".image-details .btn.btn-danger").off();
    $(".image-details .btn.btn-danger").on('click', function () {
        // confirm dialog
        $this = $(this);
        alertify.confirm("are you sure you want to delete image?", function (e) {

            if (e) {
                $.ajax({
                    url: g_url + '/taicontrol/media/delete/' + $this.data('imgid'),
                    type: 'DELETE',
                    success: function (result) {
                        // Do something with the result
                        $('#gal-img-' + $this.data('imgid')).remove();
                        $('.galley-imgs .thumbnail').eq(0).click();
                    }
                });
            } else {
                // user clicked "cancel"
            }
        });
    });
// update img details
    $(".image-details form").off()
    $(".image-details form").on('submit', function (e) {
        e.preventDefault();
        // confirm dialog
        $this = $(this);
        var params = $(this).serialize();
        $.ajax({
            url: g_url + '/taicontrol/media/update/' + $this.data('imgid'),
            type: 'PUT',
            data: params,
            error: function (res) {
                alertify.alert(decodeURI(res.responseText));
            }
        });

        return false;
    });
// pager
    $('.galley-imgs .pagination a').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('href'),
            success: function (res) {
                $('.galley-imgs').replaceWith(res);
            }
        });

        return false;
    });

    $('#use-img').on('click', function (e) {
        e.preventDefault();

        var $obj = $('#resource-modal .modal-body').data("obj");
        $obj.data("imageid", $(".image-details form").data("imgid"));
        if ($obj.prop("tagName") == "IMG") {
            $obj.attr("src", $(".image-details form [name='url']").val());
        }
        else if ($obj.css("background-image") != "none") {
            $obj.css("background-image", "url(" + $(".image-details form [name='url']").val() + ")")
        } else {
            $obj.find("img:first").attr("src", $(".image-details form [name='url']").val());
        }
        $("#resource-modal").modal("hide")
        return false;
    });
    $('.galley-imgs .thumbnail').eq(0).click();
});


// galley
// json filler helper
// alias property_name:'element_name'
function jsonFill(parent, json, alias) {
    $.each(alias, function (prop, elem) {
        if (typeof elem == "function") {
            elem(json);
        }
        else {
            $e = $(parent + " " + elem);
            if ($e.length > 0) {
                switch ($e[0].tagName) {
                    case "IMG":
                    {
                        $e.attr("src", json[prop]);
                        break;
                    }
                    case "INPUT":
                    case "TEXTAREA":
                    {
                        $e.val(json[prop]);
                        break;
                    }
                    case "SELECT":{
                        $e.find("option[value='"+json[prop]+"']").prop('selected', true);
                        break;
                    }
                    default:
                    {
                        $e.html(json[prop]);
                        break;
                    }
                }
            }
        }
    });
}

