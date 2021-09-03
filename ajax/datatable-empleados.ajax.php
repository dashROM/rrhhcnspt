<?php

require_once "../controladores/empleados.controlador.php";
require_once "../modelos/empleados.modelo.php";

class TablaEmpleados {

	/*=============================================
	MOSTRAR LA TABLA DE EMPLEADOS
	=============================================*/
		
	public function mostrarTablaEmpleados() {

		$item = null;
		$valor1 = null;
		$valor2 = null;

		$empleados = ControladorEmpleados::ctrMostrarEmpleados($item, $valor1, $valor2);

		if ($empleados == null) {
			
			$datosJson = '{
				"data": []
			}';

		} else {

			$datosJson = '{
				"data": [';

				for ($i = 0; $i < count($empleados); $i++) { 

					$btnEditarEmpleado = "<button class='btn btn-warning btnEditarEmpleado' idEmpleado='".$empleados[$i]["id_empleado"]."' data-toggle='modal' data-target='#modalEditarEmpleado' data-toggle='tooltip' title='Editar'><i class='fas fa-pencil-alt'></i></button>";

					$btnMasDetalles = "<button class='btn btn-primary btnMasDetalles' idEmpleado='".$empleados[$i]["id_empleado"]."' data-toggle='modal' data-target='#modalMasDetalles' data-toggle='tooltip' title='Mas Detalle'><i class='fas fa-file-invoice'></i></button>";


					if ($empleados[$i]["estado_empleado"] != 0) {

            $estado = "<td><button class='btn btn-success btnActivarEmpleado' idEmpleado='".$empleados[$i]['id_empleado']."' estadoEmpleado='0'>ACTIVO</button></td>";

          } else {

            $estado = "<td><button class='btn btn-danger btnActivarEmpleado' idEmpleado='".$empleados[$i]['id_empleado']."' estadoEmpleado='1'>INACTIVO</button></td>";

          }

					/*=============================================
					TRAEMOS LAS ACCIONES
					=============================================*/

					if (isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Especial") {
						
						
						$botones = "<div class='btn-group'>".$btnEditarEmpleado."</div>";

					} else {

						$botones = "<div class='btn-group'>".$btnEditarEmpleado.$btnMasDetalles."</div>";

					}
					
					$datosJson .='[
						"'.($i+1).'",					
						"'.$empleados[$i]["nombre_establecimiento"].'",
						"'.$empleados[$i]["nombre_completo"].'",
						"'.$empleados[$i]["ci_persona"].'",
						"'.date("d/m/Y", strtotime($empleados[$i]["fecha_nacimiento"])).'",
						"'.$empleados[$i]["nombre_cargo"].'",
						"'.date("d/m/Y", strtotime($empleados[$i]["fecha_inicio_contrato"])).'",
						"'.date("d/m/Y", strtotime($empleados[$i]["fecha_fin_contrato"])).'",
						"'.$empleados[$i]["dias_contrato"].'",
						"'.$empleados[$i]["nombre_contrato"].'",
						"'.$estado.'",
						"'.$empleados[$i]["observaciones"].'",
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
ACTIVAR TABLA DE EMPLEADOS
=============================================*/

$activarEmpleados = new TablaEmpleados();
$activarEmpleados -> mostrarTablaEmpleados();