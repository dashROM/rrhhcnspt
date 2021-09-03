<!-- page content -->
<div class="right_col" role="main">

  <div class="">

    <div class="page-title">

      <div class="title_left">

        <h3>Administrar empleados</h3>

      </div>

      <div class="title_right">

        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

          <div class="input-group">

            <span class="breadcrumb-item"><a href="inicio" class="menu" id="inicio"><i class="fas fa-home"></i> Inicio</a></span>
            <span class="breadcrumb-item active">Administrar empleados</span>

          </div>

        </div>

      </div>

    </div>

    <div class="clearfix"></div>

    <div class="row">
      
      <div class="col-md-12 col-sm-12">
       
        <div class="x_panel">
                  
          <div class="x_title">
        
            <button class="btn btn-round btn-outline-success btnAgregarPersona" data-toggle="modal" data-target="#modalAgregarEmpleado">

              <i class="fas fa-plus"></i>
              Agregar Empleado

            </button>

            <div class="clearfix"></div>

          </div>
        
          <div class="x_content">

            <div class="row">
                
              <div class="col-sm-12">
                            
                <div class="card-box table-responsive">
            
                  <table class="table table-bordered table-striped table-hover" id="tablaEmpleados" width="100%">
                    
                    <thead>
                      
                      <tr>
                        <th>#</th>
                        <th>LUGAR</th>
                        <th>NOMBRE EMPLEADO</th>
                        <th>DOCUMENTO CI</th>
                        <th>FECHA NACIM.</th>
                        <th>CARGO</th>
                        <th>INICIO CONTRATO</th>
                        <th>FIN CONTRATO</th>
                        <th>DIAS CONTRATO</th>
                        <th>TIPO CONTRATO</th>
                        <th>ESTADO</th>
                        <th>OBSERVACIONES</th>
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
MODAL AGREGAR EMPLEADO
======================================-->

<div id="modalAgregarEmpleado" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="agregarEmpleado" aria-hidden="true">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form id="frmNuevoEmpleado">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-modal">

          <h5 class="modal-title" id="agregarEmpleado">Agregar Empleado</h5>
        
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

              <!-- ENTRADA PARA ESTABLECIMIENTO -->
            
              <div class="form-group">
              
                <label class="font-weight-normal" for="nuevoEstablecimiento">LUGAR DE TRABAJO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="custom-select select2" id="nuevoEstablecimiento" name="nuevoEstablecimiento" ata-dropdown-css-class="select2-info" style="width: 100%;">
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
                <i class="fas fa-asterisk asterisk"></i>
                <select class="custom-select" id="nuevoBuscarPersona" name="nuevoBuscarPersona" data-toggle="modal" data-target="#modalBuscarPersona">

                  <option value="">SELECCIONE PERSONA...</option>

                </select>

              </div>

              <!-- ENTRADA PARA EL NRO CI -->
            
              <div class="form-group">
                  
                <label class="font-weight-normal" for="nuevoCIEmpleado">NRO. CI</label>
                <input type="text" class="form-control" id="nuevoCIEmpleado" name="nuevoCIEmpleado" readonly="">

              </div>

              <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="nuevoFechaNacimientoEmpleado">FECHA NACIMIENTO</label>
                <input type="date" class="form-control" id="nuevoFechaNacimientoEmpleado" name="nuevoFechaNacimientoEmpleado" readonly>

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
                <input type="date" class="form-control" id="nuevoFechaFin" name="nuevoFechaFin" readonly>

              </div>
      
              <!-- ENTRADA PARA TIPO CONTRATO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="nuevoTipoContrato">TIPO DE CONTRATO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="custom-select select2" id="nuevoTipoContrato" name="nuevoTipoContrato" required>
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

              <!-- ENTRADA PARA LAS OBSERVACIONES -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="nuevoObservacionesEmpleado">OBSERVACIONES</label>
                <textarea type="text" class="form-control mayuscula" rows="2" id="nuevoObservacionesEmpleado" name="nuevoObservacionesEmpleado">

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
            Guardar Empleado

          </button>

        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR EMPLEADO
