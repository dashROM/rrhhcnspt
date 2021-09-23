<?php

require_once "../controladores/planillas.controlador.php";
require_once "../modelos/planillas.modelo.php";

class TablaGenerarPlanilla {

	public $id_planilla;

	/*=============================================
	MOSTRAR LA TABLA DE RELACION DE NOVEDADES
	=============================================*/
		
	public function mostrarTablaGenerarRelacion() {

		$item = "id_planilla";
		$valor1 = $this->id_planilla;
		$valor2 = null;

		$datos_planilla = ControladorPlanillas::ctrMostrarGenerarRelacion($item, $valor1, $valor2);

		if ($datos_planilla == null) {
			
			$datosJson = '{
				"data": []
			}';

		} else {

			$datosJson = '{
				"data": [';

				for ($i = 0; $i < count($datos_planilla); $i++) { 

					/*=============================================
					TRAEMOS LAS ACCIONES
					=============================================*/

					if (isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Especial") {
						
						$botones = "";

					} else {

						$botones = "<div class='btn-group'><button class='btn btn-primary btnAgregarDiasTrabajados' idPlanillaPersona='".$datos_planilla[$i]["id_planilla_persona_contrato"]."' data-toggle='modal' data-target='#modalAgregarDiasTrabajados' data-toggle='tooltip' title='Generar Importes'><i class='far fa-money-bill-alt'></i></button>";

					}
					
					$datosJson .='[	
						"'.($i+1).'",				
						"'.$datos_planilla[$i]["abrev_establecimiento"].'",
						"'.$datos_planilla[$i]["paterno_persona"].'",
						"'.$datos_planilla[$i]["materno_persona"].'",
						"'.$datos_planilla[$i]["nombre_persona"].'",
						"'.$datos_planilla[$i]["ci_persona"].'",
						"'.$datos_planilla[$i]["nombre_cargo"].'",
						"'.$datos_planilla[$i]["inicio_contrato"].'",
						"'.$datos_planilla[$i]["fin_contrato"].'",
						"'.number_format($datos_planilla[$i]["haber_basico"], 2, ",", ".").'",
						"'.$datos_planilla[$i]["dias_trabajados"].'",
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
ACTIVAR TABLA DE PLANILLA GENERADA
=============================================*/

if (isset($_POST["action"])) { 

	if ($_POST["action"] == "relacion") {

		/*=============================================
		ACTIVAR TABLA DE RELACION DE NOVEDADES GENERADA
		=============================================*/

		$activarRelacion = new TablaGenerarPlanilla();
		$activarRelacion -> perfil = $_POST["perfilOculto"];
		$activarRelacion -> id_planilla = $_POST["id_planilla"];
		$activarRelacion -> mostrarTablaGenerarRelacion();

	} else if ($_POST["action"] == "planilla") {

		/*=============================================
		ACTIVAR TABLA DE PLANILLA GENERADA
		=============================================*/

		$activarFichas = new TablaPlanillas();
		$activarFichas -> perfil = $_POST["perfilOculto"];
		$activarFichas -> mostrarTablaGenerarPlanillas();

	}

}