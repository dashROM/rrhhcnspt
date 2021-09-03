<?php

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class TablaUsuarios {

	/*=============================================
	MOSTRAR LA TABLA DE USUARIOS
	=============================================*/
		
	public function mostrarTablaUsuarios() {

		$item = null;
		$valor1 = null;
		$valor2 = null;

		$usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor1, $valor2);

		if ($usuarios == null) {
			
			$datosJson = '{
				"data": []
			}';

		} else {

			$datosJson = '{
				"data": [';

				for ($i = 0; $i < count($usuarios); $i++) { 

					// VERIFICAMOS SI EL USUARIO TIENE FOTO

					if ($usuarios[$i]["foto_usuario"] != "") {
                              
                    	$foto = "<img src='".$usuarios[$i]["foto_usuario"]."' class='img-thumbnail' width='40px'>";

                    } else {

                    	$foto = "<img src='vistas/img/usuarios/default/anonymous.png' class='img-thumbnail' width='40px'>";

                    }

					/*=============================================
					VERIFICAMOS EL ESTADO DEL USUARIO
					=============================================*/

					if ($usuarios[$i]["estado_usuario"] != 0) {

                    	$estado = "<button class='btn btn-success btn-sm btnActivar' idUsuario='".$usuarios[$i]["id_usuario"]."' estadoUsuario='0'>ACTIVO</button>";

                    } else {

                    	$estado = "<button class='btn btn-danger btn-sm btnActivar' idUsuario='".$usuarios[$i]["id_usuario"]."' estadoUsuario='1'>INACTIVO</button>";

                    }

					/*=============================================
					TRAEMOS LAS ACCIONES
					=============================================*/

					if (isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Especial") {
						
						$botones = "<div class='btn-group'><button class='btn btn-warning btnEditarUsuario' idUsuario='".$usuarios[$i]["id_usuario"]."' data-toggle='modal' data-target='#modalEditarUsuario' data-toggle='tooltip' title='Editar'><i class='fas fa-pencil-alt'></i></button></div>";

					} else {

						$botones = "<div class='btn-group'><button class='btn btn-warning btnEditarUsuario' idUsuario='".$usuarios[$i]["id_usuario"]."' data-toggle='modal' data-target='#modalEditarUsuario' data-toggle='tooltip' title='Editar'><i class='fas fa-pencil-alt'></i></button></div>";

					}
					
					$datosJson .='[
						"'.($i+1).'",					
						"'.$usuarios[$i]["nombre_completo"].'",
						"'.$usuarios[$i]["nick_usuario"].'",
						"'.$foto.'",
						"'.$usuarios[$i]["ci_usuario"].'",
						"'.$usuarios[$i]["telefono_usuario"].'",
						"'.$usuarios[$i]["email_usuario"].'",
						"'.$usuarios[$i]["perfil_usuario"].'",
						"'.$estado.'",
						"'.date("d/m/Y (H:i:s)", strtotime($usuarios[$i]["fecha_registro"])).'",
						"'.$botones.'"
					],';
				}

				$datosJson = substr($datosJson, 0, -1);

			$datosJson .= ']

			}';

		}
		
		echo $datosJson;
	
	}

}

/*=============================================
ACTIVAR TABLA DE USUARIOS
=============================================*/

$activarUsuarios = new TablaUsuarios();
$activarUsuarios -> mostrarTablaUsuarios();