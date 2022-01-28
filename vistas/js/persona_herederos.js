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
   		nuevoFechaNacimientoHeredero: { required: true},
   		nuevoParentezco: { required: true},
	},

	messages: {
  		nuevoParentezco : "Elija un parentezco",
	},

});

/*=============================================
GUARDANDO DATOS DE NUEVO PERSONA HEREDERO
=============================================*/

$("#frmNuevoPersonaHeredero").on("click", ".btnGuardar", function() {

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

					});
					
				} else if (respuesta >= 2) {
					
					swal.fire({
							
						title: "¡La persona tiene dos o mas contratos!<br>Pedir autorización para otro contrato",
						icon: "error",
						allowOutsideClick: false,
						confirmButtonText: "¡Cerrar!"

					});
				}

			},
			error: function(error) {

	      		console.log("No funciona");
	        
	    	}

		});

    } else {

		swal.fire({
				
			title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales!",
			icon: "error",
			allowOutsideClick: false,
			confirmButtonText: "¡Cerrar!"

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

	      console.log("No funciona");
	        
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
   		editarFechaNacimientoHeredero: { required: true},
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

					});
					
				}

			},
			error: function(error) {

		        console.log("No funciona");
		        
		    }

		});

    } else {

		swal.fire({
				
			title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales!",
			icon: "error",
			allowOutsideClick: false,
			confirmButtonText: "¡Cerrar!"

		});
		
	} 

});