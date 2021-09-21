<div class="col-md-3 left_col">

  <div class="left_col scroll-view">

    <div class="navbar nav_title" style="border: 0;">

      <a href="index.html" class="site_title">

        <img onmouseout="this.src='<?= SERVERURL; ?>/vistas/img/template/icono-blanco.png';" onmouseover="this.src='<?= SERVERURL; ?>/vistas/img/template/icono-color.png';" src="<?= SERVERURL; ?>/vistas/img/template/icono-blanco.png" alt="SISVECOM Logo" class="brand-image elevation-3" style="opacity: .8; width: 30px"> 
        <span class="brand-text font-weight-bold text-success">CNS</span>
        <span class="brand-text font-weight-bold ml-0" style="color: #01ff70;">RRHH</span>

      </a>
    </div>

    <div class="clearfix"></div>

    <!-- menu profile quick info -->
    <div class="profile clearfix">

      <div class="profile_pic">

        <?php 

        if ($_SESSION["foto_rrhh"] != "") {
          
          echo "<img src='".$_SESSION["foto_rrhh"]."' class='img-circle profile_img'>";

        } else {

          echo "<img src='".SERVERURL."/vistas/img/usuarios/default/anonymous.png' class='img-circle profile_img'>";

        }

        ?>

      </div>

      <div class="profile_info">

        <span>Bienvenido,</span>
        <h2><?= $_SESSION["nombre_rrhh"] ?></h2>

      </div>

    </div>
    <!-- /menu profile quick info -->

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

      <div class="menu_section">

        <ul class="nav side-menu">

          <li>

            <a href="<?= SERVERURL; ?>/inicio" class="nav-link menu active" id="inicio">
              <i class="fas fa-home"></i> Inicio 
            </a>

          </li>

          <li>

            <a id="acceso">
              <i class="fas fa-desktop"></i> Administrador Acceso <span class="fas fa-chevron-down"></span>
            </a>

            <ul class="nav child_menu">

              <li><a href="<?= SERVERURL; ?>/usuarios" class="nav-link menu" id="usuarios">Usuarios</a></li>
            
            </ul>
          </li>

          <li>

            <a id="rrhh">

              <i class="fas fa-users"></i> Administrador RRHH <span class="fas fa-chevron-down"></span>

            </a>

            <ul class="nav child_menu">

              <li><a href="<?= SERVERURL; ?>/personas" id="personas">Personas</a></li>

              <li><a href="<?= SERVERURL; ?>/relacion-novedades" id="relacion">Relacion de Novedades</a></li>

              <li><a href="<?= SERVERURL; ?>/planillas" id="relacion">Planillas</a></li>

            </ul>

          </li>
          
        </ul>

      </div>

      <div class="menu_section">
        <h3>Reportes</h3>
        <ul class="nav side-menu">
          <li><a><i class="fa fa-bug"></i> Additional Pages <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="e_commerce.html">E-commerce</a></li>
              <li><a href="projects.html">Projects</a></li>
              <li><a href="project_detail.html">Project Detail</a></li>
              <li><a href="contacts.html">Contacts</a></li>
              <li><a href="profile.html">Profile</a></li>
            </ul>
          </li>
          <li><a><i class="fa fa-windows"></i> Extras <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
              <li><a href="page_403.html">403 Error</a></li>
              <li><a href="page_404.html">404 Error</a></li>
              <li><a href="page_500.html">500 Error</a></li>
              <li><a href="plain_page.html">Plain Page</a></li>
              <li><a href="login.html">Login Page</a></li>
              <li><a href="pricing_tables.html">Pricing Tables</a></li>
            </ul>
          </li>            
        </ul>
      </div>

    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <a href="salir" data-toggle="tooltip" data-placement="top" title="Logout">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
      </a>
    </div>
    <!-- /menu footer buttons -->
  </div>
</div>