define([
	'backbone',
	'hbs!../../../templates/modals/signup',
	'app',
	'views/modals/haveAccount',
	'views/modals/welcomeModal',
	'alertify',
], function(
	Backbone,
	tpl,
	App,
	HaveAccount,
	WelcomeModal,
	alertify
) {
	var Signup = Backbone.View.extend({
		className: 'signup-popup',

		initialize: function(options) {},

		events: {
			'click .log-in-link': 'onLogin',
			'click #signupBTN': 'onSignup'
		},

		onSignup: function(e) {
			if (e) {
				e.preventDefault();
			}

			$.ajax({
				url: App.APIURL + 'auth/register',
				type: 'POST',
				dataType: 'json',
				data: {
					'email': $('.sign-up-form input[name=email]').val(),
					'password': $('.sign-up-form input[name=password1]').val(),
					'password_confirmation': $('.sign-up-form input[name=password2]').val(),
					'first_name': $('.sign-up-form input[name=firstName]').val(),
					'last_name': $('.sign-up-form input[name=lastName]').val(),
					'birthday': $('.sign-up-form input[name=dateOfBirthDay]').val() + '-' + $('.sign-up-form input[name=dateOfBirthMonth]').val() + '-' + $('.sign-up-form input[name=dateOfBirthYear]').val()
				}
			}).done(function(e) {

				if (e.success) {
					App.vent.trigger('popup:close');
					ga('send', 'event', 'register', 'Creating Account');
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


			return false;
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

		onClose: function() {},

		render: function() {
			var self = this;

			self.$el.append(tpl({
				PUBLICURL: App.PUBLICURL
			}));

			return this;
		}
	});
	return Signup;
});