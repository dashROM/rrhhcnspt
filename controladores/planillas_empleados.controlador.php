<?php 

class ControladorPlanillasEmpleados {	

	/*=============================================
	MOSTRAR DATOS DE PLANILLA DE UN EMPLEADO
	=============================================*/
	
	static public function ctrMostrarPlanillaEmpleado($item, $valor) {

		$tabla = "planillas_empleados_tbl";

		$respuesta = ModeloPlanillasEmpleados::mdlMostrarPlanillaEmpleado($tabla, $item, $valor);

		return $respuesta;

	}


	/*=============================================
	MOSTRAR DATOS DE PLANILLA DE UN EMPLEADO COMPLETO
	=============================================*/
	
	static public function ctrMostrarPlanillaEmpleadoCompleto($item, $valor) {

		$tabla = "planillas_empleados_tbl";

		$respuesta = ModeloPlanillasEmpleados::mdlMostrarPlanillaEmpleadoCompleto($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR DATOS DE PLANILLA DE UN EMPLEADO COMPLETO
	=============================================*/
	
	static public function ctrMostrarTotalesPlanillaEmpleado($item, $valor) {

		$tabla = "planillas_empleados_tbl";

		$respuesta = ModeloPlanillasEmpleados::mdlMostrarTotalesPlanillaEmpleado($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	ACTUALIZAR DE DATOS DE IMPORTES DE PLANILLA 
	=============================================*/
	
	static public function ctrAgregarImportes($datos) {

		$tabla = "planillas_empleados_tbl";

		$respuesta = ModeloPlanillasEmpleados::mdlAgregarImportes($tabla, $datos);

		return $respuesta;

	}

}