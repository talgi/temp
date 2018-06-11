define([
    'backbone',
    'hbs!../../../templates/modals/homeUpComing',
    'app'
], function(
    Backbone,
    tpl,
    App
) {
    var HomeUpComing = Backbone.View.extend({
        className: 'upcomingLotteries-popup',

        initialize: function(options) {
            this.all = options;
        },

        events: {},

        onClose: function() {},

        render: function() {
            var self = this;

            self.$el.append(tpl({
                PUBLICURL: App.PUBLICURL,
                all:self.all
            }));

            return this;
        }
    });

    return HomeUpComing;
});