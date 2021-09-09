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
				$sql = "SELECT pc.id_persona_contrato, l.id_lugar, l.codificacion, l.nombre_lugar, e.id_establecimiento, e.nombre_establecimiento, concat_ws(' ', pe.paterno_persona, pe.materno_persona, pe.nombre_persona) AS nombre_completo, concat_ws(' ', pe.ci_persona, pe.ext_ci_persona) AS ci_persona, pe.fecha_nacimiento, co.id_contrato, co.nombre_contrato, ca.id_cargo, ca.nombre_cargo, pc.inicio_contrato, pc.dias_contrato, pc.fin_contrato, pc.estado_contrato, pc.observaciones_contrato, pe.id_persona, s.id_suplencia, s.tipo_suplencia FROM personas pe, persona_contratos pc, cargos ca, contratos co, establecimientos e, suplencias s, lugares l WHERE pe.id_persona = pc.id_persona AND ca.id_cargo = pc.id_cargo AND co.id_contrato = pc.id_contrato AND e.id_establecimiento = pc.id_establecimiento AND s.id_suplencia = pc.id_suplencia AND l.id_lugar = pc.id_lugar AND pc.$item = :$item";

				$stmt = Conexion::conectarPG()->prepare($sql);

				$stmt->bindParam(":".$item, $valor1, PDO::PARAM_INT);

			}			

			$stmt->execute();
			return $stmt->fetch();

		} else {

			//muestra el listado de las persona que tienen uno o mas contratos
			$sql = "SELECT pc.id_persona_contrato, l.id_lugar, l.codificacion, l.nombre_lugar, e.id_establecimiento, e.nombre_establecimiento, co.id_contrato, co.nombre_contrato, ca.id_cargo, ca.nombre_cargo, pc.inicio_contrato, pc.dias_contrato, pc.fin_contrato, pc.estado_contrato, pc.observaciones_contrato, pe.id_persona FROM personas pe, persona_contratos pc, cargos ca, contratos co, establecimientos e, lugares l WHERE pe.id_persona = pc.id_persona AND ca.id_cargo = pc.id_cargo AND co.id_contrato = pc.id_contrato AND e.id_establecimiento = pc.id_establecimiento AND l.id_lugar = pc.id_lugar AND pc.id_persona = :id_persona ORDER BY pc.id_persona_contrato DESC";

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
			$sql = "SELECT pc.id_persona_contrato, pc.documento_contrato, pe.id_persona FROM personas pe, persona_contratos pc WHERE pe.id_persona = pc.id_persona AND pc.id_persona_contrato = :id_persona_contrato";

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

		$stmt = Conexion::conectarPG()->prepare("INSERT INTO $tabla(id_lugar, id_establecimiento, id_persona, id_cargo, inicio_contrato, dias_contrato, fin_contrato, id_contrato, id_suplencia, estado_contrato, observaciones_contrato, documento_contrato) VALUES (:id_lugar, :id_establecimiento, :id_persona, :id_cargo, :inicio_contrato, :dias_contrato, :fin_contrato, :id_contrato, :id_suplencia, :estado_contrato, :observaciones_contrato, :documento_contrato)");

		$stmt->bindParam(":id_lugar", $datos["id_lugar"], PDO::PARAM_INT);
		$stmt->bindParam(":id_establecimiento", $datos["id_establecimiento"], PDO::PARAM_INT);
		$stmt->bindParam(":id_persona", $datos["id_persona"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cargo", $datos["id_cargo"], PDO::PARAM_INT);
		$stmt->bindParam(":inicio_contrato", $datos["inicio_contrato"], PDO::PARAM_STR);
		$stmt->bindParam(":dias_contrato", $datos["dias_contrato"], PDO::PARAM_INT);
		$stmt->bindParam(":fin_contrato", $datos["fin_contrato"], PDO::PARAM_STR);
		$stmt->bindParam(":id_contrato", $datos["id_contrato"], PDO::PARAM_INT);
		$stmt->bindParam(":id_suplencia", $datos["id_suplencia"], PDO::PARAM_INT);
		$stmt->bindParam(":estado_contrato", $datos["estado_contrato"], PDO::PARAM_INT);
		$stmt->bindParam(":observaciones_contrato", $datos["observaciones_contrato"], PDO::PARAM_STR);
		$stmt->bindParam(":documento_contrato", $datos["documento_contrato"], PDO::PARAM_STR);

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

		$stmt = Conexion::conectarPG()->prepare("UPDATE $tabla SET id_lugar = :id_lugar, id_establecimiento = :id_establecimiento, id_persona = :id_persona, id_cargo = :id_cargo, inicio_contrato = :inicio_contrato, dias_contrato = :dias_contrato, fin_contrato = :fin_contrato, id_contrato = :id_contrato, id_suplencia = :id_suplencia, observaciones_contrato = :observaciones_contrato, documento_contrato = :documento_contrato  WHERE id_persona_contrato = :id_persona_contrato");

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
		$stmt->bindParam(":observaciones_contrato", $datos["observaciones_contrato"], PDO::PARAM_STR);
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
	EDITAR PERSONA CONTRATO
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
	
}