/*=============================================
CARGAR LA TABLA DINÁMICA DE USUARIOS
=============================================*/

var perfilOculto = $("#perfilOculto").val();

var tablaUsuarios = $('#tablaUsuarios').DataTable({

	"ajax": "ajax/datatable-usuarios.ajax.php?perfilOculto="+perfilOculto,

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
SUBIENDO LA FOTO DEL USUARIO
=============================================*/
$(".nuevoFotoUsuario").change(function() {
 	
 	var imagen = this.files[0];

	console.log("PRESIONADO");

 	/*=============================================
	SUBIENDO LA FOTO DEL USUARIO
	=============================================*/

	if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {

		$(".nuevaFotoUsuario").val("");

		swal.fire({
			
			title: "Error al subir la imagen",
			text: "La imagen debe estar en formato JPG o PNG",
			icon: "error",
			allowOutsideClick: false,
			confirmButtonText: "¡Cerrar!"

		});

	} else if(imagen["size"] > 2000000) {

		$(".nuevaFotoUsuario").val("");

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
VALIDANDO DATOS DE NUEVO USUARIO
=============================================*/
$("#frmNuevoUsuario").validate({

  	rules: {
  		nuevoPaternoUsuario : { patron_texto: true},
		nuevoMaternoUsuario: { patron_texto: true},
		nuevoNombreUsuario: { required: true, patron_texto: true},
		nuevoNickUsuario : { required: true, patron_numerosLetras: true},
		nuevoPassword : { required: true},
   		nuevoCIUsuario: { required: true},
   		nuevoExtCIUsuario : { required: true},
   		nuevoTelefonoUsuario : { patron_numeros: true},
   		nuevoEmailUsuario : { patron_textoEspecial: true},   		
   		nuevoPerfilUsuario : { required: true},   
  	},

  	messages: {
		nuevoExtCIUsuario : "Elija una extensión",
		nuevoPerfilUsuario : "Elija un tipo de usuario",
	},

});

/*=============================================
GUARDANDO DATOS DE NUEVO USUARIO
=============================================*/

$("#frmNuevoUsuario").on("click", ".btnGuardar", function() {

    if ($("#frmNuevoUsuario").valid()) {

    	// console.log("VALIDADO USUARIO");

		var datos = new FormData($("#frmNuevoUsuario")[0]);
		datos.append("nuevoUsuario", 'nuevoUsuario');
	
		$.ajax({

			url:"ajax/usuarios.ajax.php",
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

	  						window.location = "usuarios";

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
RESETEAR LA CARGAR FOTO POR DEFENCTO 
=============================================*/

$(document).on("click", ".btnAgregarUsuario", function() {

	$(".previsualizar").attr("src", "vistas/img/usuarios/default/anonymous.png");

});



/*=============================================
CARGANDO DATOS DE USUARIO AL FORMULARIO EDITAR USUARIO
=============================================*/

$(document).on("click", ".btnEditarUsuario", function() {

	console.log("CARGAR USUARIO");

	var id_usuario = $(this).attr("idUsuario");
	console.log("id_usuario", id_usuario);


	var datos = new FormData();
	datos.append("mostrarUsuario", 'mostrarUsuario');
	datos.append("id_usuario", id_usuario);

	$.ajax({

		url: "ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {
			console.log("respuesta", respuesta);

			$('#editarIdUsuario').val(respuesta["id_usuario"]);
			$('#editarPaternoUsuario').val(respuesta["paterno_usuario"]);
			$('#editarMaternoUsuario').val(respuesta["materno_usuario"]);
			$('#editarNombreUsuario').val(respuesta["nombre_usuario"]);
			$('#editarNickUsuario').val(respuesta["nick_usuario"]);
			$('#editarCIUsuario').val(respuesta["ci_usuario"]);
			$('#editarExtCIUsuario').val(respuesta["ext_ci_usuario"]).selectpicker('refresh');
			$('#editarTelefonoUsuario').val(respuesta["telefono_usuario"]);
			$('#editarEmailUsuario').val(respuesta["email_usuario"]);

			$("#editarPerfilUsuario").val(respuesta["perfil_usuario"]).selectpicker('refresh');

			$("#fotoActualUsuario").val(respuesta["foto_usuario"]);
			$("#passwordActual").val(respuesta["password_usuario"]);			

			if (respuesta["foto_usuario"] != "") {

				$(".previsualizar").attr("src", respuesta["foto_usuario"]);

			} else {

				$(".previsualizar").attr("src", "vistas/img/usuarios/default/anonymous.png");

			}

		},
	    error: function(error){

	      console.log("No funciona");
	        
	    }

	});

});

/*=============================================
VALIDANDO DATOS DE EDITAR USUARIO
=============================================*/
$("#frmEditarUsuario").validate({

  	rules: {
  		editarPaternoUsuario : { patron_texto: true},
		editarMaternoUsuario: { patron_texto: true},
		editarNombreUsuario: { required: true, patron_texto: true},
		editarNickUsuario : { required: true, patron_numerosLetras: true},
   		editarCIUsuario: { required: true},
   		editarExtCIUsuario : { required: true},
   		editarTelefonoUsuario : { patron_numeros: true},
   		editarEmailUsuario : { patron_textoEspecial: true},   		
   		editarPerfilUsuario : { required: true},   
  	},

  	messages: {
		editarExtCIUsuario : "Elija una extensión",
		editarCargoEmpleado : "Elija un tipo de usuario",
	},

});

/*=============================================
GUARDANDO DATOS DE EDITAR USUARIO
=============================================*/

$("#frmEditarUsuario").on("click", ".btnGuardar", function() {

    if ($("#frmEditarUsuario").valid()) {

    	var datos = new FormData($("#frmEditarUsuario")[0]);
		datos.append("editarUsuario", 'editarUsuario');

		$.ajax({

			url:"ajax/usuarios.ajax.php",
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

	  						$('#modalEditarUsuario').modal('toggle');

							$("#editarPaternoUsuario").val("");	
							$("#editarMaternoUsuario").val("");
							$("#editarNombreUsuario").val("");	
							$("#editarNickUsuario").val("");
							$("#editarPassword").val("");	
							$("#editarCIEmpleado").val("");
							$("#editarExtCIEmpleado").val("");
							$("#editarTelefonoUsuario").val("");
							$("#editarEmailUsuario").val("");
							$("#editarPerfilUsuario").val("");
							$("#editarFotoUsuario").val("");
							$("#editarIdEmpleado").val("");

	  						// Funcion que recarga y actuaiiza la tabla	

							tablaUsuarios.ajax.reload( null, false );

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
ACTIVAR USUARIO
=============================================*/

$(document).on("click", ".btnActivar", function() {
	
	var idUsuario = $(this).attr("idUsuario");
	var estadoUsuario = $(this).attr("estadoUsuario");

	var datos = new FormData();
	datos.append("activarId", idUsuario);
	datos.append("activarUsuario", estadoUsuario);

	$.ajax({

		url: "ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta) {
			
			if (window.matchMedia("(max-width:767px)").matches) {

				swal.fire({
					
					title: "El usuario ha sido actualizado",
					icon: "success",
					allowOutsideClick: false,
					confirmButtonText: "¡Cerrar!"

				}).then(function(result) {

					if (result.value) {

						window.location = "usuarios";
					}

				});

			} else {

				swal.fire({
					
					title: "El usuario ha sido actualizado",
					icon: "success",
					allowOutsideClick: false,
					confirmButtonText: "¡Cerrar!"

				});

			}

		}

	});

	if (estadoUsuario == 0) {

		$(this).removeClass('btn-success');
		$(this).addClass('btn-danger');
		$(this).html('INACTIVO');
		$(this).attr('estadoUsuario', 1);

	} else {

		$(this).addClass('btn-success');
		$(this).removeClass('btn-danger');
		$(this).html('ACTIVO');
		$(this).attr('estadoUsuario', 0);

	}

});

/*=============================================
REVISAR SI EL NICK USUARIO YA ESTÁ REGISTRADO
=============================================*/

$("#nuevoNickUsuario").change(function() {

	$(".invalid-feedback").remove();
	
	$(this).removeClass('is-invalid');
	$(this).addClass('is-valid');
	
	var usuario = $(this).val();

	var datos = new FormData();
	datos.append("validarUsuario", usuario);

	$.ajax({
		url: "ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {

			if (respuesta) {

				// $("#nuevoNickUsuario").parent().after('<div class="alert alert-danger" style="display: none;">Este usuario ya existe en la base de datos</div>');
				$("#nuevoNickUsuario").after('<div class="invalid-feedback" style="display: none;">Este usuario ya existe en la base de datos</div>');				

				$("#nuevoNickUsuario").addClass('is-invalid');
				
				$(".invalid-feedback").show('fast');

				$("#nuevoNickUsuario").val('');

				$("#nuevoNickUsuario").after().removeClass('mb-3');

			} 

		}

	});

});

/*=============================================
ELIMINAR USUARIO
=============================================*/

$(document).on("click", ".btnEliminarUsuario", function() {
	
	var idUsuario = $(this).attr("idUsuario");
	var fotoUsuario = $(this).attr("fotoUsuario");
	var nickUsuario = $(this).attr("nickUsuario");

	swal.fire({

		title: '¿Está seguro de borrar el usuario?',
		text: '¡Si no lo esta puede cancelar la acción!',
		icon: 'warning',
		showCancelButton: true,
		allowOutsideClick: false,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar usuario!'

	}).then((result)=>{

		if (result.value) {

			window.location = "index.php?ruta=usuarios&idUsuario="+idUsuario+"&nickUsuario="+nickUsuario+"&fotoUsuario="+fotoUsuario;

		}

	});

});