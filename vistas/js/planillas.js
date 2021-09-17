// Inicializando la libreria CKEDITOR
CKEDITOR.replace('tituloRelacion');

/*=============================================
CARGAR LA TABLA DINÁMICA DE LISTADO DE RELACION DE NOVEDADES
=============================================*/

var perfilOculto = $("#perfilOculto").val();

var tablaRelacion = $('#tablaRelacion').DataTable({

	"ajax": "ajax/datatable-planillas.ajax.php?perfilOculto="+perfilOculto,

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

	"responsive": true,

	"lengthChange": false,


}); 

/*=============================================
CARGAR LA TABLA DINÁMICA DE LISTADO DE PLANILLAS
=============================================*/

var perfilOculto = $("#perfilOculto").val();

var tablaPlanilla = $('#tablaPlanillas').DataTable({

	"ajax": "ajax/datatable-planillas.ajax.php?perfilOculto="+perfilOculto,

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

	"responsive": true,

	"lengthChange": false,


}); 


/*=============================================
//VALIDANDO DATOS DE NUEVA PLANILLA
=============================================*/

$("#frmNuevoRelacion").validate({

	rules: {
		nuevoMes : { required: true},
		nuevoGestion : { required: true},
		nuevoTipoContrato : { required: true},
	},

	messages: {
		nuevoMes : "Elija un mes",
		nuevoGestion : "Elija una gestión",
		nuevoTipoContrato : "Elija una tipo de contrato",
	},

});

/*=============================================
GUARDANDO DATOS DE NUEVO RELACION DE NOVEDADES
=============================================*/

