<?php 
include "vistas/php/config.php";

session_start();

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?= SERVERURL; ?>/vistas/img/template/icono-color.png" type="image/ico" />

  <title>CNS Potosí | RRHH</title>

  <!--=====================================
  PLUGINS CSS
  ======================================-->

  <!-- Bootstrap -->
  <link href="<?= SERVERURL; ?>/vistas/plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Font Awesome Icons -->
  <link href="<?= SERVERURL; ?>/vistas/plugins/fontawesome-free/css/all.min.css" rel="stylesheet" >

  <!-- Font Awesome -->
  <link href="<?= SERVERURL; ?>/vistas/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  
  <!-- NProgress -->
  <link href="<?= SERVERURL; ?>/vistas/plugins/nprogress/nprogress.css" rel="stylesheet">

  <!-- Animate.css -->
  <link href="<?= SERVERURL; ?>/vistas/plugins/animate.css/animate.min.css" rel="stylesheet">
  
  <!-- iCheck -->
  <link href="<?= SERVERURL; ?>/vistas/plugins/iCheck/skins/flat/green.css" rel="stylesheet">
  
  <!-- bootstrap-progressbar -->
  <link href="<?= SERVERURL; ?>/vistas/plugins/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
  
  <!-- JQVMap -->
  <link href="<?= SERVERURL; ?>/vistas/plugins/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>

  <!-- DataTables -->
  <link href="<?= SERVERURL; ?>/vistas/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="<?= SERVERURL; ?>/vistas/plugins/datatables-responsive/css/responsive.bootstrap4.min.css" rel="stylesheet">
  <link href="<?= SERVERURL; ?>/vistas/plugins/datatables-buttons/css/buttons.bootstrap4.min.css" rel="stylesheet">

  <!-- SweetAlert 2 -->
  <link href="<?= SERVERURL; ?>/vistas/plugins/sweetalert2/themes/bootstrap-4.css" rel="stylesheet">

  <!-- Toastr -->
  <link href="<?= SERVERURL; ?>/vistas/plugins/toastr/toastr.min.css" rel="stylesheet">

  <!-- Select2 -->
  <link href="<?= SERVERURL; ?>/vistas/plugins/select2/css/select2.min.css" rel="stylesheet">
  <link href="<?= SERVERURL; ?>/vistas/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css" rel="stylesheet">

  <!-- Switchery -->
  <link href="<?= SERVERURL; ?>/vistas/plugins/switchery/dist/switchery.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="<?= SERVERURL; ?>/vistas/css/custom.css" rel="stylesheet">

  <!--=====================================
  PLUGINS JAVASCRIPT
  ======================================-->

  <!-- jQuery -->
  <script src="<?= SERVERURL; ?>/vistas/plugins/jquery/dist/jquery.min.js"></script>

  <!-- jQuery Validation -->
  <script src="<?= SERVERURL; ?>/vistas/plugins/jquery-validation/jquery.validate.min.js"></script>

  <!-- Bootstrap -->
  <script src="<?= SERVERURL; ?>/vistas/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

  <!-- FastClick -->
  <script src="<?= SERVERURL; ?>/vistas/plugins/fastclick/lib/fastclick.js"></script>

  <!-- NProgress -->
  <script src="<?= SERVERURL; ?>/vistas/plugins/nprogress/nprogress.js"></script>

  <!-- Chart.js -->
  <script src="<?= SERVERURL; ?>/vistas/plugins/Chart.js/dist/Chart.min.js"></script>

  <!-- gauge.js -->
  <script src="<?= SERVERURL; ?>/vistas/plugins/gauge.js/dist/gauge.min.js"></script>

  <!-- bootstrap-progressbar -->
  <script src="<?= SERVERURL; ?>/vistas/plugins/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>

  <!-- iCheck -->
  <script src="<?= SERVERURL; ?>/vistas/plugins/iCheck/icheck.min.js"></script>

  <!-- Skycons -->
  <script src="<?= SERVERURL; ?>/vistas/plugins/skycons/skycons.js"></script>

  <!-- Flot -->
  <script src="<?= SERVERURL; ?>/vistas/plugins/Flot/jquery.flot.js"></script>
  <script src="<?= SERVERURL; ?>/vistas/plugins/Flot/jquery.flot.pie.js"></script>
  <script src="<?= SERVERURL; ?>/vistas/plugins/Flot/jquery.flot.time.js"></script>
  <script src="<?= SERVERURL; ?>/vistas/plugins/Flot/jquery.flot.stack.js"></script>
  <script src="<?= SERVERURL; ?>/vistas/plugins/Flot/jquery.flot.resize.js"></script>

  <!-- Flot plugins -->
  <script src="<?= SERVERURL; ?>/vistas/plugins/flot.orderbars/js/jquery.flot.orderBars.js"></script>
  <script src="<?= SERVERURL; ?>/vistas/plugins/flot-spline/js/jquery.flot.spline.min.js"></script>
  <script src="<?= SERVERURL; ?>/vistas/plugins/flot.curvedlines/curvedLines.js"></script>

  <!-- DateJS -->
  <script src="<?= SERVERURL; ?>/vistas/plugins/DateJS/build/date.js"></script>

  <!-- JQVMap -->
  <script src="<?= SERVERURL; ?>/vistas/plugins/jqvmap/dist/jquery.vmap.js"></script>
  <script src="<?= SERVERURL; ?>/vistas/plugins/jqvmap/dist/maps/jquery.vmap.world.js"></script>
  <script src="<?= SERVERURL; ?>/vistas/plugins/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>

  <!-- DataTables -->
  <script src="<?= SERVERURL; ?>/vistas/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= SERVERURL; ?>/vistas/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= SERVERURL; ?>/vistas/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= SERVERURL; ?>/vistas/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= SERVERURL; ?>/vistas/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= SERVERURL; ?>/vistas/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= SERVERURL; ?>/vistas/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= SERVERURL; ?>/vistas/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= SERVERURL; ?>/vistas/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <!-- SweetAlert 2 -->
  <script src="<?= SERVERURL; ?>/vistas/plugins/sweetalert2/sweetalert2.min.js"></script>

  <!-- Toastr -->
  <script src="<?= SERVERURL; ?>/vistas/plugins/toastr/toastr.min.js"></script>

  <!-- Select2 -->
  <script src="<?= SERVERURL; ?>/vistas/plugins/select2/js/select2.full.min.js"></script>

  <!-- Switchery -->
  <script src="<?= SERVERURL; ?>/vistas/plugins/switchery/dist/switchery.js"></script>

  <!-- InputMask -->
  <script src="<?= SERVERURL; ?>/vistas/plugins/moment/moment.min.js"></script>
  <script src="<?= SERVERURL; ?>/vistas/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>

   <!-- ckEditor -->
  <script src="<?= SERVERURL; ?>/vistas/plugins/ckeditor/ckeditor.js"></script>

  <!-- PDF Objetct --> 
  <script src="<?= SERVERURL; ?>/vistas/plugins/pdf_object/pdfobject.js"></script>

  <!-- Moment.js --> 
  <script src="<?= SERVERURL; ?>/vistas/plugins/moment/moment.js"></script>

