define([
	'hbs/handlebars'
], function(Handlebars) {
	'use strict';

	Handlebars.registerHelper("math", function(lvalue, operator, rvalue, options) {
		lvalue = parseFloat(lvalue);
		rvalue = parseFloat(rvalue);

		return {
			"+": lvalue + rvalue
		}[operator];
	});

	return Handlebars;
});