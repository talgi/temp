require.config({
	baseUrl: "js",
	hbs: {
		disableHelpers: true,
		disableI18n: true,
		amd: true,
		templateExtension: "html"
	},
	paths: {
		jquery: "../components/jquery/dist/jquery",
		helper: "helpers/helper",
		"jquery-plugin": "helpers/jquery.countdown/jquery.plugin",
		countdown: "helpers/jquery.countdown/jquery.countdown",
		utils: "helpers/utils",
		backbone: "../components/backbone-amd/backbone",
		underscore: "../components/underscore-amd/underscore",
		hbs: "../components/require-handlebars-plugin/hbs",
		json2: "../components/require-handlebars-plugin/hbs/json2",
		i18nprecompile: "../components/require-handlebars-plugin/hbs/i18nprecompile",
		handlebars: "../components/require-handlebars-plugin/hbs/handlebars",
		"backbone-amd": "../components/backbone-amd/backbone",
		bootstrap: "../components/bootstrap/dist/js/bootstrap",
		"require-handlebars-plugin": "../components/require-handlebars-plugin/hbs",
		requirejs: "../components/requirejs/require",
		"underscore-amd": "../components/underscore-amd/underscore",
		moment: "../components/moment/moment",
		swiper: "../components/swiper/dist/js/swiper",
		facebook: "helpers/all",
		alertify: "../components/alertify/alertify.min",
		"jquery.nicescroll": "helpers/jquery.nicescroll",
		"valhallaLoader": "helpers/valhalla-loader",
		odometer: "../components/odometer/odometer",
		mobileDetect: "../components/mobile-detect/mobile-detect"
	},
	shim: {
		bootstrap: {
			deps: [
				"jquery"
			]
		},
		countdown: {
			deps: [
				"jquery",
				"jquery-plugin"
			]
		},
		facebook: {
			exports: "FB"
		}
	},
	packages: [

	]
});

paceOptions = {
	document: false
}

//require(['fb']);
require(['app', 'routers/router'], function() {});