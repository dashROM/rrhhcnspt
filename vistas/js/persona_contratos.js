// Inicializando la libreria CKEDITOR
CKEDITOR.replace('documentoContrato');

/*=============================================
CARGAR LA TABLA DINÁMICA DE PERSONA CONTRATOS
=============================================*/

var perfilOculto = $("#perfilOculto").val();
var idPersona = $("#idPersona").val();

var tablaPersonaContratos = $('#tablaPersonaContratos').DataTable({

	"ajax": "../ajax/datatable-persona_contratos.ajax.php?perfilOculto="+perfilOculto+"&idPersona="+idPersona,

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
SI EL TIPO DE CONTRATO ES SUPLENCIA APARECE LA OPCION PARA ELEGIR TIPO DE SUPLENCIA
=============================================*/

$(document).on("change", "#nuevoTipoContrato", function() {

	if ($(this).val() == "1") {
		
		$("#contratoSuplencia").removeClass("d-none");

	} else if ($(this).val() == "3")  {

		$("#contratoSuplencia").addClass("d-none");
		// $("#resolucionMinisterial").removeClass("d-none");

	} else {

		$("#contratoSuplencia").addClass("d-none");
		// $("#resolucionMinisterial").addClass("d-none");

	}
	
});

/*=============================================
CALCULAR FECHA FIN DE CONTRATO EN AGREGAR CONTRATO
=============================================*/

$(document).on("change", "#nuevoDiasContrato", function() {
	
	var fechaInicio = new Date($("#nuevoFechaInicio").val());
	
	var diasContrato = $(this).val();

	var fechaFin = sumarDiasFecha(fechaInicio, diasContrato);

	$("#nuevoFechaFin").val(fechaFin);

});

$(document).on("change", "#nuevoFechaInicio", function() {
	
	var fechaInicio = new Date($(this).val());
	
	var diasContrato = $("#nuevoDiasContrato").val()

	var fechaFin = sumarDiasFecha(fechaInicio, diasContrato);

	$("#nuevoFechaFin").val(fechaFin);

});

$(document).on("change", "#nuevoFechaFin", function() {
	
	var fechaFin = new Date($(this).val());

	var fechaInicio = new Date($("#nuevoFechaInicio").val());

	var difference= Math.abs(fechaFin-fechaInicio);

	days = difference/(1000 * 3600 * 24)

	$("#nuevoDiasContrato").val(days);

});

/*=============================================
CALCULAR FECHA FIN DE CONTRATO EN EDITAR CONTRATO
=============================================*/

$(document).on("change", "#editarDiasContrato", function() {
	
	var fechaInicio = new Date($("#editarFechaInicio").val());
	
	var diasContrato = $(this).val();

	var fechaFin = sumarDiasFecha(fechaInicio, diasContrato);

	$("#editarFechaFin").val(fechaFin);

});

$(document).on("change", "#editarFechaInicio", function() {
	
	var fechaInicio = new Date($(this).val());
	
	var diasContrato = $("#editarDiasContrato").val()

	var fechaFin = sumarDiasFecha(fechaInicio, diasContrato);

	$("#editarFechaFin").val(fechaFin);

});


$(document).on("change", "#editarFechaFin", function() {
	
	var fechaFin = new Date($(this).val());

	var fechaInicio = new Date($("#editarFechaInicio").val());

	var difference= Math.abs(fechaFin-fechaInicio);

	days = difference/(1000 * 3600 * 24)

	$("#editarDiasContrato").val(days+1);

});

/*=============================================
FUNCION PARA SUMAR DIAS A UNA DETERMINADA FECHA
=============================================*/

function sumarDiasFecha(miFecha, days){

	// fecha = new Date();
	day = miFecha.getDate();
	month = miFecha.getMonth() + 1;
	year = miFecha.getFullYear();

	tiempo = miFecha.getTime();
	milisegundos = parseInt(days * 24 * 60 * 60 * 1000);
	total = miFecha.setTime(tiempo + milisegundos);
	day = miFecha.getDate();
	month = miFecha.getMonth() + 1;
	year = miFecha.getFullYear();

	if (day < 10) day = '0'+ day;

	if (month < 10) month = '0'+ month;

	return(year+"-"+month+"-"+day);
	
}

/*=============================================
VALIDANDO DATOS DE NUEVO PERSONA CONTRATO
=============================================*/
$("#frmNuevoPersonaContrato").validate({

	rules: {
		nuevoLugar : { required: true},
		nuevoEstablecimiento : { required: true},
 		nuevoCargoEmpleado : { required: true},
 		nuevoFechaInicio : { required: true},
 		nuevoDiasContrato : {required: true},
 		nuevoFechaFin : { required: true},
 		nuevoTipoContrato : { required: true},  
 		nuevoTipoContratacion : { required: true}, 	
 		nuevoMemorandumInstructivo : { required: true},      	
 		nuevoObservacionesEmpleado : { patron_textoEspecial: true},   
	},

  messages: {
  		nuevoLugar : "Elija un lugar",
		nuevoEstablecimiento : "Elija un establecimiento",
		nuevoBuscarPersona : "Elija una persona",
		nuevoCargoEmpleado : "Elija un cargo",
		nuevoMemorandumInstructivo : "Elija una opción",
		nuevoTipoContrato : "Elija una tipo de contrato",
		nuevoTipoContratacion : "Elija una tipo de contratacion",
	},

});

/*=============================================
GUARDANDO DATOS DE NUEVO PERSONA CONTRATO
=============================================*/

$("#frmNuevoPersonaContrato").on("click", ".btnGuardar", function() {

	var idPersona = $("#nuevoIdPersona").val();

	var recurrencia = $(this).attr("recurrencia");

    if ($("#frmNuevoPersonaContrato").valid()) {

    	// console.log("VALIDADO PERSONA CONTRATO");

    	var datos = new FormData($("#frmNuevoPersonaContrato")[0]);
		datos.append("nuevoPersonaContratos", 'nuevoPersonaContratos');
		datos.append("recurrencia", recurrencia);

		$.ajax({

			url:"../ajax/persona_contratos.ajax.php",
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

	  						$('#modalAgregarPersonaContrato').modal('toggle');

							$("#nuevoFechaInicio").val("");
							$("#nuevoFechaFin").val("");
							$("#nuevoDiasContrato").val("");
							$("#nuevoObservacionesEmpleado").val("");

	  						// Funcion que recarga y actuaiiza la tabla	
							tablaPersonaContratos.ajax.reload( null, false );

						}

					});

				} else if(respuesta == "error") {

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
CARGANDO DATOS DE PERSONA CONTRATO AL FORMULARIO EDITAR PERSONA CONTRATO
=============================================*/

$(document).on("click", ".btnEditarPersonaContrato", function() {

	// console.log("CARGAR EMPLEADO");

	var id_persona_contrato = $(this).attr("idPersonaContrato");

	var datos = new FormData();
	datos.append("mostrarPersonaContrato", 'mostrarPersonaContrato');
	datos.append("id_persona_contrato", id_persona_contrato);

	$.ajax({

		url: "../ajax/persona_contratos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {
			console.log("respuesta", respuesta);

			// cargando datos de lugares
			$("#editarLugar").append('<option value="'+respuesta["id_lugar"]+'">'+respuesta["codificacion"]+'-'+respuesta["nombre_lugar"]+'</option>').selectpicker('refresh')
			
			var datosLugar = new FormData();
			datosLugar.append("buscadorLugares", 'buscadorLugares');
			datosLugar.append("id_lugar", respuesta["id_lugar"]);

			$.ajax({

				url: "../ajax/lugares.ajax.php",
				method: "POST",
				data: datosLugar,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta) {

					$.each(respuesta, function(index, val) {
						
						$("#editarLugar").append('<option value="'+val.id_lugar+'">'+val.codificacion+'-'+val.nombre_lugar+'</option>').selectpicker('refresh')

					});

				},
				error: function(error) {

			    	console.log("No funciona");
			        
			    }

			});

			// cargando datos de establecimientos
			$("#editarEstablecimiento").empty().append('<option value="'+respuesta["id_establecimiento"]+'">'+respuesta["nombre_establecimiento"]+'</option>').selectpicker('refresh')
			
			var datosEstablecimiento = new FormData();
			datosEstablecimiento.append("buscadorEstablecimientos", 'buscadorEstablecimientos');
			datosEstablecimiento.append("id_establecimiento", respuesta["id_establecimiento"]);

			$.ajax({

				url: "../ajax/establecimientos.ajax.php",
				method: "POST",
				data: datosEstablecimiento,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta) {

					$.each(respuesta, function(index, val) {
						
						$("#editarEstablecimiento").append('<option value="'+val.id_establecimiento+'">'+val.nombre_establecimiento+'</option>').selectpicker('refresh')

					});

				},
				error: function(error) {

			    	console.log("No funciona");
			        
			    }

			});

			// // cargando datos de personas
			// $('#editarBuscarPersona').empty().prepend("<option value='"+respuesta["id_persona"]+"' >"+respuesta["nombre_completo"]+"</option>");
			$('#editarBuscarPersona').val(respuesta["nombre_completo"]);
			$('#editarIdPersona').val(respuesta["id_persona"]);
			$('#editarCIEmpleado').val(respuesta["ci_persona"]);
			$('#editarFechaNacimientoEmpleado').val(respuesta["fecha_nacimiento"]);
			
			
			// cargando datos de cargos
			$("#editarCargoEmpleado").empty().append('<option value="'+respuesta["id_cargo"]+'">'+respuesta["nombre_cargo"]+'</option>').selectpicker('refresh')

			var datosCargo = new FormData();
			datosCargo.append("buscadorCargos", 'buscadorCargos');
			datosCargo.append("id_cargo", respuesta["id_cargo"]);

			$.ajax({

				url: "../ajax/cargos.ajax.php",
				method: "POST",
				data: datosCargo,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta) {

					$.each(respuesta, function(index, val) {
						
						$("#editarCargoEmpleado").append('<option value="'+val.id_cargo+'">'+val.nombre_cargo+'</option>').selectpicker('refresh')

					});

				},
				error: function(error){

		      		console.log("No funciona");
		        
		    	}

			});

			// cargando tipo_contratacion
			$("#editarTipoContratacion").empty().append('<option value="'+respuesta["tipo_contratacion"]+'">'+respuesta["tipo_contratacion"]+'</option>').selectpicker('refresh')

			if (respuesta["tipo_contratacion"] == "SALUD") {

				$("#editarTipoContratacion").append('<option value="ADMINISTRATIVO">ADMINISTRATIVO</option>').selectpicker('refresh')

			} else {

				$("#editarTipoContratacion").append('<option value="SALUD">SALUD</option>').selectpicker('refresh')

			}

			$('#editarFechaInicio').val(respuesta["inicio_contrato"]);
			$('#editarFechaFin').val(respuesta["fin_contrato"]);
			$('#editarDiasContrato').val(respuesta["dias_contrato"]);

			// cargando datos de contratos 
			$("#editarTipoContrato").empty().append('<option value="'+respuesta["id_contrato"]+'">'+respuesta["nombre_contrato"]+'</option>').selectpicker('refresh')

			var datosContrato = new FormData();
			datosContrato.append("buscadorContratos", 'buscadorContratos');
			datosContrato.append("id_contrato", respuesta["id_contrato"]);

			$.ajax({

				url: "../ajax/contratos.ajax.php",
				method: "POST",
				data: datosContrato,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta) {

					$.each(respuesta, function(index, val) {
						
						$("#editarTipoContrato").append('<option value="'+val.id_contrato+'">'+val.nombre_contrato+'</option>').selectpicker('refresh')

					});

				},
				error: function(error){

		      		console.log("No funciona");
		        
		    	}

			});

			if (respuesta["id_contrato"] == 1) {

				$("#editarContratoSuplencia").removeClass("d-none");

			} else if (respuesta["id_contrato"] == 3) {

				$("#editarContratoSuplencia").addClass("d-none");
				$("#cambiarResolucionMinisterial").removeClass("d-none");

			} else {

				$("#editarContratoSuplencia").addClass("d-none");
				$("#cambiarResolucionMinisterial").addClass("d-none");

			}

			// cargando datos de suplencia 
			$("#editarTipoSuplencia").empty().append('<option value="'+respuesta["id_suplencia"]+'">'+respuesta["tipo_suplencia"]+'</option>').selectpicker('refresh')

			var datosSuplencia = new FormData();
			datosSuplencia.append("buscadorTipoSuplencias", 'buscadorTipoSuplencias');
			datosSuplencia.append("id_suplencia", respuesta["id_suplencia"]);

			$.ajax({

				url: "../ajax/suplencias.ajax.php",
				method: "POST",
				data: datosSuplencia,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta) {

					$.each(respuesta, function(index, val) {
						
						$("#editarTipoSuplencia").append('<option value="'+val.id_suplencia+'">'+val.tipo_suplencia+'</option>').selectpicker('refresh')

					});

				},
				error: function(error){

		      		console.log("No funciona");
		        
		    	}

			});

			// $('#editarResolucionMinisterial').val(respuesta["resolucion_ministerial"]);

			// cargando datos de memorandum instructivo 
			$("#editarMemorandumInstructivo").empty().append('<option data-subtext="de fecha '+respuesta["fecha_memorandum"]+'" value="'+respuesta["id_memorandum"]+'">'+respuesta["nro_memorandum"]+'</option>').selectpicker('refresh')
			
			var datosMemorandum = new FormData();
			datosMemorandum.append("buscadorMemorandums", 'buscadorMemorandums');
			datosMemorandum.append("id_memorandum", respuesta["id_memorandum"]);

			$.ajax({

				url: "../ajax/memorandums.ajax.php",
				method: "POST",
				data: datosMemorandum,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta) {

					$.each(respuesta, function(index, val) {
						
						$("#editarMemorandumInstructivo").append('<option data-subtext="de fecha '+val.fecha_memorandum+'" value="'+val.id_memorandum+'">'+val.nro_memorandum+'</option>').selectpicker('refresh')

					});

				},
				error: function(error){

		      		console.log("No funciona");
		        
		    	}

			});

			$('#editarObservacionesContrato').val(respuesta["observaciones_contrato"]);
			$('#editarIdPersonaContrato').val(respuesta["id_persona_contrato"]);

		},
	    error: function(error){

	      console.log("No funciona");
	        
	    }

	});

});

