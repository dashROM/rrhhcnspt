<!-- page content -->
<div class="right_col" role="main">

  <div class="">

    <div class="page-title">

      <div class="title_left">
        <h3>Administrar usuarios</h3>
      </div>

      <div class="title_right">

        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

          <div class="input-group">

            <span class="breadcrumb-item"><a href="<?= SERVERURL; ?>/inicio" class="menu" id="inicio"><i class="fas fa-home"></i> Inicio</a></span>
            <span class="breadcrumb-item active">Administrar usuarios</span>

          </div>

        </div>

      </div>

    </div>

    <div class="clearfix"></div>

    <div class="row">
      
      <div class="col-md-12 col-sm-12 ">
       
        <div class="x_panel">
                  
          <div class="x_title">
          
            <button class="btn btn-round btn-outline-success btnAgregarUsuario" data-toggle="modal" data-target="#modalAgregarUsuario">

              <i class="fas fa-plus"></i>
              Agregar Usuario

            </button>

            <div class="clearfix"></div>

          </div>
        
          <div class="x_content">

            <div class="row">
                
              <div class="col-sm-12">
                            
                <div class="card-box table-responsive">
                
                  <table class="table table-bordered table-striped dt-responsive nowrap table-hover" id="tablaUsuarios" width="100%">
                    
                    <thead>
                      
                     <tr>
                        <th>#</th>
                        <th>APELLIDOS Y NOMBRE(S)</th>
                        <th>NICK. USUARIO</th>
                        <th>FOTO</th>
                        <th>NRO. CI</th>
                        <th>TELÉFONO</th>
                        <th>EMAIL</th>
                        <th>PERFIL</th>
                        <th>ESTADO</th>
                        <th>FECHA REGISTRO</th>
                        <th>ACCIONES</th>
                      </tr>

                    </thead>

                  </table>

                  <input type="hidden" value="<?= $_SESSION['perfil_rrhh']; ?>" id="perfilOculto">

                </div>

              </div>
             
            </div>

          </div>

        </div>
        
      </div>
      
    </div>
  
  </div>

</div>
<!-- /page content -->

