<!-- page content -->
<div class="right_col" role="main">

  <div class="">

    <div class="page-title">

      <div class="title_left">

        <h3>Administrar personas</h3>

      </div>

      <div class="title_right">

        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

          <div class="input-group">

            <span class="breadcrumb-item"><a href="<?= SERVERURL; ?>/inicio" class="menu" id="inicio"><i class="fas fa-home"></i> Inicio</a></span>
            <span class="breadcrumb-item active">Administrar personas</span>

          </div>

        </div>

      </div>

    </div>

    <div class="clearfix"></div>

    <div class="row">
      
      <div class="col-md-12 col-sm-12">
       
        <div class="x_panel">

          <?php

          if ($_SESSION["perfil_rrhh"] == "ADMIN_SYSTEM" || $_SESSION["perfil_rrhh"] == "ABOGADO" || $_SESSION["perfil_rrhh"] == "SECRETARIO") {

          ?>
                  
          <div class="x_title">
        
            <button class="btn btn-round btn-outline-success btnAgregarPersona" data-toggle="modal" data-target="#modalAgregarPersona">

              <i class="fas fa-plus"></i>
              Agregar Persona

            </button>

            <div class="clearfix"></div>

          </div>

          <?php
          
          }

          ?>
        
          <div class="x_content">

            <div class="row">
                
              <div class="col-sm-12">

                <div class="tituloTabla">

                  <h3>Listado de Personas</h3>

                </div>
                            
                <div class="card-box table-responsive">
            
                  <table class="table table-bordered table-striped table-hover" id="tablaPersonas" width="100%">
                    
                    <thead>
                      
                      <tr>
                        <th>#</th>
                        <th>APELLIDOS Y NOMBRES</th>
                        <th>FOTO</th>
                        <th>NRO. CI</th>
                        <th>FECHA NACIM.</th>
                        <th>SEXO</th>
                        <th>ESTADO CIVIL</th>
                        <th>DIRECCION</th>
                        <th>TELEFONO</th>
                        <th>EMAIL</th>
                        <th>FECHA REGISTRO</th>
                        <th>MATRICULA</th>
                        <th>ACCIONES</th>
                      </tr>

                    </thead>

                  </table>

                  <input type="hidden" value="<?php echo $_SESSION['perfil_rrhh']; ?>" id="perfilOculto">

                </div>
          
              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>
  
</div>

<!--=====================================
MODAL AGREGAR PERSONA
======================================-->

