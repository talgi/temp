$(function() {
	
	var waypointVideo = new Waypoint({
	  element: document.getElementsByClassName('video'),
	  handler: function(direction) {
	    $('.video').addClass('animated fadeIn div-shown');
	  },
	  offset: 400
	})

	var waypointVideoMenu = new Waypoint({
	  element: document.getElementsByClassName('menu-btns'),
	  handler: function(direction) {
	    $('.menu-btns').addClass('animated fadeIn');
	  },
	  offset: 450
	})

	var waypointVideoContent = new Waypoint({
	  element: document.getElementsByClassName('video-text'),
	  handler: function(direction) {
	    $('.video-text').addClass('animated slideInLeft');
	    $('.video-picture-bg').addClass('animated slideInRight');
	  },
	  offset: 549
	})

	var waypointCollectThemAll = new Waypoint({
	  element: document.getElementsByClassName('collect-them-all'),
	  handler: function(direction) {
	    $('.collect-them-all').addClass('animated fadeIn div-shown');
	  },
	  offset: 550
	})

	var waypointCollectThemAllHeader = new Waypoint({
	  element: document.getElementsByClassName('collect-header'),
	  handler: function(direction) {
	    $('.collect-header').addClass('animated fadeIn div-shown');
	  },
	  offset: 570
	})

	var waypointCollectThemAllTopImage = new Waypoint({
	  element: document.getElementsByClassName('top-image'),
	  handler: function(direction) {
	    $('.top-image').addClass('animated slideInUp div-shown');
	  },
	  offset: 550
	})

	var waypointCollectThemAllTopArrow = new Waypoint({
	  element: document.getElementsByClassName('top-arrow'),
	  handler: function(direction) {
	    $('.top-arrow').addClass('animated fadeIn div-shown');
	  },
	  offset: 550
	})

	var waypointCollectThemAllSitePicture = new Waypoint({
	  element: document.getElementsByClassName('site-picture'),
	  handler: function(direction) {
	    $('.site-picture').addClass('animated slideInLeft div-shown');
	  },
	  offset: 550
	})

	var waypointCollectThemAllEnterCode = new Waypoint({
	  element: document.getElementsByClassName('collect-enter-code'),
	  handler: function(direction) {
	    $('.collect-enter-code').addClass('animated slideInRight div-shown');
	  },
	  offset: 550
	})

	var waypointCollectThemAllMiddleArrow = new Waypoint({
	  element: document.getElementsByClassName('middle-arrow'),
	  handler: function(direction) {
	    $('.middle-arrow').addClass('animated fadeIn div-shown');
	  },
	  offset: 550
	})

	var waypointCollectThemAllBottomImage = new Waypoint({
	  element: document.getElementsByClassName('bottom-img'),
	  handler: function(direction) {
	    $('.bottom-img').addClass('animated slideInDown div-shown');
	  },
	  offset: 550
	})

	var waypointCollectThemAllLeftArrow = new Waypoint({
	  element: document.getElementsByClassName('left-arrow'),
	  handler: function(direction) {
	    $('.left-arrow').addClass('animated fadeIn div-shown');
	  },
	  offset: 550
	})

	var waypointPrizes = new Waypoint({
	  element: document.getElementsByClassName('prizes'),
	  handler: function(direction) {
	    $('.prizes').addClass('animated fadeIn div-shown');
	  },
	  offset: 250
	})

	var waypointPrizesSlider = new Waypoint({
	  element: document.getElementsByClassName('prizes-slider'),
	  handler: function(direction) {
	    $('.prizes-slider').addClass('animated slideInRight div-shown');
	  },
	  offset: 350
	})

	var waypointPrizesLeaderboard = new Waypoint({
	  element: document.getElementsByClassName('leaderboard'),
	  handler: function(direction) {
	    $('.leaderboard').addClass('animated slideInLeft div-shown');
	  },
	  offset: 350
	})

	var waypointLottory = new Waypoint({
	  element: document.getElementsByClassName('lottory'),
	  handler: function(direction) {
	    $('.lottory').addClass('animated fadeIn div-shown');
	  },
	  offset: 350
	})

	var waypointLottoryHeadline = new Waypoint({
	  element: document.getElementsByClassName('lottory-headline'),
	  handler: function(direction) {
	    $('.lottory-headline').addClass('animated fadeIn div-shown');
	  },
	  offset: 300
	});

	var waypointLottoryCountdown = new Waypoint({
	  element: document.getElementsByClassName('the-next-challenge'),
	  handler: function(direction) {
	    $('.the-next-challenge').addClass('animated fadeIn div-shown');
	  },
	  offset: 400
	});

	var waypointCollectNowFooter = new Waypoint({
	  element: document.getElementsByClassName('collect-now-footer'),
	  handler: function(direction) {
	    $('.collect-now-footer').addClass('animated fadeIn div-shown');
	  },
	  offset: 450
	});

	var waypointCollectNowBtn = new Waypoint({
	  element: document.getElementsByClassName('collect-btn-footer'),
	  handler: function(direction) {
	    $('.collect-btn-footer').addClass('animated fadeIn div-shown');
	  },
	  offset: 460
	});

	var waypointFooter = new Waypoint({
	  element: document.getElementsByClassName('site-footer'),
	  handler: function(direction) {
	    $('.site-footer').addClass('animated fadeIn div-shown');
	  },
	  offset: 600
	});


	$(window).scroll(function(event) {
		/* Act on the event */
		console.log($(this).scrollTop())
	});

});
