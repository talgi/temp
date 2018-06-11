define([
	'hbs/handlebars'
], function(Handlebars) {
	'use strict';



	/**
	 * Handlebars helper: shout
	 *
	 * @example
	 * // returns 'the bar helper got: HELLO !!'
	 * {{shout 'hello' }}
	 */
	Handlebars.registerHelper('shout', function(words) {
		return words.toUpperCase() + ' !!';
	});

	/**
	 * Handlebars helper: shout
	 *
	 * @example
	 * // returns 'the bar helper got: HELLO !!'
	 * {{shout 'hello' }}
	 */
	Handlebars.registerHelper('link', function(object) {
		var url = Handlebars.escapeExpression(object.url),
			text = Handlebars.escapeExpression(object.text);

		return new Handlebars.SafeString(
			"<a href='" + url + "'>" + text + "</a>"
		);
	});



	return Handlebars;
});