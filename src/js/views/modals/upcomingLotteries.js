define([
    'backbone',
    'hbs!../../../templates/modals/upcomingLotteries',
    'app',
    "countdown"
], function(
    Backbone,
    tpl,
    App
) {
    var UpcomingLotteries = Backbone.View.extend({
        className: 'upcomingLotteries-popup',

        initialize: function(options) {},

        events: {},

        onClose: function() {

            this.$el.find(".time-counting").countdown("destroy");
        },

        render: function() {
            var self = this;
            $.ajax({
                url: App.APIURL + 'my-flip-madness/upcoming-lotteries',
                type: 'get',
                dataType: 'json'
            }).done(function(e) {
                var lotteris = {
                    lotteris: [],
                    all: e.all,
                    IMAGEURL: App.IMAGEURL,
                    PUBLICURL: App.PUBLICURL
                };

                $.each(e.upcoming, function(index, value) {
                    lotteris.lotteris[index] = value;
                    lotteris.lotteris[index].user_points = App.generalDetails.score > value.required_points ? value.required_points : App.generalDetails.score;
                    lotteris.lotteris[index].percent = App.generalDetails.score > value.required_points ? 100 : App.generalDetails.score / value.required_points * 100;
                });

                lotteris.fill_lot_details = !App.generalDetails.fill_lot_details;
                self.$el.append(tpl(lotteris));

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
            });


            return this;
        }
    });
    return UpcomingLotteries;
});