======================================-->

<div id="modalEditarEmpleado" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editarEmpleado" aria-hidden="true">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form id="frmEditarEmpleado">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-modal">

          <h5 class="modal-title" id="agregarEmpleado">Editar Empleado</h5>
        
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

              <!-- ENTRADA PARA ESTABLECIMIENTO -->
            
              <div class="form-group">
              
                <label class="font-weight-normal" for="editarEstablecimiento">LUGAR DE TRABAJO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="custom-select select2" id="editarEstablecimiento" name="editarEstablecimiento" ata-dropdown-css-class="select2-info" style="width: 100%;">
                </select>

              </div>

              <!-- ENTRADA PARA BUSCAR PERSONA -->
              
              <div class="form-group">
                
                <label class="font-weight-normal" for="editarBuscarPersona">NOMBRE PERSONA</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="custom-select" id="editarBuscarPersona" name="editarBuscarPersona" data-toggle="modal" data-target="#modalBuscarPersona">

                  <option value="">SELECCIONE PERSONA...</option>

                </select>

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
                <input type="date" class="form-control" id="editarFechaFin" name="editarFechaFin" readonly>

              </div>
      
              <!-- ENTRADA PARA TIPO CONTRATO -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="editarTipoContrato">TIPO DE CONTRATO</label>
                <i class="fas fa-asterisk asterisk"></i>
                <select class="custom-select select2" id="editarTipoContrato" name="editarTipoContrato" required>
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

              <!-- ENTRADA PARA LAS OBSERVACIONES -->
            
              <div class="form-group">
                
                <label class="font-weight-normal" for="editarObservacionesEmpleado">OBSERVACIONES</label>
                <textarea type="text" class="form-control mayuscula" rows="4" id="editarObservacionesEmpleado" name="editarObservacionesEmpleado">

                </textarea>

              </div>
      
            </div>  

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <input type="hidden" id="editarIdEmpleado" name="editarIdEmpleado" value="">

          <button type="button" class="btn btn-round btn-outline-danger btnCerrar float-left" data-dismiss="modal">

            <i class="fas fa-times"></i>
            Cerrar

          </button>

          <button type="button" class="btn btn-round btn-outline-success btnGuardar">

            <i class="fas fa-save"></i>
            Guardar Empleado

          </button>

        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL SELECCIONAR PERSONA
======================================-->

<div id="modalBuscarPersona" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="BuscarPersona" aria-hidden="true">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->

      <div class="modal-header bg-modal">

        <h5 class="modal-title" id="modificarUsuario">Buscar Persona</h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="btn btn-outline-danger m-0 py-0 px-2">&times;</span>
        </button>

      </div>

      <!--=====================================
      CUERPO DEL MODAL
      ======================================-->

      <div class="modal-body">

       <!--  <div class="form-row">

          <div class="input-group col-md-3"></div>
          
          <div class="input-group col-md-9">

            <span class="mt-2 mr-2">Buscar:</span>
            
            <input type="text" class="form-control mr-2" id="buscardorPersonas" placeholder="Ingrese Apellidos o Nombre(s) o CI.">

            <button type="button" class="btn btn-success px-2 btnBuscarPersonas">
          
              <i class="fas fa-search"></i> Buscar
            
            </button>  

          </div>     

        </div> -->
 
        <!--=====================================
        SE MUESTRA LAS TABLAS GENERADAS
        ======================================-->            

        <div class="table-responsive" id="tblPersonas">   

          <table class="table table-bordered table-striped dt-responsive" id="buscarTablaPersonas" width="100%">
                
            <thead>
                  
              <tr>
                <th>ID</th>
                <th>APELLIDOS Y NOMBRES</th>
                <th>FOTO</th>
                <th>CI</th>
                <th>FECHA DE NACIMIENTO</th>
                <th>SEXO</th>
                <th>DIRECCIÓN</th>
                <th>TELÉFONO</th>
                <th>EMAIL</th>
              </tr>

            </thead>
                
          </table>

        </div>

      </div>

    </div>

  </div>

</div>