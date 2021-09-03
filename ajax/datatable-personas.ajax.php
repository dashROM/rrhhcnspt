<?php

require_once "../controladores/personas.controlador.php";
require_once "../modelos/personas.modelo.php";

class TablaPersonas {

	/*=============================================
	MOSTRAR LA TABLA DE PERSONAS
	=============================================*/
		
	public function mostrarTablaPersonas() {

		$item = null;
		$valor1 = null;
		$valor2 = null;

		$personas = ControladorPersonas::ctrMostrarPersonas($item, $valor1, $valor2);

		if ($personas == null) {
			
			$datosJson = '{
				"data": []
			}';

		} else {

			$datosJson = '{
				"data": [';

				for ($i = 0; $i < count($personas); $i++) { 

					$btnEditarPersona = "<button class='btn btn-warning btnEditarPersona' idPersona='".$personas[$i]["id_persona"]."' data-toggle='modal' data-target='#modalEditarPersona' data-toggle='tooltip' title='Editar'><i class='fas fa-pencil-alt'></i></button>";

					$btnMasDetalles = "<button class='btn btn-success btnMasDetallesPersona' idPersona='".$personas[$i]["id_persona"]."' data-toggle='modal' data-target='#modalMasDetalles' data-toggle='tooltip' title='Mas Detalle'><i class='fas fa-plus'></i></button>";

					// VERIFICAMOS SI LA PERSONA TIENE FOTO

					if ($personas[$i]["foto_persona"] != "") {
                              
                    	$foto = "<img src='".$personas[$i]["foto_persona"]."' class='img-thumbnail' width='40px'>";

                    } else {

                    	$foto = "<img src='vistas/img/personas/default/anonymous.png' class='img-thumbnail' width='40px'>";

                    }

					/*=============================================
					VERIFICAMOS EL ESTADO DE LA PERSONA
					=============================================*/

					// if ($personas[$i]["estado_persona"] != 0) {

     //                	$estado = "<button class='btn btn-success btn-xs btnActivar' idPersona='".$personas[$i]["id_persona"]."' estadoPersona='0'>ACTIVO</button>";

     //                } else {

     //                	$estado = "<button class='btn btn-danger btn-xs btnActivar' idPersona='".$personas[$i]["id_persona"]."' estadoPersona='1'>INACTIVO</button>";

     //                }

					/*=============================================
					TRAEMOS LAS ACCIONES
					=============================================*/

					if (isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Especial") {
						
						$botones = "<div class='btn-group'>".$btnEditarPersona."</div>";

					} else {

						$botones = "<div class='btn-group'>".$btnEditarPersona.$btnMasDetalles."</div>";

					}
					
					$datosJson .='[
						"'.($i+1).'",					
						"'.$personas[$i]["nombre_completo"].'",
						"'.$foto.'",
						"'.$personas[$i]["ci_persona"].'",
						"'.date("d/m/Y", strtotime($personas[$i]["fecha_nacimiento"])).'",
						"'.$personas[$i]["sexo_persona"].'",
						"'.$personas[$i]["direccion_persona"].'",
						"'.$personas[$i]["telefono_persona"].'",
						"'.$personas[$i]["email_persona"].'",
						"'.date("d/m/Y (H:i:s)", strtotime($personas[$i]["fecha_registro"])).'",
						"'.$botones.'"
					],';
				}

				$datosJson = substr($datosJson, 0, -1);

			$datosJson .= ']

			}';

		}
		
		echo $datosJson;
	
	}

	/*=============================================
	BUSCAR PERSONAS
	=============================================*/
		
	public function buscarPersonas() {

		$item = null;
		$valor1 = null;
		$valor2 = null;

		$personas = ControladorPersonas::ctrMostrarPersonas($item, $valor1, $valor2);

		if ($personas == null) {
			
			$datosJson = '{
				"data": []
			}';

		} else {

			$datosJson = '{
				"data": [';

				for ($i = 0; $i < count($personas); $i++) { 

					// VERIFICAMOS SI LA PERSONA TIENE FOTO

					if ($personas[$i]["foto_persona"] != "") {
                              
                    	$foto = "<img src='".$personas[$i]["foto_persona"]."' class='img-thumbnail' width='40px'>";

                    } else {

                    	$foto = "<img src='vistas/img/personas/default/anonymous.png' class='img-thumbnail' width='40px'>";

                    }

					/*=============================================
					VERIFICAMOS EL ESTADO DE LA PERSONA
					=============================================*/

					// if ($personas[$i]["estado_persona"] != 0) {

     //                	$estado = "<button class='btn btn-success btn-xs btnActivar' idPersona='".$personas[$i]["id_persona"]."' estadoPersona='0'>ACTIVO</button>";

     //                } else {

     //                	$estado = "<button class='btn btn-danger btn-xs btnActivar' idPersona='".$personas[$i]["id_persona"]."' estadoPersona='1'>INACTIVO</button>";

     //                }

					/*=============================================
					TRAEMOS LAS ACCIONES
					=============================================*/

					// if (isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Especial") {
						
					// 	$botones = "<div class='btn-group'><button class='btn btn-warning btnEditarPersona' idPersona='".$personas[$i]["id_persona"]."' data-toggle='modal' data-target='#modalEditarPersona' data-toggle='tooltip' title='Editar'><i class='fas fa-pencil-alt'></i></button></div>";

					// } else {

					// 	$botones = "<div class='btn-group'><button class='btn btn-warning btnEditarPersona' idPersona='".$personas[$i]["id_persona"]."' data-toggle='modal' data-target='#modalEditarPersona' data-toggle='tooltip' title='Editar'><i class='fas fa-pencil-alt'></i></button></div>";

					// }
					
					$datosJson .='[
						"'.$personas[$i]["id_persona"].'",					
						"'.$personas[$i]["nombre_completo"].'",
						"'.$foto.'",
						"'.$personas[$i]["ci_persona"].'",
						"'.date("d/m/Y", strtotime($personas[$i]["fecha_nacimiento"])).'",
						"'.$personas[$i]["sexo_persona"].'",
						"'.$personas[$i]["direccion_persona"].'",
						"'.$personas[$i]["telefono_persona"].'",
						"'.$personas[$i]["email_persona"].'"
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
ACTIVAR TABLA DE PERSONAS
=============================================*/

if (isset($_POST["buscarPersona"])) {

	$activarPersonas = new TablaPersonas();
	$activarPersonas -> buscarPersonas();

} else {

	$activarPersonas = new TablaPersonas();
	$activarPersonas -> mostrarTablaPersonas();

}