<div id="modalAgregarPersona" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="agregarPersona" aria-hidden="true">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form id="frmNuevoPersona" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-modal">

          <h5 class="modal-title" id="agregarPersona">Agregar Persona</h5>
        
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
                
                <label class="font-weight-normal" for="nuevoPaternoPersona">APELLIDO PATERNO</label>
                <input type="text" class="form-control mayuscula" id="nuevoPaternoPersona" name="nuevoPaternoPersona">

              </div>

              <!-- ENTRADA PARA EL APELLIDO MATERNO -->
            
              <div class="form-group">
              
                <label class="font-weight-normal" for="nuevoMaternoPersona">APELLIDO MATERNO</label>
                <input type="text" class="form-control mayuscula" id="nuevoMaternoPersona" name="nuevoMaternoPersona">

              </div>

              <!-- ENTRADA PARA EL NOMBRE -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="nuevoNombrePersona">NOMBRE(S)</label>
                <i class="fas fa-asterisk asterisk"></i>
                <input type="text" class="form-control mayuscula" id="nuevoNombrePersona" name="nuevoNombrePersona">

              </div>  

              <!-- ENTRADA PARA EL CI -->
              
              <div class="form-group mb-3">
                
                <label class="font-weight-normal" for="nuevoCIPersona">NRO. CI</label>
                <i class="fas fa-asterisk asterisk"></i>

                <div class="input-group mb-0">

                  <input type="text" class="form-control" id="nuevoCIPersona" name="nuevoCIPersona" data-error="#errNm1">                
                  <select class="form-control selectpicker show-tick" id="nuevoExtCIPersona" name="nuevoExtCIPersona"  data-size="5" title="Elegir..." data-error="#errNm2">
                    <option value="PT">PT</option>
                    <option value="CH">CH</option>
                    <option value="OR">OR</option>
                    <option value="LP">LP</option>
                    <option value="SC">SC</option>
                    <option value="CB">CB</option>
                    <option value="TR">TR</option>
                    <option value="PA">PA</option>
                    <option value="BE">BE</option>
                  </select>

                </div>

                <span id="errNm1"></span><span id="errNm2"></span>

              </div>

              <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="nuevoFechaNacimientoPersona">FECHA NACIMIENTO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <input type="date" class="form-control" id="nuevoFechaNacimientoPersona" name="nuevoFechaNacimientoPersona">

              </div>

              <!-- ENTRADA PARA SELECCIONAR SEXO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="nuevoSexoPersona">SEXO</label>
                <i class="fas fa-asterisk asterisk"></i>

                <select class="form-control selectpicker show-tick" id="nuevoSexoPersona" name="nuevoSexoPersona" data-size="5" title="Elegir..." data-error="#errNm3">
                  
                  <option value="FEMENINO">FEMENINO</option>
                  <option value="MASCULINO">MASCULINO</option>

                </select>

                <span id="errNm3"></span>

              </div>

              <!-- ENTRADA PARA SELECCIONAR ESTADO CIVIL -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="nuevoEstadoCivilPersona">ESTADO CIVIL</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="form-control selectpicker show-tick" id="nuevoEstadoCivilPersona" name="nuevoEstadoCivilPersona" data-size="5" title="Elegir..." data-error="#errNm4">
                  <option value="SOLTERO(A)">SOLTERO(A)</option>
                  <option value="CASADO(A)">CASADO(A)</option>
                  <option value="DIVORCIADO(A)">DIVORCIADO(A)</option>
                  <option value="VIUDO(A)">VIUDO(A)</option>
                  
                </select>

                <span id="errNm4"></span>

              </div>           

            </div>

            <div class="col-md-6 col-sm-6 col-xs-12"> 

              <div class="form-group">

                <!-- ENTRADA PARA LA DIRECCIÓN -->
            
                <div class="form-group">
                  
                  <label class="font-weight-normal" for="nuevoDireccionPersona">DIRECCIÓN</label>
                  <i class="fas fa-asterisk asterisk"></i>
                  <input type="text" class="form-control mayuscula" id="nuevoDireccionPersona" name="nuevoDireccionPersona">

                </div>

                <!-- ENTRADA PARA EL TELÉFONO -->
              
                <div class="form-group">
                  
                  <label class="font-weight-normal" for="nuevoTelefonoPersona">TELF / CELULAR</label>
                  <i class="fas fa-asterisk asterisk"></i>
                  <input type="text" class="form-control" id="nuevoTelefonoPersona" name="nuevoTelefonoPersona" data-inputmask="'mask': '9{7,8}'">

                </div>

                <!-- ENTRADA PARA EL EMAIL -->
              
                <div class="form-group">
                  
                  <label class="font-weight-normal" for="nuevoEmailPersona">EMAIL</label>
                  <input type="text" class="form-control inputMaskEmail" id="nuevoEmailPersona" name="nuevoEmailPersona">

                </div>

                <!-- ENTRADA PARA SUBIR FOTO -->

                <div class="input-group mt-4 mb-3">

                  <div class="input-group-prepend">
                    
                    <label class="input-group-text" for="nuevaFotoPersona" id="inputFoto"><i class="fas fa-portrait"></i></label>

                  </div>
                  
                  <div class="custom-file">
                    
                    <input type="file" class="custom-file-input nuevaFotoPersona" name="nuevaFotoPersona" id="nuevaFotoPersona" aria-describedby="inputFoto">

                    <label class="custom-file-label" for="nuevaFotoPersona" data-browse="Elegir">SUBIR FOTO</label>

                  </div>

                </div>

                <div class="text-center">

                  <p class="help-block">Peso máximo de la foto 2MB</p>

                  <img src="vistas/img/personas/default/anonymous.png" class="img-thumbnail previsualizar" width="200px">

                </div>

              </div>

            </div>
    
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-round btn-outline-danger btnCerrar float-left" data-dismiss="modal">

            <i class="fas fa-times"></i>
            Cerrar

          </button>

          <button type="button" class="btn btn-round btn-outline-success btnGuardar">

            <i class="fas fa-save"></i>
            Guardar Persona

          </button>

        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR PERSONA
======================================-->

