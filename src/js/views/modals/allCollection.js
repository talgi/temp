define([
	'backbone',
	'hbs!../../../templates/modals/allCollection',
	'app'
], function(
	Backbone,
	tpl,
	App
) {
	var AllCollection = Backbone.View.extend({
		className: 'allCollection-popup',
		collaction: null,
		options: null,

		initialize: function(options) {
			this.options = options;
			this.collaction = options.collaction;
		},

		events: {},

		onClose: function() {},

		search: function(objects) {
			var booklets = []

			$.each(objects.pages, function(index, pages) {
				$.each(pages.booklets, function(index1, obj3) {
                    obj3.total_books = obj3.total_books === 1 ? 0 :   obj3.total_books;
					booklets.push(obj3);
				});
			});

			return booklets
		},

		render: function() {
			var self = this;

			console.log(this.search(this.collaction.titanium).length);

			self.$el.append(tpl({
				IMAGEURL: App.IMAGEURL,
				PUBLICURL: App.PUBLICURL,
				name: this.options.name,
				score: this.options.score,
				userBooklets: this.collaction.superstars.ownedBooklets + this.collaction.gold.ownedBooklets + this.collaction.titanium.ownedBooklets,
				totalBooklets: this.options.totalBooklets,
				superstars: this.search(this.collaction.superstars),
				gold: this.search(this.collaction.gold),
				titanium: this.search(this.collaction.titanium)
			}));

			$('.card.titanium').width(($('.cards-bg').width() - 25) / this.search(this.collaction.titanium).length);
			$('.card.titanium').height(87);
			$('.card.gold').width((($('.cards-bg').width() - 23) / this.search(this.collaction.titanium).length) / 1.3);
			$('.card.gold').height(87 / 1.2);
			$('.card.superstars').width((($('.cards-bg').width() - 25) / this.search(this.collaction.titanium).length) / 2);
			$('.card.superstars').height(87 / 2);

			return this;
		}
	});
	return AllCollection;
});