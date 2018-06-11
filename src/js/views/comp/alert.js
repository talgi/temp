define([
	'backbone',
	'hbs!../../../templates/comp/alert',
	'app'
], function(
	Backbone,
	tpl,
	App
) {
	var Alert = Backbone.View.extend({
		className: 'page',
		id: 'alert',

		initialize: function() {

		},

		events: {
			'click .alert-footer .btn-home': 'close'
		},

		close: function(e) {
			e.preventDefault();
			$('.alert-holder').removeClass('in');
			setTimeout(function() {
				App.vent.trigger('alert:close');
			}, 100);

			return false;
		},


		render: function(obj) {
			var self = this;


			this.$el.append(tpl(obj));
			if (obj.func != null) {
				$('.alert-footer .btn-home').one('click', obj.func);
			}
			setTimeout(function() {
				$('.alert-holder').addClass('in');
			}, 20);

			return this;
		}
	});

	return Alert;
});