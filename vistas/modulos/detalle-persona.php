<?php

  $item = "id_persona";
  $valor1 = $parametros[1];
  $valor2 = null;

  $persona = ControladorPersonas::ctrMostrarPersonas($item, $valor1, $valor2);

  $cantidad_persona_contrato = ControladorPersonaContratos::ctrCantidadPersonaContratos($item, $valor1);

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

              <div class="col-md-4 col-sm-4 col-xs-12"> 

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

              <div class="col-md-4 col-sm-4 col-xs-12">

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

              </div>

              <div class="col-md-4 col-sm-4 col-xs-12">

                <!-- ENTRADA PARA SELECCIONAR SEXO -->
              
                <div class="form-group">
                  
                  <label class="font-weight-bold mr-1">SEXO:</label><label class="font-weight-normal"><?= $persona['sexo_persona'] ?></label>

                </div>   

                <!-- ENTRADA PARA LA DIRECCI??N -->
              
                <div class="form-group">
                  
                  <label class="font-weight-bold mr-1">DIRECCI??N:</label><label class="font-weight-normal"><?= $persona['direccion_persona'] ?></label>

                </div>

                <!-- ENTRADA PARA EL TEL??FONO -->
              
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

          <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="herederos-tab" data-toggle="tab" href="#herederos" role="tab" aria-controls="herederos" aria-selected="true">Herederos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="contratos-tab" data-toggle="tab" href="#contratos" role="tab" aria-controls="contratos" aria-selected="false">Contratos</a>
            </li>
          </ul>

          <div class="tab-content" id="myTabContent">

            <!-- PANEL PERSONA HEREDEROS -->

            <div class="tab-pane fade show active" id="herederos" role="tabpanel" aria-labelledby="herederos-tab">

              <?php if ($_SESSION["perfil_rrhh"] == "ADMIN_SYSTEM" || $_SESSION["perfil_rrhh"] == "ABOGADO" || $_SESSION["perfil_rrhh"] == "SECRETARIO") { ?>

              <div class="x_title">
            
                <button class="btn btn-round btn-outline-success btnAgregarPersonaHeredero" data-toggle="modal" data-target="#modalAgregarPersonaHeredero">

                  <i class="fas fa-plus"></i>
                  Agregar Heredero

                </button>

                <div class="clearfix"></div>

              </div>

              <?php } ?>

              <div class="x_content">

                <div class="row">
                    
                  <div class="col-sm-12">

                    <div class="tituloTabla">

                      <h3>Listado de Herederos</h3>

                    </div>
                                
                    <div class="card-box table-responsive">
                
                      <table class="table table-bordered table-striped table-hover" id="tablaPersonaHerederos" width="100%">
                        
                        <thead>
                          
                          <tr>
                            <th>#</th>
                            <th>NOMBRES Y APELLIDOS</th>
                            <th>EDAD</th>
                            <th>PARETEZCO</th>
                            <th>ACCIONES</th>
                          </tr>

                        </thead>

                      </table>

                      <input type="hidden" value="<?php echo $_SESSION['perfil_rrhh']; ?>" id="perfilOculto">
                      <input type="hidden" value="<?php echo $parametros[1]; ?>" id="idPersona">

                    </div>
              
                  </div>

                </div>

              </div>

            </div>

            <!-- PANEL PERSONA CONTRATOS -->
            
            <div class="tab-pane fade" id="contratos" role="tabpanel" aria-labelledby="contratos-tab">

              <?php if ($_SESSION["perfil_rrhh"] == "ADMIN_SYSTEM" || $_SESSION["perfil_rrhh"] == "ABOGADO" || $_SESSION["perfil_rrhh"] == "SECRETARIO") { ?>
                      
              <div class="x_title">

                <?php if ($cantidad_persona_contrato["numero_filas"] < 2) { ?>
            
                <button class="btn btn-round btn-outline-success btnAgregarPersonaContrato" recurrencia="0" data-toggle="modal" data-target="#modalAgregarPersonaContrato">

                  <i class="fas fa-plus"></i>
                  Agregar Contrato

                </button>

                <?php } else { ?>

                <button class="btn btn-round btn-outline-success btnAgregarPersonaContrato" recurrencia="1" data-toggle="modal" data-target="#modalAgregarPersonaContrato">

                  <i class="fas fa-plus"></i>
                  Agregar Contrato Recurrente

                </button>

                <?php } ?>

                <div class="clearfix"></div>

              </div>

              <?php } ?>
            
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
                            <th>CERTIFICACION PRESUPUESTARIA</th>
                            <th>LUGAR</th>
                            <th>ESTABLECIMIENTO</th>
                            <th>CARGO</th>
                            <th>HABER BASICO</th>
                            <th>HRS: SEM.</th>
                            <th>SECTOR CONTRATACION</th>
                            <th>CONTRATO</th>
                            <th>NRO. CONTRATO</th>
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
                <select class="form-control selectpicker show-tick" name="nuevoLugar" id="nuevoLugar" data-live-search="true" data-size="5" title="Elegir...">
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
                <select class="form-control selectpicker show-tick" name="nuevoEstablecimiento" id="nuevoEstablecimiento" data-live-search="true" data-size="5" title="Elegir...">
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

              <!-- ENTRADA PARA CERTIFICACION PRESUPUESTARIA -->
            
              <div class="form-group">
                  
                <label class="font-weight-normal" for="nuevoCertificacion">CERTIFICACI??N PRESUPUESTARIA</label>
                <input type="text" class="form-control" id="nuevoCertificacion" name="nuevoCertificacion" data-inputmask="'mask': '999999-999999-9999'">

              </div>

              <!-- ENTRADA PARA SELECCIONAR CARGO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="nuevoCargoEmpleado">CARGO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="form-control selectpicker show-tick" id="nuevoCargoEmpleado" name="nuevoCargoEmpleado" data-live-search="true" data-size="5" title="Elegir...">
                <?php 

                  $item = null;
                  $valor = null;

                  $cargos = ControladorCargos::ctrMostrarCargos($item, $valor);

                  foreach ($cargos as $key => $value) {
                    
                    echo '<option value="'.$value["id_cargo"].'">'.$value["nombre_cargo"].' - '.$value["haber_basico"].'</option>';
                  } 

                ?>
                </select>

              </div>

              <!-- ENTRADA PARA SELECCIONAR TIPO CONTRATACION -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="nuevoTipoContratacion">TIPO CONTRATACION</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="form-control selectpicker show-tick" id="nuevoTipoContratacion" name="nuevoTipoContratacion" data-size="5" title="Elegir...">
                  <option value="SALUD">SALUD</option>
                  <option value="ADMINISTRATIVO">ADMINISTRATIVA</option>
                </select>

              </div>

              <!-- ENTRADA PARA SELECCIONAR RECURRENCIA-->
            
              <!-- <div class="form-group">
                
                <input type="checkbox" class="flat"  id="nuevoRecurrencia" name="nuevoRecurrencia"> RECURRENCIA

              </div> -->

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
                
                <label class="font-weight-normal" for="nuevoFechaFin">FECHA FINALIZACI??N</label>
                <i class="fas fa-asterisk asterisk"></i>
                <input type="date" class="form-control" id="nuevoFechaFin" name="nuevoFechaFin">

              </div>
      
              <!-- ENTRADA PARA TIPO CONTRATO -->
            
              <!-- <div class="form-group">
                
                <label class="font-weight-normal" for="nuevoTipoContrato">TIPO DE CONTRATO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="form-control selectpicker show-tick" id="nuevoTipoContrato" name="nuevoTipoContrato" data-size="5" title="Elegir...">
                <?php 

                  $item = null;
                  $valor = null;

                  $contratos = ControladorContratos::ctrMostrarContratos($item, $valor);

                  foreach ($contratos as $key => $value) {
                    
                    echo '<option value="'.$value["id_contrato"].'">'.$value["nombre_contrato"].' - '.$value["proposito_contrato"].'</option>';
                  } 

                ?>
                </select>

              </div> -->

              <!-- ENTRADA PARA TIPO CONTRATO -->

              <div class="form-group">
                    
                <label class="font-weight-normal" for="nuevoTipoContrato">TIPO DE CONTRATO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="form-control selectpicker show-tick" id="nuevoTipoContrato" name="nuevoTipoContrato" data-size="5" title="Elegir...">
                <?php 

                  $item = null;
                  $valor = null;

                  $contratos = ControladorContratos::ctrMostrarContratos($item, $valor);

                  foreach ($contratos as $key => $value) {
                    
                    echo '<option value="'.$value["id_contrato"].'">'.$value["nombre_contrato"].' - '.$value["proposito_contrato"].'</option>';
                  } 

                ?>
                </select>

              </div>

              <!-- ENTRADA PARA ASINACION PERSONA CONTRATO -->
            
              <div class="form-group d-none" id="asignacionPersonaContrato">
                  
                <label class="font-weight-normal" for="nuevoAsigPersonaContrato">ASIGNACION PERSONA CONTRATO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="form-control selectpicker show-tick" id="nuevoAsigPersonaContrato" name="nuevoAsigPersonaContrato" data-size="5" title="Elegir...">
                  
                  <option value="1ER CONTRATO">1ER CONTRATO</option>
                  <option value="2DO CONTRATO">2DO CONTRATO</option>

                </select>

              </div>

              <!-- ENTRADA PARA TIPO CONTRATO SUPLENCIA (SOLO SE VE EN TIPO DE CONTRATO SUPLENCIA)-->
            
              <div class="form-group d-none" id="contratoSuplencia">
                
                <label class="font-weight-normal" for="nuevoTipoContratoSuplencia">TIPO DE SUPLENCIA</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="form-control selectpicker show-tick" id="nuevoTipoSuplencia" name="nuevoTipoSuplencia" data-live-search="true" data-size="5" title="Elegir...">
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

              <!-- ENTRADA PARA RESOLUCION MINISTERIAL (SOLO SE VE EN TIPO DE CONTRATO COVID) -->
            
              <!-- <div class="form-group d-none" id="resolucionMinisterial">
                
                <label class="font-weight-normal" for="nuevoResolucionMinisterial">RESOLUCI??N MINISTERIAL</label>
                <i class="fas fa-asterisk asterisk"></i>
                <input type="text" class="form-control" class="form-control" id="nuevoResolucionMinisterial" name="nuevoResolucionMinisterial">

              </div> -->

              <!-- ENTRADA PARA MEMORANDUM INSTRUCTIVO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="nuevoMemorandumInstructivo">MEMORANDUM INSTRUCTIVO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="form-control selectpicker show-tick" id="nuevoMemorandumInstructivo" name="nuevoMemorandumInstructivo" data-live-search="true" data-size="5" title="Elegir...">
                <!-- <select class="form-control form-control-sm select2" data-live-search="true" data-size="5"> -->
                <?php 

                  $item = null;
                  $valor = null;

                  $memorandums = ControladorMemorandums::ctrMostrarMemorandums($item, $valor);

                  foreach ($memorandums as $key => $value) {
                    
                    echo '<option data-subtext="de fecha '.$value["fecha_memorandum"].'" value="'.$value["id_memorandum"].'">N?? '.$value["nro_memorandum"].'</option>';
                  } 

                ?>
                </select>

              </div>

              <div class="row">

                <div class="col-6 col-xs-12">

                  <!-- ENTRADA PARA NRO CONTRATO -->

                  <div class="form-group">
                        
                      <label class="font-weight-normal" for="nuevoNroContrato">NRO. CONTRATO</label>
                      <i class="fas fa-asterisk asterisk"></i>
                      <input type="number" class="form-control" id="nuevoNroContrato" name="nuevoNroContrato" min=1>

                  </div>

                </div>

                <div class="col-6 col-xs-12">

                  <!-- ENTRADA PARA GESTION CONTRATO -->
                
                  <div class="form-group">
                      
                    <label class="font-weight-normal" for="nuevoGestionContrato">GESTI??N CONTRATO</label>
                    <i class="fas fa-asterisk asterisk"></i>
                    <select class="form-control selectpicker show-tick" id="nuevoGestionContrato" name="nuevoGestionContrato" data-size="5" title="Elegir...">
                    <?php 

                      for ($i = date("Y"); $i >= 2020 ; $i--) { 
                        
                        echo '<option value="'.$i.'">'.$i.'</option>';

                      } 

                    ?>
                    </select>

                  </div>

                </div> 

              </div> 

              <!-- ENTRADA PARA LAS OBSERVACIONES -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="nuevoObservacionesContrato">OBSERVACIONES</label>
                <textarea type="text" class="form-control mayuscula" rows="3" id="nuevoObservacionesContrato" name="nuevoObservacionesContrato">

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

          <!-- <?php if ($cantidad_persona_contrato["numero_filas"] < 2) { ?>

          <button type="button" class="btn btn-round btn-outline-success btnGuardar" recurrencia=0>

            <i class="fas fa-save"></i>
            Guardar Datos

          </button>

          <?php } else { ?>

          <button type="button" class="btn btn-round btn-outline-success btnGuardar" recurrencia=1>

            <i class="fas fa-save"></i>
            Guardar Datos

          </button>

          <?php } ?> -->

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
                <select class="form-control selectpicker show-tick" id="editarLugar" name="editarLugar" data-live-search="true" data-size="5">

                </select>

              </div>

              <!-- ENTRADA PARA ESTABLECIMIENTO -->
            
              <div class="form-group">
              
                <label class="font-weight-normal" for="editarEstablecimiento">ESTABLECIMIENTO DE TRABAJO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="form-control selectpicker show-tick" id="editarEstablecimiento" name="editarEstablecimiento" data-live-search="true" data-size="5">

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

              <!-- ENTRADA PARA CERTIFICACION PRESUPUESTARIA -->
            
              <div class="form-group">
                  
                <label class="font-weight-normal" for="editarCertificacion">CERTIFICACI??N PRESUPUESTARIA</label>
                <input type="text" class="form-control" id="editarCertificacion" name="editarCertificacion" data-inputmask="'mask': '999999-999999-9999'">

              </div>

               <!-- ENTRADA PARA SELECCIONAR CARGO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="editarCargoEmpleado">CARGO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="form-control selectpicker show-tick" id="editarCargoEmpleado" name="editarCargoEmpleado" data-live-search="true" data-size="5">                  
                </select>

              </div>

              <!-- ENTRADA PARA SELECCIONAR TIPO CONTRATACION -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="editarTipoContratacion">TIPO CONTRATACION</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="form-control selectpicker show-tick" id="editarTipoContratacion" name="editarTipoContratacion" data-size="5">

                </select>

              </div>

              <!-- ENTRADA PARA SELECCIONAR RECURRENCIA-->
            
              <!-- <div class="form-group">
                
                <input type="checkbox" class="flat"  id="editarRecurrencia" name="editarRecurrencia"> RECURRENCIA

              </div> -->

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
                
                <label class="font-weight-normal" for="editarFechaFin">FECHA FINALIZACI??N</label>
                <i class="fas fa-asterisk asterisk"></i>
                <input type="date" class="form-control" id="editarFechaFin" name="editarFechaFin">

              </div>
      
              <!-- ENTRADA PARA TIPO CONTRATO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="editarTipoContrato">TIPO DE CONTRATO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="form-control selectpicker show-tick" id="editarTipoContrato" name="editarTipoContrato" data-size="5">

                </select>

              </div>

              <!-- ENTRADA PARA ASINACION PERSONA CONTRATO -->
            
              <div class="form-group d-none" id="editarAsignacionPersonaContrato">
                  
                <label class="font-weight-normal" for="editarAsigPersonaContrato">ASIGNACION PERSONA CONTRATO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="form-control selectpicker show-tick" id="editarAsigPersonaContrato" name="editarAsigPersonaContrato" data-size="5">
                  
                  <option value="1ER CONTRATO">1ER CONTRATO</option>
                  <option value="2DO CONTRATO">2DO CONTRATO</option>

                </select>

              </div>

              <!-- ENTRADA PARA TIPO CONTRATO SUPLENCIA -->
            
              <div class="form-group d-none" id="editarContratoSuplencia">
                
                <label class="font-weight-normal" for="editarTipoSuplencia">TIPO DE SUPLENCIA</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="form-control selectpicker show-tick" id="editarTipoSuplencia" name="editarTipoSuplencia" required data-live-search="true" data-size="5">

                </select>

              </div>

              <!-- ENTRADA PARA RESOLUCION MINISTERIAL (SOLO SE VE EN TIPO DE CONTRATO COVID) -->
            
              <!-- <div class="form-group d-none" id="cambiarResolucionMinisterial">
                
                <label class="font-weight-normal" for="editarResolucionMinisterial">RESOLUCI??N MINISTERIAL</label>
                <i class="fas fa-asterisk asterisk"></i>
                <input type="text" class="form-control" class="form-control" id="editarResolucionMinisterial" name="editarResolucionMinisterial">

              </div> -->

              <!-- ENTRADA PARA MEMORANDUM INSTRUCTIVO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="editarMemorandumInstructivo">MEMORANDUM INSTRUCTIVO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="form-control selectpicker show-tick" id="editarMemorandumInstructivo" name="editarMemorandumInstructivo" data-size="5">
               
                </select>

              </div>

              <div class="row">

                <div class="col-6 col-xs-12">

                  <!-- ENTRADA PARA NRO CONTRATO -->

                  <div class="form-group">
                        
                      <label class="font-weight-normal" for="editarNroContrato">NRO. CONTRATO</label>
                      <i class="fas fa-asterisk asterisk"></i>
                      <input type="number" class="form-control" id="editarNroContrato" name="editarNroContrato" min=1>

                  </div>

                </div>

                <div class="col-6 col-xs-12">

                  <!-- ENTRADA PARA GESTION CONTRATO -->
                
                  <div class="form-group">
                  
                    <label class="font-weight-normal" for="editarGestionContrato">GESTI??N CONTRATO</label>
                    <i class="fas fa-asterisk asterisk"></i>
                    <select class="form-control selectpicker show-tick" id="editarGestionContrato" name="editarGestionContrato" data-size="5">
                    <?php 

                      for ($i = 2022; $i >= 2020 ; $i--) { 
                        
                        echo '<option value="'.$i.'">'.$i.'</option>';

                      } 

                    ?>
                    </select>

                  </div>

                </div> 

              </div>           
          
              <!-- ENTRADA PARA LAS OBSERVACIONES -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="editarObservacionesContrato">OBSERVACIONES</label>
                <textarea type="text" class="form-control mayuscula" rows="3" id="editarObservacionesContrato" name="editarObservacionesContrato">

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
  
  <div class="modal-dialog modal-xl">

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
  
  <div class="modal-dialog modal-xl">

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
  
  <div class="modal-dialog modal-xl">

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

            <p class="help-block">Peso m??ximo del archvio 5MB</p>

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
                
                <label class="font-weight-normal" for="ampliarFechaFin">FECHA FINALIZACI??N</label>
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

            <p class="help-block">Peso m??ximo del archvio 5MB</p>

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

