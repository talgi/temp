define([
    'backbone',
    'hbs!../../templates/contact',
    'hbs!../../templates/comp/footer',
    'app',
    'alertify'
], function(
    Backbone,
    tpl,
    Footer,
    App,
    alertify

) {
    var Contact = Backbone.View.extend({

        initialize: function(options) {

        },
        events:{
            "submit #contact_form": 'onSubmit',
            'click .inner-back': 'onBack'
        },
        onClose: function() {

        },
        onBack: function(event) {
            event.preventDefault();
            App.Router.navigate("", true);
        },

        onSubmit:function(e){
            e.preventDefault();

            event.preventDefault();
            var data = $(event.target).serialize();
            $.ajax({
                url: App.APIURL + 'general/contact',
                type: 'post',
                data: data
            }).done(function (e) {


                if (e.success) {
                    $("#contact_form").find("input , textarea").val("");
                    alertify.alert("Your massage was sent Successfully");
                }
                else {
                    var msg = "";
                    if ($.isArray(e.error)) {

                        $.each(e.error, function (index, value) {
                            msg += value + "<br>";
                        });
                    }

                    alertify.alert(msg);
                }
            });
        },
        render: function() {
            var self = this;
            self.$el.append(tpl({
                IMAGEURL: App.IMAGEURL,
                PUBLICURL: App.PUBLICURL,
                footer: Footer({
                    IMAGEURL: App.IMAGEURL,
                    PUBLICURL: App.PUBLICURL
                })
            }));
            App.valhallaLoader.start();
            $("body").animate({scrollTop:0},0)
            return this;
        }
    });
    return Contact;
});