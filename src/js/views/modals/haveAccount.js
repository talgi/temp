define([

    'backbone',
    'hbs!../../../templates/modals/haveAccount',
    'views/modals/welcomeModal',
    'views/modals/forgetPassword',
    'app',
    'alertify'
], function(
    Backbone,
    tpl,
    WelcomeModal,
    ForgetPassword,
    App,
    alertify
) {
    var HaveAccount = Backbone.View.extend({
        className: 'haveAccount-popup',

        initialize: function(options) {
            FB.init({
                appId: '383697938491466',
                version: 'v2.4'
            });
        },

        events: {
            'click .facebook-signup-btn': 'onFacebook',
            'submit #login-form': 'onLogin',
            'click #forgetPassword': 'forgetPassword',
            'click #onSignup': 'onSignup'
        },

        onSignup: function(e) {
            if (e) {
                e.preventDefault();
            }
            require(['views/modals/signup'], function(Signup) {
                App.vent.trigger('popup:open', {
                    view: new Signup()
                })
            });


            return false;
        },
        forgetPassword: function(e) {
            if (e) {
                e.preventDefault();
            }


            App.vent.trigger('popup:open', {
                view: new ForgetPassword()
            });

            return false;
        },

        onClose: function() {},

        onLogin: function(e) {
            e.preventDefault();
            var data = $(e.target).serialize()
            $.ajax({
                url: App.APIURL + 'auth/login',
                type: 'POST',
                dataType: 'json',
                data: data
            }).done(function(e) {
                if (e.success) {
                    App.vent.trigger('popup:close');
                    App.generalDetails = e.generalDetails;
                    App.Router.navigate("my-flip-madness", true);
                } else {
                    var err = e.error;
                    var html = '<h3>Oops, something has happened!</h3>';
                    $.each(err, function(index, val) {
                        html += '<p>' + val + '</p>';
                    });
                    alertify.alert(html);
                }
            });
        },

        onFacebook: function(e) {
            if (e) {
                e.preventDefault();
            }

            var self = this;



            FB.getLoginStatus(function(response) {
                if (response.status === 'connected') {
                    //self.sendFacebookResponseToServer(response)
                    FB.api('/me?fields=id,name,picture,friends,email', function(fields) {
                        //elf.sendFacebookResponseToServer($.extend(true, fields, response));
                        self.sendFacebookResponseToServer(response);
                    });
                } else {
                    FB.login(function(response) {
                        if (response.authResponse) {
                            FB.api('/me?fields=id,name,picture,friends,email', function(fields) {
                                //self.sendFacebookResponseToServer($.extend(true, fields, response))
                                self.sendFacebookResponseToServer(response);
                            });
                        } else {
                        }
                        //console.log(response);

                    }, {
                        scope: 'public_profile, email, user_friends'
                    });
                }
            });
            return false;
        },

        sendFacebookResponseToServer: function(response) {
            var data = response.authResponse;
            $.ajax({
                url: App.APIURL + 'auth/fb-login',
                type: 'POST',
                dataType: 'json',
                data: data
            }).done(function(e) {
                if (e.success) {

                    App.vent.trigger('popup:close');
                    App.generalDetails = e.generalDetails;
                    if (e.welcomePopUp) {
                        App.generalDetails.welcomePopUp = 0;
                        App.vent.trigger('popup:open', {
                            full: false,
                            view: new WelcomeModal()
                        })
                    } else {
                        App.Router.navigate("my-flip-madness", true);
                    }
                } else {
                    var err = e.error;
                    var html = '<h3>Oops, something has happened!</h3>';
                    $.each(err, function(index, val) {
                        html += '<p>' + val + '</p>';
                    });
                    alertify.alert(html);
                }
            }).fail(function() {
                console.log("error");
            });
        },

        render: function() {
            var self = this;

            self.$el.append(tpl({
                PUBLICURL: App.PUBLICURL
            }));

            return this;
        }
    });
    return HaveAccount;
});