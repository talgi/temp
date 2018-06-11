$(function() {
	
	var waypointVideo = new Waypoint({
	  element: document.getElementsByClassName('settings-form'),
	  handler: function(direction) {
	    $('.regular-update-btn').addClass('animated fadeIn div-shown');
	  },
	  offset: 250
	})

	var waypointVideo = new Waypoint({
	  element: document.getElementsByClassName('site-footer'),
	  handler: function(direction) {
	    $('.site-footer').addClass('animated fadeIn div-shown');
	  },
	  offset: 850
	})

	$(window).scroll(function(event) {
		/* Act on the event */
		console.log($(this).scrollTop())
	});

});
