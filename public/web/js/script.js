(function($) {

	"use strict";

	$('[data-toggle="tooltip"]').tooltip();

 	// loader
 	var loader = function() {
 		setTimeout(function() { 
 			if($('#ftco-loader').length > 0) {
 				$('#ftco-loader').removeClass('show');
 			}
 		}, 1);
 	};
 	loader();

 })(jQuery);

 $('#modal-login .btn-register').click(function() {
 	$('#modal-login').modal('hide');
 	$('#modal-register').modal();
 });

 $('#modal-register .btn-login').click(function() {
 	$('#modal-register').modal('hide');
 	$('#modal-login').modal();
 });