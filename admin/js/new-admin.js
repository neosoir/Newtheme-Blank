(function( $ ) {
	'use strict';

	var preload = $('.preload');
	var urledit = "?page=new_data&accion=edit&id=";

	/**
	 * Open modal.
	 */ 
	$(document).ready( function() {

		$('.modal').modal();

		$('.add-new-table').on('click', function(e) {
			e.preventDefault();
			$('#add_new_table').modal('open');
		});

	});

	/**
	 * Create table.
	 */
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

				$.ajax({
					url: newdata.url,
					type: 'POST',
					dataType: 'json',
					data: {
						action: 'new_crud_table',
						nonce: newdata.seguridad,
						nombre: n,
						tipo: 'add'
					},
					success: function( response ) {
						if ( response.result ) {
							
							urledit += response.insert_id
							setTimeout( function() {
								location.href = urledit;
							}, 1300 );
						}
					},
					error: function ( d, x, v ) {
						console.log( d );
						console.log( x );
						console.log( v );
					}
				});

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

	/**
	 * Delete table (use sweetalert).
	 */
	$(document).ready( function() {
		$('table').on('click', '[data-new-id-remove]', function() {

			var id 		= $(this).attr('data-new-id-remove');
			var nombre 	= $('#dataTable' + id + ' [data-new-name]').attr('data-new-name');



			swal({

				title: "¿Estás seguro?",
				text: "Una vez eliminada la tabla no podras recuperarla",
				icon: "warning",
				buttons: true,
				dangerMode: true,

			})
			.then((willDelete) => {

				if (willDelete) {

					$.ajax({
						url: 		newtabdelete.url,
						type: 		'POST',
						dataType: 	'json',
						data: {
							action: 	'ajax_delete_table',
							nonce: 		newtabdelete.seguridad,
							nombre: 	nombre,
							id: 		id,
							tipo: 		'delete'
						},
						success: function( response ) {

							if ( response.result == 1 ) {
							
								$("[ data-table='" + response.id + "' ]").remove();

								swal("¡Tu tabla " + response.nombre + " ha sido eliminda!", {
									icon: "success",
								  });
								
							}
							else {
								swal("Lo sentimos, no se podido eliminar tu tabla " + data.nombre + " se ha producido un error en la consulta.", {
									icon: "error",
								  });	
							}
						}
					});

				} 
				else {
				  swal("La tabla " + nombre + " no ha sido eliminda.");
				}

			});



			

			
		});

	});


	/**
	 * Redirect to edit page (edit button).
	 */
	$(document).ready( function() {
		$('table').on('click', '[data-new-id-edit]',function(e) {

			var id = $(this).attr('data-new-id-edit');

			location.href = urledit + id;

			console.log(location.href )

		});

	});

})( jQuery );