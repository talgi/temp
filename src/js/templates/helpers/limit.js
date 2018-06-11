define([
	'hbs/handlebars'
], function(Handlebars) {
	'use strict';

	Handlebars.registerHelper('limit', function(arr, limit) {
		if (!_.isArray(arr)) {
			return [];
		} // remove this line if you don't want the lodash/underscore dependency
		return arr.slice(0, limit);
	});

	return Handlebars;
});