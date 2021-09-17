<?php

require_once "../controladores/planillas.controlador.php";
require_once "../modelos/planillas.modelo.php";

class TablaPlanillas {

	// /*=============================================
	// MOSTRAR LA TABLA DE PLANILLAS
	// =============================================*/
		
	// public function mostrarTablaPlanillas() {

	// 	$item = null;
	// 	$valor1 = null;
	// 	$valor2 = null;

	// 	$planillas = ControladorPlanillas::ctrMostrarPlanillas($item, $valor1, $valor2);


	// 	if ($planillas == null) {
			
	// 		$datosJson = '{
	// 			"data": []
	// 		}';

	// 	} else {


	// 		$datosJson = '{
	// 			"data": [';

	// 			for ($i = 0; $i < count($planillas); $i++) { 

	// 				// Convertir numero de Mes a su valor literal
	// 				setlocale(LC_TIME, 'spanish');
	// 				$numero = $planillas[$i]["mes_planilla"];
	// 				$dateObj   = DateTime::createFromFormat('!m', $numero);
	// 				$mes = strftime('%B', $dateObj->getTimestamp());

	// 				/*=============================================
	// 				TRAEMOS LAS ACCIONES
	// 				=============================================*/

	// 				if (isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Especial") {
						
	// 					$botones = "<div class='btn-group'><button class='btn btn-warning btnEditarPlanilla' idPlanilla='".$planillas[$i]["id_planilla"]."' data-toggle='modal' data-target='#modalEditarPlanilla' data-toggle='tooltip' title='Editar'><i class='fas fa-pencil-alt'></i></button></div>";

	// 				} else {

	// 					$botones = "<div class='btn-group'><button class='btn btn-warning btnEditarPlanilla' idPlanilla='".$planillas[$i]["id_planilla"]."' data-toggle='modal' data-target='#modalEditarPlanilla' data-toggle='tooltip' title='Editar'><i class='fas fa-pencil-alt'></i></button><button class='btn btn-info btnGenerarPlanilla' idPlanilla='".$planillas[$i]["id_planilla"]."' data-toggle='tooltip' title='Generar Planilla'><i class='fab fa-wpforms'></i></button></div>";

	// 				}

	// 				$titulo_planilla = str_replace('"','\\"',$planillas[$i]["titulo_planilla"]);
					
	// 				$datosJson .='[
	// 					"'.($i+1).'",					
	// 					"'.$titulo_planilla.'",
	// 					"'.strtoupper($mes).'",
	// 					"'.$planillas[$i]["gestion_planilla"].'",
	// 					"'.$planillas[$i]["tipo_contrato"].'",
	// 					"'.$botones.'"
	// 				],';
	// 			}

	// 			$datosJson = substr($datosJson, 0, -1);

	// 		$datosJson .= ']

	// 		}';

	// 	}
		
	// 	echo $datosJson;
	
	// }


	/*=============================================
	MOSTRAR LA TABLA DE RELACION DE NOVEDADES
	=============================================*/
		
	public function mostrarTablaRelacion() {

		$item = null;
		$valor1 = null;
		$valor2 = null;

		$relacion = ControladorPlanillas::ctrMostrarRelacion($item, $valor1, $valor2);


		if ($relacion == null) {
			
			$datosJson = '{
				"data": []
			}';

		} else {


			$datosJson = '{
				"data": [';

				for ($i = 0; $i < count($relacion); $i++) { 

					// Convertir numero de Mes a su valor literal
					setlocale(LC_TIME, 'spanish');
					$numero = $relacion[$i]["mes_planilla"];
					$dateObj   = DateTime::createFromFormat('!m', $numero);
					$mes = strftime('%B', $dateObj->getTimestamp());

					/*=============================================
					TRAEMOS LAS ACCIONES
					=============================================*/

					if (isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Especial") {
						
						$botones = "<div class='btn-group'><button class='btn btn-warning btnEditarRelacion' idPlanilla='".$relacion[$i]["id_planilla"]."' data-toggle='modal' data-target='#modalEditarRelacion' data-toggle='tooltip' title='Editar'><i class='fas fa-pencil-alt'></i></button></div>";

					} else {

						$botones = "<div class='btn-group'><button class='btn btn-warning btnEditarRelacion' idPlanilla='".$relacion[$i]["id_planilla"]."' data-toggle='modal' data-target='#modalEditarRelacion' data-toggle='tooltip' title='Editar'><i class='fas fa-pencil-alt'></i></button><button class='btn btn-info btnGenerarRelacion' idPlanilla='".$relacion[$i]["id_planilla"]."' data-toggle='tooltip' title='Generar Planilla'><i class='fab fa-wpforms'></i></button></div>";

					}

					$titulo_relacion = str_replace("&NBSP;", ' ', strip_tags($relacion[$i]["titulo_relacion"]));;
					
					$datosJson .='[
						"'.($i+1).'",					
						"'.$titulo_relacion.'",
						"'.strtoupper($mes).'",
						"'.$relacion[$i]["gestion_planilla"].'",
						"'.$relacion[$i]["nombre_contrato"].'",
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
ACTIVAR TABLA DE RELACION DE NOVEDADES
=============================================*/

$activarRelacion = new TablaPlanillas();
$activarRelacion -> mostrarTablaRelacion();