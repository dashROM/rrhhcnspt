<?php

require_once "../controladores/persona_contratos.controlador.php";
require_once "../modelos/persona_contratos.modelo.php";

class TablaPersonaContratos {

	/*=============================================
	MOSTRAR LA TABLA DE PERSONA CONTRATOS
	=============================================*/
		
	public function mostrarTablaPersonaContratos() {

		$item = null;
		$valor1 = $_GET["idPersona"];
		$valor2 = null;

		$persona_contratos = ControladorPersonaContratos::ctrMostrarPersonaContratos($item, $valor1, $valor2);

		if ($persona_contratos == null) {
			
			$datosJson = '{
				"data": []
			}';

		} else {

			$datosJson = '{
				"data": [';

				for ($i = 0; $i < count($persona_contratos); $i++) { 

					$btnEditarPersonaContrato = "<button class='btn btn-warning btnEditarPersonaContrato' idPersonaContrato='".$persona_contratos[$i]["id_persona_contrato"]."' data-toggle='modal' data-target='#modalEditarPersonaContrato' data-toggle='tooltip' title='Editar'><i class='fas fa-pencil-alt'></i></button>";

					$btnDocumentoContrato = "<button class='btn btn-secondary btnDocumentoContrato' idPersonaContrato='".$persona_contratos[$i]["id_persona_contrato"]."' data-toggle='modal' data-target='#modalEditarDocumentoContrato' data-toggle='tooltip' title='Editar Documento'><i class='fas fa-file-invoice'></i></button>";

					$btnImprimirContrato = "<button class='btn btn-danger btnImprimirContrato' idPersonaContrato='".$persona_contratos[$i]["id_persona_contrato"]."' data-toggle='tooltip' title='Imprimir Documento'><i class='far fa-file-pdf'></i></button>";

					// $btnValidarContrato = "<button class='btn btn-success btnValidarContrato' idPersonaContrato='".$persona_contratos[$i]["id_persona_contrato"]."' data-toggle='tooltip' title='Validar Documento'><i class='far fa-check-square'></i></button>";

					$btnCargarArchivoContrato = "<button class='btn btn-success btnCargarContrato' idPersonaContrato='".$persona_contratos[$i]["id_persona_contrato"]."' data-toggle='modal' data-target='#modalCargarArchivoContrato' data-toggle='tooltip' title='Cargar Contrato'><i class='far fa-file-image'></i></button>";

					$btnAmpliarContrato = "<button class='btn btn-primary btnAmpliarPersonaContrato' idPersonaContrato='".$persona_contratos[$i]["id_persona_contrato"]."' data-toggle='modal' data-target='#modalAmpliarPersonaContrato' data-toggle='tooltip' title='Ampliar Contrato'><i class='fas fa-file-export'></i></button>";

					if ($persona_contratos[$i]["estado_contrato"] != 0) {

            $estado = "<td><button class='btn btn-success' idPersonaContrato='".$persona_contratos[$i]['id_persona_contrato']."'></button></td>";

          } else {

            $estado = "<td><button class='btn btn-danger' idPersonaContrato='".$persona_contratos[$i]['id_persona_contrato']."'></button></td>";

          }

          if ($persona_contratos[$i]["ampliacion"] != 0) {

            $ampliacion = "<td><button class='btn btn-primary' idPersonaContrato='".$persona_contratos[$i]['id_persona_contrato']."'></button></td>";

          } else {

            $ampliacion = "<td><button class='btn btn-secondary' idPersonaContrato='".$persona_contratos[$i]['id_persona_contrato']."'></button></td>";

          }

					/*=============================================
					TRAEMOS LAS ACCIONES
					=============================================*/

					if (isset($_GET["perfilOculto"]) && ($_GET["perfilOculto"] == "ADMIN_SYSTEM")) {
						
						$botones = "<div class='btn-group'>".$btnEditarPersonaContrato.$btnDocumentoContrato.$btnImprimirContrato.$btnCargarArchivoContrato.$btnAmpliarContrato."</div>";

					} elseif ($_GET["perfilOculto"] == "ABOGADO" || $_GET["perfilOculto"] == "SECRETARIO") {

						if ($persona_contratos[$i]["estado_contrato"] == 0) {

							if ($persona_contratos[$i]["ampliacion"] == 0) {

								$botones = "<div class='btn-group'>".$btnEditarPersonaContrato.$btnImprimirContrato."</div>";

							} else {

								$botones = "<div class='btn-group'>".$btnCargarArchivoContrato.$btnAmpliarContrato."</div>";

							}

						} else {

							$botones = "<div class='btn-group'>".$btnCargarArchivoContrato."</div>";

						}

					} elseif ($_GET["perfilOculto"] == "PLANILLERO") {

						$botones = "<div class='btn-group'></div>";

					}
					
					$datosJson .='[
						"'.($i+1).'",	
						"'.$persona_contratos[$i]["certificacion_presupuestaria"].'",	
						"'.$persona_contratos[$i]["codificacion"].'-'.$persona_contratos[$i]["nombre_lugar"].'",
						"'.$persona_contratos[$i]["nombre_establecimiento"].'",				
						"'.$persona_contratos[$i]["nombre_cargo"].'",
						"'.$persona_contratos[$i]["haber_basico"].'",
						"'.$persona_contratos[$i]["hrs_semanales"].'",
						"'.$persona_contratos[$i]["tipo_contratacion"].'",
						"'.$persona_contratos[$i]["datos_contrato"].'",
						"'.$persona_contratos[$i]["gestion_contrato"].'",
						"'.date("d/m/Y", strtotime($persona_contratos[$i]["inicio_contrato"])).'",
						"'.date("d/m/Y", strtotime($persona_contratos[$i]["fin_contrato"])).'",
						"'.$persona_contratos[$i]["dias_contrato"].'",
						"'.$estado.$ampliacion.'",
						"'.$persona_contratos[$i]["observaciones_contrato"].'",
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
ACTIVAR TABLA DE PERSONA CONTRATOS
=============================================*/

$activarPersonaContratos = new TablaPersonaContratos();
$activarPersonaContratos -> mostrarTablaPersonaContratos();