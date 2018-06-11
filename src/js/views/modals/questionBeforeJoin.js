define([
	'backbone',
	'hbs!../../../templates/modals/questionBeforeJoin',
	'app'
], function(
	Backbone,
	tpl,
	App
) {
	var QuestionBeforeJoin = Backbone.View.extend({
		className: 'questionBeforeJoin-popup',

		initialize: function(options) {},

		events: {},

		onClose: function() {},

		render: function() {
			var self = this;

			self.$el.append(tpl());

			return this;
		}
	});

	return QuestionBeforeJoin;
});