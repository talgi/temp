define([
	'backbone',
	'hbs!../../../templates/comp/popup',
	'app',
	'jquery.nicescroll',
], function(
	Backbone,
	tpl,
	App
) {
	var Popup = Backbone.View.extend({
		className: 'popup',
		id: 'popup',

		initialize: function() {},

		events: {
			'click .close': 'close',
			'click .overflow': 'close'
		},

		close: function(e) {
			if (e) {
				e.preventDefault();
			}
			var self = this;

			//$('.popup-holder').getNiceScroll().remove();


			//$('body').css('overflow', 'auto');

			self.innerView.close();

			if ($('.popup-holder').getNiceScroll().length > 0) {
				$('.popup-holder').getNiceScroll().remove();
			}
			if (typeof(App.nice) !== "undefined" && typeof(App.nice.remove) == "function") {
				App.nice.remove();
			}
			if (!App.md.mobile() && !App.md.tablet()) {
				$('body').removeClass('noScroll');
				App.nice = $('body').niceScroll({
					cursorcolor: "#daa132",
					cursorwidth: "12px",
					cursorborder: '0px solid #fff',
					zindex: 9999,
					autohidemode: 'cursor',
					horizrailenabled: false

				});
			}


			$('.popup-holder').removeClass('in');
			App.vent.trigger('popup:close');

			return false;
		},

		render: function(obj) {
			var self = this;

			self.$el.append(tpl());

			if (obj.view) {
				this.innerView = obj.view
				self.$el.find('.popup-holder').append(this.innerView.el);
				this.innerView.render();
			}


			if (typeof obj.notificationId != "undefined") {
				self.notificationId = obj.notificationId;
			}

			if (!App.md.mobile() && !App.md.tablet()) {
				$('body').addClass('noScroll');
			}

			setTimeout(function() {
				$('.popup-holder').addClass('in');
				if (obj.full) {
					$('.popup-holder').addClass('full');
					setTimeout(function() {
                        if (typeof(App.nice) !== "undefined" && typeof(App.nice.remove) == "function") {
                            App.nice.remove();
                        }
                        App.nice = self.$el.niceScroll({
                            cursorcolor: "#daa132",
                            cursorwidth: "12px",
                            cursorborder: '0px solid #fff',
                            zindex: 9999,
                            autohidemode: 'cursor',
                            horizrailenabled: false

                        });
					}, 2000);

				};
			}, 20);

			return this;
		}
	});

	return Popup;
});