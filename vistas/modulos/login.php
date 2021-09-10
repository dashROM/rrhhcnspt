<div>

  <a class="hiddenanchor" id="signup"></a>

  <a class="hiddenanchor" id="signin"></a>

  <div class="login_wrapper">

    <div class="animate form login_form">

      <div class="login_titulo_logo">

        <img src="vistas/img/template/logo-lineal.png" width="300">

      </div>

      <section class="login_content">

        <form method="post">

          <h1>Ingresa al sistema</h1>

          <div class="input-group">

            <input type="text" class="form-control icono-placeholder" placeholder=" Usuario" name="ingUsuario" required>

          </div>

          <div>

            <input type="password" class="form-control icono-placeholder" placeholder=" Contraseña" name="ingPassword" required>

          </div>

          <div>

            <button type="submit" class="btn btn-success btn-block btn-flat">Ingresar</button>

          </div>

          <div class="clearfix"></div>

          <div class="separator">

            <div class="clearfix"></div>

          </div>

          <?php 

            $login = new ControladorUsuarios();
            $login -> ctrIngresoUsuario();

          ?>

        </form>

      </section>

    </div>

  </div>

</div>