<div id="modalEditarPersona" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editarPersona" aria-hidden="true">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form id="frmEditarPersona" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-modal">

          <h5 class="modal-title" id="editarPersona">Editar Persona</h5>
        
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
                
                <label class="font-weight-normal" for="editarPaternoPersona">APELLIDO PATERNO</label>
                <input type="text" class="form-control mayuscula" id="editarPaternoPersona" name="editarPaternoPersona">

              </div>

              <!-- ENTRADA PARA EL APELLIDO MATERNO -->
            
              <div class="form-group">
              
                <label class="font-weight-normal" for="editarMaternoPersona">APELLIDO MATERNO</label>
                <input type="text" class="form-control mayuscula" id="editarMaternoPersona" name="editarMaternoPersona">

              </div>

              <!-- ENTRADA PARA EL NOMBRE -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="editarNombrePersona">NOMBRE(S)</label>
                <i class="fas fa-asterisk asterisk"></i>
                <input type="text" class="form-control mayuscula" id="editarNombrePersona" name="editarNombrePersona">

              </div>  

              <!-- ENTRADA PARA EL CI -->
              
              <div class="form-group">
                
                <label class="font-weight-normal" for="editarCIPersona">NRO. CI</label>
                <i class="fas fa-asterisk asterisk"></i>

                <div class="input-group mb-0">

                  <input type="text" class="form-control" id="editarCIPersona" name="editarCIPersona" data-error="#errNm5">                
                  <select class="form-control selectpicker show-tick" id="editarExtCIPersona" name="editarExtCIPersona" data-size="5" data-error="#errNm6">
                    <option value="PT">PT</option>
                    <option value="CH">CH</option>
                    <option value="OR">OR</option>
                    <option value="LP">LP</option>
                    <option value="SC">SC</option>
                    <option value="CB">CB</option>
                    <option value="TR">TR</option>
                    <option value="PA">PA</option>
                    <option value="BE">BE</option>
                  </select>

                </div>

                <span id="errNm5"></span><span id="errNm6"></span>

              </div>

              <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="editarFechaNacimientoPersona">FECHA NACIMIENTO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <input type="date" class="form-control" id="editarFechaNacimientoPersona" name="editarFechaNacimientoPersona">

              </div>

               <!-- ENTRADA PARA SELECCIONAR SEXO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="editarSexoPersona">SEXO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="form-control selectpicker show-tick" name="editarSexoPersona" id="editarSexoPersona" data-size="5">
                  <option value="FEMENINO">FEMENINO</option>
                  <option value="MASCULINO">MASCULINO</option>             
                </select>

              </div>  

              <!-- ENTRADA PARA SELECCIONAR ESTADO CIVIL -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="editarEstadoCivilPersona">ESTADO CIVIL</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="form-control selectpicker show-tick" id="editarEstadoCivilPersona" name="editarEstadoCivilPersona" data-size="5">
                  <option value="SOLTERO(A)">SOLTERO(A)</option>
                  <option value="CASADO(A)">CASADO(A)</option>
                  <option value="DIVORCIADO(A)">DIVORCIADO(A)</option>
                  <option value="VIUDO(A)">VIUDO(A)</option>
                  
                </select>

              </div>            

            </div>

            <div class="col-md-6 col-sm-6 col-xs-12"> 

              <div class="form-group">

                <!-- ENTRADA PARA LA DIRECCIÓN -->
            
                <div class="form-group">
                  
                  <label class="font-weight-normal" for="editarDireccionPersona">DIRECCIÓN</label>
                  <input type="text" class="form-control mayuscula" id="editarDireccionPersona" name="editarDireccionPersona">

                </div>

                <!-- ENTRADA PARA EL TELÉFONO -->
              
                <div class="form-group">
                  
                  <label class="font-weight-normal" for="editarTelefonoPersona">TELF / CELULAR</label>
                  <input type="text" class="form-control" id="editarTelefonoPersona" name="editarTelefonoPersona" data-inputmask="'mask': '9{7,8}'">

                </div>

                <!-- ENTRADA PARA EL EMAIL -->
              
                <div class="form-group">
                  
                  <label class="font-weight-normal" for="editarEmailPersona">EMAIL</label>
                  <input type="text" class="form-control inputMaskEmail" id="editarEmailPersona" name="editarEmailPersona">

                </div>

                <!-- ENTRADA PARA SUBIR FOTO -->

                <div class="input-group mt-4 mb-3">

                  <div class="input-group-prepend">
                    
                    <label class="input-group-text" for="editarFotoPersona" id="inputFoto"><i class="fas fa-portrait"></i></label>

                  </div>
                  
                  <div class="custom-file">
                    
                    <input type="file" class="custom-file-input nuevaFotoPersona" name="editarFotoPersona" id="editarFotoPersona" aria-describedby="inputFoto">

                    <label class="custom-file-label" for="editarFotoPersona" data-browse="Elegir">SUBIR FOTO</label>

                  </div>

                </div>

                <div class="text-center">

                  <p class="help-block">Peso máximo de la foto 2MB</p>

                  <img src="vistas/img/personas/default/anonymous.png" class="img-thumbnail previsualizar" width="200px">

                  <input type="hidden" name="fotoActualPersona" id="fotoActualPersona">

                </div>

              </div>

            </div>
    
          </div> 
          
          <!-- <div class="form-group">

            <div class="input-group mb-3">

              <div class="input-group-prepend">
                
                <label class="input-group-text" for="editarFotoPersona" id="inputEditarFoto"><i class="fas fa-portrait"></i></label>

              </div>
              
              <div class="custom-file">
                
                <input type="file" class="custom-file-input nuevaFotoPersona" name="editarFotoPersona" id="editarFotoPersona" aria-describedby="inputFoto">

                <label class="custom-file-label" for="editarFotoPersona" data-browse="Elegir">SUBIR FOTO</label>

              </div>

            </div>

            <p class="help-block">Peso máximo de la foto 2MB</p>

            <img src="vistas/img/personas/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            <input type="hidden" name="fotoActualPersona" id="fotoActualPersona">

          </div> -->

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <input type="hidden" id="editarIdPersona" name="editarIdPersona" value="">

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