<!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<div id="modalAgregarUsuario" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="agregarUsuario" aria-hidden="true">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form id="frmNuevoUsuario" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-modal">

          <h5 class="modal-title" id="agregarUsuario">Agregar Usuario</h5>
        
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="btn btn-outline-danger m-0 py-0 px-2">&times;</span>
          </button>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="row">

            <div class="col-md-12 col-sm-12">

              Campos Obligatorios<i class="fas fa-asterisk asterisk mt-2"></i>
              
            </div>

          </div>

          <div class="row">

            <div class="col-md-6 col-sm-6 col-xs-12">

              <!-- ENTRADA PARA EL APELLIDO PATERNO -->

              <div class="form-group">

                <label class="font-weight-normal" for="nuevoPaternoUsuario">A. PATERNO</label>
                <input type="text" class="form-control mayuscula" id="nuevoPaternoUsuario" name="nuevoPaternoUsuario">

              </div>

              <!-- ENTRADA PARA EL APELLIDO MATERNO -->

              <div class="form-group">

                <label class="font-weight-normal" for="nuevoMaternoUsuario">A. MATERNO</label>
                <input type="text" class="form-control mayuscula" id="nuevoMaternoUsuario" name="nuevoMaternoUsuario">

              </div>

              <!-- ENTRADA PARA EL NOMBRE -->

              <div class="form-group">

                <label class="font-weight-normal" for="nuevoNombreUsuario">NOMBRE(S)</label>
                <i class="fas fa-asterisk asterisk"></i>
                <input type="text" class="form-control mayuscula" id="nuevoNombreUsuario" name="nuevoNombreUsuario">

              </div>

              <!-- ENTRADA PARA EL NICK USUARIO -->

              <div class="form-group">

                <label class="font-weight-normal" for="nuevoNickUsuario">NICK USUARIO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <input type="text" class="form-control" id="nuevoNickUsuario" name="nuevoNickUsuario">

              </div>

              <!-- ENTRADA PARA LA CONTRASEÑA -->

              <div class="form-group">

                <label class="font-weight-normal" for="nuevoPassword">CONTRASEÑA</label>
                <i class="fas fa-asterisk asterisk"></i>
                  
                <div class="input-group">
                  <input type="password" class="form-control txtPassword" id="nuevoPassword" name="nuevoPassword">
                  <div class="input-group-append">
                    <button id="show_password" class="btn btn-primary btnMostrarPassword" type="button"> <span class="fa fa-eye-slash icon"></span> </button>
                  </div>
                </div>

              </div>             

              <!-- ENTRADA PARA EL CI -->

              <div class="form-group">

                <label class="font-weight-normal"  for="nuevoCIUsuario">NRO. CI</label>
                <i class="fas fa-asterisk asterisk"></i>

                <div class="input-group mb-3">

                  <input type="text" class="form-control" id="nuevoCIUsuario" name="nuevoCIUsuario">
                  <select class="custom-select" id="nuevoExtCIUsuario" name="nuevoExtCIUsuario">
                    <option value="">ELEGIR...</option>
                    <option value="PT">PT</option>
                    <option value="CH">CH</option>
                    <option value="OR">OR</option>
                    <option value="LP">LP</option>
                    <option value="SC">SC</option>
                    <option value="CO">CO</option>
                    <option value="TR">TR</option>
                    <option value="PA">PA</option>
                    <option value="BE">BE</option>
                  </select>

                </div>

              </div>  

              <!-- ENTRADA PARA EL TELÉFONO -->
                
              <div class="form-group">
                  
                <label class="font-weight-normal" for="nuevoTelefonoUsuario">TELF / CELULAR</label>
                <input type="text" class="form-control" id="nuevoTelefonoUsuario" name="nuevoTelefonoUsuario" data-inputmask="'mask': '9{7,8}'">

              </div>

              <!-- ENTRADA PARA EL EMAIL -->
              
              <div class="form-group">
                
                <label class="font-weight-normal" for="nuevoEmailUsuario">EMAIL</label>
                <input type="text" class="form-control" id="nuevoEmailUsuario" name="nuevoEmailUsuario" data-inputmask="'alias': 'email'" inputmode="email">

              </div>

              <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->
              
              <div class="form-group">

                <label class="font-weight-normal" for="nuevoPerfilUsuario">TIPO USUARIO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="custom-select" id="nuevoPerfilUsuario" name="nuevoPerfilUsuario">
                  <option value="">ELEGIR...</option>
                  <option value="ADMIN_SYSTEM">ADMIN_SYTEM</option>
                  <option value="SECRETARIO">SECRETARIO</option>
                  <option value="PLANILLERO">PLANILLERO</option>
                  <option value="ABOGADO">ABOGADO</option>
                </select>

              </div>

            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">

              <div class="form-group">

                <!-- ENTRADA PARA SUBIR FOTO -->

                <div class="input-group mt-4 mb-3">

                  <div class="input-group-prepend">
                    
                    <label class="input-group-text" for="nuevoFotoUsuario" id="inputFoto"><i class="fas fa-portrait"></i></label>

                  </div>
                  
                  <div class="custom-file">
                    
                    <input type="file" class="custom-file-input nuevoFotoUsuario" name="nuevoFotoUsuario" id="nuevoFotoUsuario" aria-describedby="inputFoto">

                    <label class="custom-file-label" for="nuevoFotoUsuario" data-browse="Elegir">SUBIR FOTO</label>

                  </div>

                </div>

                <div class="text-center">

                  <p class="help-block">Peso máximo de la foto 2MB</p>

                  <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="200px">

                </div>

              </div>     

            </div>

          </div>     

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-round btn-outline-danger float-left" data-dismiss="modal">

            <i class="fas fa-times"></i>
            Cerrar

          </button>

          <button type="button" class="btn btn-round btn-outline-success btnGuardar">

            <i class="fas fa-save"></i>
            Guardar Usuario

          </button>

        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div id="modalEditarUsuario" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editarUsuario" aria-hidden="true">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form id="frmEditarUsuario" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-modal">

          <h5 class="modal-title" id="editarUsuario">Editar Usuario</h5>
        
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="btn btn-outline-danger m-0 py-0 px-2">&times;</span>
          </button>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="row">

            <div class="col-md-12 col-sm-12">

              Campos Obligatorios<i class="fas fa-asterisk asterisk mt-2"></i>
              
            </div>

          </div>

          <div class="row">

            <div class="col-md-6 col-sm-6 col-xs-12">

              <!-- ENTRADA PARA EL APELLIDO PATERNO -->
              
              <div class="form-group">
                
                <label class="font-weight-normal" for="editarPaternoUsuario">A. PATERNO</label>
                <input type="text" class="form-control mayuscula" id="editarPaternoUsuario" name="editarPaternoUsuario">

              </div>

              <!-- ENTRADA PARA EL APELLIDO MATERNO -->
            
              <div class="form-group">
              
                <label class="font-weight-normal" for="editarMaternoUsuario">A. MATERNO</label>
                <input type="text" class="form-control mayuscula" id="editarMaternoUsuario" name="editarMaternoUsuario">

              </div>

              <!-- ENTRADA PARA EL NOMBRE -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="editarNombreUsuario">NOMBRE(S)</label>
                <i class="fas fa-asterisk asterisk"></i>
                <input type="text" class="form-control mayuscula" id="editarNombreUsuario" name="editarNombreUsuario">

              </div>

              <!-- ENTRADA PARA EL NICK USUARIO -->
              
              <div class="form-group">
                
                <label class="font-weight-normal" for="editarNickUsuario">NICK USUARIO</label>
                <i class="fas fa-asterisk asterisk"></i>           
                <input type="text" class="form-control" id="editarNickUsuario" name="editarNickUsuario">

              </div>

              <!-- ENTRADA PARA LA CONTRASEÑA -->
             
              <div class="form-group">

                <label class="font-weight-normal" for="editarPassword">CONTRASEÑA</label>
                <i class="fas fa-asterisk asterisk"></i>
                
                <div class="input-group">
                
                  <input type="password" class="form-control txtPassword" id="editarPassword" name="editarPassword" placeholder="INGRESE NUEVA CONTRASEÑA">
                  <div class="input-group-append">
                    <button id="show_password" class="btn btn-primary btnMostrarPassword" type="button"> <span class="fa fa-eye-slash icon"></span> </button>
                  </div>

                </div>

                <input type="hidden" id="passwordActual" name="passwordActual">

              </div>

              <!-- ENTRADA PARA EL CI -->
              
              <div class="form-group">
                
                <label class="font-weight-normal" for="editarCIUsuario">NRO. CI</label>
                <i class="fas fa-asterisk asterisk"></i>
                <input type="text" class="form-control" id="editarCIUsuario" name="editarCIUsuario">

              </div>

              <!-- ENTRADA PARA LA EXT. CI -->
              
              <div class="form-group">
                
                <label class="font-weight-normal" for="editarExtCIUsuario">EXT. CI</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="custom-select" id="editarExtCIUsuario" name="editarExtCIUsuario">
                  <option value="">ELEGIR...</option>
                  <option value="PT">PT</option>
                  <option value="CH">CH</option>
                  <option value="OR">OR</option>
                  <option value="LP">LP</option>
                  <option value="SC">SC</option>
                  <option value="CO">CO</option>
                  <option value="TR">TR</option>
                  <option value="PA">PA</option>
                  <option value="BE">BE</option>
                </select>

              </div>

              <!-- ENTRADA PARA EL TELÉFONO -->
                
              <div class="form-group">
                  
                <label class="font-weight-normal" for="editarTelefonoUsuario">TELF / CELULAR</label>
                <input type="text" class="form-control" id="editarTelefonoUsuario" name="editarTelefonoUsuario"  data-inputmask="'mask': '9{7,8}'">

              </div>

              <!-- ENTRADA PARA EL EMAIL -->
              
              <div class="form-group">
                
                <label class="font-weight-normal" for="editarEmailUsuario">EMAIL</label>
                <input type="text" class="form-control" id="editarEmailUsuario" name="editarEmailUsuario" data-inputmask="'alias': 'email'" inputmode="email">

              </div>

              <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->
              
              <div class="form-group">

                <label class="font-weight-normal" for="editarPerfilUsuario">TIPO USUARIO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="custom-select" name="editarPerfilUsuario">
                  <option value="" id="editarPerfilUsuario"></option>
                  <option value="ADMIN_SYSTEM">ADMIN_SYTEM</option>
                  <option value="SECRETARIO">SECRETARIO</option>
                  <option value="PLANILLERO">PLANILLERO</option>
                  <option value="ABOGADO">ABOGADO</option>
                </select>

              </div>

            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">
          
              <div class="form-group">

                <!-- ENTRADA PARA SUBIR FOTO -->

                <div class="input-group mt-3 mb-3">

                  <div class="input-group-prepend">
                    
                    <label class="input-group-text" for="editarFotoUsuario" id="inputFoto"><i class="fas fa-portrait"></i></label>

                  </div>
                  
                  <div class="custom-file">
                    
                    <input type="file" class="custom-file-input nuevoFotoUsuario" name="editarFotoUsuario" id="editarFotoUsuario" aria-describedby="inputFoto">

                    <label class="custom-file-label" for="editarFotoUsuario" data-browse="Elegir">SUBIR FOTO</label>

                  </div>

                </div>

                <div class="text-center">

                  <p class="help-block">Peso máximo de la foto 2MB</p>

                  <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="200px">

                  <input type="hidden" name="fotoActualUsuario" id="fotoActualUsuario">

                </div>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <input type="hidden" id="editarIdUsuario" name="editarIdUsuario" value="">

          <button type="button" class="btn btn-round btn-outline-danger float-left" data-dismiss="modal">

            <i class="fas fa-times"></i>
            Cerrar

          </button>

          <button type="button" class="btn btn-round btn-outline-success btnGuardar">

            <i class="fas fa-save"></i>
            Guardar cambios

          </button>

        </div>

      </form>

    </div>

  </div>

</div>