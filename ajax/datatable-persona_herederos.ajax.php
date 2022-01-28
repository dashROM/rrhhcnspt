<?php

require_once "../controladores/persona_herederos.controlador.php";
require_once "../modelos/persona_herederos.modelo.php";

class TablaPersonaHerederos {

	public $id_persona;

	/*=============================================
	MOSTRAR LA TABLA DE PERSONAS
	=============================================*/
		
	public function mostrarTablaPersonaHerederos() {

		$item = "id_persona";
		$valor1 = $this->id_persona;
		$valor2 = null;

		$persona_herederos = ControladorPersonaHerederos::ctrMostrarPersonaHerederos($item, $valor1, $valor2);

		if ($persona_herederos == null) {
			
			$datosJson = '{
				"data": []
			}';

		} else {

			$datosJson = '{
				"data": [';

				for ($i = 0; $i < count($persona_herederos); $i++) { 

					$btnEditarPersonaHeredero = "<button class='btn btn-warning btnEditarPersonaHeredero' idPersonaHeredero='".$persona_herederos[$i]["id_persona_heredero"]."' data-toggle='modal' data-target='#modalEditarPersonaHeredero' data-toggle='tooltip' title='Editar'><i class='fas fa-pencil-alt'></i></button>";

					$btnEliminarPersonaHeredero = "<button class='btn btn-danger btnMasDetallesPersona' idPersona='".$persona_herederos[$i]["id_persona_heredero"]."' data-toggle='modal' data-target='#modalEliminarPersonaHeredero' data-toggle='tooltip' title='Eliminar'><i class='fas fa-trash-alt'></i></button>";

					/*=============================================
					TRAEMOS LAS ACCIONES
					=============================================*/

					if (isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Especial") {
						
						$botones = "<div class='btn-group'>".$btnEditarPersona."</div>";

					} else {

						$botones = "<div class='btn-group'>".$btnEditarPersonaHeredero.$btnEliminarPersonaHeredero."</div>";

					}

					/*=============================================
					CALCULAMOS LA EDAD DE LA PERSONA
					=============================================*/

					$fecha_nacimiento = new DateTime($persona_herederos[$i]["fecha_nacimiento"]);
					$hoy = new DateTime();
					$edad = $hoy->diff($fecha_nacimiento);
					
					$datosJson .='[
						"'.($i+1).'",					
						"'.$persona_herederos[$i]["nombre_completo"].'",
						"'.$edad->y.'",
						"'.$persona_herederos[$i]["parentezco"].'",
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
ACTIVAR TABLA DE PERSONA HEREDEROS
=============================================*/

$activarPersonaHerederos = new TablaPersonaHerederos();
$activarPersonaHerederos -> id_persona = $_POST["idPersona"];
$activarPersonaHerederos -> mostrarTablaPersonaHerederos();