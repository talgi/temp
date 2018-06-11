define([
	'backbone',
	'hbs!../../../templates/modals/forgetPassword',
	'app',
	'alertify'
], function(
	Backbone,
	tpl,
	App,
	alertify
) {
	var ForgetPassword = Backbone.View.extend({
		className: 'forgetPassword-popup',

		initialize: function(options) {},

		events: {
            "submit #lost-password-form":"onSubmit"
        },

		onClose: function() {},

        onSubmit:function(e){
            e.preventDefault();
            $.ajax({
                url: App.APIURL + 'auth/forgot-password',
                type: 'post',
                data:$("#lost-password-form").serialize()
            }).done(function(res) {
                alertify.alert(res.msg);
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
	return ForgetPassword;
});