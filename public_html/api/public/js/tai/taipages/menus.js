$(document).ready(function() {


    $("#form_new_link").submit(function(e) {
        e.preventDefault();
        var json = $(this).serializeObject();

        var xhr = $.ajax({
            url: window.location.href.substr(0, window.location.href.indexOf("menus")) + "links",
            type: "post",
            data: json
        })

        xhr.done(function(res) {
            if (res == 0) {
                alertify.error("this name is already in use. please pick a different name");
            } else {
                var li = $("<li class='col-md-2'  data-external='" + json.external + "' data-link='" + json.link + "'>" +
                    "<div class='panel'>" +
                    "<div class='panel-heading'>" +
                    "<div class='pull-left'>" +
                    "<h3 class='panel-title' >" + json.name + " </h3>"+
                    "<div class='fa fa-times delete_extrnal' style='position: absolute;top:-6px;right: -4px;z-index: 1;'></div>"+
                    "</div>"+
                    "<div class='clearfix' ></div>"+
                    "</div>" +
                    "</div><!-- /.panel-- >" +
                    "<!--/ End collapsible panel -->" +
                    "</li>"
                );
                $("#unuse_links").prepend(li);
                initSorting();
            }
        })
    });


    var oldList = null;
    initSorting();
    $(document).on('submit', 'form', function(e) {
        if ($(this).attr("id") == "form_new_link") {
            return;
        }
        e.preventDefault();

        var json = $(this).serializeObject();

        var xhr = $.ajax({
            url: window.location.href.replace("show", "updatelink"),
            type: "put",
            data: json
        })
    });

})

function moveToDelete(ui) {
    ui.item.find(".panel-body").remove();
    ui.item.find(".pull-right").remove();
    ui.item.addClass("col-md-2");

    var json = {
        menu_id: ui.item.data("id")
    }
    var xhr = $.ajax({
        url: window.location.href.replace("show", "remove"),
        type: "get",
        data: json
    })

}

function moveFromDelete(ui) {
    var json = {
        link: ui.item.data('link'),
        linkName: ui.item.find(".panel-title").html(),
        place: ui.item.parent().data("id"),
        external: ui.item.data('external')
    }
    var xhr = $.ajax({
        url: window.location.href.replace("show", "create"),
        type: "post",
        data: json
    });
    xhr.done(function(res) {
        var x = $(res);
        ui.item.data("id", x.data("id"));
        ui.item.data("link", x.data("link"));
        ui.item.html(x.html());
        ui.item.find(".btn.btn-sm").click(function() {
            if (ui.item.find("i").hasClass("fa-angle-down")) {
                ui.item.find("i").removeClass("angle-down").addClass("fa-angle-up");
                ui.item.find(".panel-body").slideDown();
            } else {
                ui.item.find("i").removeClass("fa-angle-up").addClass("fa-angle-down");
                ui.item.find(".panel-body").slideUp();
            }
        })
        sorting(ui);

    })
}

function sorting(ui) {
    var items = [];
    ui.item.parent().find("li").each(function(index) {
        items[index] = {
            id: $(this).data("id"),
            order: index
        }
    })

    var json = {
        place: ui.item.parent().data('id'),
        items: items
    }
    json = JSON.stringify(json);
    var xhr = $.ajax({
        url: window.location.href.replace("show", "update"),
        type: "put",
        data: {
            json: json
        }
    })
}

function initSorting() {
    $(".sort-container").sortable({
        connectWith: ".sort-container",
        dropOnEmpty: true,
        start: function(event, ui) {
            oldList = ui.item.parent().data('id');
        },
        stop: function(event, ui) {
            ui.item.removeClass("col-md-2");

            if (oldList == 'delete' && ui.item.parent().data('id') == "delete") {
                ui.item.addClass("col-md-2");
                return;
            }

            if (ui.item.parent().data('id') == "delete") {
                moveToDelete(ui);
                return;
            }
            if (oldList == 'delete') {
                moveFromDelete(ui);
                return;
            }
            sorting(ui);

        }
    });
}

$(document).on("ready , ajaxComplete",function(){
    $(".delete_extrnal").unbind("click");
    $(".delete_extrnal").click(function(){
        $this = $(this);

        alertify.confirm("? Are you sure you want to delete", function (e) {
            var json = {};
            json.id = $this.parents("li").data("id");
            json.lang_id = $this.parents("li").find(".lang_id").val();
            if (e) {
                var xhr = $.ajax({
                    url:  window.location.href.substr(0, window.location.href.indexOf("menus")) + "links",
                    type: "delete",
                    data:json

                })

                xhr.done(function () {
                    $this.parents("li").remove();
                })
            }

        });
    })
})
