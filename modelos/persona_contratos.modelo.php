<?php

require_once "conexion.db.php";

class ModeloPersonaContratos {

	/*=============================================
	MOSTRAR PERSONA CONTRATOS
	=============================================*/
	
	static public function mdlMostrarPersonaContratos($tabla, $item, $valor1, $valor2) {

		if ($item != null) {
			
			if ($valor2 != null) {

				//muestra datos de un contrato en especifico
				$stmt = Conexion::conectarPG()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND id_persona_contrato != :id_persona_contrato");

				$stmt->bindParam(":".$item, $valor1, PDO::PARAM_STR);
				$stmt->bindParam(":id_persona_contrato", $valor2, PDO::PARAM_INT);

			} else {

				//muestra varios datos de una persona que tiene un respectivo contrato
				$sql = "SELECT pc.id_persona_contrato, pc.cod_contrato, l.id_lugar, l.codificacion, l.nombre_lugar, e.id_establecimiento, e.nombre_establecimiento, concat_ws(' ', pe.paterno_persona, pe.materno_persona, pe.nombre_persona) AS nombre_completo, concat_ws(' ', pe.ci_persona, pe.ext_ci_persona) AS ci_persona, pe.fecha_nacimiento, co.id_contrato, co.nombre_contrato, co.proposito_contrato, ca.id_cargo, ca.nombre_cargo, ca.haber_basico, pc.tipo_contratacion, ca.observacion_cargo, pc.inicio_contrato, pc.dias_contrato, pc.fin_contrato, pc.estado_contrato, pc.observaciones_contrato, pe.id_persona, s.id_suplencia, s.tipo_suplencia, pc.archivo_contrato, pc.documento_ampliacion, pc.ampliacion, pc.resolucion_ministerial, pc.id_memorandum, m.nro_memorandum, m.fecha_memorandum, pc.certificacion_presupuestaria, pc.gestion_contrato, pc.recurrencia FROM personas pe, persona_contratos pc, cargos ca, contratos co, establecimientos e, suplencias s, lugares l, memorandums m WHERE pe.id_persona = pc.id_persona AND ca.id_cargo = pc.id_cargo AND co.id_contrato = pc.id_contrato AND e.id_establecimiento = pc.id_establecimiento AND s.id_suplencia = pc.id_suplencia AND l.id_lugar = pc.id_lugar AND m.id_memorandum = pc.id_memorandum AND pc.$item = :$item";

				$stmt = Conexion::conectarPG()->prepare($sql);

				$stmt->bindParam(":".$item, $valor1, PDO::PARAM_INT);

			}			

			$stmt->execute();
			return $stmt->fetch();

		} else {

			//muestra el listado de las persona que tienen uno o mas contratos
			$sql = "SELECT pc.id_persona_contrato, pc.cod_contrato, l.id_lugar, l.codificacion, l.nombre_lugar, e.id_establecimiento, e.nombre_establecimiento, co.id_contrato, co.nombre_contrato, ca.id_cargo, ca.nombre_cargo, ca.haber_basico, ca.hrs_semanales, ca.observacion_cargo, pc.inicio_contrato, pc.dias_contrato, pc.fin_contrato, pc.estado_contrato, pc.observaciones_contrato, pe.id_persona, pc.archivo_contrato, pc.ampliacion, pc.tipo_contratacion, pc.gestion_contrato, concat_ws(' - ', co.nombre_contrato, co.proposito_contrato) AS datos_contrato FROM personas pe, persona_contratos pc, cargos ca, contratos co, establecimientos e, lugares l WHERE pe.id_persona = pc.id_persona AND ca.id_cargo = pc.id_cargo AND co.id_contrato = pc.id_contrato AND e.id_establecimiento = pc.id_establecimiento AND l.id_lugar = pc.id_lugar AND pc.id_persona = :id_persona ORDER BY pc.id_persona_contrato DESC";

			$stmt = Conexion::conectarPG()->prepare($sql);

			$stmt->bindParam(":id_persona", $valor1, PDO::PARAM_INT);

			$stmt->execute();
			return $stmt->fetchAll();

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR DOCUMENTO CONTRATO
	=============================================*/
	
	static public function mdlMostrarDocumentoContrato($tabla, $item, $valor) {

		if ($item != null) {

			//muestra el listado de las persona que tienen uno o mas contratos
			$sql = "SELECT pc.id_persona_contrato, pc.documento_contrato, pe.id_persona, concat_ws(' ', pe.paterno_persona, pe.materno_persona, pe.nombre_persona) AS nombre_completo, pe.ci_persona, co.nombre_contrato, co.proposito_contrato, pc.inicio_contrato, pc.fin_contrato FROM personas pe, contratos co, persona_contratos pc WHERE pe.id_persona = pc.id_persona AND co.id_contrato = pc.id_contrato AND  pc.id_persona_contrato = :id_persona_contrato";

			$stmt = Conexion::conectarPG()->prepare($sql);

			$stmt->bindParam(":id_persona_contrato", $valor, PDO::PARAM_INT);

			$stmt->execute();
			return $stmt->fetch();

		}

		$stmt->close();
		$stmt = null;

	}
	
	/*=============================================
	CREAR NUEVO PERSONA CONTRATO
	=============================================*/
	
	static public function mdlNuevoPersonaContrato($tabla, $datos){

		$stmt = Conexion::conectarPG()->prepare("INSERT INTO $tabla(id_lugar, id_establecimiento, id_persona, id_cargo, inicio_contrato, dias_contrato, fin_contrato, id_contrato, id_suplencia, id_memorandum, estado_contrato, observaciones_contrato, documento_contrato, nro_cod_contrato, cod_contrato, tipo_contratacion, ampliacion, recurrencia, certificacion_presupuestaria, gestion_contrato) VALUES (:id_lugar, :id_establecimiento, :id_persona, :id_cargo, :inicio_contrato, :dias_contrato, :fin_contrato, :id_contrato, :id_suplencia, :id_memorandum, :estado_contrato, :observaciones_contrato, :documento_contrato, :nro_cod_contrato, :cod_contrato, :tipo_contratacion, :ampliacion, :recurrencia, :certificacion_presupuestaria, :gestion_contrato)");

		$stmt->bindParam(":id_lugar", $datos["id_lugar"], PDO::PARAM_INT);
		$stmt->bindParam(":id_establecimiento", $datos["id_establecimiento"], PDO::PARAM_INT);
		$stmt->bindParam(":id_persona", $datos["id_persona"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cargo", $datos["id_cargo"], PDO::PARAM_INT);
		$stmt->bindParam(":inicio_contrato", $datos["inicio_contrato"], PDO::PARAM_STR);
		$stmt->bindParam(":dias_contrato", $datos["dias_contrato"], PDO::PARAM_INT);
		$stmt->bindParam(":fin_contrato", $datos["fin_contrato"], PDO::PARAM_STR);
		$stmt->bindParam(":id_contrato", $datos["id_contrato"], PDO::PARAM_INT);
		$stmt->bindParam(":id_suplencia", $datos["id_suplencia"], PDO::PARAM_INT);
		$stmt->bindParam(":id_memorandum", $datos["id_memorandum"], PDO::PARAM_INT);
		$stmt->bindParam(":estado_contrato", $datos["estado_contrato"], PDO::PARAM_INT);
		$stmt->bindParam(":observaciones_contrato", $datos["observaciones_contrato"], PDO::PARAM_STR);
		$stmt->bindParam(":documento_contrato", $datos["documento_contrato"], PDO::PARAM_STR);
		$stmt->bindParam(":nro_cod_contrato", $datos["nro_cod_contrato"], PDO::PARAM_INT);
		$stmt->bindParam(":cod_contrato", $datos["cod_contrato"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_contratacion", $datos["tipo_contratacion"], PDO::PARAM_STR);
		$stmt->bindParam(":ampliacion", $datos["ampliacion"], PDO::PARAM_INT);
		$stmt->bindParam(":recurrencia", $datos["recurrencia"], PDO::PARAM_INT);
		$stmt->bindParam(":certificacion_presupuestaria", $datos["certificacion_presupuestaria"], PDO::PARAM_STR);
		$stmt->bindParam(":gestion_contrato", $datos["gestion_contrato"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		} else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR PERSONA CONTRATO
	=============================================*/
	
	static public function mdlEditarPersonaContrato($tabla, $datos){

		$stmt = Conexion::conectarPG()->prepare("UPDATE $tabla SET id_lugar = :id_lugar, id_establecimiento = :id_establecimiento, id_persona = :id_persona, id_cargo = :id_cargo, inicio_contrato = :inicio_contrato, dias_contrato = :dias_contrato, fin_contrato = :fin_contrato, id_contrato = :id_contrato, id_suplencia = :id_suplencia, id_memorandum = :id_memorandum, observaciones_contrato = :observaciones_contrato, documento_contrato = :documento_contrato, nro_cod_contrato = :nro_cod_contrato, cod_contrato = :cod_contrato, tipo_contratacion = :tipo_contratacion, certificacion_presupuestaria = :certificacion_presupuestaria, gestion_contrato = :gestion_contrato, recurrencia = :recurrencia WHERE id_persona_contrato = :id_persona_contrato");

		$stmt->bindParam(":id_persona_contrato", $datos["id_persona_contrato"], PDO::PARAM_INT);
		$stmt->bindParam(":id_lugar", $datos["id_lugar"], PDO::PARAM_INT);
		$stmt->bindParam(":id_establecimiento", $datos["id_establecimiento"], PDO::PARAM_INT);
		$stmt->bindParam(":id_persona", $datos["id_persona"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cargo", $datos["id_cargo"], PDO::PARAM_INT);
		$stmt->bindParam(":inicio_contrato", $datos["inicio_contrato"], PDO::PARAM_STR);
		$stmt->bindParam(":dias_contrato", $datos["dias_contrato"], PDO::PARAM_INT);
		$stmt->bindParam(":fin_contrato", $datos["fin_contrato"], PDO::PARAM_STR);
		$stmt->bindParam(":id_contrato", $datos["id_contrato"], PDO::PARAM_INT);
		$stmt->bindParam(":id_suplencia", $datos["id_suplencia"], PDO::PARAM_INT);
		$stmt->bindParam(":id_memorandum", $datos["id_memorandum"], PDO::PARAM_INT);
		$stmt->bindParam(":observaciones_contrato", $datos["observaciones_contrato"], PDO::PARAM_STR);
		$stmt->bindParam(":documento_contrato", $datos["documento_contrato"], PDO::PARAM_STR);
		$stmt->bindParam(":nro_cod_contrato", $datos["nro_cod_contrato"], PDO::PARAM_INT);
		$stmt->bindParam(":cod_contrato", $datos["cod_contrato"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_contratacion", $datos["tipo_contratacion"], PDO::PARAM_STR);
		$stmt->bindParam(":certificacion_presupuestaria", $datos["certificacion_presupuestaria"], PDO::PARAM_STR);
		$stmt->bindParam(":gestion_contrato", $datos["gestion_contrato"], PDO::PARAM_STR);
		$stmt->bindParam(":recurrencia", $datos["recurrencia"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR DOCUMENTO CONTRATO
	=============================================*/
	
	static public function mdlEditarDocumentoContrato($tabla, $datos){

		$stmt = Conexion::conectarPG()->prepare("UPDATE $tabla SET documento_contrato = :documento_contrato  WHERE id_persona_contrato = :id_persona_contrato");

		$stmt->bindParam(":id_persona_contrato", $datos["id_persona_contrato"], PDO::PARAM_INT);
		$stmt->bindParam(":documento_contrato", $datos["documento_contrato"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR PERSONA CONTRATO
	=============================================*/

	static public function mdlEliminarDocumentoContrato($tabla, $datos) {
		
		$stmt = Conexion::conectarPG()->prepare("DELETE FROM $tabla WHERE id_persona_contrato = :id_persona_contrato");

		$stmt->bindParam(":id_persona_contrato", $datos, PDO::PARAM_INT);

		
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR ARCHIVO CONTRATO
	=============================================*/
	
	static public function mdlGuardarArchivoContrato($tabla, $datos){

		$stmt = Conexion::conectarPG()->prepare("UPDATE $tabla SET archivo_contrato = :archivo_contrato  WHERE id_persona_contrato = :id_persona_contrato");

		$stmt->bindParam(":id_persona_contrato", $datos["id_persona_contrato"], PDO::PARAM_INT);
		$stmt->bindParam(":archivo_contrato", $datos["archivo_contrato"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR USUARIO
	=============================================*/

	static public function mdlActualizarContratoPersona($tabla, $item1, $valor1, $item2, $valor2) {

		$stmt = Conexion::conectarPG()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if ($stmt->execute()) {
			
			return "ok";

		} else {
			
			return "error";

		}
		
		$stmt->close();
		$stmt = null;

	}	

	/*=============================================
	ULTIMO CODIGO CONTRATO
	=============================================*/

	static public function mdlUltimoCodigoContrato($tabla, $item1, $valor1, $item2, $valor2) {

		$sql = "SELECT pc.nro_cod_contrato FROM persona_contratos pc, cargos c, contratos co WHERE pc.id_cargo = c.id_cargo AND pc.id_contrato = co.id_contrato AND co.codigo = :$item1 AND c.grupo_cargo = :$item2 ORDER BY pc.id_persona_contrato DESC LIMIT 1";

		$stmt = Conexion::conectarPG()->prepare($sql);

		$stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		$stmt->execute();
		return $stmt->fetch();

		$stmt->close();
		$stmt = null;

	}	

	/*=============================================
	CANTIDAD PERSONA CONTRATOS
	=============================================*/
	
	static public function mdlCantidadPersonaContratos($tabla, $item, $valor) {

		//muestra varios datos de una persona que tiene un respectivo contrato
		$sql = "SELECT count(*) as numero_filas FROM $tabla WHERE $item = :$item";

		$stmt = Conexion::conectarPG()->prepare($sql);

		$stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);		

		$stmt->execute();
		return $stmt->fetch();

		$stmt->close();
		$stmt = null;

	}


	/*=============================================
	AMPLIAR PERSONA CONTRATO
	=============================================*/
	
	static public function mdlAmpliarPersonaContrato($tabla, $datos){

		$stmt = Conexion::conectarPG()->prepare("UPDATE $tabla SET dias_contrato = :dias_contrato, fin_contrato = :fin_contrato, documento_contrato = :documento_contrato, ampliacion = :ampliacion, ant_fin_contrato = :ant_fin_contrato, documento_ampliacion = :documento_ampliacion WHERE id_persona_contrato = :id_persona_contrato");

		$stmt->bindParam(":id_persona_contrato", $datos["id_persona_contrato"], PDO::PARAM_INT);
		$stmt->bindParam(":dias_contrato", $datos["dias_contrato"], PDO::PARAM_INT);
		$stmt->bindParam(":fin_contrato", $datos["fin_contrato"], PDO::PARAM_STR);
		$stmt->bindParam(":ampliacion", $datos["ampliacion"], PDO::PARAM_INT);
		$stmt->bindParam(":documento_contrato", $datos["documento_contrato"], PDO::PARAM_STR);
		$stmt->bindParam(":ant_fin_contrato", $datos["ant_fin_contrato"], PDO::PARAM_STR);
		$stmt->bindParam(":documento_ampliacion", $datos["documento_ampliacion"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}
	
}