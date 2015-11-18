(function() {
	'use strict';

	var UI = {

		init: function() {
			UI.notyinit();
			UI.event_handlers_init();
		},

		notyinit: function() {
			$.noty.defaults.theme = 'relax';
			$.noty.defaults.layout = 'topLeft';
			$.noty.defaults.type = 'information';
			$.noty.defaults.timeout = 10000;
		},
		event_handlers: {

		},

		event_handlers_init: function() {

		}

	};

	$(function () {

		UI.init();

	});


})();