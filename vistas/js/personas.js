/*=============================================
CARGAR LA TABLA DINÁMICA DE PERSONAS
=============================================*/

var perfilOculto = $("#perfilOculto").val();

var tablaPersonas = $('#tablaPersonas').DataTable({

	"ajax": "ajax/datatable-personas.ajax.php?perfilOculto="+perfilOculto,

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
SUBIENDO LA FOTO DE LA PERSONA
=============================================*/
$(".nuevaFotoPersona").change(function() {
 	
 	var imagen = this.files[0];

 	console.log("PRESIONADO");

 	/*=============================================
	SUBIENDO LA FOTO DE LA PERSONA
	=============================================*/

	if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {

		$(".nuevaFotoPersona").val("");

		swal.fire({
			
			title: "Error al subir la imagen",
			text: "La imagen debe estar en formato JPG o PNG",
			icon: "error",
			allowOutsideClick: false,
			confirmButtonText: "¡Cerrar!"

		});

	} else if(imagen["size"] > 2000000) {

		$(".nuevaFoto").val("");

		swal.fire({

			title: "Error al subir la imagen",
			text: "La imagen no debe pesar mas de 2MB",
			icon: "error",
			allowOutsideClick: false,
			confirmButtonText: "¡Cerrar!"

		});

	} else {

		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen);

		$(datosImagen).on("load", function(event){

			var rutaImagen = event.target.result;
			$(".previsualizar").attr("src", rutaImagen);

		});

	}

});

/*=============================================
VALIDANDO DATOS DE NUEVA PERSONA
=============================================*/
$("#frmNuevoPersona").validate({

  	rules: {
  		nuevoPaternoPersona : { patron_texto: true},
		nuevoMaternoPersona: { patron_texto: true},
		nuevoNombrePersona: { required: true, patron_texto: true},
   		nuevoCIPersona: { required: true},
   		nuevoExtCIPersona : { required: true},
   		nuevoFechaNacimientoPersona: { required: true},
   		nuevoSexoPersona: { required: true},
   		nuevoDireccionPersona : { required: true, patron_textoEspecial: true},
   		nuevoTelefonoPersona : { required: true, patron_numeros: true},
   		nuevoEmailPersona : { patron_textoEspecial: true},   		  
  	},

  	messages: {
		nuevoExtCIUsuario : "Elija una extensión",
		nuevoSexoPersona : "Elija una opción",
	},

});

/*=============================================
GUARDANDO DATOS DE NUEVA PERSONA
=============================================*/

$("#frmNuevoPersona").on("click", ".btnGuardar", function() {

    if ($("#frmNuevoPersona").valid()) {

    	console.log("VALIDADO PERSONA");

		var datos = new FormData($("#frmNuevoPersona")[0]);
		datos.append("nuevoPersona", 'nuevoPersona');
	
		$.ajax({

			url:"ajax/personas.ajax.php",
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
						title: "¡Los datos se guardaron correctamente!",
						showConfirmButton: true,
						allowOutsideClick: false,
						confirmButtonText: "Cerrar"

					}).then((result) => {
	  					
	  					if (result.value) {

	  						window.location = "personas";

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

/*=============================================
CARGANDO DATOS DE PERSONA AL FORMULARIO EDITAR PERSONA
=============================================*/

$(document).on("click", ".btnEditarPersona", function() {

	// console.log("CARGAR PERSONA");

	var id_persona = $(this).attr("idPersona");
	console.log("id_persona", id_persona);


	var datos = new FormData();
	datos.append("mostrarPersona", 'mostrarPersona');
	datos.append("id_persona", id_persona);

	$.ajax({

		url: "ajax/personas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {
			console.log("respuesta", respuesta);
			$('#editarIdPersona').val(respuesta["id_persona"]);
			$('#editarPaternoPersona').val(respuesta["paterno_persona"]);
			$('#editarMaternoPersona').val(respuesta["materno_persona"]);
			$('#editarNombrePersona').val(respuesta["nombre_persona"]);
			$('#editarCIPersona').val(respuesta["ci_persona"]);
			$('#editarExtCIPersona').val(respuesta["ext_ci_persona"]).selectpicker('refresh');
			$('#editarFechaNacimientoPersona').val(respuesta["fecha_nacimiento"]);
			$('#editarSexoPersona').val(respuesta["sexo_persona"]).selectpicker('refresh');
			$('#editarEstadoCivilPersona').val(respuesta["estado_civil"]).selectpicker('refresh');
			$('#editarDireccionPersona').val(respuesta["direccion_persona"]);
			$('#editarTelefonoPersona').val(respuesta["telefono_persona"]);
			$('#editarEmailPersona').val(respuesta["email_persona"]);

			$("#fotoActualPersona").val(respuesta["foto_persona"]);		

			if (respuesta["foto_persona"] != "") {

				$(".previsualizar").attr("src", respuesta["foto_persona"]);

			}

		},
	    error: function(error){

	      console.log("No funciona");
	        
	    }

	});

});

/*=============================================
VALIDANDO DATOS DE EDITAR PERSONA
=============================================*/
$("#frmEditarPersona").validate({

  	rules: {
  		editarPaternoPersona : { patron_texto: true},
		editarMaternoPersona : { patron_texto: true},
		editarNombrePersona : { required: true, patron_texto: true},
   		editarCIPersona : { required: true},
   		editarExtCIPersona : { required: true},
   		editarFechaNacimientoPersona: { required: true},
   		editarSexoPersona : { required: true},
   		editarEstadoCivilPersona : { required: true},
   		editarDireccionPersona : { required: true, patron_textoEspecial: true},
   		editarTelefonoPersona : { required: true, patron_numeros: true},
   		editarEmailPersona : { patron_textoEspecial: true},   		  
  	},

  	messages: {
		editarExtCIUsuario : "Elija una extensión",
		editarSexoPersona : "Elija una opción",
		editarEstadoCivilPersona : "Elija una opción",
	},

});

/*=============================================
GUARDANDO DATOS DE EDITAR PERSONA
=============================================*/

$("#frmEditarPersona").on("click", ".btnGuardar", function() {

    if ($("#frmEditarPersona").valid()) {

    	var datos = new FormData($("#frmEditarPersona")[0]);
		datos.append("editarPersona", 'editarPersona');

		$.ajax({

			url:"ajax/personas.ajax.php",
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
						title: "¡Los datos se guardaron correctamente!",
						showConfirmButton: true,
						allowOutsideClick: false,
						confirmButtonText: "Cerrar"

					}).then((result) => {
	  					
	  					if (result.value) {

	  						$('#modalEditarPersona').modal('toggle');

							$("#editarPaternoPersona").val("");	
							$("#editarMaternoPersona").val("");
							$("#editarNombrePersona").val("");		
							$("#editarCIPersona").val("");
							$("#editarExtCIPersona").val("");
							$("#editarFechaNacimientoPersona").val("");
							$("#editarSexoPersona").val("");
							$("#editarEstadoCivilPersona").val("");
							$("#editarDireccionPersona").val("");
							$("#editarTelefonoPersona").val("");
							$("#editarEmailPersona").val("");
							$("#editarFotoPersona").val("");
							$("#editarIdPersona").val("");

	  						// Funcion que recarga y actuaiiza la tabla	

							tablaPersonas.ajax.reload( null, false );

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

/*=============================================
REVISAR SI EL CI PERSONA YA ESTÁ REGISTRADO
=============================================*/

$("#nuevoCIPersona").change(function() {

	if ($(this).val() == "") {

		$(this).removeClass('is-valid');

	} else {

		$(".invalid-feedback").remove();
		
		$(this).removeClass('is-invalid');
		$(this).addClass('is-valid');
		
		var usuario = $(this).val();

		var datos = new FormData();
		datos.append("validarPersona", usuario);

		$.ajax({
			url: "ajax/personas.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta) {

				if (respuesta) {

					$("#nuevoCIPersona").after('<div class="invalid-feedback" style="display: none;">Este nro ci ya existe en la base de datos</div>');				

					$("#nuevoCIPersona").addClass('is-invalid');
					
					$(".invalid-feedback").show('fast');

					$("#nuevoCIPersona").val('');

					$("#nuevoCIPersona").after().removeClass('mb-3');

				} 

			}

		});

	}

});

/*=============================================
ABRIR VENTANA MAS DETALLE PERSONA 
=============================================*/

$(document).on("click", ".btnMasDetallesPersona", function() {

	var id_persona = $(this).attr("idPersona");
	console.log("id_persona", id_persona);

	// window.location = "index.php?ruta=detalle-persona&idPersona="+id_persona;	
	window.location = "detalle-persona/"+id_persona;	

});