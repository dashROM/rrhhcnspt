<?php 

class ControladorUsuarios {

	/*=============================================
	INGRESO DE USUARIO
	=============================================*/
	
	static public function ctrIngresoUsuario() {

		if (isset($_POST["ingUsuario"])) {
			
			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])) {

				$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
				
				$tabla = "usuarios";

				$item = "nick_usuario";
				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

				// var_dump($respuesta);

				if ($respuesta["nick_usuario"] == $_POST["ingUsuario"] && $respuesta["password_usuario"] == $encriptar) {

					if ($respuesta["estado_usuario"] == 1) {
						
						$_SESSION["iniciarSesion_rrhh"] = "ok";
						$_SESSION["idusuario_rrhh"] = $respuesta["id_usuario"];
						$_SESSION["nombre_rrhh"] = $respuesta["nombre_usuario"];
						$_SESSION["nick_usuario_rrhh"] = $respuesta["nick_usuario"];
						$_SESSION["foto_rrhh"] = $respuesta["foto_usuario"];
						$_SESSION["perfil_rrhh"] = $respuesta["perfil_usuario"];

						echo '<script>

							window.location = "inicio";

						</script>';

						/*=============================================
						REGISTRAR FECHA PARA SABER EL ULTIMO LOGIN
						=============================================*/	

						// date_default_timezone_set('America/La_Paz');

						// $fecha = date('Y-m-d');
						// $hora = date('H:i:s');

						// $fechaActual = $fecha.' '.$hora;

						// $item1 = "ultimo_login";
						// $valor1 = $fechaActual;

						// $item2 = "id";
						// $valor2 = $respuesta["id"];

						// $ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

						// if ($ultimoLogin == "ok") {
							
						// 	echo '<script>

						// 		window.location = "inicio";

						// 	</script>';
						// }				

					} else {

						echo '<div class="alert alert-danger mt-3">El usuario aún no está activado</div>';

					}					

				}else {

					echo '<div class="alert alert-danger mt-3">Error al ingresar, vuelva a intentarlo</div>';

				}

			}

		}

	}

	/*=============================================
	LISTADO DE USUARIO
	=============================================*/
	
	static public function ctrMostrarUsuarios($item, $valor1, $valor2) {

		$tabla = "usuarios";
		$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor1, $valor2);

		return $respuesta;

	}

	/*=============================================
	CREAR NUEVO USUARIO
	=============================================*/
	
	static public function ctrNuevoUsuario($datos) {
		
		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::mdlNuevoUsuario($tabla, $datos);

		return $respuesta;

	}


	/*=============================================
	EDITAR USUARIO
	=============================================*/
	
	static public function ctrEditarUsuario($datos) {
		
		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

		return $respuesta;

	}

	/*=============================================
	BORRAR USUARIO
	=============================================*/

	// static public function ctrBorrarUsuario() {
		
	// 	if (isset($_GET["idUsuario"])) {
			
	// 		$tabla = "usuarios";
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