/*=============================================
SI EL TIPO DE CONTRATO ES SUPLENCIA APARECE LA OPCION PARA ELEGIR TIPO DE SUPLENCIA EN EDITAR
=============================================*/

$(document).on("change", "#editarTipoContrato", function() {

	if ($(this).val() == "1") {
		
		$("#editarContratoSuplencia").removeClass("d-none");

	} else if ($(this).val() == "3")  {

		$("#editarContratoSuplencia").addClass("d-none");
		$("#cambiarResolucionMinisterial").removeClass("d-none");

	} else {

		$("#editarContratoSuplencia").addClass("d-none");
		$("#cambiarResolucionMinisterial").addClass("d-none");

	}
	
});

/*=============================================
VALIDANDO DATOS DE EDITAR PERSONA CONTRATO
=============================================*/
$("#frmEditarPersonaContrato").validate({

	rules: {
		editarLugar : { required: true},
		editarEstablecimiento : { required: true},
		editarBuscarPersona : { required: true},
 		editarCargoEmpleado : { required: true},
 		editarFechaInicio : { required: true},
 		editarFechaFin : { required: true},
 		editarDiasContrato : { required: true}, 
 		editarTipoContrato : { required: true},   
 		editarTipoContratacion : { required: true},		
 		editarObservacionesEmpleado : { patron_textoEspecial: true},   
	},

	messages: {
		editarLugar : "Elija un lugar",
		editarEstablecimiento : "Elija un establecimiento",
		editarCargoEmpleado : "Elija un cargo",
		editarTipoContrato : "Elija una tipo de contrato",
		editarTipoContratacion : "Elija una tipo de contratacion",
	},

});

