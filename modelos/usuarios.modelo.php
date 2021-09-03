<?php

require_once "conexion.db.php";

class ModeloUsuarios {
	
	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/
	
	static public function mdlMostrarUsuarios($tabla, $item, $valor) {

		if ($item != null) {
			
			$stmt = Conexion::conectarPG()->prepare("SELECT * FROM  $tabla WHERE $item = :$item");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();

		} else {

			$stmt = Conexion::conectarPG()->prepare("SELECT id_usuario, concat_ws(' ', paterno_usuario, materno_usuario, nombre_usuario) AS nombre_completo, nick_usuario ,foto_usuario, concat_ws(' ', ci_usuario, ext_ci_usuario) AS ci_usuario, telefono_usuario, email_usuario, perfil_usuario, estado_usuario, fecha_registro FROM  $tabla ORDER BY id_usuario DESC");

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	REGISTRO DE NUEVO USUARIO
	=============================================*/

	static public function mdlNuevoUsuario($tabla, $datos) {

		$stmt = Conexion::conectarPG()->prepare("INSERT INTO $tabla(paterno_usuario, materno_usuario, nombre_usuario, nick_usuario, password_usuario, foto_usuario, ci_usuario, ext_ci_usuario, telefono_usuario, email_usuario, perfil_usuario, fecha_registro) VALUES (:paterno_usuario, :materno_usuario, :nombre_usuario, :nick_usuario, :password_usuario, :foto_usuario, :ci_usuario, :ext_ci_usuario, :telefono_usuario, :email_usuario, :perfil_usuario, current_timestamp)");

		$stmt->bindParam(":paterno_usuario", $datos["paterno_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":materno_usuario", $datos["materno_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_usuario", $datos["nombre_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":nick_usuario", $datos["nick_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password_usuario", $datos["password_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":foto_usuario", $datos["foto_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":ci_usuario", $datos["ci_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":ext_ci_usuario", $datos["ext_ci_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono_usuario", $datos["telefono_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":email_usuario", $datos["email_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":perfil_usuario", $datos["perfil_usuario"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			
			return "ok";

		} else {
			
			return "error";

		}
		
		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function mdlEditarUsuario($tabla, $datos) {

		$stmt = Conexion::conectarPG()->prepare("UPDATE $tabla SET paterno_usuario = :paterno_usuario, materno_usuario = :materno_usuario, nombre_usuario = :nombre_usuario, nick_usuario = :nick_usuario, password_usuario = :password_usuario, foto_usuario = :foto_usuario, ci_usuario = :ci_usuario, ext_ci_usuario = :ext_ci_usuario, telefono_usuario = :telefono_usuario, email_usuario = :email_usuario, perfil_usuario = :perfil_usuario WHERE id_usuario = :id_usuario");

		$stmt->bindParam(":paterno_usuario", $datos["paterno_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":materno_usuario", $datos["materno_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_usuario", $datos["nombre_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":nick_usuario", $datos["nick_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password_usuario", $datos["password_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":foto_usuario", $datos["foto_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":ci_usuario", $datos["ci_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":ext_ci_usuario", $datos["ext_ci_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono_usuario", $datos["telefono_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":email_usuario", $datos["email_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":perfil_usuario", $datos["perfil_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);

		if ($stmt->execute()) {
			
			return "ok";

		} else {
			
			return "error";

		}
		
		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR USUARIO
	=============================================*/

	static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2) {

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
	BORRAR USUARIO
	=============================================*/

	static public function mdlBorrarUsuario($tabla, $datos)	{
		
		$stmt = Conexion::conectarPG()->prepare("DELETE FROM $tabla WHERE idUsuario = :idUsuario");

		$stmt->bindParam(":idUsuario", $datos, PDO::PARAM_INT);

		if ($stmt->execute()) {
			
			return "ok";

		} else {
			
			return "error";

		}
		
		$stmt->close();
		$stmt = null;

	}

}