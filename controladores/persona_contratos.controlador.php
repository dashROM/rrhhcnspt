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


	/*=============================================
	CARGAR ARCHIVO CONTRATO
	=============================================*/
	
	static public function ctrGuardarArchivoContrato($datos) {
		
		$tabla = "persona_contratos";

		$respuesta = ModeloPersonaContratos::mdlGuardarArchivoContrato($tabla, $datos);

		return $respuesta;

	}

	/*=============================================
	ULTIMO CODIGO CONTRATO
	=============================================*/

	static public function ctrUltimoCodigoContrato($item1, $valor1, $item2, $valor2) {

		$tabla = "persona_contratos";
		$respuesta = ModeloPersonaContratos::mdlUltimoCodigoContrato($tabla, $item1, $valor1, $item2, $valor2);

		return $respuesta;

	}

	/*=============================================
	CANTIDAD DE PERSONA CONTRATOS
	=============================================*/

	static public function ctrCantidadPersonaContratos($item, $valor) {

		$tabla = "persona_contratos";
		$respuesta = ModeloPersonaContratos::mdlCantidadPersonaContratos($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	AMPLIAR PERSONA CONTRATO
	=============================================*/
	
	static public function ctrAmpliarPersonaContrato($datos) {
		
		$tabla = "persona_contratos";

		$respuesta = ModeloPersonaContratos::mdlAmpliarPersonaContrato($tabla, $datos);

		return $respuesta;

	}

	/*=============================================
	REPORTE PERSONA CONTRATOS
	=============================================*/
	
	static public function ctrMostrarReportePersonaContratos($item1, $item2, $valor1, $valor2) {
		
		$tabla = "persona_contratos";

		$respuesta = ModeloPersonaContratos::mdlMostrarReportePersonaContratos($tabla, $item1, $item2, $valor1, $valor2);

		return $respuesta;

	}

}