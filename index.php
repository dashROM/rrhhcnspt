<?php 

require_once "controladores/template.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/personas.controlador.php";
require_once "controladores/empleados.controlador.php";
require_once "controladores/establecimientos.controlador.php";
require_once "controladores/cargos.controlador.php";
require_once "controladores/contratos.controlador.php";
require_once "controladores/suplencias.controlador.php";
require_once "controladores/planillas.controlador.php";
require_once "controladores/planillas_empleados.controlador.php";

require_once "modelos/usuarios.modelo.php";
require_once "modelos/personas.modelo.php";
require_once "modelos/empleados.modelo.php";
require_once "modelos/establecimientos.modelo.php";
require_once "modelos/cargos.modelo.php";
require_once "modelos/contratos.modelo.php";
require_once "modelos/suplencias.modelo.php";
require_once "modelos/planillas.modelo.php";
require_once "modelos/planillas_empleados.modelo.php";

$template = new ControladorTemplate();
$template -> ctrTemplate();
