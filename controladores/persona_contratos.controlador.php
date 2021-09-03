<?php

class ControladorPersonaContratos {

	/*=============================================
	LISTADO DE PERSONA CONTRATOS
	=============================================*/

	static public function ctrMostrarPersonaContratos($item, $valor1, $valor2) {

		$tabla = "persona_contratos";
		$respuesta = ModeloPersonaContratos::mdlMostrarPersonaContratos($tabla, $item, $valor1, $valor2);

		return $respuesta;

	}

	/*=============================================
	DATOS DE DOCUMENTO CONTRATO
	=============================================*/

	static public function ctrMostrarDocumentoContrato($item, $valor) {

		$tabla = "persona_contratos";
		$respuesta = ModeloPersonaContratos::mdlMostrarDocumentoContrato($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR NUEVO PERSONA CONTRATO
	=============================================*/
	
	static public function ctrNuevoPersonaContrato($datos) {
		
		$tabla = "persona_contratos";

		$respuesta = ModeloPersonaContratos::mdlNuevoPersonaContrato($tabla, $datos);

		return $respuesta;

	}

	/*=============================================
	EDITAR PERSONA CONTRATO
	=============================================*/
	
	static public function ctrEditarPersonaContrato($datos) {
		
		$tabla = "persona_contratos";

		$respuesta = ModeloPersonaContratos::mdlEditarPersonaContrato($tabla, $datos);

		return $respuesta;

	}

	/*=============================================
	EDITAR DOCUMENTO CONTRATO
	=============================================*/
	
	static public function ctrEditarDocumentoContrato($datos) {
		
		$tabla = "persona_contratos";

		$respuesta = ModeloPersonaContratos::mdlEditarDocumentoContrato($tabla, $datos);

		return $respuesta;

	}

	/*=============================================
	ELIMINAR EMPLEADO
	=============================================*/

	static public function ctrEliminarPersonaContrato()	{

		
	}

}