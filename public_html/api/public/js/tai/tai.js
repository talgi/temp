$(document).ready(function () {
    $('[data-toggle="popover"]').popover()
    $("#btn-components-modal").click(function () {
        $("#components-modal").modal("show");
        $("#components-modal").data("elemid", "");
    });
    Holder.run({
        domain: "holder.canvas",
        use_canvas: true
    });
    if ($.trim($("#error_alert").html())) {
        alertify.set('notifier', 'position', 'top-left');
        alertify.error($("#error_alert").html(), 0);
    }

    $("select").each(function () {

        if (!$(this).hasClass("noSelect")) {
            $(this).select2({"width": "150px"});
        }
    });

    $("#pages_select").select2().on("change", function (e) {
        $("#tai-link-modal-link").val(e.val);
        $("#tai-link-modal-link").html(e.val);
    });
    $("#all-pages-form").submit(function (e) {
        e.preventDefault();
        if ($($(this).data("connectLink")).hasClass("tai-show-connect")) {
            $connectLink = $($(this).data("connectLink"));
            $connectLink.data("attr", $("select[name='all_pages_select'] option:selected").data("url"));
            $connectLink.html($("select[name='all_pages_select'] option:selected").text());

            $("#all-pages-modal").modal("hide");
            return;
        }
        var $connectLink = $("#all-pages-modal").data("connectLink");
        var selectValue = $("select[name='all_pages_select']").val();
        $connectLink.html(selectValue);
        $connectLink.attr("href", $connectLink.data("editlink") + selectValue);
        $connectLink.data("link", $connectLink.data("basehref") + "/" + selectValue);
        $("#all-pages-modal").modal("hide");
        $connectLink.parents(".top").click();
        $connectLink.parents(".tai-component").find(".tai-panel-save").click();
    });
    $("#tai-embed-form").submit(function (e) {
        e.preventDefault();
        $($(this).data("obj")).html($("#tai-embed-area").val());
        $("#tai-embed-modal").modal("hide")
    });


});

$(document).ajaxStart(function () {
    $('#loading').show('fast');
});

$(document).ajaxComplete(function () {
    $('#loading').hide('fast');
});
if (window.location.href.indexOf("seo") == -1) {
    $(document).ready(function () {
        $("#seo_form").submit(function (e) {
            e.preventDefault();
            data = $(this).serialize();
            var lang_id = $(this).find("#lang_id").val();
            var xhr = $.ajax({
                url: base_url + "/" + CMS_NAME + "/seo/" + lang_id,
                type: 'put',
                data: data
            });

            xhr.done(function (res) {
            });
        })

        $("#export_form").submit(function (e) {
            e.preventDefault();
            data = $(this).serialize();
            var page_id = $(this).attr('data-page_id');
            var xhr = $.ajax({
                url: base_url + "/" + CMS_NAME + "/export/" + page_id,
                type: 'put',
                data: data
            });

            xhr.success(function (res) {
                if (res.status == true) {
                    alertify.set('notifier', 'position', 'top-left');
                    alertify.success('Template Saved Successfully');
                } else {
                    alertify.set('notifier', 'position', 'top-left');
                    alertify.error(res.error);
                }
            });

            xhr.error(function (res) {
                alertify.set('notifier', 'position', 'top-left');
                alertify.error('Internal Error');
                console.log('res');
            });
        })
    })
}

$('[data-action=collapse]').click(function () {
    var targetCollapse = $(this).parents('.panel').find('.panel-body'),
        targetCollapse2 = $(this).parents('.panel').find('.panel-sub-heading'),
        targetCollapse3 = $(this).parents('.panel').find('.panel-footer')
    if ((targetCollapse.is(':visible'))) {
        $(this).find('i').removeClass('fa-angle-up').addClass('fa-angle-down');
        targetCollapse.slideUp();
        targetCollapse2.slideUp();
        targetCollapse3.slideUp();
    } else {
        $(this).find('i').removeClass('fa-angle-down').addClass('fa-angle-up');
        targetCollapse.slideDown();
        targetCollapse2.slideDown();
        targetCollapse3.slideDown();
    }
});


$.fn.serializeObject = function () {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
        if (o[this.name]) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};
