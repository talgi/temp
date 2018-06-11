define([
	'backbone',
	'hbs!../../../templates/modals/youLose',
	'app'
], function(
	Backbone,
	tpl,
	App
) {
	var YouLose = Backbone.View.extend({
		className: 'youLose-popup',

        initialize: function(options) {
            this.details = options;
        },

        events: {},

        onClose: function() {},

        render: function() {
            var self = this;

            self.$el.append(tpl({
                PUBLICURL: App.PUBLICURL,
                IMAGEURL:App.IMAGEURL,
                details:self.details
            }));

            return this;
        }
    });

	return YouLose;
});