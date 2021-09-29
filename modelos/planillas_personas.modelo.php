<?php

require_once "conexion.db.php";

class ModeloPlanillasPersonas {

	/*=============================================
	MOSTRAR DATOS DE RELACION DE NOVEDADES DE UNA PERSONA
	=============================================*/
	
	static public function mdlMostrarRelacionNovedadesPersona($tabla, $item, $valor) {

		if ($item != null) {

			$sql = "SELECT ppc.id_planilla_persona_contrato, concat_ws(' ', p.paterno_persona, p.materno_persona, p.nombre_persona) AS nombre_persona, concat_ws(' ', p.ci_persona, p.ext_ci_persona) AS ci_persona, c.nombre_cargo, c.haber_basico, ppc.dias_trabajados FROM planilla_persona_contratos ppc, persona_contratos pc,  personas p,cargos c WHERE pc.id_cargo = c.id_cargo AND pc.id_persona = p.id_persona AND ppc.id_persona_contrato = pc.id_persona_contrato AND ppc.$item = :$item";
			
			$stmt = Conexion::conectarPG()->prepare($sql);

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR DATOS DE PLANILLA DE UNA PERSONA COMPLETO
	=============================================*/
	
	static public function mdlMostrarPlanillaPersonasCompleto($tabla, $item, $valor) {

		if ($item != null) {
			
			$stmt = Conexion::conectarPG()->prepare("SELECT ppc.id_planilla_persona_contrato, est.abrev_establecimiento, p.paterno_persona, p.materno_persona, p.nombre_persona, concat_ws(' ', p.ci_persona, p.ext_ci_persona) AS ci_persona, c.nombre_cargo, c.haber_basico, ppc.dias_trabajados, ppc.total_ganado, ppc.desc_afp, ppc.desc_solidario, ppc.total_desc, ppc.liquido_pagable, ppc.id_planilla FROM planilla_persona_contratos ppc, persona_contratos pc, personas p, cargos c, establecimientos est WHERE ppc.id_persona_contrato = pc.id_persona_contrato AND pc.id_persona = p.id_persona AND pc.id_establecimiento = est.id_establecimiento AND pc.id_cargo = c.id_cargo AND ppc.$item = :$item");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR SUMATORIAS TOTALES DE PLANILLA DE UN EMPLEADO
	=============================================*/
	
	static public function mdlMostrarTotalesPlanillaPersonas($tabla, $item, $valor) {

		if ($item != null) {
			
			$stmt = Conexion::conectarPG()->prepare("SELECT SUM(total_ganado) AS total_ganado, SUM(desc_afp) AS desc_afp, SUM(desc_solidario) AS desc_solidario, SUM(total_desc) AS total_desc, SUM(liquido_pagable) AS liquido_pagable FROM planilla_persona_contratos WHERE $item = :$item");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR DE DATOS DE DIAS TRABAJADOS EN RELACION DE NOVEDADES
	=============================================*/

	static public function mdlAgregarDiasTrabajados($tabla, $datos) {

		$pdo = Conexion::conectarPG();

		$sql = "UPDATE $tabla SET dias_trabajados = :dias_trabajados, total_ganado = :total_ganado, desc_afp = :desc_afp, total_desc = :total_desc, liquido_pagable = :liquido_pagable WHERE id_planilla_persona_contrato = :id_planilla_persona_contrato";
			
		$stmt = $pdo->prepare($sql);

		$stmt->bindParam(":id_planilla_persona_contrato", $datos["id_planilla_persona_contrato"], PDO::PARAM_INT);
		$stmt->bindParam(":dias_trabajados", $datos["dias_trabajados"], PDO::PARAM_INT);
		$stmt->bindParam(":total_ganado", $datos["total_ganado"], PDO::PARAM_INT);
		$stmt->bindParam(":desc_afp", $datos["desc_afp"], PDO::PARAM_INT);
		$stmt->bindParam(":total_desc", $datos["total_desc"], PDO::PARAM_INT);
		$stmt->bindParam(":liquido_pagable", $datos["liquido_pagable"], PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";

		} else {
			
			return "error";

		}
		
		$stmt->close();
		$stmt = null;

	}

}