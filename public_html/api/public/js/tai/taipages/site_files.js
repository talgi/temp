// load dorpzone
Dropzone.autoDiscover = false;
var g_url = typeof (g_url) != "undefined" ? g_url : base_url
$(document).on("ready ajaxComplete", function () {
    if ($("#dropzone").length > 0 && !$(dropzone).hasClass("dz-clickable")) {
        new Dropzone("#dropzone", {
            maxFilesize: 5,
            //uploadMultiple:true,
            // TODO replace with a good URL
            url: g_url + "/taicontrol/site-files/upload",

            queuecomplete: function () {
                $.ajax({
                    url: g_url + '/taicontrol/site-files/show/',
                    type: "get",
                    success: function (res) {
                        $("#pages-table").remove();
                        $("#site_files_table").html(res);

                        var responsiveHelperDom = undefined;
                        var breakpointDefinition = {
                            tablet: 1024,
                            phone : 480
                        };
                        $("#pages-table").dataTable({
                            autoWidth: false,
                            preDrawCallback: function () {
                                // Initialize the responsive datatables helper once.
                                if (!responsiveHelperDom) {
                                    responsiveHelperDom = new ResponsiveDatatablesHelper($("#pages-table"), breakpointDefinition);
                                }
                            },
                            rowCallback: function (nRow) {
                                responsiveHelperDom.createExpandIcon(nRow);
                            },
                            drawCallback: function (oSettings) {
                                responsiveHelperDom.respond();
                            }
                        });
                    }
                });


            }
        });
    }



    $(".file_delete").on('click', function () {
        // confirm dialog
        $this = $(this);
        alertify.confirm("are you sure you want to delete this file?", function (e) {

            if (e) {
                $.ajax({
                    url: g_url + '/taicontrol/site-files/destroy/' + $this.data('id'),
                    type: 'DELETE',
                    success: function (result) {
                        // Do something with the result
                        $("#remove_"+$this.data("id")).remove();

                    }
                });
            } else {
                // user clicked "cancel"
            }
        });
    });

    $(".copy-clip").each(function(e){

        var client = new ZeroClipboard( this );

    })



});

var responsiveHelperDom = undefined;
var breakpointDefinition = {
    tablet: 1024,
    phone : 480
};
$("#pages-table").dataTable({
    autoWidth: false,
    preDrawCallback: function () {
        // Initialize the responsive datatables helper once.
        if (!responsiveHelperDom) {
            responsiveHelperDom = new ResponsiveDatatablesHelper($("#pages-table"), breakpointDefinition);
        }
    },
    rowCallback: function (nRow) {
        responsiveHelperDom.createExpandIcon(nRow);
    },
    drawCallback: function (oSettings) {
        responsiveHelperDom.respond();
    }
});

