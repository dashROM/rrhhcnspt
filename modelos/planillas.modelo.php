<?php

require_once "conexion.db.php";

class ModeloPlanillas {

	/*=============================================
	MOSTRAR RELACION
	=============================================*/
	
	static public function mdlMostrarRelacion($tabla, $item, $valor1, $valor2) {

		if ($item != null) {
			
			if ($valor2 != null) {

				$stmt = Conexion::conectarPG()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND id_planilla != :id_planilla");

				$stmt->bindParam(":".$item, $valor1, PDO::PARAM_STR);
				$stmt->bindParam(":id_planilla", $valor2, PDO::PARAM_INT);

			} else {


				$stmt = Conexion::conectarPG()->prepare("SELECT p.id_planilla, p.titulo_relacion, p.titulo_planilla, p.mes_planilla, p.gestion_planilla, c.nombre_contrato FROM planillas p, contratos c WHERE p.id_contrato = c.id_contrato AND $item = :$item");

				$stmt->bindParam(":".$item, $valor1, PDO::PARAM_STR);
 
			}			

			$stmt->execute();

			return $stmt->fetch();

		} else {

			$sql = "SELECT p.id_planilla, p.titulo_relacion, p.titulo_planilla, p.mes_planilla, p.gestion_planilla, c.nombre_contrato FROM planillas p, contratos c WHERE p.id_contrato = c.id_contrato ORDER BY p.id_planilla DESC";

			$stmt = Conexion::conectarPG()->prepare($sql);

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR PLANILLA
	=============================================*/
	
	static public function mdlMostrarPlanillas($tabla, $item, $valor1, $valor2) {

		if ($item != null) {
			
			if ($valor2 != null) {

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND id_planilla != :id_planilla");

				$stmt->bindParam(":".$item, $valor1, PDO::PARAM_STR);
				$stmt->bindParam(":id_planilla", $valor2, PDO::PARAM_INT);

			} else {

				$stmt = Conexion::conectar()->prepare("SELECT p.id_planilla, p.titulo_planilla, p.mes_planilla, p.gestion_planilla, c.tipo_contrato FROM planillas_tbl p, contratos_tbl c WHERE p.id_contrato = c.id_contrato AND $item = :$item");

				$stmt->bindParam(":".$item, $valor1, PDO::PARAM_STR);
 
			}			

			$stmt->execute();

			return $stmt->fetch();

		} else {

			$sql = "SELECT p.id_planilla, p.titulo_planilla, p.mes_planilla, p.gestion_planilla, c.tipo_contrato FROM planillas_tbl p, contratos_tbl c WHERE p.id_contrato = c.id_contrato";

			$stmt = Conexion::conectar()->prepare($sql);

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();
		$stmt = null;

	}
	
	/*=============================================
	CREAR NUEVO RELACION DE NOVEDADES
	=============================================*/
	
	static public function mdlNuevoRelacion($tabla, $datos){

		$pdo = Conexion::conectarPG();

		try {
 
		    //Inicio de las transacciones.

		    $pdo->beginTransaction();
		 
		    // Consulta 1: Ingreso de datos por defecto en la tabla fichas.

		    $sql1 = "INSERT INTO $tabla(mes_planilla, gestion_planilla, id_contrato, titulo_relacion) VALUES (:mes_planilla, :gestion_planilla, :id_contrato, :titulo_relacion)";

			$stmt = $pdo->prepare($sql1);

			$stmt->bindParam(":titulo_relacion", $datos["titulo_relacion"], PDO::PARAM_STR);
			$stmt->bindParam(":mes_planilla", $datos["mes_planilla"], PDO::PARAM_STR);
			$stmt->bindParam(":gestion_planilla", $datos["gestion_planilla"], PDO::PARAM_STR);
			$stmt->bindParam(":id_contrato", $datos["id_contrato"], PDO::PARAM_INT);

			if($stmt->execute()){

				// return $pdo->lastInsertId();
				$id_planilla = $pdo->lastInsertId();

				// Consulta 2: Ingreso de Datos por defecto en la tabla pacientes_asegurados.

				$sql2 = "INSERT INTO planilla_persona_contratos(id_persona_contrato, id_planilla) SELECT id_persona_contrato, :id_planilla FROM persona_contratos WHERE fin_contrato > :fecha_calculo AND :mes_planilla >= EXTRACT(MONTH FROM inicio_contrato) AND :gestion_planilla >= EXTRACT(YEAR FROM inicio_contrato) AND id_contrato = :id_contrato";

				$stmt = $pdo->prepare($sql2);

				$stmt->bindParam(":id_planilla", $id_planilla, PDO::PARAM_INT);
				$stmt->bindParam(":id_contrato", $datos["id_contrato"], PDO::PARAM_INT);
				$stmt->bindParam(":fecha_calculo", $datos["fecha_calculo"], PDO::PARAM_STR);
				$stmt->bindParam(":mes_planilla", $datos["mes_planilla"], PDO::PARAM_STR);
				$stmt->bindParam(":gestion_planilla", $datos["gestion_planilla"], PDO::PARAM_STR);

				if ($stmt->execute()) {

					// Permitir la transacción.
					$pdo->commit();

					return "ok";

				} else{

					// Revertir la transacción.
					$pdo->rollBack();

					return "error2";
				
				}
			} else {

				// Revertir la transacción.
				$pdo->rollBack();

	    		return "error1";

			}

		} 
		// Bloque de captura manejará cualquier excepción que se lance.
		catch (Exception $e){
		    // Se ha producido una excepción, lo que significa que una de nuestras consultas de base de datos hafallado
		    // Imprimiendo mensaje de error.
		    echo $e->getMessage();
		    // Revertir la transacción.
		    $pdo->rollBack();

		    return "error";

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR RELACION DE NOVEDADES
	=============================================*/
	
	static public function mdlEditarRelacion($tabla, $datos){

		$stmt = Conexion::conectarPG()->prepare("UPDATE $tabla SET titulo_relacion = :titulo_relacion  WHERE id_planilla = :id_planilla");

		$stmt->bindParam(":id_planilla", $datos["id_planilla"], PDO::PARAM_INT);
		$stmt->bindParam(":titulo_relacion", $datos["titulo_relacion"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR PLANILLA GENERADA
	=============================================*/
	
	static public function mdlMostrarGenerarRelacion($item, $valor1, $valor2) {

		if ($item != null) {
			
			if ($valor2 != null) {

				$stmt = Conexion::conectarPG()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND id_planilla != :id_planilla");

				$stmt->bindParam(":".$item, $valor1, PDO::PARAM_STR);
				$stmt->bindParam(":id_planilla", $valor2, PDO::PARAM_INT);

			} else {

				$sql = "SELECT ppc.id_planilla_persona_contrato, pe.id_persona, est.abrev_establecimiento, pe.paterno_persona, pe.materno_persona, pe.nombre_persona, concat_ws(' ', pe.ci_persona, pe.ext_ci_persona) AS ci_persona, c.nombre_cargo, c.haber_basico, ppc.dias_trabajados, pc.inicio_contrato, pc.fin_contrato FROM personas pe, establecimientos est, cargos c, persona_contratos pc, planilla_persona_contratos ppc WHERE pc.id_establecimiento = est.id_establecimiento AND pc.id_cargo = c.id_cargo AND pc.id_persona = pe.id_persona AND pc.id_persona_contrato = ppc.id_persona_contrato AND ppc.$item = :$item";

				$stmt = Conexion::conectarPG()->prepare($sql);

				$stmt->bindParam(":".$item, $valor1, PDO::PARAM_STR);

			}			

			$stmt->execute();

			return $stmt->fetchAll();

		} else {

			$sql = "SELECT ppc.id_planilla_persona_contrato, pe.id_persona, est.abrev_establecimiento, pe.paterno_persona, pe.materno_persona, pe.nombre_persona, concat_ws(' ', pe.ci_persona, pe.ext_ci_persona) AS ci_persona, c.nombre_cargo, c.haber_basico, ppc.dias_trabajados, pc.inicio_contrato, pc.fin_contrato FROM personas pe, establecimientos est, cargos c, persona_contratos pc, planilla_persona_contratos ppc WHERE pc.id_establecimiento = est.id_establecimiento AND pc.id_cargo = c.id_cargo AND pc.id_persona = pe.id_persona AND pc.id_persona_contrato = ppc.id_persona_contrato";

			$stmt = Conexion::conectarPG()->prepare($sql);

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();
		$stmt = null;

	}
	
}

