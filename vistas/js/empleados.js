/*=============================================
CARGAR LA TABLA DINÁMICA DE EMPLEADOS
=============================================*/

var perfilOculto = $("#perfilOculto").val();

var tablaEmpleado = $('#tablaEmpleados').DataTable({

	"ajax": "ajax/datatable-empleados.ajax.php?perfilOculto="+perfilOculto,

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
VALIDANDO DATOS DE NUEVO EMPLEADO
=============================================*/
$("#frmNuevoEmpleado").validate({

  	rules: {
  		nuevoEstablecimiento : { required: true},
		nuevoBuscarPersona : { required: true},
   		nuevoCargoEmpleado : { required: true},
   		nuevoFechaInicio : { required: true},
   		nuevoDiasContrato : {required: true},
   		nuevoFechaFin : { required: true},
   		nuevoTipoContrato : { required: true},   		
   		nuevoObservacionesEmpleado : { patron_textoEspecial: true},   
  	},

  	messages: {
		nuevoEstablecimiento : "Elija un establecimiento",
		nuevoBuscarPersona: "Elija una persona",
		nuevoCargoEmpleado : "Elija un cargo",
		nuevoTipoContrato : "Elija una tipo de contrato",
	},

});

/*=============================================
GUARDANDO DATOS DE NUEVO EMPLEADO
=============================================*/

$("#frmNuevoEmpleado").on("click", ".btnGuardar", function() {

    if ($("#frmNuevoEmpleado").valid()) {

    	// console.log("VALIDADO EMPLEADO");

    	var datos = new FormData($("#frmNuevoEmpleado")[0]);
		datos.append("nuevoEmpleado", 'nuevoEmpleado');

		$.ajax({

			url:"ajax/empleados.ajax.php",
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

	  						window.location = "empleados";

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
CARGANDO DATOS DE EMPLEADO AL FORMULARIO EDITAR EMPLEADO
=============================================*/

$(document).on("click", ".btnEditarEmpleado", function() {

	// console.log("CARGAR EMPLEADO");

	var id_empleado = $(this).attr("idEmpleado");

	var datos = new FormData();
	datos.append("mostrarEmpleado", 'mostrarEmpleado');
	datos.append("id_empleado", id_empleado);

	$.ajax({

		url: "ajax/empleados.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {
			console.log("respuesta", respuesta);

			console.log("id_establecimiento", respuesta["id_establecimiento"]);

			console.log("nombre_establecimiento", respuesta["nombre_establecimiento"]);

			// cargando datos de establecimientos
			$("#editarEstablecimiento").empty().append('<option value="'+respuesta["id_establecimiento"]+'" select>'+respuesta["nombre_establecimiento"]+'</option>')
			
			var datos2 = new FormData();
			datos2.append("buscadorEstablecimientos", 'buscadorEstablecimientos');
			datos2.append("id_establecimiento", respuesta["id_establecimiento"]);

			$.ajax({

				url: "ajax/establecimientos.ajax.php",
				method: "POST",
				data: datos2,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta) {

					$.each(respuesta, function(index, val) {
						
						$("#editarEstablecimiento").append('<option value="'+val.id_establecimiento+'">'+val.nombre_establecimiento+'</option>')

					});

				},
				error: function(error){

		      		console.log("No funciona");
		        
		    	}

			});

			// cargando datos de personas
			$('#editarBuscarPersona').empty().prepend("<option value='"+respuesta["id_persona"]+"' >"+respuesta["nombre_completo"]+"</option>");
			$('#editarCIEmpleado').val(respuesta["ci_persona"]);
			$('#editarFechaNacimientoEmpleado').val(respuesta["fecha_nacimiento"]);
			
			
			// cargando datos de cargos
			$("#editarCargoEmpleado").empty().append('<option value="'+respuesta["id_cargo"]+'">'+respuesta["nombre_cargo"]+'</option>')

			var datos3 = new FormData();
			datos3.append("buscadorCargos", 'buscadorCargos');
			datos3.append("id_cargo", respuesta["id_cargo"]);

			$.ajax({

				url: "ajax/cargos.ajax.php",
				method: "POST",
				data: datos3,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta) {

					$.each(respuesta, function(index, val) {
						
						$("#editarCargoEmpleado").append('<option value="'+val.id_cargo+'">'+val.nombre_cargo+'</option>')

					});

				},
				error: function(error){

		      		console.log("No funciona");
		        
		    	}

			});

			$('#editarFechaInicio').val(respuesta["fecha_inicio_contrato"]);
			$('#editarFechaFin').val(respuesta["fecha_fin_contrato"]);
			$('#editarDiasContrato').val(respuesta["dias_contrato"]);

			// cargando datos de contratos 
			$("#editarTipoContrato").empty().append('<option value="'+respuesta["id_contrato"]+'">'+respuesta["nombre_contrato"]+'</option>')

			var datos4 = new FormData();
			datos4.append("buscadorContratos", 'buscadorContratos');
			datos4.append("id_contrato", respuesta["id_contrato"]);

			$.ajax({

				url: "ajax/contratos.ajax.php",
				method: "POST",
				data: datos4,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta) {

					$.each(respuesta, function(index, val) {
						
						$("#editarTipoContrato").append('<option value="'+val.id_contrato+'">'+val.nombre_contrato+'</option>')

					});

				},
				error: function(error){

		      		console.log("No funciona");
		        
		    	}

			});

			$('#editarObservacionesEmpleado').val(respuesta["observaciones"]);
			$('#editarIdEmpleado').val(respuesta["id_empleado"]);

		},
	    error: function(error){

	      console.log("No funciona");
	        
	    }

	});

});

/*=============================================
VALIDANDO DATOS DE EDITAR EMPLEADO
=============================================*/
$("#frmEditarEmpleado").validate({

  	rules: {
  		editarEstablecimiento : { required: true},
		editarBuscarPersona : { required: true},
   		editarCargoEmpleado : { required: true},
   		editarFechaInicio : { required: true},
   		editarFechaFin : { required: true},
   		editarDiasContrato : { required: true}, 
   		editarTipoContrato : { required: true},   		
   		editarObservacionesEmpleado : { patron_textoEspecial: true},   
  	},

  	messages: {
		editarEstablecimiento : "Elija un establecimiento",
		editarCargoEmpleado : "Elija un cargo",
		editarTipoContrato : "Elija una tipo de contrato",
	},

});

/*=============================================
GUARDANDO DATOS DE EDITAR EMPLEADO
=============================================*/

$("#frmEditarEmpleado").on("click", ".btnGuardar", function() {

    if ($("#frmEditarEmpleado").valid()) {

		var datos = new FormData($("#frmEditarEmpleado")[0]);
		datos.append("editarEmpleado", 'editarEmpleado');

		console.log("datos", datos);

		$.ajax({

			url:"ajax/empleados.ajax.php",
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

	  						$('#modalEditarEmpleado').modal('toggle');

	  						// $("#editarEstablecimiento").remove();
							$("#editarBuscarPersona").val("");		
							$("#editarCIEmpleado").val("");
							$("#editarFechaNacimientoEmpleado").val("");
							// $("#editarCargoEmpleado").remove();
							$("#editarFechaInicio").val("");
							$("#editarFechaFin").val("");
							$("#editarDiasContrato").val("");
							// $("#editarTipoContrato").remove();
							$("#editarObservacionesEmpleado").val("");
							// $("#editarIdEmpleado").val("");

	  						// Funcion que recarga y actuaiiza la tabla	

							tablaEmpleado.ajax.reload( null, false );

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
BORRAR LOS MENSAJES DE ERROR EN VENTANA MODAL
=============================================*/ 

$(document).on("click", ".btnCerrar", function() {

	$(".invalid-feedback").remove();

	//Para la ventana modal de agregar
	$("#nuevoDocumentoCI").removeClass("is-invalid");
	$("#nuevoDocumentoCI").removeClass("is-valid");

	//Para la ventana modal de editar
	$("#editarDocumentoCI").removeClass("is-invalid");
	$("#editarDocumentoCI").removeClass("is-valid");

});


/*=============================================
ELIMINAR CLIENTE
=============================================*/

$(document).on("click", ".btnEliminarCliente", function() {

	var idCliente = $(this).attr("idCliente");
	
	swal.fire({
							
		title: "¿Esta seguro de borrar el cliente?",
		text: "¡Si no lo está puede cancelar la acción!",
		icon: "warning",
		showCancelButton: true,
		allowOutsideClick: false,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		cancelButtonText: "Cancelar",
		confirmButtonText: "¡Si, borrar cliente!"		

	}).then((result) => {
			
			if (result.value) {

			window.location = "index.php?ruta=clientes&idCliente="+idCliente;

		}
	});

})

/*=============================================
BUSQUEDA DE PERSONA A PARTIR DEL NOMBRE O CI POR EL BOTON BUSCAR
=============================================*/

$(document).on("click", "#nuevoBuscarPersona, #editarBuscarPersona", function() {

	var buscarPersona = 'buscarPersona';

	var accion = $(this).attr('name');

	console.log("accion", accion);

    var buscarTablaPersonas = $('#buscarTablaPersonas').DataTable({

    	'ajax': {
	    	'url': 'ajax/datatable-personas.ajax.php',
	        'data': { 'buscarPersona' : buscarPersona, 'accion' : accion },
	        'type': 'post'
	    },

		// "ajax": "ajax/datatable-personas.ajax.php",

		'createdRow': function( row, data, dataIndex ) {
      		$(row).attr('id', data[0]);
      		$(row).attr('accion', accion);
  		},

		"deferRender": true,

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

		"lengthChange": false,

		"searching": true,

		"ordering": true, 
		
		"info": true,

		"destroy": true,

	});      			
		

});

/*=============================================
SELECCIÓN DE PERSONA Y TRASPASO AL FORMULARIO NUEVO EMPLEADO
=============================================*/

$(document).on("click", "#buscarTablaPersonas tr", function() {

	$(".invalid-feedback").remove();
	
	$(this).removeClass('is-invalid');
	$(this).addClass('is-valid');

	var id_persona = $(this).attr("id");
	console.log("id_persona", id_persona);
	var accion = $(this).attr("accion");

	var datos = new FormData();
	datos.append("mostrarPersona", "mostrarPersona");
	datos.append("id_persona", id_persona);
	datos.append("accion", accion);

	$.ajax({

		url:"ajax/personas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta) {

			// toastr.success('El Dato se guardó correctamente.')

			var id_persona = respuesta["id_persona"];
			var nombre_persona = respuesta["nombre_persona"];
			var paterno_persona = respuesta["paterno_persona"];
			var materno_persona = respuesta["materno_persona"];
			var ci_persona = respuesta["ci_persona"];
			var fecha_nacimiento = respuesta["fecha_nacimiento"];

			if (accion == 'nuevoBuscarPersona') {

				/*=============================================
				REVISAR SI EL EMPLEADO YA ESTÁ REGISTRADO Y ASIGNADO
				=============================================*/
				var datos2 = new FormData();
				datos2.append("validarEmpleado", respuesta["id_persona"]);

				$.ajax({
					url: "ajax/empleados.ajax.php",
					method: "POST",
					data: datos2,
					cache: false,
					contentType: false,
					processData: false,
					dataType: "json",
					success: function(respuesta) {

						if (respuesta) {

							$("#nuevoBuscarPersona").parent().after('<div class="invalid-feedback" style="display: none;">Este Persona ya se encuentra registrado como empleado</div>');				

							$("#nuevoBuscarPersona").addClass('is-invalid');
							
							$(".invalid-feedback").show('fast');

							$("#nuevoBuscarPersona").val('');

							$("#nuevoBuscarPersona").parent().after().removeClass('mb-3');

						} 

					}

				});

				$('#nuevoBuscarPersona').empty().prepend("<option value='"+id_persona+"'>"+nombre_persona+" "+paterno_persona+" "+materno_persona+"</option>");
				$('#nuevoCIEmpleado').val(ci_persona);
				$('#nuevoFechaNacimientoEmpleado').val(fecha_nacimiento);		

			} else {

				/*=============================================
				REVISAR SI EL EMPLEADO YA ESTÁ REGISTRADO EN MODIFICAR
				=============================================*/
		
				var datos2 = new FormData();
				datos2.append("validarEmpleado", respuesta["id_persona"]);
				datos2.append("validarId", $("#editarIdEmpleado").val());

				$.ajax({
					url: "ajax/empleados.ajax.php",
					method: "POST",
					data: datos2,
					cache: false,
					contentType: false,
					processData: false,
					dataType: "json",
					success: function(respuesta) {

						if (respuesta) {

							$("#editarBuscarPersona").parent().after('<div class="invalid-feedback" style="display: none;">Este Persona ya se encuentra registrado como empleado</div>');				

							$("#editarBuscarPersona").addClass('is-invalid');
							
							$(".invalid-feedback").show('fast');

							$("#editarBuscarPersona").val('');

							$("#editarBuscarPersona").parent().after().removeClass('mb-3');

						} 

					}

				});

				$('#editarBuscarPersona').empty().prepend("<option value='"+id_persona+"'>"+nombre_persona+" "+paterno_persona+" "+materno_persona+"</option>");
				$('#editarCIEmpleado').val(ci_persona);
				$('#editarFechaNacimientoEmpleado').val(fecha_nacimiento);

			}	
			
			$('#modalBuscarPersona').modal('toggle');

		},
		error: function(error) {

	        // toastr.warning('¡Error! Falla en la consulta a BD, no se modificaron.')
	        
	    }

	});

});

/*=============================================
ACTIVAR EMPLEADO
=============================================*/

$(document).on("click", ".btnActivarEmpleado", function() {
	
	var idEmpleado = $(this).attr("idEmpleado");
	var estadoEmpleado = $(this).attr("estadoEmpleado");

	var datos = new FormData();
	datos.append("activarId", idEmpleado);
	datos.append("activarEmpleado", estadoEmpleado);

	$.ajax({

		url: "ajax/empleados.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta) {
			
			if (window.matchMedia("(max-width:767px)").matches) {

				swal.fire({
					
					title: "El empleado ha sido actualizado",
					icon: "success",
					allowOutsideClick: false,
					confirmButtonText: "¡Cerrar!"

				}).then(function(result) {

					if (result.value) {

						window.location = "empleados";
					}

				});

			} else {

				swal.fire({
					
					title: "El empleado ha sido actualizado",
					icon: "success",
					allowOutsideClick: false,
					confirmButtonText: "¡Cerrar!"

				});

			}

		}

	});

	if (estadoEmpleado == 0) {

		$(this).removeClass('btn-success');
		$(this).addClass('btn-danger');
		$(this).html('INACTIVO');
		$(this).attr('estadoEmpleado', 1);

	} else {

		$(this).addClass('btn-success');
		$(this).removeClass('btn-danger');
		$(this).html('ACTIVO');
		$(this).attr('estadoEmpleado', 0);

	}

});

/*=============================================
ACTIVAR EMPLEADO
=============================================*/

$(document).on("change", "#nuevoDiasContrato", function() {
	
	var fechaInicio = new Date($("#nuevoFechaInicio").val());
	
	var diasContrato = $(this).val();

	var fechaFin = sumarDiasFecha(fechaInicio, diasContrato);

	$("#nuevoFechaFin").val(fechaFin);


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