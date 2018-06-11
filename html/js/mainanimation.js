$(function() {
	
	var waypointVideo = new Waypoint({
	  element: document.getElementsByClassName('content-pictures'),
	  handler: function(direction) {
	    $('.album-picture-top').addClass('animated fadeIn div-shown');
	  },
	  offset: 700
	})

	var waypointVideo = new Waypoint({
	  element: document.getElementsByClassName('content-pictures'),
	  handler: function(direction) {
	    $('.album-picture-bottom').addClass('animated fadeIn div-shown');
	  },
	  offset: 500
	})

	var waypointVideo = new Waypoint({
	  element: document.getElementsByClassName('flippers'),
	  handler: function(direction) {
	    $('.flipper1').addClass('animated fadeIn div-shown');
	  },
	  offset: 880
	})

	var waypointVideo = new Waypoint({
	  element: document.getElementsByClassName('flippers'),
	  handler: function(direction) {
	    $('.flipper2').addClass('animated fadeIn div-shown');
	  },
	  offset: 860
	})

	var waypointVideo = new Waypoint({
	  element: document.getElementsByClassName('flippers'),
	  handler: function(direction) {
	    $('.flipper3').addClass('animated fadeIn div-shown');
	  },
	  offset: 840
	})

	var waypointVideo = new Waypoint({
	  element: document.getElementsByClassName('flippers'),
	  handler: function(direction) {
	    $('.flipper4').addClass('animated fadeIn div-shown');
	  },
	  offset: 750
	})

	var waypointVideo = new Waypoint({
	  element: document.getElementsByClassName('flippers'),
	  handler: function(direction) {
	    $('.flipper5').addClass('animated fadeIn div-shown');
	  },
	  offset: 730
	})

	var waypointVideo = new Waypoint({
	  element: document.getElementsByClassName('flippers'),
	  handler: function(direction) {
	    $('.flipper6').addClass('animated fadeIn div-shown');
	  },
	  offset: 700
	})

	var waypointVideo = new Waypoint({
	  element: document.getElementsByClassName('flippers'),
	  handler: function(direction) {
	    $('.flipper7').addClass('animated fadeIn div-shown');
	  },
	  offset: 690
	})

	var waypointVideo = new Waypoint({
	  element: document.getElementsByClassName('flippers'),
	  handler: function(direction) {
	    $('.flipper8').addClass('animated fadeIn div-shown');
	  },
	  offset: 670
	})

	var waypointVideo = new Waypoint({
	  element: document.getElementsByClassName('flippers'),
	  handler: function(direction) {
	    $('.flipper9').addClass('animated fadeIn div-shown');
	  },
	  offset: 650
	})

	var waypointVideo = new Waypoint({
	  element: document.getElementsByClassName('flippers'),
	  handler: function(direction) {
	    $('.flipper10').addClass('animated fadeIn div-shown');
	  },
	  offset: 630
	})

	var waypointVideo = new Waypoint({
	  element: document.getElementsByClassName('content-pictures'),
	  handler: function(direction) {
	    $('.second-seperator').addClass('animated fadeIn div-shown');
	  },
	  offset: 500
	})

	var waypointVideo = new Waypoint({
	  element: document.getElementsByClassName('user-challenges'),
	  handler: function(direction) {
	    $('.my-lotteries').addClass('animated fadeIn div-shown');
	    $('.my-next-challenges').addClass('animated fadeIn div-shown');
	  },
	  offset: 500
	})

	var waypointVideo = new Waypoint({
	  element: document.getElementsByClassName('site-footer'),
	  handler: function(direction) {
	    $('.site-footer').addClass('animated fadeIn div-shown');
	  },
	  offset: 650
	})

	$(window).scroll(function(event) {
		/* Act on the event */
		console.log($(this).scrollTop())
	});

});
