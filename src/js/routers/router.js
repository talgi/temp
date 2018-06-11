define([
		//main
		'backbone',
		'app',
		//views
		'views/mainapp',
	],
	function(
		//main
		Backbone,
		App,
		//views
		MainView
	) {
		'use strict';
		return Backbone.Router.extend({
			newView: null,
			oldview: null,
			viewsHolder: [],

			routes: {
				'': 'home',
				'home': 'home',
				'my-flip-madness': 'mainpage',
				'settings': 'settings',
				'inner/:id': 'content',
				'inner': 'content',
				'contact': 'contact'
			},
			/**
			 * [initialize add the main view to the app + add slidemenu screen]
			 *
			 */
			initialize: function() {
				this.main_view = new MainView();
				App.$('body').append(this.main_view.el);
				this.main_view.render();
			},

			/**
			 * [loadView load all the view - and slide them]
			 * @param  {[type]} view [backobone view]
			 * @return {[type]}      [none]
			 */


			loadView: function(view) {
				var _self = this;
				App.currentPage = this.current().route;
				App.vent.trigger("popup:close");
				this.newView = view;
				//this.newView.el.className = "page center";
				this.newView.$el.hide();
				this.main_view.$el.append(this.newView.el);
				this.newView.render();

				this.newView.$el.fadeIn();
				this.viewsHolder.push(this.newView);

				if (this.oldview) {

					this.oldview.$el.fadeOut('fast', function() {
						_self.oldview.close();
						_self.oldview = _self.newView;

						$.each(_self.viewsHolder, function(index, val) {
							if (typeof val != "undefined") {

								if (val.cid != _self.newView.cid) {

									val.close();
									_self.viewsHolder.splice(index, 1)
								}
							} else {
								_self.viewsHolder.splice(index, 1);
							}
						});
					});
				} else {
					this.oldview = this.newView;
				}
                if(App.nice) {
                    App.nice.resize();
                }

			},

			/**
			 * [current -  show the current screen]
			 * @return {[obj]} [route: route, fragment: fragment,params: params]
			 */
			current: function() {
				var Router = this,
					fragment = Backbone.history.fragment,
					routes = _.pairs(Router.routes),
					route = null,
					params = null,
					matched;

				matched = _.find(routes, function(handler) {
					route = _.isRegExp(handler[0]) ? handler[0] : Router._routeToRegExp(handler[0]);
					return route.test(fragment);
				});

				if (matched) {
					// NEW: Extracts the params using the internal
					// function _extractParameters
					params = Router._extractParameters(route, fragment);
					route = matched[1];
				}

				return {
					route: route,
					fragment: fragment,
					params: params
				};
			},

			home: function() {
				var self = this;
				$.ajax({
					url: App.APIURL + 'auth/is-login',
					type: 'get'
				}).done(function(e) {
					if (e == "1") {
						App.Router.navigate("my-flip-madness", true);

					} else {

						require(['views/home'], function(HomeView) {
							self.loadView(new HomeView());
						});
					}
				});

			},

			mainpage: function() {
				var self = this;
				require(['views/mainpage'], function(MainPageView) {
					self.loadView(new MainPageView());
				});
			},

			settings: function() {
				var self = this;
				require(['views/settings'], function(SettingsView) {
					self.loadView(new SettingsView());
				});
			},

			contact: function() {
				var self = this;
				require(['views/contact'], function(ContactView) {
					self.loadView(new ContactView());
				});
			},

			content: function(page) {
				var self = this;
				require(['views/content'], function(ContentView) {
					self.loadView(new ContentView({
						page: page
					}));
				});
			},

			notFound: function() {}
		});
	});