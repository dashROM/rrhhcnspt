<?php

require_once "../controladores/personas.controlador.php";
require_once "../modelos/personas.modelo.php";

class AjaxPersonas {

	/*=============================================
	MOSTRAR LISTADO DE PERSONA
	=============================================*/

	public function ajaxMostrarListaPersonas()	{

		$item = null;
		$valor1 = null;
		$valor2 = null;

		$respuesta = ControladorPersonas::ctrMostrarPersonas($item, $valor1, $valor2);

		echo json_encode($respuesta);

	}

	public $id_persona;
	
	/*=============================================
	MOSTRAR DATOS PERSONA
	=============================================*/

	public function ajaxMostrarPersona()	{

		$item = "id_persona";
		$valor1 = $this->id_persona;
		$valor2 = null;

		$respuesta = ControladorPersonas::ctrMostrarPersonas($item, $valor1, $valor2);

		echo json_encode($respuesta);

	}

	public $paterno_persona;
	public $materno_persona;
	public $nombre_persona;
	public $foto_persona;
	public $ci_persona;
	public $ext_ci_persona;
	public $fecha_nacimiento;
	public $sexo_persona;
	public $estado_civil;
	public $direccion_persona;
	public $telefono_persona;
	public $email_persona;
	public $matricula;

	/*=============================================
	NUEVO PERSONA
	=============================================*/

	public function ajaxNuevoPersona()	{

		/*============================================= 			
		VALIDAR IMAGEN
	 	=============================================*/

		$ruta = "";

		if (isset($this->foto_persona["tmp_name"]) && $this->foto_persona["tmp_name"] != "") {

			list($ancho, $alto) = getimagesize($this->foto_persona["tmp_name"]);
			
			$nuevoAncho = 500;
			$nuevoAlto = 650;

			/*=============================================
			CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
			=============================================*/

			// $directorio = "../vistas/img/personas/".$this->ci_persona;

			// mkdir($directorio, 0755);

			/*=============================================
			DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
			=============================================*/

			if ($this->foto_persona["type"] == "image/jpeg") {
				
				/*=============================================
				GUARDAMOS LA IMAGEN EN EL DIRECTORIO
				=============================================*/

				$aleatorio = mt_rand(100000,999999);

				// $ruta = "../vistas/img/personas/".$this->ci_persona."/".$aleatorio.".jpg";

				$ruta = "../vistas/img/personas/".$this->ci_persona."-".$aleatorio.".jpg";

				$origen = imagecreatefromjpeg($this->foto_persona["tmp_name"]);

				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				// imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				imagejpeg($destino, $ruta);

			}

			if ($this->foto_persona["type"] == "image/png") {
				
				/*=============================================
				GUARDAMOS LA IMAGEN EN EL DIRECTORIO
				=============================================*/

				// $aleatorio = mt_rand(100,999);

				// $ruta = "../vistas/img/personas/".$this->ci_persona."/".$aleatorio.".png";

				$aleatorio = mt_rand(100000,999999);

				$ruta = "../vistas/img/personas/".$this->ci_persona."-".$aleatorio.".png";

				$origen = imagecreatefrompng($this->foto_persona["tmp_name"]);

				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				// imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				imagepng($destino, $ruta);

			}

			$ruta = substr($ruta,3);

		}

		/*=============================================
		GENERAR LA MATRICULA
		=============================================*/

		$anio = date("y", strtotime($this->fecha_nacimiento));

		if ($this->sexo_persona == "FEMENINO") {

			$mes = date("m", strtotime($this->fecha_nacimiento))+50;

		} else {

			$mes = date("m", strtotime($this->fecha_nacimiento));

		}
		
		$dia = date("d", strtotime($this->fecha_nacimiento));

		$paterno = $this->paterno_persona;
		$materno = $this->materno_persona;
		$nombre = $this->nombre_persona;

		$matricula = $anio.$mes.$dia.substr($paterno, 0, 1).substr($materno, 0, 1).substr($nombre, 0, 1);

		$datos = array("paterno_persona"     => mb_strtoupper($this->paterno_persona,'utf-8'), 
						       "materno_persona"	   => mb_strtoupper($this->materno_persona,'utf-8'),
						       "nombre_persona"      => mb_strtoupper($this->nombre_persona,'utf-8'),  
						       "foto_persona"     	 => $ruta,
						       "ci_persona"  	       => $this->ci_persona,
						       "ext_ci_persona"   	 => $this->ext_ci_persona,
						       "fecha_nacimiento"    => $this->fecha_nacimiento,
						       "sexo_persona"   	   => $this->sexo_persona,
						       "estado_civil"   	   => $this->estado_civil,
						       "direccion_persona"   => mb_strtoupper($this->direccion_persona,'utf-8'),
						       "telefono_persona"    => $this->telefono_persona,
						       "email_persona"   	   => $this->email_persona,
						       "matricula_persona"   => mb_strtoupper($matricula,'utf-8'),
						);	

		$respuesta = ControladorPersonas::ctrNuevoPersona($datos);

		echo $respuesta;

	}

