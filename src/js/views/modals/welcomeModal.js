define([
	'backbone',
	'hbs!../../../templates/modals/welcomeModal',
	'app'
], function(
	Backbone,
	tpl,
	App
) {
	var WelcomeModal = Backbone.View.extend({
		className: 'welcomeModal-popup',

		initialize: function(options) {},

		events: {
			"click .yellow-btn-join": "moveToUserPage"
		},

		onClose: function() {
			App.Router.navigate("my-flip-madness", true);
		},

		moveToUserPage: function() {
			App.vent.trigger('popup:close');
			App.Router.navigate("my-flip-madness", true);
		},

		render: function() {
			var self = this;

			self.$el.append(tpl({
				PUBLICURL: App.PUBLICURL
			}));

			return this;
		}
	});
	return WelcomeModal;
});