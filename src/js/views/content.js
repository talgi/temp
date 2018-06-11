define([
    'backbone',
    'hbs!../../templates/content',
    'hbs!../../templates/comp/footer',
    'hbs!../../templates/inner_content',
    'app'
], function(
    Backbone,
    tpl,
    Footer,
    InnerContent,
    App

) {
    var content = Backbone.View.extend({
        page: null,

        initialize: function(options) {
            this.page = options.page;
        },

        events: {
            'click .inner-back': 'onBack'
        },

        onBack: function(event) {
            event.preventDefault();
            App.Router.navigate("", true);
        },
        onClose: function() {},

        render: function() {
            var self = this;
            var html = '';
            $(window).scrollTop(0);
            if (this.page) {
                $.ajax({
                    url: App.APIURL + 'general/inner/' + this.page,
                    type: 'GET'
                }).done(function(res) {

                    if (!res.success) {
                        App.router.navigate("", true);
                        return;
                    }
                    html = InnerContent();

                    html += res.view.content;
                    self.$el.append(tpl({
                        IMAGEURL: App.IMAGEURL,
                        PUBLICURL: App.PUBLICURL,
                        html: html,
                        footer: Footer({
                            IMAGEURL: App.IMAGEURL,
                            PUBLICURL: App.PUBLICURL
                        })
                    }));
                    App.valhallaLoader.start();
                    $(window).scrollTop(0);
                });

            }



            return this;
        }
    });
    return content;
});