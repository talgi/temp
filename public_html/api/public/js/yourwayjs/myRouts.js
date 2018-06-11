/*
 * yourwayjs Plugin Beta version
 *
 *
 * Copyright (c) 2014  Amit Wagner
 *
 *
 * Requires jQuery v1.7.2+ , history.js , helper.js
 *
 */


var myRouts = {


	"": {
		route: function(response) {
			myRouts.default.route(response);
			$("body").addClass("home");
		}
	},
	"default": {
		route: function(response) {
			$("body").removeClass("home");
			$("#components-holder").html(response)


			//$('.grid-sizer').height($('.grid-sizer').width());

			$('.cat-holder-new').each(function() {

				var $container = $(this).isotope({
					itemSelector: '.cat-item'

				});
				$(this).parents(".row:first").find('.filter a').on('click', function(e) {
					e.preventDefault();
					var filterValue = $(this).attr('data-filter');
					$container.isotope({
						filter: filterValue
					});


				});
			});



			$(window).resize(function() {
				setHeight();
			});

			function setHeight() {
				$.each($('.cat-item .img'), function() {
					$(this).height($(this).width());
				});
			}

			setHeight();

			$(".open_hidden_link").unbind("click");
			$(".open_hidden_link").click(function() {
				$("#" + $(this).data("target")).toggle();
			});


			$(".artist-tab:first").click();
		},
		error: function(jqXHR, textStatus, errorThrown) {
			$("#components-holder").html(jqXHR.responseText);
		}
	}


}
myRouts[homePage] = {
	route: function(response) {
		myRouts.default.route(response);
		$("body").addClass("home");
	}
}