(function( $ ) {
	'use strict';

	var preload = $('.preload');

	// Open modal.
	$(document).ready( function() {

		$('.modal').modal();

		$('.add-new-table').on('click', function(e) {
			e.preventDefault();
			$('#add_new_table').modal('open');
		});

	});

	// Create table.
	$(document).ready( function() {

		$('#crear-tabla').on('click', function(e) {

			e.preventDefault();

			var nombre = $('#nombre-tabla');
			var n = nombre.val();
			var mensaje = $('#add_new_table #mensaje');

			if ( n != '' ) {
				
				// Envio ajax.
				mensaje.html('');
				// Preload
				preload.css('display', 'flex');

			}
			else {

				if ( !nombre.hasClass('invalid') ) {
					
					// Preload
					preload.css('display', 'none');

					nombre.addClass('invalid');
					nombre.after('<p id="mensaje">Insertar nombre de la tabla.</p>')

				}

			}
		});

	});

})( jQuery );