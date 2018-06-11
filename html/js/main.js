$(function() {
	$("#tabs ul li a").tab();

	$('[data-toggle="tooltip"]').tooltip({

	})

	$("#myFifthModal").on("shown.bs.modal", function() {

		window.setTimeout(function() {

			$(".modal-body").find(".all-lottorys-content").niceScroll({
				cursorcolor: "#0700ff",
				cursoropacitymin: 1,
				cursoropacitymax: 1,
				cursorwidth: 8,
				cursorfixedheight: 94,
				background: "transparent",
				cursorborder: "none",
				cursorborderradius: 6,
				horizrailenabled: false,
				railpadding: {
					top: 15,
					right: 10,
					left: 0,
					bottom: 15
				},
			});
		}, 100)

	});

	$(".close").on('click', function() {
		$(".modal-body").find(".all-lottorys-content").getNiceScroll().remove();
	});

	$("#myFifthModal.modal").on('hide.bs.modal', function() {
		$(".modal-body").find(".all-lottorys-content").getNiceScroll().remove();
	});

	$(document).ready(function () {
	    //initialize swiper when document ready  
	    var mySwiper = new Swiper ('.swiper-container', {
	      // Optional parameters
	      direction: 'horizontal',
	      loop: true,
	      pagination: '.swiper-pagination',
	      nextButton: '.swiper-button-next',
	    	prevButton: '.swiper-button-prev'
	    })        
	 });

});

function showEditPass() {
	document.getElementById("editPassword").style.display = "inline";
	document.getElementById("editPasswordHide").style.display = "none";
}

