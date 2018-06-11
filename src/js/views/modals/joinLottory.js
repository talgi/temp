define([
	'backbone',
	'hbs!../../../templates/modals/joinLottory',
	'app',
    'alertify',
], function(
	Backbone,
	tpl,
	App,
    alertify
) {
	var JoinLottory = Backbone.View.extend({
		className: 'joinLottory-popup',

		initialize: function(options) {


        },

		events: {
            'submit #join-lottery-form': 'onSubmit'
        },

		onClose: function() {},

        onSubmit:function(event){
            event.preventDefault();
            data = $(event.target).serialize();
            $.ajax({
                url: App.APIURL + 'my-flip-madness/join-lottery',
                type: 'post',
                data:data
            }).done(function(res) {

                var msg = "";
                if($.isArray(res.msg)){

                    $.each(res.msg,function(index , value){
                        msg+=value+"<br>";
                    });
                }
                else{
                    msg = res.msg
                }
                alertify.alert(msg);
                if(res.success){
                    ga('send', 'event', 'Entrance to a DRAW');
                    App.generalDetails.fill_lot_details = 1;
                    $(document).off("click" , ".yellow-btn-join" );
                    $(".enter-lottery .yellow-btn").remove();
                    $(".yellow-btn-join").remove();
                    App.vent.trigger("popup:close");
                }
            });
        },

		render: function() {
			var self = this;

			self.$el.append(tpl());

			return this;
		}
	});
	return JoinLottory;
});