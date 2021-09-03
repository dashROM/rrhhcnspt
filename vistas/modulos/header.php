<!-- top navigation -->
<div class="top_nav">

  <div class="nav_menu">

    <div class="nav toggle">
      <a id="menu_toggle"><i class="fa fa-bars"></i></a>

    </div>

    <nav class="nav navbar-nav">

      <ul class=" navbar-right">

        <li class="nav-item dropdown open" style="padding-left: 15px;">

          <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">

            <?php 

            if ($_SESSION["foto_rrhh"] != "") {
              
              echo '<img src="https://localhost/rrhhcnspt/'.$_SESSION["foto_rrhh"].'">'.$_SESSION["nombre_rrhh"];

            } else {

              echo '<img src="https://localhost/rrhhcnspt/vistas/img/usuarios/default/anonymous.png">'.$_SESSION["nombre_rrhh"];
            }

            ?>

          </a>

          <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
          
            <a href="https://localhost/rrhhcnspt/salir" class="dropdown-item"><i class="fa fa-sign-out pull-right"></i> Cerrar Sesión</a>

          </div>

        </li>

      </ul>

    </nav>

  </div>

</div>
<!-- /top navigation -->