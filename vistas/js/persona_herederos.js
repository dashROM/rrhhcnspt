/*=============================================
CARGAR LA TABLA DINÁMICA DE PERSONA CONTRATOS
=============================================*/

var perfilOculto = $("#perfilOculto").val();
var idPersona = $("#idPersona").val();

var tablaPersonaHerederos = $('#tablaPersonaHerederos').DataTable({

	"ajax": {
		url: "../ajax/datatable-persona_herederos.ajax.php",
		data: { 'perfilOculto' : perfilOculto, 'idPersona' : idPersona },
		type: "post"
	},
	// "ajax": "../ajax/datatable-persona_herederos.ajax.php?perfilOculto="+perfilOculto+"&idPersona="+idPersona,

	"deferRender": true,

	"retrieve" : true,

	"processing" : true,

	"language": {

		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
		"sFirst":    "Primero",
		"sLast":     "Último",
		"sNext":     "Siguiente",
		"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		},
		"buttons": {
			"copy": "Copiar",
    		"colvis": "Visibilidad de columnas"
    	}
		
	},

	// "responsive": true,

	"lengthChange": false,

}); 


/*=============================================
VALIDANDO DATOS DE NUEVO PERSONA HEREDERO
=============================================*/

$("#frmNuevoPersonaHeredero").validate({

	rules: {
		nuevoPaternoHeredero : { patron_texto: true},
		nuevoMaternoHeredero: { patron_texto: true},
		nuevoNombreHeredero: { required: true, patron_texto: true},
   	// nuevoFechaNacimientoHeredero: { required: true},
   	nuevoParentezco: { required: true},
	},

	messages: {
  		nuevoParentezco : "Elija un parentezco",
	},

	errorPlacement: function(error, element) {
    var placement = $(element).data('error');
    if (placement) {
      $(placement).append(error)
    } else {
      error.insertAfter(element);
    }
  }

});

/*=============================================
GUARDANDO DATOS DE NUEVO PERSONA HEREDERO
=============================================*/

$("#frmNuevoPersonaHeredero").on("click", ".btnGuardar", function() {

	$(".btnGuardar").prop("disabled", true);

	var idPersona = $("#nuevoIdPersona").val();
	// console.log("idPersona", idPersona);

  if ($("#frmNuevoPersonaHeredero").valid()) {

    // console.log("VALIDADO PERSONA HEREDERO");

    var datos = new FormData($("#frmNuevoPersonaHeredero")[0]);
		datos.append("idPersona", idPersona);
		datos.append("nuevoPersonaHeredero", 'nuevoPersonaHeredero');

		$.ajax({

			url:"../ajax/persona_herederos.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "html",
			success: function(respuesta) {
				// console.log("respuesta", respuesta);
			
				if (respuesta == "ok") {

					swal.fire({
						
						icon: "success",
						title: "¡Los datos se guardaron correctamente!",
						showConfirmButton: true,
						allowOutsideClick: false,
						confirmButtonText: "Cerrar"

					}).then((result) => {
	  					
	  				if (result.value) {

	  					$('#modalAgregarPersonaHeredero').modal('toggle');

							$("#nuevoPaternoHeredero").val("");
							$("#nuevoMaternoHeredero").val("");
							$("#nuevoNombreHeredero").val("");
							$("#nuevoFechaNacimientoHeredero").val("");
							$("#nuevoParentezco").val("");

							$(".btnGuardar").prop("disabled", false); 

	  					// Funcion que recarga y actuaiiza la tabla	
							tablaPersonaHerederos.ajax.reload( null, false );

						}

					});

				} else if(respuesta == "error") {

					swal.fire({
							
						title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales!",
						icon: "error",
						allowOutsideClick: false,
						confirmButtonText: "¡Cerrar!"

					}).then((result) => {

						if (result.value) {
							$(".btnGuardar").prop("disabled", false);
						}

					});
					
				} else if (respuesta >= 2) {
					
					swal.fire({
							
						title: "¡La persona tiene dos o mas contratos!<br>Pedir autorización para otro contrato",
						icon: "error",
						allowOutsideClick: false,
						confirmButtonText: "¡Cerrar!"

					}).then((result) => {

						if (result.value) {
							$(".btnGuardar").prop("disabled", false);
						}

					});

				}

			},
			error: function(error) {

	      swal.fire({

					title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales!",
					icon: "error",
					allowOutsideClick: false,
					confirmButtonText: "¡Cerrar!"

				}).then((result) => {

					if (result.value) {
						$(".btnGuardar").prop("disabled", false);
					}

				});
	        
	    }

		});

    } else {

		swal.fire({
				
			title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales!",
			icon: "error",
			allowOutsideClick: false,
			confirmButtonText: "¡Cerrar!"

		}).then((result) => {

			if (result.value) {
				$(".btnGuardar").prop("disabled", false);
			}

		});
		
	} 

});

/*=============================================
CARGANDO DATOS DE PERSONA HEREDERO AL FORMULARIO EDITAR PERSONA HEREDERO
=============================================*/

