$(document).ready(function() {
	$('.img-radio').click(function(e) {

		$(this).parent().siblings().find("input").prop('checked', false)
		$(this).parent().siblings().find('.img-radio').css('opacity', '0.5');
		$(this).siblings('input').prop('checked', true)
		$(this).css('opacity', '1');
	});

	$(".img-radio:eq(0)").click();

	$(".page_delete").on("click", function(e) {
		e.preventDefault();
		var id = $(this).data("id");
		var $self = $(this);
		alertify.confirm("are you sure you want to delete this pages ? ", function(answer) {
			if (answer) {
				var xhr = $.ajax({
					url: window.location.href + "/" + id,
					type: "DELETE"

				});
				xhr.done(function(res) {
					if (res) {
						$self.parents("tr").remove();
					}
				});

			}
		});

	})

	$(".homeradio").click(function(){
				var id = $(this).val();

				var xhr = $.ajax({
					url: window.location.href + "/" + id,
					type: "put"

				});
				xhr.done(function(res) {
					alertify.success("All right we have a new homepage")
				});
	})
    var responsiveHelperDom = undefined;
    var breakpointDefinition = {
        tablet: 1024,
        phone : 480
    };
    $("#pages-table").dataTable({
        autoWidth        : false,
        preDrawCallback: function () {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelperDom) {
                responsiveHelperDom = new ResponsiveDatatablesHelper($("#pages-table"), breakpointDefinition);
            }
        },
        rowCallback    : function (nRow) {
            responsiveHelperDom.createExpandIcon(nRow);
        },
        drawCallback   : function (oSettings) {
            responsiveHelperDom.respond();
        }
    });
});
