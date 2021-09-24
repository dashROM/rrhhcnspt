<?php

require_once "../controladores/planillas.controlador.php";
require_once "../modelos/planillas.modelo.php";

class TablaPlanillaPersonas {

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
						"'.$datos_planilla[$i]["haber_basico"].'",
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

		/*=============================================
	MOSTRAR LA TABLA DE PLANILLA GENERADA
	=============================================*/
		
	public function mostrarTablaGenerarPlanillas() {
		
		$item = "id_planilla";
		$valor1 = $this->id_planilla;
		$valor2 = null;

		$datos_planilla = ControladorPlanillas::ctrMostrarGenerarPlanilla($item, $valor1, $valor2);

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
						
						$botones = "<div class='btn-group'><button class='btn btn-primary btnGenerarImportes' idPlanillaEmpleado='".$datos_planilla[$i]["id_planilla_persona_contrato"]."' data-toggle='modal' data-target='#modalGenerarImportes' data-toggle='tooltip' title='Generar Importes'><i class='far fa-money-bill-alt'></i></button></div>";

					} else {

						$botones = "<div class='btn-group'><button class='btn btn-primary btnGenerarImportes' idPlanillaEmpleado='".$datos_planilla[$i]["id_planilla_persona_contrato"]."' data-toggle='modal' data-target='#modalGenerarImportes' data-toggle='tooltip' title='Generar Importes'><i class='far fa-money-bill-alt'></i></button><button class='btn btn-info btnGenerarBoletaEmpleado' idPlanillaEmpleado='".$datos_planilla[$i]["id_planilla_persona_contrato"]."' data-toggle='tooltip' title='Generar Boleta'><i class='fab fa-wpforms'></i></button></div>";

					}
					
					$datosJson .='[	
						"'.($i+1).'",				
						"'.$datos_planilla[$i]["abrev_establecimiento"].'",
						"'.$datos_planilla[$i]["paterno_persona"].'",
						"'.$datos_planilla[$i]["materno_persona"].'",
						"'.$datos_planilla[$i]["nombre_persona"].'",
						"'.$datos_planilla[$i]["ci_persona"].'",
						"'.$datos_planilla[$i]["nombre_cargo"].'",
						"'.$datos_planilla[$i]["haber_basico"].'",
						"'.$datos_planilla[$i]["dias_trabajados"].'",
						"'.$datos_planilla[$i]["total_ganado"].'",
						"'.$datos_planilla[$i]["desc_afp"].'",
						"'.$datos_planilla[$i]["total_desc"].'",
						"'.$datos_planilla[$i]["liquido_pagable"].'",
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

		$activarRelacion = new TablaPlanillaPersonas();
		$activarRelacion -> perfil = $_POST["perfilOculto"];
		$activarRelacion -> id_planilla = $_POST["id_planilla"];
		$activarRelacion -> mostrarTablaGenerarRelacion();

	} else if ($_POST["action"] == "planilla") {

		/*=============================================
		ACTIVAR TABLA DE PLANILLA GENERADA
		=============================================*/

		$activarPlanilla = new TablaPlanillaPersonas();
		$activarPlanilla -> perfil = $_POST["perfilOculto"];
		$activarPlanilla -> id_planilla = $_POST["id_planilla"];
		$activarPlanilla -> mostrarTablaGenerarPlanillas();

	}

}