<!--=====================================
MODAL AGREGAR PERSONA HEREDERO
======================================-->

<div id="modalAgregarPersonaHeredero" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="agregarPersonaHeredero" aria-hidden="true">
  
  <div class="modal-dialog modal-sm">

    <div class="modal-content">

      <form id="frmNuevoPersonaHeredero">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-modal">

          <h5 class="modal-title" id="agregarPersonaHeredero">Agregar Heredero</h5>
        
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

            <div class="col-md-12 col-sm-12">

              <!-- ENTRADA PARA EL APELLIDO PATERNO -->
              
              <div class="form-group">
                
                <label class="font-weight-normal" for="nuevoPaternoHeredero">APELLIDO PATERNO</label>
                <input type="text" class="form-control mayuscula" id="nuevoPaternoHeredero" name="nuevoPaternoHeredero">

              </div>

              <!-- ENTRADA PARA EL APELLIDO MATERNO -->
            
              <div class="form-group">
              
                <label class="font-weight-normal" for="nuevoMaternoHeredero">APELLIDO MATERNO</label>
                <input type="text" class="form-control mayuscula" id="nuevoMaternoHeredero" name="nuevoMaternoHeredero">

              </div>

              <!-- ENTRADA PARA EL NOMBRE -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="nuevoNombreHeredero">NOMBRE(S)</label>
                <i class="fas fa-asterisk asterisk"></i>
                <input type="text" class="form-control mayuscula" id="nuevoNombreHeredero" name="nuevoNombreHeredero">

              </div>

              <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="nuevoFechaNacimientoHeredero">FECHA NACIMIENTO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <input type="date" class="form-control" id="nuevoFechaNacimientoHeredero" name="nuevoFechaNacimientoHeredero">

              </div>
      
              <!-- ENTRADA PARA PARENTEZCO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="nuevoParentezco">PARENTEZCO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="form-control selectpicker show-tick" id="editarEstablecimiento" id="nuevoParentezco" name="nuevoParentezco" data-live-search="true" data-size="5" title="Elegir...">                  
                  <option value="PADRE">PADRE</option>
                  <option value="MADRE">MADRE</option>
                  <option value="ESPOSO(A)">ESPOSO(A)</option>
                  <option value="CONCUBINO(A)">CONCUBINO(A)</option>
                  <option value="ABUELO">ABUELO</option>
                  <option value="ABUELA">ABUELA</option>
                  <option value="HERMANO">HERMANO</option>
                  <option value="HERMANA">HERMANA</option>
                  <option value="HIJO">HIJO</option>
                  <option value="HIJA">HIJA</option>
                  <option value="NIETO">NIETO</option>
                  <option value="NIETA">NIETA</option>
                  <option value="SUEGRO">SUEGRO</option>
                  <option value="SUEGRA">SUEGRA</option>
                  <option value="TIO">TIO</option>
                  <option value="TIA">TIA</option>
                  <option value="CU??ADO">CU??ADO</option>
                  <option value="CU??ADA">CU??ADA</option>
                  <option value="SOBRINO">SOBRINO</option>
                  <option value="SOBRINA">SOBRINA</option>
                  <option value="PRIMO">PRIMO</option>
                  <option value="PRIMA">PRIMA</option>
                </select>

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
MODAL EDITAR PERSONA HEREDERO
======================================-->