$("#frmNuevoRelacion").on("click", ".btnGuardar", function() {

	if ($("#frmNuevoRelacion").valid()) {

		console.log("VALIDADO RELACION");

		var datos = new FormData($("#frmNuevoRelacion")[0]);
		datos.append("nuevoRelacion", 'nuevoRelacion');

		$.ajax({

			url:"ajax/planillas.ajax.php",
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

	  						window.location = "relacion-novedades";

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
CARGANDO DATOS DE PLANILLA AL FORMULARIO EDITAR RELACION DE NOVEDADES
=============================================*/

$(document).on("click", ".btnEditarRelacion", function() {

	console.log("CARGAR RELACION");

	var id_planilla = $(this).attr("idPlanilla");
	console.log("id_planilla", id_planilla);


	var datos = new FormData();
	datos.append("mostrarRelacion", 'mostrarRelacion');
	datos.append("id_planilla", id_planilla);

	$.ajax({

		url: "ajax/planillas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {
			console.log("respuesta", respuesta);

			var value = CKEDITOR.instances.tituloRelacion.setData(respuesta["titulo_relacion"]);

			// $('#editarTituloRelacion').val(respuesta["titulo_relacion"]);
			$('#editarMes').val(respuesta["mes_planilla"]);
			$('#editarGestion').val(respuesta["gestion_planilla"]);
			$('#editarTipoContrato').val(respuesta["nombre_contrato"]);
			$('#editarIdPlanilla').val(respuesta["id_planilla"]);

		},
	    error: function(error){

	      console.log("No funciona");
	        
	    }

	});

});

/*=============================================
//VALIDANDO DATOS DE EDITAR PLANILLA
=============================================*/

$("#frmEditarRelacion").validate({

	rules: {
		editarTituloRelacion : { required: true, patron_textoEspecial: true},
		editarMesPlanilla: { required: true},
		editarGestionPlanilla: { required: true},
		editarTipoContrato: { required: true},
	},

	messages: {
		editarMesPlanilla : "Elija un mes",
		editarGestionPlanilla : "Elija una gestión",
		editarTipoContrato : "Elija una tipo de contrato",
	},

});

/*=============================================
GUARDANDO DATOS DE EDITAR RELACION
=============================================*/

$("#frmEditarRelacion").on("click", ".btnGuardar", function() {

    if ($("#frmEditarRelacion").valid()) {

		var titulo_relacion = CKEDITOR.instances.tituloRelacion.getData();
		console.log("titulo_relacion", titulo_relacion);
		var id_planilla = $("#editarIdPlanilla").val();
		console.log("id_planilla", id_planilla);

		var datos = new FormData();
		datos.append("editarRelacion", 'editarRelacion');

		datos.append("titulo_relacion", titulo_relacion);
		datos.append("id_planilla", id_planilla);

		$.ajax({

			url:"ajax/planillas.ajax.php",
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

	  						$('#modalEditarRelacion').modal('toggle');

							// $("#editarTituloPlanilla").val("");
							$("#editarIdPlanilla").val("");

	  						// Funcion que recarga y actuaiiza la tabla	

							tablaRelacion.ajax.reload( null, false );

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
BOTÓN GENERAR PLANILLA
=============================================*/

$(document).on("click", "button.btnGenerarPlanilla", function() {
	
	var idPlanilla = $(this).attr("idPlanilla");

	window.location = "index.php?ruta=planillas-empleados&idPlanilla="+idPlanilla;

});

/*=============================================
CARGAR LA TABLA DINÁMICA DE PLANILLA EMPLEADOS GENERADA
=============================================*/

var perfilOculto = $("#perfilOculto").val();

var idPlanilla = $("#idPlanilla").val();

var tablaPlanillaEmpleado = $('#tablaGenerarPlanilla').DataTable({

	"ajax": "ajax/datatable-planillas_empleados.ajax.php?perfilOculto="+perfilOculto+"&idPlanilla="+idPlanilla,

	"deferRender": true,

	"retrieve" : true,

	"processing" : true,

	"columnDefs": [
	{
		"targets": 7,
		"className": "text-right",
	},
	{
		"targets": 8,
		"className": "text-center",
	},
	{
		"targets": 9,
		"className": "text-right",
	},
	{
		"targets": 10,
		"className": "text-right",
	},
	{
		"targets": 11,
		"className": "text-right",
	},
	{
		"targets": 12,
		"className": "text-right",
	},
	{
		"targets": 13,
		"className": "text-right",
	}],

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
//GUARDANDO DATOS DE MODAL PARA GENERAR IMPORTES
=============================================*/

$(document).on("click", ".btnGenerarImportes", function() {

	console.log("GENERAR IMPORTES");

	var id_planilla_empleado = $(this).attr("idPlanillaEmpleado");
	console.log("id_planilla_empleado", id_planilla_empleado);

	// var fila = $(this).parent().parent().parent().attr("id", "fila"+id_planilla_empleado);
	// console.log("fila", fila);

	var datos = new FormData();
	datos.append("mostrarPlanillaEmpleado", 'mostrarPlanillaEmpleado');
	datos.append("id_planilla_empleado", id_planilla_empleado);

	$.ajax({

		url: "ajax/planillas_empleados.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {
			console.log("respuesta", respuesta);

			$('#nuevoHaberBasico').val(parseFloat(respuesta["haber_basico"]).toFixed(2));
			$('#nuevoDiasTrab').val(respuesta["dias_trabajados"]);
			$('#nuevoTotalGanado').val(respuesta["total_ganado"]);
			$('#nuevoDescAFP').val(respuesta["desc_afp"]);
			// $('#nuevoDescSolidario').val(respuesta["desc_solidario"]);
			$('#nuevoTotalDesc').val(respuesta["total_desc"]);
			$('#nuevoLiquidoPagable').val(respuesta["liquido_pagable"]);
			$('#idPlanillaEmpleado').val(respuesta["id_planilla_empleado"]);

		},
	    error: function(error){

	      console.log("No funciona");
	        
	    }

	});

}); 

const formatter = new Intl.NumberFormat('de-DE', {
    minimumFractionDigits: 2
})

/*=============================================
SI SE CAMBIAN LOS DIAS TRABAJADOS, SE MODIFICAN LOS IMPORTES EN LA PLANILLA
=============================================*/

$(document).on("change", "#nuevoDiasTrab", function() {

	var dias_trabajados = $(this).val();
	var haber_basico = $("#nuevoHaberBasico").val();

	// Calculando el Total Ganado
	var total_ganado = (haber_basico / 30) * dias_trabajados;
	total_ganado = parseFloat((total_ganado * 100) / 100).toFixed(2);

	$("#nuevoTotalGanado").val(total_ganado);

	// Calculando el Descuento AFP
	var desc_afp = total_ganado * 0.1271;
	desc_afp = parseFloat((desc_afp * 100) / 100).toFixed(2);

	$("#nuevoDescAFP").val(desc_afp);	

	// Calculando el Descuento Solidario
	// var desc_solidario = total_ganado * 0.0050;
	// desc_solidario = parseFloat(Math.round(desc_solidario * 100) / 100).toFixed(2);

	// $("#nuevoDescSolidario").val(desc_solidario);

	// Calculando el Total Descuento
	var total_desc = parseFloat(desc_afp).toFixed(2);	

	$("#nuevoTotalDesc").val(total_desc);

	// Calculando el Líquido Pagable
	var liquido_pagable = total_ganado - total_desc;
	liquido_pagable = parseFloat((liquido_pagable * 100) / 100).toFixed(2);	

	$("#nuevoLiquidoPagable").val(liquido_pagable);

});

/*=============================================
//VALIDANDO DATOS DE EDITAR PLANILLA
=============================================*/

$("#frmAgregarImportes").validate({

	rules: {
		nuevoDiasTrab : { required: true, min: 0, max: 30},
	},

	messages: {
		nuevoDiasTrab : "Los días trabajados no deben ser menor a 0 y mayor a 30 días",
	},

});

/*=============================================
AGREGANDO LOS NUEVOS IMPORTES PARA EL RESPECTIVO EMPLEADO EN LA PLANILLA
=============================================*/

$("#frmAgregarImportes").on("click", ".btnGuardar", function() {

	$('#modalGenerarImportes').modal('toggle');

	if ($("#frmAgregarImportes").valid()) {

		var id_planilla = $('#idPlanilla').val();
		var id_planilla_empleado = $('#idPlanillaEmpleado').val();
		var dias_trabajados = $('#nuevoDiasTrab').val();
		var total_ganado = $('#nuevoTotalGanado').val();
		var desc_afp = $('#nuevoDescAFP').val();
		// var desc_solidario = $('#nuevoDescSolidario').val();
		var total_desc = $('#nuevoTotalDesc').val();
		var liquido_pagable = $('#nuevoLiquidoPagable').val();;

		var datos = new FormData();
		datos.append("agregarImportes", 'agregarImportes');
		datos.append("id_planilla_empleado", id_planilla_empleado);
		datos.append("dias_trabajados", dias_trabajados);
		datos.append("total_ganado", total_ganado);
		datos.append("desc_afp", desc_afp);
		// datos.append("desc_solidario", desc_solidario);
		datos.append("total_desc", total_desc);
		datos.append("liquido_pagable", liquido_pagable);

		$.ajax({

			url:"ajax/planillas_empleados.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "html",
			success: function(respuesta) {
			
				if (respuesta == "ok") {

					swal.fire({
						
						icon: "success",
						title: "¡Los importes se generaron correctamente!",
						showConfirmButton: true,
						allowOutsideClick: false,
						confirmButtonText: "Cerrar"

					}).then((result) => {
	  					
	  					if (result.value) {

	  						// Eliminamos el contenido de la fila
	  						// $("#fila"+id_planilla_empleado).empty();

	  						var datos2 = new FormData();
							datos2.append("mostrarTotalesPlanillaEmpleado", 'mostrarTotalesPlanillaEmpleado');
							datos2.append("id_planilla", id_planilla);

	  						$.ajax({

								url:"ajax/planillas_empleados.ajax.php",
								method: "POST",
								data: datos2,
								cache: false,
								contentType: false,
								processData: false,
								dataType: "json",
								success: function(respuesta) {
									console.log("respuesta", respuesta);
									
									$('#nuevoDiasTrab').val("");
									$('#nuevoTotalGanado').val("");
									$('#nuevoDescAFP').val("");
									$('#nuevoDescSolidario').val("");
									$('#nuevoTotalDesc').val("");
									$('#nuevoLiquidoPagable').val("");
									$('.totalGanadoT').html(formatter.format(respuesta["total_ganado"]));
									$('.descAFPT').html(formatter.format(respuesta["desc_afp"]));
									// $('.descSolidarioT').html(formatter.format(respuesta["desc_solidario"]));
									$('.totalDescT').html(formatter.format(respuesta["total_desc"]));
									$('.liquidoPagableT').html(formatter.format(respuesta["liquido_pagable"]));

									// Funcion que recarga y actuaiiza la tabla	

									tablaPlanillaEmpleado.ajax.reload( null, false );

								},
								error: function(error) {

							        console.log("No funciona2");
							        
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

					});
					
				}

			},
			error: function(error) {

		        console.log("No funciona");
		        
		    }

		});

	}

});

/*=============================================
BOTÓN GENERERAR BOLETA PDF
=============================================*/

$(document).on("click", "button.btnGenerarBoletaEmpleado", function() {
	
	var id_planilla_empleado = $(this).attr("idPlanillaEmpleado");
	console.log("id_planilla_empleado", id_planilla_empleado);

	var datos = new FormData();

	datos.append("boletaEmpleadoPDF", "boletaEmpleadoPDF");
	datos.append("id_planilla_empleado", id_planilla_empleado);
	// datos.append("nombre_usuario", nombre_usuario);

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

		url: "ajax/planillas_empleados.ajax.php",
		type: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta) {
			console.log("respuesta", respuesta);

			//Para cerrar la alerta personalizada de loading
			swal.close();
			
			$('#ver-pdf').modal({
			
				show:true,
				backdrop:'static'
			
			});	
			
			PDFObject.embed("temp/boleta-"+id_planilla_empleado+".pdf", "#view_pdf");

		}

	});

});

/*=============================================
BOTÓN GENERERAR PLANILLA PDF
=============================================*/

$(document).on("click", "a.btnGenerarPlanilla", function() {
	
	var id_planilla = $(this).attr("idPlanilla");
	console.log("id_planilla", id_planilla);

	var datos = new FormData();

	datos.append("generarPlanillaPDF", "generarPlanillaPDF");
	datos.append("id_planilla", id_planilla);
	// datos.append("nombre_usuario", nombre_usuario);

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

		url: "ajax/planillas_empleados.ajax.php",
		type: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta) {
			console.log("respuesta", respuesta);

			//Para cerrar la alerta personalizada de loading
			swal.close();
			
			$('#ver-pdf').modal({
			
				show:true,
				backdrop:'static'
			
			});	
			
			PDFObject.embed("temp/planilla-"+id_planilla+".pdf", "#view_pdf");

		}

	});

});

/*=============================================
BOTON QUE PARA CERRAR LA VENTANA MODAL DEL REPORTE PDF Y ELIMINA EL ARCHIVO TEMPORAL
=============================================*/

$("#ver-pdf").on("click", ".btnCerrarReporte", function() {

	var url = $(this).parent().parent().children(".modal-body").children().children().attr("src");

	var datos = new FormData();

	datos.append("eliminarPDF", "eliminarPDF");
	datos.append("url", url);

	$.ajax({

		url: "ajax/planillas.ajax.php",
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
BOTÓN GENERAR PLANILLA
=============================================*/

$(document).on("click", "button.btnPlanillaImpositiva", function() {
	
	var idPlanilla = $(this).attr("idPlanilla");
	// console.log("idPlanilla", idPlanilla);


	window.location = "index.php?ruta=planillas-rciva-empleados&idPlanilla="+idPlanilla;

});