/*global define */
define(function(require) {
	'use strict';
	var App = (function() {
		// constructor
		function App() {
			// context refvn
			var _this = this;

			App.startApp(_this);
		}

		App.startApp = function(_this) {

			if (typeof debug !== 'undefined') {
				App.prototype.APIURL = 'http://localhost:8000/api/';
				App.prototype.IMAGEURL = 'http://localhost:8000/uploads/';
				App.prototype.PUBLICURL = '';
			}

			//console.log(_this);
			// fired by the router, signals the destruct event within top view and
			// recursively collapses all the sub-views that are stored as properties
			Backbone.View.prototype.close = function() {

				// calls views closing event handler first, if implemented (optional)
				if (this.onClose) {
					this.onClose(); // this for custom cleanup purposes
				}

				// first loop through childViews[] if defined, in collection views
				//  populate an array property i.e. this.childViews[] = new ControlViews()
				if (this.childViews) {
					_.each(this.childViews, function(child) {
						child.close();
					});
				}

				// close all child views that are referenced by property, in model views
				//  add a property for reference i.e. this.toolbar = new ToolbarView();
				for (var prop in this) {
					if (this[prop] instanceof Backbone.View) {
						this[prop].close();
					}
				}

				this.unbind();
				this.remove();

				// available in Backbone 0.9.9 + when using view.listenTo,
				//  removes model and collection bindings
				// this.stopListening(); // its automatically called by remove()

				// remove any model bindings to this view
				//  (pre Backbone 0.9.9 or if using model.on to bind events)
				// if (this.model) {
				//  this.model.off(null, null, this);
				// }

				// remove and collection bindings to this view
				//  (pre Backbone 0.9.9 or if using collection.on to bind events)
				// if (this.collection) {
				//  this.collection.off(null, null, this);
				// }
			}

			require(['routers/router'], function(Router) {
				App.prototype.Router = new Router();

				$.ajaxSetup({
					xhrFields: {
						withCredentials: true
					}
				});

				$(document).ajaxError(function(event, jqxhr, settings, thrownError) {
					switch (jqxhr.status) {
						case 500:
							console.log("somthing went wrong");
							break;
						case 401:
							_this.Router.navigate("", true);
							break;
					}


				});
				//history backbone start {pushState: true}


				$.ajax({
					url: _this.APIURL + 'auth/is-login',
					type: 'GET'
				}).done(function(e) {
					if (e == "1") {
						$.ajax({
							url: _this.APIURL + 'auth/general-details',
							type: 'get',
							dataType: 'json'
						}).done(function(e) {
							Backbone.history.start();
							App.prototype.generalDetails = e.generalDetails;
							if (_this.Router.route == "") {
								_this.Router.navigate("my-flip-madness", true);
							}
						});
					} else if(e == -1){
						window.location.href = "http://es.flipmadness.co.uk/"
					}else {
						Backbone.history.start();
						if (_this.Router.route != "") {
							_this.Router.navigate("", true);
						}

					}
				});
			});
		}
		App.prototype.updateNotifications = function() {
				var xhr = $.ajax({

					url: App.APIURL + 'my-flip-madness/notifications',
					type: 'get'
				});
			}
			// My Awesome App VERSION
		App.prototype.VERSION = '1.0.0';
		// Backbone
		App.prototype.Backbone = require('backbone');
		// underscore
		App.prototype._ = require('underscore');
		// jQuery
		App.prototype.$ = require('jquery');

		//global for the current page;
		App.prototype.currentPage = '';

		App.prototype.vent = null;

		//App.prototype.APIURL = 'http://52x.co/dev/framebyframe/public_html/api/';
		//App.prototype.IMAGEURL = 'http://52x.co/dev/framebyframe/public_html/uploads/';

		App.prototype.APIURL = 'http://flipmadness.co.uk/api/';
		App.prototype.IMAGEURL = 'http://flipmadness.co.uk/uploads/';
		App.prototype.PUBLICURL = 'app/';

		App.prototype.notificationPopup = [];

		return App;

	})();

	return (new App());
});