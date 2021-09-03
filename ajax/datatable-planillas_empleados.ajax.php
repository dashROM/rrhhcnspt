<?php

require_once "../controladores/planillas.controlador.php";
require_once "../modelos/planillas.modelo.php";

class TablaGenerarPlanilla {

	/*=============================================
	MOSTRAR LA TABLA DE PLANILLA GENERADA
	=============================================*/
		
	public function mostrarTablaGenerarPlanillas() {

		$item = "id_planilla";
		$valor1 = $_GET["idPlanilla"];
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
						
						$botones = "<div class='btn-group'><button class='btn btn-primary btnGenerarImportes' idPlanillaEmpleado='".$datos_planilla[$i]["id_planilla_empleado"]."' data-toggle='modal' data-target='#modalGenerarImportes' data-toggle='tooltip' title='Generar Importes'><i class='far fa-money-bill-alt'></i></button></div>";

					} else {

						$botones = "<div class='btn-group'><button class='btn btn-primary btnGenerarImportes' idPlanillaEmpleado='".$datos_planilla[$i]["id_planilla_empleado"]."' data-toggle='modal' data-target='#modalGenerarImportes' data-toggle='tooltip' title='Generar Importes'><i class='far fa-money-bill-alt'></i></button><button class='btn btn-info btnGenerarBoletaEmpleado' idPlanillaEmpleado='".$datos_planilla[$i]["id_planilla_empleado"]."' data-toggle='tooltip' title='Generar Boleta'><i class='fab fa-wpforms'></i></button></div>";

					}
					
					$datosJson .='[	
						"'.($i+1).'",				
						"'.$datos_planilla[$i]["abrev_establecimiento"].'",
						"'.$datos_planilla[$i]["paterno_empleado"].'",
						"'.$datos_planilla[$i]["materno_empleado"].'",
						"'.$datos_planilla[$i]["nombre_empleado"].'",
						"'.$datos_planilla[$i]["ci_empleado"].'",
						"'.$datos_planilla[$i]["nombre_cargo"].'",
						"'.number_format($datos_planilla[$i]["haber_basico"], 2, ",", ".").'",
						"'.$datos_planilla[$i]["dias_trabajados"].'",
						"'.number_format($datos_planilla[$i]["total_ganado"], 2, ",", ".").'",
						"'.number_format($datos_planilla[$i]["desc_afp"], 2, ",", ".").'",
						"'.number_format($datos_planilla[$i]["total_desc"], 2, ",", ".").'",
						"'.number_format($datos_planilla[$i]["liquido_pagable"], 2, ",", ".").'",
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

$activarGenerarPlanillas = new TablaGenerarPlanilla();
$activarGenerarPlanillas -> mostrarTablaGenerarPlanillas();