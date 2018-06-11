define([
	'backbone',
	'hbs!../../../templates/modals/youWin',
	'app'
], function(
	Backbone,
	tpl,
	App
) {
	var YouWin = Backbone.View.extend({
		className: 'youWin-popup',

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

	return YouWin;
});