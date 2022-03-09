<?php

require_once "../controladores/persona_contratos.controlador.php";
require_once "../modelos/persona_contratos.modelo.php";

class TablaReportes {

	public $id_contrato;
	public $gestion_contrato;

	/*=============================================
	MOSTRAR LA TABLA DE REPORTE CONTRATOS
	=============================================*/
		
	public function mostrarTablaReportePersonaContratos() {

		$item1 = 'id_contrato';
		$valor1 = $this->id_contrato;
		$item2 = 'gestion_contrato';
		$valor2 = $this->gestion_contrato;

		$datos_reporte = ControladorPersonaContratos::ctrMostrarReportePersonaContratos($item1, $item2, $valor1, $valor2);

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
						"'.$datos_reporte[$i]["nro_contrato"].'/'.$datos_reporte[$i]["gestion_contrato"].'",				
						"'.$datos_reporte[$i]["nombre_completo"].'",
						"'.$datos_reporte[$i]["ci_persona"].'",
						"'.date("d/m/Y", strtotime($datos_reporte[$i]["fecha_nacimiento"])).'",
						"'.$datos_reporte[$i]["matricula_persona"].'",
						"'.$datos_reporte[$i]["abrev_establecimiento"].'",
						"'.$datos_reporte[$i]["tipo_contratacion"].'",
						"'.$datos_reporte[$i]["nombre_cargo"].'",
						"'.$datos_reporte[$i]["haber_basico"].'",
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
	$activarReportes -> id_contrato = $_POST["idContrato"];
	$activarReportes -> gestion_contrato = $_POST["gestionContrato"];
	$activarReportes -> mostrarTablaReportePersonaContratos();

} else {

	$activarPersonas = new TablaPersonas();
	$activarPersonas -> mostrarTablaPersonas();

}

