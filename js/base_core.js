var home = home || {};

home.exception = function( e ) {
	"use strict";
	console.error( e.message );
	noty({ text: e.message, type: 'error', dismissQueue:true });
};

home.call = function( method, opt, type ) {
	"use strict";

	var deferred = $.Deferred();

	home.api.client( method, opt, type )
		.done( function( response ) {
			if ( response.message ) {
				var message = response.message;
				noty({text: message, dismissQueue: true});
				response.notification_message = message;
			}
			deferred.resolve( response );
		} )
		.fail( function( error ) {
			home.exception( error );
			deferred.reject( error );
		});

	return deferred.promise();
};

home.get = function(method) {
	return home.call(method, {}, 'get');
};

home.post = function(method, opt) {
	return home.call(method, opt, 'post');
};