	public $foto_actual;

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	public function ajaxEditarPersona()	{

		/*============================================= 			
		VALIDAR IMAGEN
	 	=============================================*/

		$ruta = $this->foto_actual;

		if (isset($this->foto_persona["tmp_name"]) && $this->foto_persona["tmp_name"] != "") {

			list($ancho, $alto) = getimagesize($this->foto_persona["tmp_name"]);
			
			$nuevoAncho = 500;
			$nuevoAlto = 650;

			/*=============================================
			CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
			=============================================*/

			// $directorio = "../vistas/img/personas/".$this->ci_actual;

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

			if ($this->foto_persona["type"] == "image/jpeg") {
				
				/*=============================================
				GUARDAMOS LA IMAGEN EN EL DIRECTORIO
				=============================================*/

				// $aleatorio = mt_rand(100,999);

				// $ruta = "../vistas/img/personas/".$this->ci_actual."/".$aleatorio.".jpg";

				$aleatorio = mt_rand(100000,999999);

				$ruta = "../vistas/img/personas/".$this->ci_persona."-".$aleatorio.".jpg";

				$origen = imagecreatefromjpeg($this->foto_persona["tmp_name"]);

				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				// imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				imagejpeg($destino, $ruta);

			}

			if ($this->foto_persona["type"] == "image/png") {
				
				/*=============================================
				GUARDAMOS LA IMAGEN EN EL DIRECTORIO
				=============================================*/

				// $aleatorio = mt_rand(100,999);

				// $ruta = "../vistas/img/personas/".$this->ci_actual."/".$aleatorio.".png";

				$aleatorio = mt_rand(100000,999999);

				$ruta = "../vistas/img/personas/".$this->ci_persona."-".$aleatorio.".png";

				$origen = imagecreatefrompng($this->foto_persona["tmp_name"]);

				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				// imagecopyresized(dst_image, src_image, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h);

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				imagepng($destino, $ruta);

			}

			$ruta = substr($ruta,3);

		}

		/*=============================================
		GENERAR LA MATRICULA
		=============================================*/

		$anio = date("y", strtotime($this->fecha_nacimiento));

		if ($this->sexo_persona == "FEMENINO") {

			$mes = date("m", strtotime($this->fecha_nacimiento))+50;

		} else {

			$mes = date("m", strtotime($this->fecha_nacimiento));

		}
		
		$dia = date("d", strtotime($this->fecha_nacimiento));

		$paterno = $this->paterno_persona;
		$materno = $this->materno_persona;
		$nombre = $this->nombre_persona;

		$matricula = $anio.$mes.$dia.substr($paterno, 0, 1).substr($materno, 0, 1).substr($nombre, 0, 1);

		$datos = array("paterno_persona"    => mb_strtoupper($this->paterno_persona,'utf-8'), 
						       "materno_persona"	  => mb_strtoupper($this->materno_persona,'utf-8'),
						       "nombre_persona"     => mb_strtoupper($this->nombre_persona,'utf-8'),  
						       "foto_persona"     	=> $ruta,
						       "ci_persona"  	      => $this->ci_persona,
						       "ext_ci_persona"   	=> $this->ext_ci_persona,
						       "fecha_nacimiento"   => $this->fecha_nacimiento,
						       "sexo_persona"   	  => $this->sexo_persona,
						       "estado_civil"   	  => $this->estado_civil,
						       "direccion_persona"  => mb_strtoupper($this->direccion_persona,'utf-8'),
						       "telefono_persona"   => $this->telefono_persona,
						       "email_persona"   	  => $this->email_persona,
						       "matricula_persona"  => mb_strtoupper($matricula,'utf-8'),
						       "id_persona"   		  => $this->id_persona,
						);	

		$respuesta = ControladorPersonas::ctrEditarPersona($datos);

		echo $respuesta;

	}