</head>

<!--=====================================
CUERPO DOCUMENTO
======================================-->

<?php 

if (isset($_SESSION["iniciarSesion_rrhh"]) && $_SESSION["iniciarSesion_rrhh"] == "ok") {
    
  echo '
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">';

    /*=====================================
    HEADER
    ======================================*/

    include "modulos/header.php";

    /*=====================================
    MENU
    ======================================*/
    
    include "modulos/menu.php";

    /*=====================================
    CONTENIDO
    ======================================*/

    $parametros = array(); 

    if (isset($_GET["ruta"])) {

      $parametros = explode("/", $_GET["ruta"]);
      
      if ($parametros[0] == "inicio" ||
          $parametros[0] == "usuarios" ||
          $parametros[0] == "personas" ||
          $parametros[0] == "detalle-persona" ||
          $parametros[0] == "empleados" ||
          $parametros[0] == "relacion-novedades" ||
          $parametros[0] == "relacion-persona" ||
          $parametros[0] == "planillas" ||
          $parametros[0] == "planilla-personas" ||
          $parametros[0] == "salir") {

        include "modulos/".$parametros[0].".php";

      } else {

        include "modulos/404.php";

      }

    } else {

      include "modulos/inicio.php";

    }

    /*=====================================
    FOOTER
    ======================================*/

    include "modulos/footer.php";

    echo '
      </div>
    </div>';

} else {

  echo '
  <body class="login">';

  include "modulos/login.php";

}

?>

  <!-- Custom Theme Scripts -->
  <script src="<?= SERVERURL; ?>/vistas/js/custom.js"></script>

  <script src="<?= SERVERURL; ?>/vistas/js/template.js"></script>
  <script src="<?= SERVERURL; ?>/vistas/js/usuarios.js"></script>
  <script src="<?= SERVERURL; ?>/vistas/js/personas.js"></script>
  <script src="<?= SERVERURL; ?>/vistas/js/persona_contratos.js"></script>
  <script src="<?= SERVERURL; ?>/vistas/js/empleados.js"></script>
  <script src="<?= SERVERURL; ?>/vistas/js/planillas.js"></script>

  </body>
</html>
