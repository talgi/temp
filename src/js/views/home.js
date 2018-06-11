define([
	'backbone',
	'hbs!../../templates/home',
	'hbs!../../templates/comp/footer',
	'app',
	'views/modals/login',
	'views/modals/haveAccount',
	'hbs/handlebars',
	'views/modals/homeUpComing',
	'views/modals/allCollection',
	'helper',
	'swiper',
	'bootstrap',
	'countdown'
], function(
	Backbone,
	tpl,
	Footer,
	App,
	Login,
	HaveAccount,
	Handlebars,
	HomeUpComing,
	AllCollection
) {
	var Home = Backbone.View.extend({
		className: 'home-bg',
		id: 'home',

		initialize: function(options) {

		},

		events: {
			'click .log-in-btn': 'openLoginPopup',
			'click .collect-btn': 'openSignUpPopup',
			'click #UPCOMINGLOTTORY': 'openUpcomingPopup',
			'click .flippers a': 'openAllCollectionPopup'

		},

		openUpcomingPopup: function(event) {
			event.preventDefault();
			ga('send', 'event', 'button', 'click', 'open-upcoming-lottory-popup');
			var self = this;
			App.vent.trigger('popup:open', {
				full: true,
				view: new HomeUpComing(self.content.upcomingLotteries)
			})
			return false;
		},

		openAllCollectionPopup: function(event) {
			event.preventDefault();
			var self = this;
			var id = $(event.currentTarget).data("id")
			$.ajax({
				url: App.APIURL + 'booklet/user-booklets/' + id,
				type: 'get'
			}).done(function(e) {
				App.vent.trigger('popup:open', {
					full: true,
					view: new AllCollection(e)
				})
			});

			return false;
		},
		openLoginPopup: function(event) {
			event.preventDefault();
			ga('send', 'event', 'button', 'click', 'Open-Login-Popup');
			App.vent.trigger('popup:open', {
				view: new HaveAccount()
			})
			return false;
		},

		openSignUpPopup: function(event) {
			event.preventDefault();
			ga('send', 'event', 'button', 'click', 'Open-SignUp-Popup');
			App.vent.trigger('popup:open', {
				view: new Login()
			})
			return false;
		},

		onClose: function() {
			var self = this;
			$(window).off("resize");
			self.$el.find(".time-counting").each(function() {
				if ($(this).data("end")) {

					$(this).countdown("destroy");
				}
			});
		},


		setSWiper: function() {
			var mySwiper = new Swiper('.swiper-container', {
				// Optional parameters
				direction: 'horizontal',
				loop: true,
				//pagination: '.swiper-pagination',
				nextButton: '.swiper-button-next',
				prevButton: '.swiper-button-prev'
			});
		},

		onResize: function() {},

		render: function() {
			var self = this;

			this.content = {}

			Handlebars.registerHelper('bold', function(options) {
				return new Handlebars.SafeString(
					'<div class="mybold">' + options.fn(this) + '</div>');
			});

			Handlebars.registerHelper('shout', function(options) {
				return options.fn(this).toUpperCase() + ' !!';
			});

			$.ajax({
				url: App.APIURL + 'home',
				type: 'GET',
				dataType: 'json'
			}).done(function(e) {

				self.content = e;
				$.extend(true, self.content, {
					IMAGEURL: App.IMAGEURL,
					PUBLICURL: App.PUBLICURL,
					footer: Footer({
						PUBLICURL: App.PUBLICURL
					})
				});
				//set the data to the page;
				self.content.nextLotteries.reverse();
				self.$el.append(tpl(self.content));

				//TODO
				//set size of header;

				$(window).on("resize", function() {
					self.onResize();
				});
				self.onResize();

				$(window).on("scroll", function() {

					if ($(this).scrollTop() < 500) {
						$('.menu-bar').removeClass("fixed-menu");
					} else {
						$('.menu-bar').addClass("fixed-menu");
					}

				});

				self.setSWiper();


				self.$el.find(".time-counting").each(function() {
					if ($(this).data("end")) {
						var timeleft = $(this).data("end") - e.server_time +10;
						$(this).countdown({
							until: +timeleft,
							format: "dHMS",
							layout: "{dnn}:{hnn}:{mnn}:{snn}",
							onExpiry: function() {

							}
						})
					} else {
						$(this).html("No draws at this moment")
						$(this).css("font-size", "25px");
					}
				});


				App.valhallaLoader.start();
			}).fail(function(e) {
				console.log("error");
			});

			return this;
		}
	});
	return Home;
});