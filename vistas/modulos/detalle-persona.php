<?php

  $item = "id_persona";
  $valor1 = $parametros[1];
  $valor2 = null;

  $persona = ControladorPersonas::ctrMostrarPersonas($item, $valor1, $valor2);

?>
<!-- page content -->
<div class="right_col" role="main">

  <div class="">

    <div class="page-title">

      <div class="title_left">

        <h3>Detalle persona</h3>

      </div>

      <div class="title_right">

        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

          <div class="input-group">

            <span class="breadcrumb-item"><a href="<?= SERVERURL; ?>/inicio" class="menu" id="inicio"><i class="fas fa-home"></i> Inicio</a></span>
            <span class="breadcrumb-item"><a href="<?= SERVERURL; ?>/personas" class="menu" id="personas">Personas</a></span>
            <span class="breadcrumb-item active">Detalle personas</span>

          </div>

        </div>

      </div>

    </div>

    <div class="clearfix"></div>

    <div class="row">

      <div class="col-md-12 col-sm-12">

        <div class="x_panel">

          <div class="x_content">
            
            <div class="row">

              <div class="col-md-5 col-sm-5 col-xs-12"> 

                <div class="form-group">

                  <!-- ENTRADA PARA FOTO -->

                  <div class="text-center">

                    <?php

                      if ($persona['foto_persona'] == "") {

                        echo '<img src="'.SERVERURL.'/vistas/img/personas/default/anonymous.png" class="img-thumbnail previsualizar" width="200px">';

                      } else {

                        echo '<img src="'.SERVERURL.'/'.$persona['foto_persona'].'" class="img-thumbnail previsualizar" width="200px">';

                      }
                    ?>

                    
                  </div>

                </div>

              </div>

              <div class="col-md-7 col-sm-7 col-xs-12">

                <!-- ENTRADA PARA EL APELLIDO PATERNO -->
                
                <div class="form-group">
                  
                  <label class="font-weight-bold mr-1">APELLIDO PATERNO:</label><label class="font-weight-normal"><?= $persona['paterno_persona'] ?></label>

                </div>

                <!-- ENTRADA PARA EL APELLIDO MATERNO -->
              
                <div class="form-group">
                
                  <label class="font-weight-bold mr-1">APELLIDO MATERNO:</label><label class="font-weight-normal"><?= $persona['materno_persona'] ?></label>

                </div>

                <!-- ENTRADA PARA EL NOMBRE -->
              
                <div class="form-group">
                  
                  <label class="font-weight-bold mr-1">NOMBRE(S):</label><label class="font-weight-normal"><?= $persona['nombre_persona'] ?></label>

                </div>  

                <!-- ENTRADA PARA EL CI -->
                
                <div class="form-group">
                  
                  <label class="font-weight-bold mr-1">NRO. CI:</label><label class="font-weight-normal"><?= $persona['ci_persona']." ".$persona['ext_ci_persona'] ?></label>

                </div>

                <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
              
                <div class="form-group">
                  
                  <label class="font-weight-bold mr-1">FECHA NACIMIENTO:</label><label class="font-weight-normal"><?= date("d/m/Y", strtotime($persona['fecha_nacimiento'])) ?></label>

                </div>

                 <!-- ENTRADA PARA SELECCIONAR SEXO -->
              
                <div class="form-group">
                  
                  <label class="font-weight-bold mr-1">SEXO:</label><label class="font-weight-normal"><?= $persona['sexo_persona'] ?></label>

                </div>   

                <!-- ENTRADA PARA LA DIRECCIÓN -->
              
                <div class="form-group">
                  
                  <label class="font-weight-bold mr-1">DIRECCIÓN:</label><label class="font-weight-normal"><?= $persona['direccion_persona'] ?></label>

                </div>

                <!-- ENTRADA PARA EL TELÉFONO -->
              
                <div class="form-group">
                  
                  <label class="font-weight-bold mr-1">TELF / CELULAR:</label><label class="font-weight-normal"><?= $persona['telefono_persona'] ?></label>

                </div>

                <!-- ENTRADA PARA EL EMAIL -->
              
                <div class="form-group">
                  
                  <label class="font-weight-bold mr-1">EMAIL:</label><label class="font-weight-normal"><?= $persona['email_persona'] ?></label>

                </div>

                 <!-- ENTRADA PARA LA MATRICULA -->
              
                <div class="form-group">
                  
                  <label class="font-weight-bold mr-1">MATRICULA:</label><label class="font-weight-normal"><?= $persona['matricula_persona'] ?></label>

                </div>

              </div>
      
            </div> 

          </div>
          
        </div>

      </div>

    </div>

    <div class="clearfix"></div>

    <div class="row">
      
      <div class="col-md-12 col-sm-12">
       
        <div class="x_panel">

          <nav>

            <div class="nav nav-tabs" id="nav-tab" role="tablist">

              <a class="nav-item nav-link active font-weight-bold" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Contratos</a>
              <!-- <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
              <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a>-->

            </div>

          </nav>

          <div class="tab-content mt-4" id="nav-tabContent">
            
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

              <?php

              if ($_SESSION["perfil_rrhh"] == "ADMIN_SYSTEM" || $_SESSION["perfil_rrhh"] == "SECRETARIO") {

              ?>
                      
              <div class="x_title">
            
                <button class="btn btn-round btn-outline-success btnAgregarPersonaContrato" data-toggle="modal" data-target="#modalAgregarPersonaContrato">

                  <i class="fas fa-plus"></i>
                  Agregar Contrato

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

                      <h3>Listado de Contratos</h3>

                    </div>
                                
                    <div class="card-box table-responsive">
                
                      <table class="table table-bordered table-striped table-hover" id="tablaPersonaContratos" width="100%">
                        
                        <thead>
                          
                          <tr>
                            <th>#</th>
                            <th>COD CONTRATO</th>
                            <th>LUGAR</th>
                            <th>ESTABLECIMIENTO</th>
                            <th>TIPO CONTRATO</th>
                            <th>CARGO</th>
                            <th>INICIO CONTRATO</th>
                            <th>FIN CONTRATO</th>
                            <th>DIAS CONTRATO</th>
                            <th>ESTADO</th>
                            <th>OBSERVACIONES</th>
                            <th>ACCIONES</th>
                          </tr>

                        </thead>

                      </table>

                      <input type="hidden" value="<?php echo $_SESSION['perfil_rrhh']; ?>" id="perfilOculto">
                      <input type="hidden" value="<?php echo $parametros[1]; ?>" id="idPersona">

                    </div>
              
                  </div>

                </div>

                <div class="row">

                  <div class="my-3 col-md-4 col-sm-6">
                    <label class="col-sm-6 col-form-label">Contrato Validado</label>
                    <div class="col-sm-6">
                      <button class='btn btn-success mt-2'></button>
                    </div>
                  </div>

                  <div class="my-3 col-md-4 col-sm-6">
                    <label class="col-sm-6 col-form-label">Contrato Ampliado</label>
                    <div class="col-sm-6">
                      <button class='btn btn-primary mt-2'></button>
                    </div>
                  </div>

                </div>

                <div class="row">

                  <div class="mb-3 col-md-4 col-sm-6">
                    <label class="col-sm-6 col-form-label">Contrato Sin Validar</label>
                    <div class="col-sm-6">
                      <button class='btn btn-danger mt-2'></button>
                    </div>
                  </div>

                  <div class="mb-3 col-md-4 col-sm-6">
                    <label class="col-sm-6 col-form-label">Contrato Sin Ampliar</label>
                    <div class="col-sm-6">
                      <button class='btn btn-secondary mt-2'></button>
                    </div>
                  </div>

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
MODAL AGREGAR PERSONA CONTRATO
======================================-->

<div id="modalAgregarPersonaContrato" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="agregarEmpleado" aria-hidden="true">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form id="frmNuevoPersonaContrato">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-modal">

          <h5 class="modal-title" id="agregarPersonaContrato">Agregar Contrato</h5>
        
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

              <!-- ENTRADA PARA LUGAR -->
            
              <div class="form-group">
              
                <label class="font-weight-normal" for="nuevoLugar">LUGAR DE TRABAJO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="form-control form-control-sm select2" name="nuevoLugar" id="nuevoLugar" data-dropdown-css-class="select2-info" style="width: 100%;">
                  
                  <option value="">ELEGIR...</option>
                  <?php 

                    $item = null;
                    $valor = null;

                    $lugares = ControladorLugares::ctrMostrarLugares($item, $valor);

                    foreach ($lugares as $key => $value) {
                      
                      echo '<option value="'.$value["id_lugar"].'">'.$value["codificacion"].'-'.$value["nombre_lugar"].'</option>';

                    } 

                  ?>

                </select>

              </div>

              <!-- ENTRADA PARA ESTABLECIMIENTO -->
            
              <div class="form-group">
              
                <label class="font-weight-normal" for="nuevoEstablecimiento">ESTABLECIMIENTO DE TRABAJO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="form-control form-control-sm select2" name="nuevoEstablecimiento" id="nuevoEstablecimiento" data-dropdown-css-class="select2-info" style="width: 100%;">
                  
                  <option value="">ELEGIR...</option>
                  <?php 

                    $item = null;
                    $valor = null;

                    $establecimientos = ControladorEstablecimientos::ctrMostrarEstablecimientos($item, $valor);

                    foreach ($establecimientos as $key => $value) {
                      
                      echo '<option value="'.$value["id_establecimiento"].'">'.$value["nombre_establecimiento"].'</option>';

                    } 

                  ?>

                </select>

              </div>

              <!-- ENTRADA PARA BUSCAR PERSONA -->
              
              <div class="form-group">
                
                <label class="font-weight-normal" for="nuevoBuscarPersona">NOMBRE PERSONA</label>
                <input type="text" class="form-control" id="nuevoBuscarPersona" name="nuevoBuscarPersona" value="<?= $persona['nombre_persona']." ".$persona['paterno_persona']." ".$persona['materno_persona'] ?>" readonly="">

                <input type="hidden" id="nuevoIdPersona" name="nuevoIdPersona" value="<?= $persona['id_persona'] ?>">

              </div>

              <!-- ENTRADA PARA EL NRO CI -->
            
              <div class="form-group">
                  
                <label class="font-weight-normal" for="nuevoCIEmpleado">NRO. CI</label>
                <input type="text" class="form-control" id="nuevoCIEmpleado" name="nuevoCIEmpleado" value="<?= $persona['ci_persona']." ".$persona['ext_ci_persona'] ?>" readonly="">

              </div>

              <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="nuevoFechaNacimientoEmpleado">FECHA NACIMIENTO</label>
                <input type="date" class="form-control" id="nuevoFechaNacimientoEmpleado" name="nuevoFechaNacimientoEmpleado" value="<?= $persona['fecha_nacimiento'] ?>" readonly>

              </div>

               <!-- ENTRADA PARA SELECCIONAR CARGO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="nuevoCargoEmpleado">CARGO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="custom-select select2" id="nuevoCargoEmpleado" name="nuevoCargoEmpleado" data-dropdown-css-class="select2-info" style="width: 100%;">
                  <option value="">ELEGIR...</option>
                  <?php 

                    $item = null;
                    $valor = null;

                    $cargos = ControladorCargos::ctrMostrarCargos($item, $valor);

                    foreach ($cargos as $key => $value) {
                      
                      echo '<option value="'.$value["id_cargo"].'">'.$value["nombre_cargo"].'</option>';
                    } 

                  ?>
                </select>

              </div>

            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">

              <!-- ENTRADA PARA LA FECHA DE INICIO DE CONTRATO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="nuevoFechaInicio">FECHA INICIO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <input type="date" class="form-control" id="nuevoFechaInicio" name="nuevoFechaInicio">

              </div>

              <!-- ENTRADA PARA LOS DIAS DE CONTRATO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="nuevoDiasContrato">DIAS DE CONTRATO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <input type="number" min="0" class="form-control" id="nuevoDiasContrato" name="nuevoDiasContrato">

              </div>

              <!-- ENTRADA PARA LA FECHA DE FIN DE CONTRATO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="nuevoFechaFin">FECHA FINALIZACIÓN</label>
                <i class="fas fa-asterisk asterisk"></i>
                <input type="date" class="form-control" id="nuevoFechaFin" name="nuevoFechaFin">

              </div>
      
              <!-- ENTRADA PARA TIPO CONTRATO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="nuevoTipoContrato">TIPO DE CONTRATO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="custom-select select2" id="nuevoTipoContrato" name="nuevoTipoContrato">
                  <option value="">ELEGIR...</option>
                  <?php 

                    $item = null;
                    $valor = null;

                    $contratos = ControladorContratos::ctrMostrarContratos($item, $valor);

                    foreach ($contratos as $key => $value) {
                      
                      echo '<option value="'.$value["id_contrato"].'">'.$value["nombre_contrato"].'</option>';
                    } 

                  ?>
                </select>

              </div>

              <!-- ENTRADA PARA TIPO CONTRATO SUPLENCIA -->
            
              <div class="form-group d-none" id="contratoSuplencia">
                
                <label class="font-weight-normal" for="nuevoTipoContratoSuplencia">TIPO DE SUPLENCIA</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="custom-select select2" id="nuevoTipoSuplencia" name="nuevoTipoSuplencia" required>
                  <option value="">ELEGIR...</option>
                  <?php 

                    $item = null;
                    $valor = null;

                    $suplencias = ControladorSuplencias::ctrMostrarSuplencias($item, $valor);

                    foreach ($suplencias as $key => $value) {
                      
                      echo '<option value="'.$value["id_suplencia"].'">'.$value["tipo_suplencia"].'</option>';
                    } 

                  ?>
                </select>

              </div>

              <!-- ENTRADA PARA LAS OBSERVACIONES -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="nuevoObservacionesContrato">OBSERVACIONES</label>
                <textarea type="text" class="form-control mayuscula" rows="4" id="nuevoObservacionesContrato" name="nuevoObservacionesContrato">

                </textarea>

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
            Guardar Datos

          </button>

        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR PERSONA CONTRATO
======================================-->

<div id="modalEditarPersonaContrato" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editarPersonaContrato" aria-hidden="true">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form id="frmEditarPersonaContrato">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-modal">

          <h5 class="modal-title" id="editarPersonaContacto">Editar Contrato</h5>
        
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

              <!-- ENTRADA PARA LUGAR -->
            
              <div class="form-group">
              
                <label class="font-weight-normal" for="editarLugar">LUGAR DE TRABAJO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="custom-select select2" id="editarLugar" name="editarLugar" data-dropdown-css-class="select2-info" style="width: 100%;">

                </select>

              </div>

              <!-- ENTRADA PARA ESTABLECIMIENTO -->
            
              <div class="form-group">
              
                <label class="font-weight-normal" for="editarEstablecimiento">ESTABLECIMIENTO DE TRABAJO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="custom-select select2" id="editarEstablecimiento" name="editarEstablecimiento" data-dropdown-css-class="select2-info" style="width: 100%;">
                </select>

              </div>

              <!-- ENTRADA PARA BUSCAR PERSONA -->
              
              <div class="form-group">
                
                <label class="font-weight-normal" for="editarBuscarPersona">NOMBRE PERSONA</label>
                <i class="fas fa-asterisk asterisk"></i>
                <input type="text" class="form-control" id="editarBuscarPersona" name="editarBuscarPersona" readonly="">

                <input type="hidden" id="editarIdPersona" name="editarIdPersona">


              </div>

              <!-- ENTRADA PARA EL NRO CI -->
            
              <div class="form-group">
                  
                <label class="font-weight-normal" for="editarCIEmpleado">NRO. CI</label>
                <input type="text" class="form-control" id="editarCIEmpleado" name="editarCIEmpleado" readonly="">

              </div>

              <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="editarFechaNacimientoEmpleado">FECHA NACIMIENTO</label>
                <input type="date" class="form-control" id="editarFechaNacimientoEmpleado" name="editarFechaNacimientoEmpleado" readonly>

              </div>

               <!-- ENTRADA PARA SELECCIONAR CARGO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="editarCargoEmpleado">CARGO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="custom-select select2" id="editarCargoEmpleado" name="editarCargoEmpleado" data-dropdown-css-class="select2-info" style="width: 100%;">                  
                </select>

              </div>

            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">

              <!-- ENTRADA PARA LA FECHA DE INICIO DE CONTRATO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="editarFechaInicio">FECHA INICIO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <input type="date" class="form-control" id="editarFechaInicio" name="editarFechaInicio">

              </div>

              <!-- ENTRADA PARA LOS DIAS DE CONTRATO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="editarDiasContrato">DIAS DE CONTRATO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <input type="number" min="0" class="form-control" id="editarDiasContrato" name="editarDiasContrato">

              </div>

              <!-- ENTRADA PARA LA FECHA DE FIN DE CONTRATO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="editarFechaFin">FECHA FINALIZACIÓN</label>
                <i class="fas fa-asterisk asterisk"></i>
                <input type="date" class="form-control" id="editarFechaFin" name="editarFechaFin">

              </div>
      
              <!-- ENTRADA PARA TIPO CONTRATO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="editarTipoContrato">TIPO DE CONTRATO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="custom-select select2" id="editarTipoContrato" name="editarTipoContrato" data-dropdown-css-class="select2-info" style="width: 100%;">
                </select>

              </div>

              <!-- ENTRADA PARA TIPO CONTRATO SUPLENCIA -->
            
              <div class="form-group d-none" id="editarContratoSuplencia">
                
                <label class="font-weight-normal" for="editarTipoSuplencia">TIPO DE SUPLENCIA</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="custom-select select2" id="editarTipoSuplencia" name="editarTipoSuplencia" required data-dropdown-css-class="select2-info" style="width: 100%;">
                </select>

              </div>

              <!-- ENTRADA PARA LAS OBSERVACIONES -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="editarObservacionesContrato">OBSERVACIONES</label>
                <textarea type="text" class="form-control mayuscula" rows="4" id="editarObservacionesContrato" name="editarObservacionesContrato">

                </textarea>

              </div>
      
            </div>  

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <input type="hidden" id="editarIdPersonaContrato" name="editarIdPersonaContrato" value="">

          <button type="button" class="btn btn-round btn-outline-danger btnCerrar float-left" data-dismiss="modal">

            <i class="fas fa-times"></i>
            Cerrar

          </button>

          <button type="button" class="btn btn-round btn-outline-success btnGuardar">

            <i class="fas fa-save"></i>
            Guardar Cambios

          </button>

        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR DOCUMENTO CONTRATO
======================================-->

<div id="modalEditarDocumentoContrato" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editarDocumentoContrato" aria-hidden="true">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form id="frmEditarDocumentoContrato">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-modal">

          <h5 class="modal-title" id="editarDocumentoContacto">Editar Documento Contrato</h5>
        
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="btn btn-outline-danger m-0 py-0 px-2">&times;</span>
          </button>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">

              <!-- ENTRADA PARA EL DOCUMENTO -->
            
              <div class="form-group">
                
                <textarea type="text" id="documentoContrato" name="documentoContrato">

                </textarea>

              </div>
      
            </div>  

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <input type="hidden" id="editarIdDocumentoContrato" name="editarIdDocumentoContrato" value="">

          <button type="button" class="btn btn-round btn-outline-danger btnCerrar float-left" data-dismiss="modal">

            <i class="fas fa-times"></i>
            Cerrar

          </button>

          <button type="button" class="btn btn-round btn-outline-success btnGuardar">

            <i class="fas fa-save"></i>
            Guardar Documento

          </button>

        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
VENTANA MODAL PARA MOSTRAR EL CONTRATO EN PDF
======================================-->

<div id="ver-pdf" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="ContratoPDF" aria-hidden="true">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-modal">

          <h5 class="modal-title" id="ContratoPDF">Contrato de Trabajo</h5>
        
          <button type="button" class="close btnCerrar" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="btn btn-outline-danger m-0 py-0 px-2">&times;</span>
          </button>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          
          <div id="view_pdf">
       

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

        </div>

    </div>

  </div>

</div>

<!--=====================================
VENTANA MODAL PARA CARGAR EL CONTRATO EN ARCHIVO PDF
======================================-->

<div id="modalCargarArchivoContrato" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="cargarArchivoContrato" aria-hidden="true">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form id="frmCargarArchivoContrato" enctype="multipart/form-data" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-modal">

          <h5 class="modal-title" id="cargarImagenContrato">Cargar Contrato</h5>
        
          <button type="button" class="close btnCerrar" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="btn btn-outline-danger m-0 py-0 px-2">&times;</span>
          </button>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
          
          <div class="card-body" id="cargarArchivoContrato">

            <div class="input-group mb-3">

              <div class="input-group-prepend">
                
                <label class="input-group-text" for="archivoContrato" id="inputArchivoContrato"><i class="fas fa-portrait"></i></label>

              </div>
              
              <div class="custom-file">
                
                <input type="file" class="custom-file-input archivoContrato" name="archivoContrato" id="archivoContrato" aria-describedby="inputArchivoContrato">

                <label class="custom-file-label" for="archivoContrato" data-browse="Elegir">SUBIR ARCHIVO</label>

              </div>

            </div>

          </div>      
          
          <div class="card-footer">

            <div id="archivo_pdf">
       

            </div>

            <p class="help-block">Peso máximo del archvio 5MB</p>

            <input type="hidden" name="archivoActual" id="archivoActual" value="">

          </div> 

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <input type="hidden" id="editarIdArchivoContrato" name="editarIdArchivoContrato" value="">

          <button type="button" class="btn btn-round btn-outline-danger btnCerrar float-left" data-dismiss="modal">

            <i class="fas fa-times"></i>
            Cerrar

          </button>

          <button type="button" class="btn btn-round btn-outline-success btnGuardar">

            <i class="fas fa-save"></i>
            Guardar Archivo

          </button>

          <!-- <div id="validar"></div> -->

          <button type="button" class="btn btn-round btn-outline-primary btnValidarArchivo d-none" idPersonaContrato="">

            <i class="fas fa-check"></i>
            Validar Archivo

          </button>

        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL AMPLIAR PERSONA CONTRATO
======================================-->

<div id="modalAmpliarPersonaContrato" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="ampliarPersonaContrato" aria-hidden="true">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form id="frmAmpliarPersonaContrato">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-modal">

          <h5 class="modal-title" id="ampliarPersonaContacto">Ampliar Contrato</h5>
        
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

              <!-- ENTRADA PARA LUGAR -->
            
              <div class="form-group">
              
                <label class="font-weight-normal" for="ampliarLugar">LUGAR DE TRABAJO</label>
                <input type="text" class="form-control" id="ampliarLugar" name="ampliarLugar" readonly>
                <input type="hidden" id="ampliarIdLugar" name="ampliarIdLugar">

                </select>

              </div>

              <!-- ENTRADA PARA ESTABLECIMIENTO -->
            
              <div class="form-group">
              
                <label class="font-weight-normal" for="ampliarEstablecimiento">ESTABLECIMIENTO DE TRABAJO</label>
                <input type="text" class="form-control" id="ampliarEstablecimiento" name="ampliarEstablecimiento" readonly>
                <input type="hidden" id="ampliarIdEstablecimiento" name="ampliarIdEstablecimiento">

              </div>

              <!-- ENTRADA PARA BUSCAR PERSONA -->
              
              <div class="form-group">
                
                <label class="font-weight-normal" for="ampliarBuscarPersona">NOMBRE PERSONA</label>
                <input type="text" class="form-control" id="ampliarBuscarPersona" name="ampliarBuscarPersona" readonly>
                <input type="hidden" id="ampliarIdPersona" name="ampliarIdPersona">


              </div>

              <!-- ENTRADA PARA EL NRO CI -->
            
              <div class="form-group">
                  
                <label class="font-weight-normal" for="ampliarCIEmpleado">NRO. CI</label>
                <input type="text" class="form-control" id="ampliarCIEmpleado" name="ampliarCIEmpleado" readonly>

              </div>

              <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="ampliarFechaNacimientoEmpleado">FECHA NACIMIENTO</label>
                <input type="date" class="form-control" id="ampliarFechaNacimientoEmpleado" name="ampliarFechaNacimientoEmpleado" readonly>

              </div>

               <!-- ENTRADA PARA SELECCIONAR CARGO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="ampliarCargo">CARGO</label>
                <input type="text" class="form-control" id="ampliarCargo" name="ampliarCargo" readonly>
                <input type="hidden" id="ampliarIdCargo" name="ampliarIdCargo">

              </div>

            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">

              <!-- ENTRADA PARA LA FECHA DE INICIO DE CONTRATO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="ampliarFechaInicio">FECHA INICIO</label>
                <input type="date" class="form-control" id="ampliarFechaInicio" name="ampliarFechaInicio" readonly>

              </div>

              <!-- ENTRADA PARA LOS DIAS DE CONTRATO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="ampliarDiasContrato">DIAS DE CONTRATO</label>
                <input type="number" min="0" class="form-control" id="ampliarDiasContrato" name="ampliarDiasContrato" readonly>

              </div>

              <!-- ENTRADA PARA LA FECHA DE FIN DE CONTRATO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="ampliarFechaFin">FECHA FINALIZACIÓN</label>
                <i class="fas fa-asterisk asterisk"></i>
                <input type="date" class="form-control" id="ampliarFechaFin" name="ampliarFechaFin">
                <input type="hidden" id="antFechaFin" name="antFechaFin">

              </div>
      
              <!-- ENTRADA PARA TIPO CONTRATO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="ampliarTipoContrato">TIPO DE CONTRATO</label>
                <input type="text" class="form-control" id="ampliarTipoContrato" name="ampliarTipoContrato" readonly>
                <input type="hidden" id="ampliarIdContrato" name="ampliarIdContrato">

              </div>

              <!-- ENTRADA PARA TIPO CONTRATO SUPLENCIA -->
            
              <div class="form-group d-none" id="ampliarContratoSuplencia">
                
                <label class="font-weight-normal" for="ampliarTipoSuplencia">TIPO DE SUPLENCIA</label>
                <input type="text" class="form-control" id="ampliarTipoSuplencia" name="ampliarTipoSuplencia" readonly>
                <input type="hidden" id="ampliarIdSuplencia" name="ampliarIdSuplencia">

              </div>

              <!-- ENTRADA PARA LAS OBSERVACIONES -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="ampliarObservacionesContrato">OBSERVACIONES</label>
                <textarea type="text" class="form-control mayuscula" rows="4" id="ampliarObservacionesContrato" name="ampliarObservacionesContrato" readonly>

                </textarea>

              </div>
      
            </div>  

          </div>

          <div class="row">
            
            <div class="input-group mb-3">

              <div class="input-group-prepend">
                
                <label class="input-group-text" for="documentoAmpliacion" id="inputDocumentoAmpliacion"><i class="fas fa-portrait"></i></label>

              </div>
              
              <div class="custom-file">
                
                <input type="file" class="custom-file-input documentoAmpliacion" name="documentoAmpliacion" id="documentoAmpliacion" aria-describedby="inputDocumentoAmpliacion">

                <label class="custom-file-label" for="documentoAmpliacion" data-browse="Elegir">SUBIR ARCHIVO</label>

              </div>          

            </div>  

          </div>    
            
          <div class="row">

            <div class="col-md-12 col-sm-12" id="doc_ampliacion_pdf">
       

            </div>

            <p class="help-block">Peso máximo del archvio 5MB</p>

            <input type="hidden" name="documentoActual" id="documentoActual" value="">     

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <input type="hidden" id="ampliarIdPersonaContrato" name="ampliarIdPersonaContrato" value="">

          <button type="button" class="btn btn-round btn-outline-danger btnCerrar float-left" data-dismiss="modal">

            <i class="fas fa-times"></i>
            Cerrar

          </button>

          <button type="button" class="btn btn-round btn-outline-success btnGuardar">

            <i class="fas fa-save"></i>
            Guardar Cambios

          </button>

          <button type="button" class="btn btn-round btn-outline-primary btnValidarDocumentoAmpliacion d-none" idPersonaContrato="">

            <i class="fas fa-check"></i>
            Validar Documento

          </button>

        </div>

      </form>

    </div>

  </div>

</div>