/*=============================================
GUARDANDO DATOS DE EDITAR PERSONA CONTRATO
=============================================*/

$("#frmEditarPersonaContrato").on("click", ".btnGuardar", function() {

    if ($("#frmEditarPersonaContrato").valid()) {

		var datos = new FormData($("#frmEditarPersonaContrato")[0]);
		datos.append("editarPersonaContrato", 'editarPersonaContrato');

		// console.log("datos", datos);

		$.ajax({

			url:"../ajax/persona_contratos.ajax.php",
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

		  					$('#modalEditarPersonaContrato').modal('toggle');

		  					// $("#editarEstablecimiento").remove();
							$("#editarBuscarPersona").val("");		
							$("#editarCIEmpleado").val("");
							$("#editarFechaNacimientoEmpleado").val("");
							// $("#editarCargoEmpleado").remove();
							$("#editarFechaInicio").val("");
							$("#editarFechaFin").val("");
							$("#editarDiasContrato").val("");
							// $("#editarTipoContrato").remove();
							$("#editarResolucionMinisterial").val("");
							$("#editarObservacionesContrato").val("");
							// $("#editarIdEmpleado").val("");

	  						// Funcion que recarga y actuaiiza la tabla	

							tablaPersonaContratos.ajax.reload( null, false );

	  						// window.location = "empleados";

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
CARGANDO DATOS DE DOCUMENTO CONTRATO AL FORMULARIO 
=============================================*/

$(document).on("click", ".btnDocumentoContrato", function() {

	// console.log("CARGAR CONTRATO");

	var id_persona_contrato = $(this).attr("idPersonaContrato");

	var datos = new FormData();
	datos.append("mostrarDocumentoContrato", 'mostrarDocumentoContrato');
	datos.append("id_persona_contrato", id_persona_contrato);

	$.ajax({

		url: "../ajax/persona_contratos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {
			// console.log("respuesta", respuesta["documento_contrato"]);
	 
			var value = CKEDITOR.instances.documentoContrato.setData(respuesta["documento_contrato"]);

			$('#editarIdDocumentoContrato').val(respuesta["id_persona_contrato"]);
			
		},
	    error: function(error){

	      console.log("No funciona");
	        
	    }

	});

});

/*=============================================
GUARDANDO DATOS DE EDITAR DOCUMENTO CONTRATO
=============================================*/

$("#frmEditarDocumentoContrato").on("click", ".btnGuardar", function() {

	var documento = CKEDITOR.instances.documentoContrato.getData();

	var datos = new FormData($("#frmEditarDocumentoContrato")[0]);
	datos.append("editarDocumentoContrato", 'editarDocumentoContrato');
	datos.append("documento", documento);

	$.ajax({

		url:"../ajax/persona_contratos.ajax.php",
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

	  					$('#modalEditarDocumentoContrato').modal('toggle');

					}

				});

			} else {

				swal.fire({
						
					title: "¡Error al guardar el contrato!",
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

});

/*=============================================
BOTÓN GENERERAR PDF PARA IMPRIMIR CONTRATO EN PDF
=============================================*/

$(document).on("click", "button.btnImprimirContrato", function() {
	
	var id_persona_contrato = $(this).attr("idPersonaContrato");
	console.log("id_persona_contrato", id_persona_contrato);

	var datos = new FormData();

	datos.append("ContratoPDF", "ContratoPDF");
	datos.append("id_persona_contrato", id_persona_contrato);

	//Para mostrar alerta personalizada de loading
	swal.fire({
        text: 'Procesando...',
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
        onOpen: () => {
            swal.showLoading()
        }
    });

	$.ajax({

		url: "../ajax/persona_contratos.ajax.php",
		type: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta) {

			//Para cerrar la alerta personalizada de loading
			swal.close();

			$('#ver-pdf').modal({

				show:true,
				backdrop:'static'

			});	

			PDFObject.embed("../temp/contrato-"+id_persona_contrato+".pdf", "#view_pdf");

		}

	});

});

/*=============================================
BOTON QUE PARA CERRAR LA VENTANA MODAL DEL REPORTE PDF Y ELIMINA EL ARCHIVO TEMPORAL
=============================================*/

$("#ver-pdf").on("click", ".btnCerrar", function() {

	var url = $(this).parent().parent().children(".modal-body").children().children().attr("src");
	console.log("url", url);

	var datos = new FormData();

	datos.append("eliminarPDF", "eliminarPDF");
	datos.append("url", url);

	$.ajax({

		url: "../ajax/persona_contratos.ajax.php",
		type: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta) {
		
		}

	});

});

/*=============================================
CARGANDO DATOS DE ARCHIVO DEL CONTRATO AL FORMULARIO 
=============================================*/

$(document).on("click", ".btnCargarContrato", function() {

	// console.log("CARGAR CONTRATO");

	var id_persona_contrato = $(this).attr("idPersonaContrato");
	console.log("id_persona_contrato", id_persona_contrato);

	var datos = new FormData();
	datos.append("mostrarPersonaContrato", 'mostrarPersonaContrato');
	datos.append("id_persona_contrato", id_persona_contrato);

	$.ajax({

		url: "../ajax/persona_contratos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {
			console.log("respuesta", respuesta);

			$("#editarIdArchivoContrato").val(respuesta["id_persona_contrato"]);

			$(".btnValidarArchivo").attr("idPersonaContrato",respuesta["id_persona_contrato"])

			if (respuesta["archivo_contrato"] != null) {

				PDFObject.embed(respuesta["archivo_contrato"], "#archivo_pdf");

				$('#archivoActual').val(respuesta["archivo_contrato"]);

				if (respuesta["estado_contrato"] != 1) {

					$("#frmCargarArchivoContrato .btnGuardar").removeClass("d-none");

					$(".btnValidarArchivo").removeClass("d-none");

				} else {

					$("#frmCargarArchivoContrato .btnGuardar").addClass("d-none");

					$(".btnValidarArchivo").addClass("d-none");
					
				}


			} else {

				PDFObject.embed("", "#archivo_pdf");

				$('#archivoActual').val();

				$("#frmCargarArchivoContrato .btnGuardar").addClass("d-none");

				$(".btnValidarArchivo").addClass("d-none");

			}
			
		},
	    error: function(error){

	      console.log("No funciona");
	        
	    }

	});

});

/*=============================================
SUBIENDO EL ARCHIVO DEL FORMULARIO 
=============================================*/
$(".archivoContrato").change(function() {
 	
 	var archivo = this.files[0];

	console.log("archivo", archivo["type"]);

 	/*=============================================
	SUBIENDO EL ARCHIVO DEL CONTRATO
	=============================================*/

	if (archivo["type"] != "application/pdf") {

		$(".archivoContrato").val("");

		swal.fire({
			
			title: "Error al subir el archivo",
			text: "La archivo debe estar en formato PDF",
			icon: "error",
			allowOutsideClick: false,
			confirmButtonText: "¡Cerrar!"

		});

	} else if(archivo["size"] > 5000000) {

		$(".archivoContrato").val("");

		swal.fire({

			title: "Error al subir el archivo",
			text: "El archivo no debe pesar mas de 5MB",
			icon: "error",
			allowOutsideClick: false,
			confirmButtonText: "¡Cerrar!"

		});

	} else {

		var datosArchivo = new FileReader;
		datosArchivo.readAsDataURL(archivo);

		$(datosArchivo).on("load", function(event){

			var rutaArchivo = event.target.result;
			// $(".previsualizarContrato").attr("src", rutaArchivo);
			PDFObject.embed(rutaArchivo, "#archivo_pdf");

			$("#frmCargarArchivoContrato .btnGuardar").removeClass("d-none");

		});

	}

});

/*=============================================
GUARDANDO ARCHIVO CONTRATO
=============================================*/

$("#frmCargarArchivoContrato").on("click", ".btnGuardar", function() {

	// console.log("guardarArchivoContrato", 'guardarArchivoContrato');

	var datos = new FormData($("#frmCargarArchivoContrato")[0]);
	datos.append("guardarArchivoContrato", 'guardarArchivoContrato');

	$.ajax({

		url:"../ajax/persona_contratos.ajax.php",
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
					title: "¡El archivo se guardo correctamente!",
					showConfirmButton: true,
					allowOutsideClick: false,
					confirmButtonText: "Cerrar"

				}).then((result) => {
  					
  					if (result.value) {

	  					$('#modalCargarArchivoContrato').modal('toggle');

					}

				});

			} else {

				swal.fire({
						
					title: "¡Error al guardar el archivo!",
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

});

/*=============================================
ELIMINADO ARCHIVO CONTRATO PREVISUALIZADO
=============================================*/

$("#frmCargarArchivoContrato").on("click", ".btnCerrar", function() {

	console.log("btnCerrar", "btnCerrar");

	// $(".previsualizarContrato").attr('src','');

	PDFObject.embed("", "#archivo_pdf");

});

/*=============================================
VALIDAR ARCHIVO CONTRATO
=============================================*/

$(document).on("click", ".btnValidarArchivo", function() {

	swal.fire({

		title: "¿Está seguro de validar el contrato?",
		text: "¡Si no lo está puede cancelar la acción!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		cancelButtonText: "Cancelar",
		confirmButtonText: "¡Si, validar!"

	}).then((result)=> {

		var id_persona_contrato = $(this).attr("idPersonaContrato");
		console.log("id_persona_contrato", id_persona_contrato);

		var datos = new FormData();

		datos.append("validarArchivoContrato", "validarArchivoContrato");
		datos.append("id_persona_contrato", id_persona_contrato);
		datos.append("estado_contrato", 1);

		$.ajax({

			url: "../ajax/persona_contratos.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			success: function(respuesta) {
				
				if (window.matchMedia("(max-width:767px)").matches) {

					swal.fire({
						
						title: "El contrato ha sido validado",
						icon: "success",
						allowOutsideClick: false,
						confirmButtonText: "¡Cerrar!"

					}).then(function(result) {

						if (result.value) {

							tablaPersonaContratos.ajax.reload( null, false );
						}

					});

				} else {

					swal.fire({
						
						title: "El contrato ha sido validado",
						icon: "success",
						allowOutsideClick: false,
						confirmButtonText: "¡Cerrar!"

					}).then(function(result) {

						if (result.value) {

							$('#modalCargarArchivoContrato').modal('toggle');
							
							tablaPersonaContratos.ajax.reload( null, false );
						}

					});

				}

			},
			error: function(error) {

	        console.log("No funciona");
	        
	    }

		});

	});

});

/*=============================================
CARGANDO DATOS DE EMPLEADO AL FORMULARIO AMPLIAR PERSONA CONTRATO
=============================================*/

$(document).on("click", ".btnAmpliarPersonaContrato", function() {

	console.log("AMPLIAR CONTRATO");

	var id_persona_contrato = $(this).attr("idPersonaContrato");

	var datos = new FormData();
	datos.append("mostrarPersonaContrato", 'mostrarPersonaContrato');
	datos.append("id_persona_contrato", id_persona_contrato);

	$.ajax({

		url: "../ajax/persona_contratos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {

			$("#ampliarIdPersonaContrato").val(respuesta["id_persona_contrato"]);

			$(".btnValidarDocumentoAmpliacion").attr("idPersonaContrato",respuesta["id_persona_contrato"]);
			
			// console.log("respuesta", respuesta["ampliacion"]);

			$('#ampliarLugar').val(respuesta["nombre_lugar"]);
			$("#ampliarIdLugar").val(respuesta["id_lugar"]);

			$('#ampliarEstablecimiento').val(respuesta["nombre_establecimiento"]);
			$("#ampliarIdEstablecimiento").val(respuesta["id_establecimiento"]);

			$('#ampliarBuscarPersona').val(respuesta["nombre_completo"]);
			$('#ampliarIdPersona').val(respuesta["id_persona"]);
			$('#ampliarCIEmpleado').val(respuesta["ci_persona"]);
			$('#ampliarFechaNacimientoEmpleado').val(respuesta["fecha_nacimiento"]);

			$('#ampliarCargo').val(respuesta["nombre_cargo"]);
			$("#ampliarIdCargo").val(respuesta["id_cargo"]);			

			$('#ampliarFechaInicio').val(respuesta["inicio_contrato"]);
			$('#ampliarFechaFin').val(respuesta["fin_contrato"]);
			$('#antFechaFin').val(respuesta["fin_contrato"]);
			$('#ampliarDiasContrato').val(respuesta["dias_contrato"]);

			$('#ampliarTipoContrato').val(respuesta["nombre_contrato"]);
			$("#ampliarIdContrato").val(respuesta["id_contrato"]);
			
			$('#ampliarIdPersonaContrato').val(respuesta["id_persona_contrato"]);

			if (respuesta["documento_ampliacion"] != null) {

				PDFObject.embed(respuesta["documento_ampliacion"], "#doc_ampliacion_pdf");

				$('#documentoActual').val(respuesta["documento_ampliacion"]);

				if (respuesta["ampliacion"] != 1) {

					$("#frmAmpliarPersonaContrato .btnGuardar").removeClass("d-none");

					$(".btnValidarDocumentoAmpliacion").removeClass("d-none");

				} else {

					$("#frmAmpliarPersonaContrato .btnGuardar").addClass("d-none");

					$(".btnValidarDocumentoAmpliacion").addClass("d-none");
					
				}


			} else {

				PDFObject.embed("", "#doc_ampliacion_pdf");

				$('#documentoActual').val();

				$("#frmAmpliarPersonaContrato .btnGuardar").addClass("d-none");

				$(".btnValidarDocumentoAmpliacion").addClass("d-none");

			}

		},
	    error: function(error) {

	      console.log("No funciona");
	        
	    }

	});

});

/*=============================================
CALCULAR DIAS DE CONTRATO EN AMPLIAR CONTRATO
=============================================*/

$(document).on("change", "#ampliarFechaFin", function() {
	
	var fechaFin = new Date($(this).val());

	var fechaInicio = new Date($("#ampliarFechaInicio").val());

	var difference= Math.abs(fechaFin-fechaInicio);

	days = difference/(1000 * 3600 * 24)

	$("#ampliarDiasContrato").val(days+1);

});

/*=============================================
VALIDANDO DATOS DE AMPLIAR PERSONA CONTRATO
=============================================*/
$("#frmAmpliarPersonaContrato").validate({

	rules: {
 		editarFechaFin : { required: true},
	},

});

/*=============================================
GUARDANDO DATOS DE AMPLIAR PERSONA CONTRATO
=============================================*/

$("#frmAmpliarPersonaContrato").on("click", ".btnGuardar", function() {

    if ($("#frmAmpliarPersonaContrato").valid()) {

		var datos = new FormData($("#frmAmpliarPersonaContrato")[0]);
		datos.append("ampliarPersonaContrato", 'ampliarPersonaContrato');

		$.ajax({

			url:"../ajax/persona_contratos.ajax.php",
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

		  					$('#modalAmpliarPersonaContrato').modal('toggle');

		  					$("#ampliarLugar").val("");
		  					$("#ampliarIdLugar").val("");
		  					$("#ampliarEstablecimiento").val("");
		  					$("#ampliarIdEstablecimiento").val("");
							$("#ampliarBuscarPersona").val("");		
							$("#ampliarCIEmpleado").val("");
							$("#ampliarFechaNacimientoEmpleado").val("");
							$("#ampliarCargo").val("");
							$("#ampliarIdCargo").val("");
							$("#ampliarFechaInicio").val("");
							$("#ampliarFechaFin").val("");
							$("#antFechaFin").val("");
							$("#ampliarDiasContrato").val("");
							$("#ampliarTipoContrato").val("");
							$("#ampliarIdContrato").val("");
							$("#ampliarTipoSuplencia").val("");
							$("#ampliarIdSuplencia").val("");
							$("#ampliarObservacionesContrato").val("");
							$("#ampliarIdPersonaContrato").val("");

							PDFObject.embed("", "#doc_ampliacion_pdf");

	  						// Funcion que recarga y actuaiiza la tabla	

							tablaPersonaContratos.ajax.reload( null, false );

	  						// window.location = "empleados";

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
SUBIENDO EL DOCUMENTO DE AMPLIACION AL FORMULARIO 
=============================================*/
$(".documentoAmpliacion").change(function() {
 	
 	var archivo = this.files[0];

	console.log("archivo", archivo["type"]);

 	/*=============================================
	SUBIENDO EL ARCHIVO DEL CONTRATO
	=============================================*/

	if (archivo["type"] != "application/pdf") {

		$(".documentoAmpliacion").val("");

		swal.fire({
			
			title: "Error al subir el archivo",
			text: "La archivo debe estar en formato PDF",
			icon: "error",
			allowOutsideClick: false,
			confirmButtonText: "¡Cerrar!"

		});

	} else if(archivo["size"] > 5000000) {

		$(".documentoAmpliacion").val("");

		swal.fire({

			title: "Error al subir el archivo",
			text: "El archivo no debe pesar mas de 5MB",
			icon: "error",
			allowOutsideClick: false,
			confirmButtonText: "¡Cerrar!"

		});

	} else {

		var datosArchivo = new FileReader;
		datosArchivo.readAsDataURL(archivo);

		$(datosArchivo).on("load", function(event){

			var rutaArchivo = event.target.result;
			// $(".previsualizarContrato").attr("src", rutaArchivo);
			PDFObject.embed(rutaArchivo, "#doc_ampliacion_pdf");

			$("#frmAmpliarPersonaContrato .btnGuardar").removeClass("d-none");

		});

	}

});

/*=============================================
VALIDAR DOCUMENTO DE AMPLIACION
=============================================*/

$(document).on("click", ".btnValidarDocumentoAmpliacion", function() {

	swal.fire({

		title: "¿Está seguro de validar el documento de ampliacion?",
		text: "¡Si no lo está puede cancelar la acción!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		cancelButtonText: "Cancelar",
		confirmButtonText: "¡Si, validar!"

	}).then((result)=> {

		var id_persona_contrato = $(this).attr("idPersonaContrato");
		console.log("id_persona_contrato", id_persona_contrato);

		var datos = new FormData();

		datos.append("validarDocumentoAmpliacion", "validarDocumentoAmpliacion");
		datos.append("id_persona_contrato", id_persona_contrato);
		datos.append("ampliacion", 1);

		$.ajax({

			url: "../ajax/persona_contratos.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			success: function(respuesta) {
				
				if (window.matchMedia("(max-width:767px)").matches) {

					swal.fire({
						
						title: "El documento de ampliación ha sido validado",
						icon: "success",
						allowOutsideClick: false,
						confirmButtonText: "¡Cerrar!"

					}).then(function(result) {

						if (result.value) {

							tablaPersonaContratos.ajax.reload( null, false );
						}

					});

				} else {

					swal.fire({
						
						title: "El ocumento de ampliación ha sido validado",
						icon: "success",
						allowOutsideClick: false,
						confirmButtonText: "¡Cerrar!"

					}).then(function(result) {

						if (result.value) {

							$('#modalAmpliarPersonaContrato').modal('toggle');
							
							tablaPersonaContratos.ajax.reload( null, false );
						}

					});

				}

			},
			error: function(error) {

	        console.log("No funciona");
	        
	    }

		});

	});

});