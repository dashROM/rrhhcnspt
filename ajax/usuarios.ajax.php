<?php

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxUsuarios {

	public $id_usuario;

	/*=============================================
	MOSTRAR DATOS USUARIO
	=============================================*/

	public function ajaxMostrarUsuario()	{

		$item = "id_usuario";
		$valor1 = $this->id_usuario;
		$valor2 = null;

		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor1, $valor2);

		echo json_encode($respuesta);

	}

	public $paterno_usuario;
	public $materno_usuario;
	public $nombre_usuario;
	public $nick_usuario;
	public $password;
	public $foto_usuario;
	public $ci_usuario;
	public $ext_ci_usuario;
	public $telefono_usuario;
	public $email_usuario;
	public $perfil_usuario;
	public $observaciones;

	/*=============================================
	NUEVO USUARIO
	=============================================*/

	public function ajaxNuevoUsuario()	{

		/*============================================= 			
		VALIDAR IMAGEN
	 	=============================================*/

		$ruta = "";

		if (isset($this->foto_usuario["tmp_name"]) && $this->foto_usuario["tmp_name"] != "") {

			list($ancho, $alto) = getimagesize($this->foto_usuario["tmp_name"]);
			
			$nuevoAncho = 500;
			$nuevoAlto = 500;

			/*=============================================
			CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
			=============================================*/

			// $directorio = "../vistas/img/usuarios/".$this->nick_usuario;

			// mkdir($directorio, 0755);

			/*=============================================
			DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
			=============================================*/

			if ($this->foto_usuario["type"] == "image/jpeg") {
				
				/*=============================================
				GUARDAMOS LA IMAGEN EN EL DIRECTORIO
				=============================================*/

				// $aleatorio = mt_rand(100,999);

				// $ruta = "../vistas/img/usuarios/".$this->nick_usuario."/".$aleatorio.".jpg";

				$aleatorio = mt_rand(100000,999999);

				$ruta = "../vistas/img/usuarios/".$aleatorio.".jpg";

				$origen = imagecreatefromjpeg($this->foto_usuario["tmp_name"]);

				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				// imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				imagejpeg($destino, $ruta);

			}

			if ($this->foto_usuario["type"] == "image/png") {
				
				/*=============================================
				GUARDAMOS LA IMAGEN EN EL DIRECTORIO
				=============================================*/

				// $aleatorio = mt_rand(100,999);

				// $ruta = "../vistas/img/usuarios/".$this->nick_usuario."/".$aleatorio.".png";

				$aleatorio = mt_rand(100000,999999);

				$ruta = "../vistas/img/usuarios/".$aleatorio.".png";

				$origen = imagecreatefrompng($this->foto_usuario["tmp_name"]);

				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				// imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				imagepng($destino, $ruta);

			}

			$ruta = substr($ruta,3);

		}

		$encriptar = crypt($this->password, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

		$datos = array( "paterno_usuario"     => mb_strtoupper($this->paterno_usuario,'utf-8'), 
						"materno_usuario"	  => mb_strtoupper($this->materno_usuario,'utf-8'),
						"nombre_usuario"      => mb_strtoupper($this->nombre_usuario,'utf-8'),  
						"nick_usuario"     	  => mb_strtoupper($this->nick_usuario,'utf-8'),
						"password_usuario"    => $encriptar,
						"foto_usuario"     	  => $ruta,
						"ci_usuario"  	      => $this->ci_usuario,
						"ext_ci_usuario"   	  => $this->ext_ci_usuario,
						"telefono_usuario"    => $this->telefono_usuario,
						"email_usuario"   	  => $this->email_usuario,
						"perfil_usuario"   	  => $this->perfil_usuario,
						);	

		$respuesta = ControladorUsuarios::ctrNuevoUsuario($datos);

		echo $respuesta;

	}

	public $foto_actual;
	public $password_actual; 

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	public function ajaxEditarUsuario()	{

		/*============================================= 			VALIDAR IMAGEN
	 	=============================================*/

		$ruta = $this->foto_actual;

		if (isset($this->foto_usuario["tmp_name"]) && $this->foto_usuario["tmp_name"] != "") {

			list($ancho, $alto) = getimagesize($this->foto_usuario["tmp_name"]);
			
			$nuevoAncho = 500;
			$nuevoAlto = 500;

			/*=============================================
			CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
			=============================================*/

			// $directorio = "../vistas/img/usuarios/".$this->nick_usuario;

			/*=============================================
			PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
			=============================================*/

			if (!empty($this->foto_actual)) {

				unlink("../".$this->foto_actual);

			} else {

				// mkdir($directorio, 0755);

			}

			/*=============================================
			DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
			=============================================*/

			if ($this->foto_usuario["type"] == "image/jpeg") {
				
				/*=============================================
				GUARDAMOS LA IMAGEN EN EL DIRECTORIO
				=============================================*/

				// $aleatorio = mt_rand(100,999);

				// $ruta = "../vistas/img/usuarios/".$this->nick_usuario."/".$aleatorio.".jpg";

				$aleatorio = mt_rand(100000,999999);

				$ruta = "../vistas/img/usuarios/".$aleatorio.".jpg";

				$origen = imagecreatefromjpeg($this->foto_usuario["tmp_name"]);

				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				// imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				imagejpeg($destino, $ruta);

			}

			if ($this->foto_usuario["type"] == "image/png") {
				
				/*=============================================
				GUARDAMOS LA IMAGEN EN EL DIRECTORIO
				=============================================*/

				// $aleatorio = mt_rand(100,999);

				// $ruta = "../vistas/img/usuarios/".$this->nick_usuario."/".$aleatorio.".png";

				$aleatorio = mt_rand(100000,999999);

				$ruta = "../vistas/img/usuarios/".$aleatorio.".png";

				$origen = imagecreatefrompng($this->foto_usuario["tmp_name"]);

				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				// imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				imagepng($destino, $ruta);

			}

			$ruta = substr($ruta,3);

		}

		if ($this->password != "") {

			$encriptar = crypt($this->password, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

		} else {

			$encriptar = $this->password_actual;
		}

		$datos = array( "paterno_usuario"     => mb_strtoupper($this->paterno_usuario,'utf-8'), 
						"materno_usuario"	  => mb_strtoupper($this->materno_usuario,'utf-8'),
						"nombre_usuario"      => mb_strtoupper($this->nombre_usuario,'utf-8'),  
						"nick_usuario"     	  => mb_strtoupper($this->nick_usuario,'utf-8'),
						"password_usuario"    => $encriptar,
						"foto_usuario"     	  => $ruta,
						"ci_usuario"  	      => $this->ci_usuario,
						"ext_ci_usuario"   	  => $this->ext_ci_usuario,
						"telefono_usuario"    => $this->telefono_usuario,
						"email_usuario"   	  => $this->email_usuario,
						"perfil_usuario"   	  => $this->perfil_usuario,
						"id_usuario"   		  => $this->id_usuario,
						);	

		$respuesta = ControladorUsuarios::ctrEditarUsuario($datos);

		echo $respuesta;

	}
	
	/*=============================================
	CARGAR DATOS AL FORMULARIO EDITAR USUARIO
	=============================================*/
	
	// public $idUsuario;

	// public function ajaxCargarUsuario()	{
		
	// 	$item = "idUsuario";
	// 	$valor = $this->idUsuario;

	// 	$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

	// 	echo json_encode($respuesta);

	// }

	/*=============================================
	ACTIVAR USUARIO
	=============================================*/

	public $activarUsuario;
	public $activarId;

	public function ajaxActivarUsuario() {
		
		$tabla = "usuarios";

		$item1 = "estado_usuario";
		$valor1 = $this->activarUsuario;

		$item2 = "id_usuario";
		$valor2 = $this->activarId;

		$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

	}

	/*=============================================
	VALIDAR NO REPETIR USUARIO
	=============================================*/

	public $validarUsuario;

	public function ajaxValidarUsuario() {

		$item = "nick_usuario";
		$valor = $this->validarUsuario;

		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

		echo json_encode($respuesta);

	}

}

/*=============================================
MOSTRAR USUARIO
=============================================*/

if (isset($_POST["mostrarUsuario"])) {
	
	$usuarios = new AjaxUsuarios();
	$usuarios -> id_usuario = $_POST["id_usuario"];
	$usuarios-> ajaxMostrarUsuario();

}

/*=============================================
NUEVO USUARIO
=============================================*/

if (isset($_POST["nuevoUsuario"])) {

	$nuevoUsuario = new AjaxUsuarios();
	$nuevoUsuario -> paterno_usuario = $_POST["nuevoPaternoUsuario"];
	$nuevoUsuario -> materno_usuario = $_POST["nuevoMaternoUsuario"];
	$nuevoUsuario -> nombre_usuario = $_POST["nuevoNombreUsuario"];
	$nuevoUsuario -> nick_usuario = $_POST["nuevoNickUsuario"];
	$nuevoUsuario -> password = $_POST["nuevoPassword"];
	$nuevoUsuario -> foto_usuario = $_FILES["nuevoFotoUsuario"];
	$nuevoUsuario -> ci_usuario = $_POST["nuevoCIUsuario"];
	$nuevoUsuario -> ext_ci_usuario = $_POST["nuevoExtCIUsuario"];
	$nuevoUsuario -> telefono_usuario = $_POST["nuevoTelefonoUsuario"];
	$nuevoUsuario -> email_usuario = $_POST["nuevoEmailUsuario"];
	$nuevoUsuario -> perfil_usuario = $_POST["nuevoPerfilUsuario"];

	$nuevoUsuario -> ajaxNuevoUsuario();

}

/*=============================================
EDITAR USUARIO
=============================================*/

if (isset($_POST["editarUsuario"])) {

	$editarUsuario = new AjaxUsuarios();
	$editarUsuario -> paterno_usuario = $_POST["editarPaternoUsuario"];
	$editarUsuario -> materno_usuario = $_POST["editarMaternoUsuario"];
	$editarUsuario -> nombre_usuario = $_POST["editarNombreUsuario"];
	$editarUsuario -> nick_usuario = $_POST["editarNickUsuario"];
	$editarUsuario -> password = $_POST["editarPassword"];
	$editarUsuario -> password_actual = $_POST["passwordActual"];
	$editarUsuario -> foto_usuario = $_FILES["editarFotoUsuario"];
	$editarUsuario -> foto_actual = $_POST["fotoActualUsuario"];
	$editarUsuario -> ci_usuario = $_POST["editarCIUsuario"];
	$editarUsuario -> ext_ci_usuario = $_POST["editarExtCIUsuario"];
	$editarUsuario -> telefono_usuario = $_POST["editarTelefonoUsuario"];
	$editarUsuario -> email_usuario = $_POST["editarEmailUsuario"];
	$editarUsuario -> perfil_usuario = $_POST["editarPerfilUsuario"];
	$editarUsuario -> id_usuario = $_POST["editarIdUsuario"];

	$editarUsuario -> ajaxEditarUsuario();

}

/*=============================================
ACTIVAR USUARIO
=============================================*/

if (isset($_POST["activarUsuario"])) {

	$activarUsuario = new AjaxUsuarios();
	$activarUsuario -> activarUsuario = $_POST["activarUsuario"];
	$activarUsuario -> activarId = $_POST["activarId"];
	$activarUsuario -> ajaxActivarUsuario();

}

/*=============================================
VALIDAR NO REPETIR USUARIO
=============================================*/

if (isset($_POST["validarUsuario"])) {

	$valUsuario = new AjaxUsuarios();
	$valUsuario -> validarUsuario = $_POST["validarUsuario"];
	$valUsuario -> ajaxValidarUsuario();

}