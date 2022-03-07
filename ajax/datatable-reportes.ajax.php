<?php

require_once "../controladores/persona_contratos.controlador.php";
require_once "../modelos/persona_contratos.modelo.php";

class TablaReportes {

	public $gestion_contrato;

	/*=============================================
	MOSTRAR LA TABLA DE REPORTE CONTRATOS
	=============================================*/
		
	public function mostrarTablaReportePersonaContratos() {

		$item = 'gestion_contrato';
		$valor = $this->gestion_contrato;

		$datos_reporte = ControladorPersonaContratos::ctrMostrarReportePersonaContratos($item, $valor);

		if ($datos_reporte == null) {
			
			$datosJson = '{
				"data": []
			}';

		} else {

			$datosJson = '{
				"data": [';

				for ($i = 0; $i < count($datos_reporte); $i++) { 

					// $btnEditarPersona = "<button class='btn btn-warning btnEditarPersona' idPersona='".$personas[$i]["id_persona"]."' data-toggle='modal' data-target='#modalEditarPersona' data-toggle='tooltip' title='Editar'><i class='fas fa-pencil-alt'></i></button>";

					// $btnMasDetalles = "<button class='btn btn-success btnMasDetallesPersona' idPersona='".$personas[$i]["id_persona"]."' data-toggle='modal' data-target='#modalMasDetalles' data-toggle='tooltip' title='Mas Detalle'><i class='fas fa-plus'></i></button>";

					/*=============================================
					TRAEMOS LAS ACCIONES
					=============================================*/

					// if (isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "ABOGADO") {
						
					// 	$botones = "<div class='btn-group'>".$btnEditarPersona.$btnMasDetalles."</div>";

					// } else {

					// 	$botones = "<div class='btn-group'>".$btnEditarPersona.$btnMasDetalles."</div>";

					// }
					
					$datosJson .='[
						"'.$datos_reporte[$i]["nro_contrato"].'",	
						"'.$datos_reporte[$i]["gestion_contrato"].'",				
						"'.$datos_reporte[$i]["nombre_completo"].'",
						"'.$datos_reporte[$i]["ci_persona"].'",
						"'.date("d/m/Y", strtotime($datos_reporte[$i]["fecha_nacimiento"])).'",
						"'.$datos_reporte[$i]["matricula_persona"].'",
						"'.$datos_reporte[$i]["abrev_establecimiento"].'",
						"'.$datos_reporte[$i]["nombre_contrato"].'-'.$datos_reporte[$i]["proposito_contrato"].'",
						"'.$datos_reporte[$i]["tipo_contratacion"].'",
						"'.date("d/m/Y", strtotime($datos_reporte[$i]["inicio_contrato"])).'",
						"'.date("d/m/Y", strtotime($datos_reporte[$i]["fin_contrato"])).'",
						"'.$datos_reporte[$i]["dias_contrato"].'"
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
	
	}

}

/*=============================================
ACTIVAR TABLA DE REPORTES
=============================================*/

if (isset($_POST["reportePersonaContratos"])) { 

	$activarReportes = new TablaReportes();
	$activarReportes -> gestion_contrato = $_POST["gestionContrato"];
	$activarReportes -> mostrarTablaReportePersonaContratos();

} else {

	$activarPersonas = new TablaPersonas();
	$activarPersonas -> mostrarTablaPersonas();

}