$(document).on("click", ".btnEditarPersonaHeredero", function() {

	console.log("CARGAR PERSONA HEREDERO");

	var id_persona_heredero = $(this).attr("idPersonaHeredero");
	console.log("id_persona_heredero", id_persona_heredero);

	var datos = new FormData();
	datos.append("mostrarPersonaHeredero", 'mostrarPersonaHeredero');
	datos.append("id_persona_heredero", id_persona_heredero);

	$.ajax({

		url: "../ajax/persona_herederos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {
			console.log("respuesta", respuesta);

			$('#editarPaternoHeredero').val(respuesta["paterno_heredero"]);
			$('#editarMaternoHeredero').val(respuesta["materno_heredero"]);
			$('#editarNombreHeredero').val(respuesta["nombre_heredero"]);
			$('#editarFechaNacimientoHeredero').val(respuesta["fecha_nacimiento"]);
			$('#editarParentezco').val(respuesta["parentezco"]).selectpicker('refresh');
			$('#idPersonaHeredero').val(respuesta["id_persona_heredero"]);

		},
	  error: function(error){

	    swal.fire({

				title: "¡Error de conexión a la Base de Datos!",
				icon: "error",
				allowOutsideClick: false,
				confirmButtonText: "¡Cerrar!"

			});
	        
	  }

	});

});

/*=============================================
VALIDANDO DATOS DE EDITAR PERSONA HEREDERO
=============================================*/
$("#frmEditarPersonaHeredero").validate({

	rules: {
		editarPaternoHeredero : { patron_texto: true},
		editarMaternoHeredero: { patron_texto: true},
		editarNombreHeredero: { required: true, patron_texto: true},
   		// editarFechaNacimientoHeredero: { required: true},
   		editarParentezco: { required: true},
	},

	messages: {
  		editarParentezco : "Elija un parentezco",
	},

});

/*=============================================
GUARDANDO DATOS DE EDITAR PERSONA HEREDERO
=============================================*/

$("#frmEditarPersonaHeredero").on("click", ".btnGuardar", function() {

  if ($("#frmEditarPersonaHeredero").valid()) {

		var datos = new FormData($("#frmEditarPersonaHeredero")[0]);
		datos.append("editarPersonaHeredero", 'editarPersonaHeredero');

		$.ajax({

			url:"../ajax/persona_herederos.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "html",
			success: function(respuesta) {

				console.log("respuesta", respuesta);
			
				if (respuesta == "ok") {

					swal.fire({
						
						icon: "success",
						title: "¡Los datos se actualizaron correctamente!",
						showConfirmButton: true,
						allowOutsideClick: false,
						confirmButtonText: "Cerrar"

					}).then((result) => {
	  					
		  			if (result.value) {

		  				$('#modalEditarPersonaHeredero').modal('toggle');

							$("#editarPaternoHeredero").val("");
							$("#editarMaternoHeredero").val("");
							$("#editarNombreHeredero").val("");
							$("#editarFechaNacimientoHeredero").val("");
							$("#editarParentezco").val("");
							$("#idPersonaHeredero").val("");

							$(".btnGuardar").prop("disabled", false);  

	  					// Funcion que recarga y actuaiiza la tabla	
							tablaPersonaHerederos.ajax.reload( null, false );

						}

					});

				} else {

					swal.fire({
							
						title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales!",
						icon: "error",
						allowOutsideClick: false,
						confirmButtonText: "¡Cerrar!"

					}).then((result) => {

						if (result.value) {
							$(".btnGuardar").prop("disabled", false);
						}

					});
					
				}

			},
			error: function(error) {

		    swal.fire({

					title: "¡Error de conexión a la Base de Datos!",
					icon: "error",
					allowOutsideClick: false,
					confirmButtonText: "¡Cerrar!"

				}).then((result) => {

					if (result.value) {
						$(".btnGuardar").prop("disabled", false);
					}

				});
		        
		  }

		});

    } else {

		swal.fire({
				
			title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales!",
			icon: "error",
			allowOutsideClick: false,
			confirmButtonText: "¡Cerrar!"

		}).then((result) => {

			if (result.value) {
				$(".btnGuardar").prop("disabled", false);
			}

		});
		
	} 

});

/*=============================================
ELIMINAR PERSONA HEREDERO
=============================================*/

$(document).on("click", ".btnEliminarPersonaHeredero", function() {
	
	var id_persona_heredero = $(this).attr("idPersonaHeredero");

	swal.fire({

		title: '¿Está seguro de borrar el heredero?',
		text: '¡Si no lo esta puede cancelar la acción!',
		icon: 'warning',
		showCancelButton: true,
		allowOutsideClick: false,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar heredero!'

	}).then((result)=>{

		if (result.value) {

			var datos = new FormData();
			datos.append("eliminarPersonaHeredero", 'eliminarPersonaHeredero');
			datos.append("id_persona_heredero", id_persona_heredero);

			$.ajax({

				url:"../ajax/persona_herederos.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "html",
				success: function(respuesta) {

					console.log("respuesta", respuesta);
				
					if (respuesta == "ok") {

						swal.fire({
							
							icon: "success",
							title: "¡Los datos se eliminaron correctamente!",
							showConfirmButton: true,
							allowOutsideClick: false,
							confirmButtonText: "Cerrar"

						}).then((result) => {
		  					
			  			if (result.value) {

		  					// Funcion que recarga y actuaiiza la tabla	

								tablaPersonaHerederos.ajax.reload( null, false );

							}

						});

					} else {

						swal.fire({
								
							title: "¡Error, no se pudo completar el procedimiento!",
							icon: "error",
							allowOutsideClick: false,
							confirmButtonText: "¡Cerrar!"

						});
						
					}

				},
				error: function(error) {

			    swal.fire({

						title: "¡Error de conexión a la Base de Datos!",
						icon: "error",
						allowOutsideClick: false,
						confirmButtonText: "¡Cerrar!"

					});
			        
			  }

			});

		}

	});

});