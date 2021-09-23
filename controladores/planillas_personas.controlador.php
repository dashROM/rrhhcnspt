<?php 

class ControladorPlanillasPersonas {	

	/*=============================================
	MOSTRAR DATOS DE RELACION DE NOVEDADES DE UNA PERSONA
	=============================================*/
	
	static public function ctrMostrarRelacionNovedadesPersona($item, $valor) {

		$tabla = "planilla_persona_contratos";

		$respuesta = ModeloPlanillasPersonas::mdlMostrarRelacionNovedadesPersona($tabla, $item, $valor);

		return $respuesta;

	}


	/*=============================================
	MOSTRAR DATOS DE RELACION DE NOVEDADES DE UNA PERSONA COMPLETO
	=============================================*/
	
	static public function ctrMostrarRelacionPersonaCompleto($item, $valor) {

		$tabla = "planilla_persona_contratos";

		$respuesta = ModeloPlanillasPersonas::mdlMostrarRelacionPersonaCompleto($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR DATOS DE PLANILLA DE UN EMPLEADO COMPLETO
	=============================================*/
	
	static public function ctrMostrarTotalesPlanillaEmpleado($item, $valor) {

		$tabla = "planilla_persona_contratos";

		$respuesta = ModeloPlanillasPersonas::mdlMostrarTotalesPlanillaEmpleado($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	ACTUALIZAR DE DATOS DE DIAS TRABAJADOS EN RELACION DE NOVEDADES
	=============================================*/
	
	static public function ctrAgregarDiasTrabajados($datos) {

		$tabla = "planilla_persona_contratos";

		$respuesta = ModeloPlanillasPersonas::mdlAgregarDiasTrabajados($tabla, $datos);

		return $respuesta;

	}

}