<div id="modalEditarPersonaHeredero" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editarPersonaHeredero" aria-hidden="true">
  
  <div class="modal-dialog modal-sm">

    <div class="modal-content">

      <form id="frmEditarPersonaHeredero">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-modal">

          <h5 class="modal-title" id="editarPersonaHeredero">Editar Heredero</h5>
        
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

            <div class="col-md-12 col-sm-12">

              <!-- ENTRADA PARA EL APELLIDO PATERNO -->
              
              <div class="form-group">
                
                <label class="font-weight-normal" for="editarPaternoHeredero">APELLIDO PATERNO</label>
                <input type="text" class="form-control mayuscula" id="editarPaternoHeredero" name="editarPaternoHeredero">

              </div>

              <!-- ENTRADA PARA EL APELLIDO MATERNO -->
            
              <div class="form-group">
              
                <label class="font-weight-normal" for="editarMaternoHeredero">APELLIDO MATERNO</label>
                <input type="text" class="form-control mayuscula" id="editarMaternoHeredero" name="editarMaternoHeredero">

              </div>

              <!-- ENTRADA PARA EL NOMBRE -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="editarNombreHeredero">NOMBRE(S)</label>
                <i class="fas fa-asterisk asterisk"></i>
                <input type="text" class="form-control mayuscula" id="editarNombreHeredero" name="editarNombreHeredero">

              </div>

              <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="editarFechaNacimientoHeredero">FECHA NACIMIENTO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <input type="date" class="form-control" id="editarFechaNacimientoHeredero" name="editarFechaNacimientoHeredero">

              </div>
      
              <!-- ENTRADA PARA PARENTEZCO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="editarParentezco">PARENTEZCO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="form-control selectpicker show-tick" id="editarParentezco" name="editarParentezco">
                  <option value="PADRE">PADRE</option>
                  <option value="MADRE">MADRE</option>
                  <option value="ESPOSO(A)">ESPOSO(A)</option>
                  <option value="CONCUBINO(A)">CONCUBINO(A)</option>
                  <option value="ABUELO">ABUELO</option>
                  <option value="ABUELA">ABUELA</option>
                  <option value="HERMANO">HERMANO</option>
                  <option value="HERMANA">HERMANA</option>
                  <option value="HIJO">HIJO</option>
                  <option value="HIJA">HIJA</option>
                  <option value="NIETO">NIETO</option>
                  <option value="NIETA">NIETA</option>
                  <option value="SUEGRO">SUEGRO</option>
                  <option value="SUEGRA">SUEGRA</option>
                  <option value="TIO">TIO</option>
                  <option value="TIA">TIA</option>
                  <option value="CU??ADO">CU??ADO</option>
                  <option value="CU??ADA">CU??ADA</option>
                  <option value="SOBRINO">SOBRINO</option>
                  <option value="SOBRINA">SOBRINA</option>
                  <option value="PRIMO">PRIMO</option>
                  <option value="PRIMA">PRIMA</option>
                </select>

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
            Guardar

          </button>

          <input type="hidden" id="idPersonaHeredero" name="idPersonaHeredero">

        </div>

      </form>

    </div>

  </div>

</div>