define([
    'backbone',
    'hbs!../../../templates/modals/challengeAchived',
    'app'
], function(
    Backbone,
    tpl,
    App
) {
    var ChallengeAchived = Backbone.View.extend({
        className: 'challengeAchived-popup',

        initialize: function(options) {
            this.details = options;
        },

        events: {
            'click .yellow-btn-join': 'joinLottoryPopup'
        },

        onClose: function() {
            var self = this;
            self.$el.find(".time-counting").each(function() {
                if ($(this).data("end")) {
                    $(this).countdown('destroy');
                }

            });
        },

        openUpcomingPopup: function(event) {
            event.preventDefault();
            App.vent.trigger('popup:open', {
                full: true,
                view: new UpcomingLotteries()
            })
            return false;
        },

        render: function() {
            var self = this;

            self.details.user_points = App.generalDetails.score > self.details.required_points ? self.details.required_points : App.generalDetails.score;
            self.details.percent = App.generalDetails.score > self.details.required_points ? 100 : App.generalDetails.score / self.details.required_points * 100;
            self.$el.append(tpl({
                PUBLICURL: App.PUBLICURL,
                IMAGEURL: App.IMAGEURL,
                details: self.details,
                fill_lot_details: !App.generalDetails.fill_lot_details
            }));
            self.$el.find(".time-counting").each(function() {
                if ($(this).data("end")) {
                    var timeleft = $(this).data("end") - App.generalDetails.server_time;
                    $(this).countdown({
                        until: +timeleft,
                        format: "dHMS",
                        layout: "{dnn}:{hnn}:{mnn}:{snn}"
                    })
                } else {
                    $(this).html("No draws at this moment")
                    $(this).css("font-size", "25px");
                }
            })
            return this;
        }
    });

    return ChallengeAchived;
});