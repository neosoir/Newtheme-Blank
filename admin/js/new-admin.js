(function( $ ) {
	'use strict';

	/**
	 * Global varibles.
	 */
	var preload = $('.preload');
	var urledit = "?page=new_data&accion=edit&id=";
	var marcoImagen = $('.marcoImagen img');
	var marco;
	var urlImgUser = $('#selectimgval');

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

	/**
	 * Add users modal open.
	 */
	$(document).ready( function() {
		$( '.addItem' ).on( 'click', function() {
			$( '#addUpdate' ).modal('open');
		});
	});

	/**
	 * Media manager of wordpress to image user.
	 */
	$(document).ready( function() {
		$('#selectimg').on( 'click', function(e) {

			e.preventDefault();

			if ( marco ) {
				marco.open();
				return;
			}

			marco = wp.media({
				frame: 'select',
				title: 'Seleccionar imagen para usuario',
				button: {
					text: 'Usar esta imagen'
				},
				mulplile: false,
				library: {
					type: 'image'
				}
			});

			marco.on('select', function() {

				var imgUser = marco.state().get('selection').first().toJSON();
				urlImgUser.val( imgUser.url );
				marcoImagen.attr('src', imgUser.url );

			});

			marco.open();
		});
	});

	/**
	 * Validate form fiels (create new user).
	 */
	$(document).ready(function() {

		$('#agregar').on('click', function() {

			var nom			= $('nombres'),
		 		ape 		= $('apellidos'),
		 		ema			= $('email'),

				nombre 		= nom.val(),
		 		apellido 	= ape.val(),
		 		email 		= ema.val(),
		 		imgVal		= urlImgUser.val(),

				camposInput = $('.formularioDataUser input');

				if ( validarCamposVacios( camposInput ) ) {
					console.log('inputs vacios');
				}
				else if( validarEmail( email ) == false ) {
					console.log('Correo incorrecto');
					
					ema.removeClass('valid');
					ema.addClass('invalid');

					if( validarEmail( email ) == true ) {
						console.log('Correo correcto');
						ema.removeClass('invalid');
						ema.addClass('valid');

					}

				}
				else {
					camposInput.removeClass('invalid');
					camposInput.addClass('valid');

					console.log('todo correcto')
				}

		});

	});

	/**
	 * Validate form fiels (create new user).
	 */
	function validarCamposVacios( selector ) {

		var inputs	= $( selector ),
			result 	= false;

		$.each( inputs, function( c, v) {

			var input		= $(v),
				inputVal 	= input.val();

			if ( ( inputVal == '' ) && ( input.attr('type') != 'file' ) ) {

				if ( !input.hasClass('invalid') ) 
					input.addClass('invalid');

				result = true;
				
			}

		});

		if ( result ) 
			return true;

		else 
			return false;

	}

	function validarEmail( email ) {

		var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

		if ( !expr.test( email ) )
			return false;

		else
			return true;

	}
	
})( jQuery );