define([
	'backbone',
	'hbs!../../../templates/modals/lotteriesResults',
	'app'
], function(
	Backbone,
	tpl,
	App
) {
	var LotteriesResults = Backbone.View.extend({
		className: 'lotteriesResults-popup',

		initialize: function(options) {},

		events: {},

		onClose: function() {},

		render: function() {
			var self = this;
			$.ajax({
				url: App.APIURL + 'my-flip-madness/lottery-winners',
				type: 'get'
			}).done(function(e) {
				data = {
					lotteries: e
				}
				data.IMAGEURL = App.IMAGEURL;
				data.PUBLICURL = App.PUBLICURL;
				console.log('------------------------------------------');
				console.log(data);

				fixData = {
					lotteries: [{
						end_date: 'Oct 11 2015',
						lot_image: "img14397998097621789.png",
						lottery_id: 20,
						prizes: "Stage I Draw: T-Shirts, Hats, Sunglasses, Posters & more",
						users: [{
							user_id: '1113',
							name: 'Ethan Adam',
							image: 'fb_profilepic_1666678596880711.jpg'
						}, {
							user_id: '2097',
							name: 'Kelly Elkington',
							image: 'fb_profilepic_1498585453795998.jpg'
						}, {
							user_id: '2475',
							name: 'owen Frost',
							image: 'no-user-image-square.jpg'
						}, {
							user_id: '3053',
							name: 'linda woodburn',
							image: 'no-user-image-square.jpg'
						}],
					}]
				}

				fixData.IMAGEURL = App.IMAGEURL;
				fixData.PUBLICURL = App.PUBLICURL;
				self.$el.append(tpl(data));

				$('[data-toggle="tooltip"]').tooltip();
			});



			return this;
		}
	});
	return LotteriesResults;
});