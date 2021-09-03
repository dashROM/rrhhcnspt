<?php 

class ControladorPersonas {

	/*=============================================
	LISTADO DE PERSONAS
	=============================================*/
	
	static public function ctrMostrarPersonas($item, $valor1, $valor2) {

		$tabla = "personas";
		$respuesta = ModeloPersonas::mdlMostrarPersonas($tabla, $item, $valor1, $valor2);

		return $respuesta;

	}

	/*=============================================
	CREAR NUEVO USUARIO
	=============================================*/
	
	static public function ctrNuevoPersona($datos) {
		
		$tabla = "personas";

		$respuesta = ModeloPersonas::mdlNuevoPersona($tabla, $datos);

		return $respuesta;

	}


	/*=============================================
	EDITAR PERSONA
	=============================================*/
	
	static public function ctrEditarPersona($datos) {
		
		$tabla = "personas";

		$respuesta = ModeloPersonas::mdlEditarPersona($tabla, $datos);

		return $respuesta;

	}

	/*=============================================
	BORRAR USUARIO
	=============================================*/

	// static public function ctrBorrarUsuario() {
		
	// 	if (isset($_GET["idUsuario"])) {
			
	// 		$tabla = "personas";
	// 		$datos = $_GET["idUsuario"];

	// 		if ($_GET["fotoUsuario"] != "") {
				
	// 			unlink($_GET["fotoUsuario"]);
	// 			rmdir('vistas/img/usuarios/'.$_GET["nickUsuario"]);

	// 		}

	// 		$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

	// 		if ($respuesta == "ok") {
					
	// 			echo '<script>		

	// 				swal.fire({
						
	// 					icon: "success",
	// 					title: "¡El usuario ha sido borrado correctamente!",
	// 					showConfirmButton: true,
	// 					allowOutsideClick: false,
	// 					confirmButtonText: "Cerrar",
	// 					closeOnConfirm: false

	// 				}).then((result) => {
	  					
	//   					if (result.value) {

	// 						window.location = "usuarios";

	// 					}
	// 				});

	// 			</script>';

	// 		}

	// 	}

	// }	
	
}