	/*=============================================
	VALIDAR NO REPETIR PERSONAS
	=============================================*/

	public $validarPersona;

	public function ajaxValidarPersona() {

		$item = "ci_persona";
		$valor1 = $this->validarPersona;
		$valor2 = null;

		$respuesta = ControladorPersonas::ctrMostrarPersonas($item, $valor1, $valor2);

		echo json_encode($respuesta);

	}

}

/*=============================================
MOSTRAR PERSONAS
=============================================*/

if (isset($_POST["mostrarListaPersonas"])) {
	
	$personas = new AjaxPersonas();
	$personas -> persona = $_POST["persona"];
	$personas -> ajaxMostrarListaPersonas();

}

/*=============================================
MOSTRAR PERSONA
=============================================*/

if (isset($_POST["mostrarPersona"])) {
	
	$personas = new AjaxPersonas();
	$personas -> id_persona = $_POST["id_persona"];
	$personas -> ajaxMostrarPersona();

}

/*=============================================
NUEVO PERSONA
=============================================*/

if (isset($_POST["nuevoPersona"])) {

	$nuevoPersona = new AjaxPersonas();
	$nuevoPersona -> paterno_persona = $_POST["nuevoPaternoPersona"];
	$nuevoPersona -> materno_persona = $_POST["nuevoMaternoPersona"];
	$nuevoPersona -> nombre_persona = $_POST["nuevoNombrePersona"];
	$nuevoPersona -> foto_persona = $_FILES["nuevaFotoPersona"];
	$nuevoPersona -> ci_persona = $_POST["nuevoCIPersona"];
	$nuevoPersona -> ext_ci_persona = $_POST["nuevoExtCIPersona"];
	$nuevoPersona -> fecha_nacimiento = $_POST["nuevoFechaNacimientoPersona"];
	$nuevoPersona -> sexo_persona = $_POST["nuevoSexoPersona"];
	$nuevoPersona -> estado_civil = $_POST["nuevoEstadoCivilPersona"];
	$nuevoPersona -> direccion_persona = $_POST["nuevoDireccionPersona"];
	$nuevoPersona -> telefono_persona = $_POST["nuevoTelefonoPersona"];
	$nuevoPersona -> email_persona = $_POST["nuevoEmailPersona"];

	$nuevoPersona -> ajaxNuevoPersona();

}

/*=============================================
EDITAR PERSONA
=============================================*/

if (isset($_POST["editarPersona"])) {

	$editarPersona = new AjaxPersonas();
	$editarPersona -> paterno_persona = $_POST["editarPaternoPersona"];
	$editarPersona -> materno_persona = $_POST["editarMaternoPersona"];
	$editarPersona -> nombre_persona = $_POST["editarNombrePersona"];
	$editarPersona -> foto_persona = $_FILES["editarFotoPersona"];
	$editarPersona -> foto_actual = $_POST["fotoActualPersona"];
	$editarPersona -> ci_persona = $_POST["editarCIPersona"];
	$editarPersona -> ext_ci_persona = $_POST["editarExtCIPersona"];
	$editarPersona -> fecha_nacimiento = $_POST["editarFechaNacimientoPersona"];
	$editarPersona -> sexo_persona = $_POST["editarSexoPersona"];
	$editarPersona -> estado_civil = $_POST["editarEstadoCivilPersona"];
	$editarPersona -> direccion_persona = $_POST["editarDireccionPersona"];
	$editarPersona -> telefono_persona = $_POST["editarTelefonoPersona"];
	$editarPersona -> email_persona = $_POST["editarEmailPersona"];
	$editarPersona -> id_persona = $_POST["editarIdPersona"];

	$editarPersona -> ajaxEditarPersona();

}


/*=============================================
VALIDAR NO REPETIR PERSONA
=============================================*/

if (isset($_POST["validarPersona"])) {

	$valPersona = new AjaxPersonas();
	$valPersona -> validarPersona = $_POST["validarPersona"];
	$valPersona -> ajaxValidarPersona();

}