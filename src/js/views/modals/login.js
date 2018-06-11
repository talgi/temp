define([
	'backbone',
	'hbs!../../../templates/modals/login',
	'app',
	'views/modals/signup',
	'views/modals/haveAccount',
	'views/modals/welcomeModal',
	'alertify',
	'facebook'
], function(
	Backbone,
	tpl,
	App,
	Signup,
	HaveAccount,
	WelcomeModal,
	alertify
) {
	var Login = Backbone.View.extend({
		className: 'login-popup',

		initialize: function(options) {
			FB.init({
				appId: '383697938491466',
				version: 'v2.4'
			});
		},

		events: {
			'click .facebook-signup-btn': 'onFacebook',
			'click .regular-signup-btn': 'onSignup',
			'click .log-in-link': 'onLogin'
		},


		onLogin: function(e) {
			if (e) {
				e.preventDefault();
			}

			App.vent.trigger('popup:open', {
				view: new HaveAccount()
			})

			return false;
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
								console.log('Good to see you, ' + fields.name + '.', fields);
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
							full: true,
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
					alertify.alert(e.error);
				}
			}).fail(function() {
				console.log("error");
			});
		},

		onSignup: function(e) {
			if (e) {
				e.preventDefault();
			}

			App.vent.trigger('popup:open', {
				view: new Signup()
			})

			return false;
		},
		onClose: function() {},

		render: function() {
			var self = this;

			self.$el.append(tpl({
				PUBLICURL: App.PUBLICURL
			}));

			return this;
		}
	});
	return Login;
});