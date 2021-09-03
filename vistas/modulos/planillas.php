<div class="content-wrapper">

  <div class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1 class="m-0 text-dark">

            Administrar Planillas

          </h1>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="inicio" class="menu" id="inicio"><i class="fas fa-home"></i> Inicio</a></li>

            <li class="breadcrumb-item active">Administrar Planillas</li>

          </ol>

        </div>

      </div>

    </div>

  </div>

  <section class="content">

    <div class="container-fluid">

      <div class="row">
        
        <div class="col-12">

          <div class="card">
        
            <div class="card-header">
        
              <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarPlanilla">

                <i class="fas fa-plus"></i>
                Agregar Planilla

              </button>

            </div>
        
            <div class="card-body">
              
              <table class="table table-bordered table-striped dt-responsive table-hover" id="tablaPlanillas" width="100%">
                
                <thead>
                  
                  <tr>
                    <th>#</th>
                    <th>TÍTULO PLANILLA</th>
                    <th>MES</th>
                    <th>GESTIÓN</th>
                    <th>TIPO CONTRATO</th>
                    <th>ACCIONES</th>
                  </tr>

                </thead>

              </table>

              <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOculto">

            </div>
            
          </div>

        </div>

      </div>

    </div>
    
  </section>
  
</div>

<!--=====================================
MODAL AGREGAR PLANILLA
======================================-->

<div id="modalAgregarPlanilla" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="agregarPlanilla" aria-hidden="true">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form id="frmNuevoPlanilla">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-gradient-success">

          <h5 class="modal-title" id="agregarPlanilla">Agregar Planilla</h5>
        
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="form-row">

            Campos Obligatorios<h5 class="text-danger"> *</h5>
            
          </div> 
          
          <div class="form-row">

            <!-- ENTRADA PARA EL TÍTULO DE LA PLANILLA -->
            
            <div class="form-group col-md-12">
              
              <label  for="nuevoTituloPlanilla">TÍTULO DE LA PLANILLA</label>
              <textarea type="text" class="form-control mayuscula" id="nuevoTituloPlanilla" name="nuevoTituloPlanilla" placeholder="Ingresar Título de la Planilla"></textarea>

            </div>

          </div>
          
          <div class="form-row">

            <!-- ENTRADA PARA EL MES DE LA PLANILLA -->
          
            <div class="form-group col-md-2">
              
              <label for="nuevoMesPlanilla">MES<span class="text-danger"> *</span></label>
              <select class="custom-select" id="nuevoMesPlanilla" name="nuevoMesPlanilla">
                <option value="">ELEGIR...</option>
                <option value="1">ENERO</option>
                <option value="2">FEBRERO</option>
                <option value="3">MARZO</option>
                <option value="4">ABRIL</option>
                <option value="5">MAYO</option>
                <option value="6">JUNIO</option>
                <option value="7">JULIO</option>
                <option value="8">AGOSTO</option>
                <option value="9">SEPTIEMBRE</option>
                <option value="10">OCTUBRE</option>
                <option value="11">NOVIEMBRE</option>
                <option value="12">DICIEMBRE</option>
              </select>

            </div>

            <!-- ENTRADA PARA LA GESTION -->
          
            <div class="form-group col-md-2">
              
              <label for="nuevoGestionPlanilla">GESTIÓN<span class="text-danger"> *</span></label>
              <select class="custom-select" id="nuevoGestionPlanilla" name="nuevoGestionPlanilla">
                <option value="">ELEGIR...</option>
                <option value="<?= date('Y') ?>"><?= date('Y') ?></option>
                <option value="<?= date('Y')-1 ?>"><?= date('Y')-1 ?></option>
              </select>

            </div>

            <!-- ENTRADA PARA TIPO CONTRATO -->
          
            <div class="form-group col-md-4">
              
              <label for="nuevoTipoContrato">TIPO DE CONTRATO<span class="text-danger"> *</span></label>
              <select class="custom-select" id="nuevoTipoContrato" name="nuevoTipoContrato" required>
                <option value="">ELEGIR...</option>
                <?php 

                  $item = null;
                  $valor = null;

                  $contratos = ControladorContratos::ctrMostrarContratos($item, $valor);

                  var_dump($contratos);

                  foreach ($contratos as $key => $value) {
                    
                    echo '<option value="'.$value["id_contrato"].'">'.$value["tipo_contrato"].'</option>';
                  } 

                ?>
              </select>

            </div>
    
          </div>  

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default btnCerrar float-left" data-dismiss="modal">

            <i class="fas fa-times"></i>
            Cerrar

          </button>

          <button type="button" class="btn btn-success btnGuardar">

            <i class="fas fa-save"></i>
            Guardar Planilla

          </button>

        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR PLANILLA
======================================-->

<div id="modalEditarPlanilla" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editarPlanilla" aria-hidden="true">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form id="frmEditarPlanilla">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-gradient-success">

          <h5 class="modal-title" id="editarPlanilla">Editar Planilla</h5>
        
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="form-row">

            Campos Obligatorios<h5 class="text-danger"> *</h5>
            
          </div> 
          
          <div class="form-row">

            <!-- ENTRADA PARA EL TÍTULO DE LA PLANILLA -->
            
            <div class="form-group col-md-12">
              
              <label  for="editarTituloPlanilla">TÍTULO DE LA PLANILLA</label>
              <textarea type="text" class="form-control mayuscula" id="editarTituloPlanilla" name="editarTituloPlanilla" placeholder="Ingresar Título de la Planilla" value=""></textarea>

            </div>

          </div>
          
          <div class="form-row">

            <!-- ENTRADA PARA EL MES DE LA PLANILLA -->
          
            <div class="form-group col-md-2">
              
              <label for="editarMesPlanilla">MES<span class="text-danger"> *</span></label>
              <input type="text" class="form-control" id="editarMesPlanilla" name="editarMesPlanilla" value="" readonly="">

            </div>

            <!-- ENTRADA PARA LA GESTION -->
          
            <div class="form-group col-md-2">
              
              <label for="editarGestionPlanilla">GESTIÓN<span class="text-danger"> *</span></label>
              <input type="text" class="form-control" id="editarGestionPlanilla" name="editarGestionPlanilla" value="" readonly>

            </div>

            <!-- ENTRADA PARA TIPO CONTRATO -->     
            <div class="form-group col-md-4">
              
              <label for="editarTipoContrato">TIPO DE CONTRATO<span class="text-danger"> *</span></label>
              <input type="text" class="form-control" id="editarTipoContrato" name="editarTipoContrato" value="" readonly="">

            </div>
    
          </div>  

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <input type="hidden" id="editarIdPlanilla" value="">

          <button type="button" class="btn btn-default btnCerrar float-left" data-dismiss="modal">

            <i class="fas fa-times"></i>
            Cerrar

          </button>

          <button type="button" class="btn btn-success btnGuardar">

            <i class="fas fa-save"></i>
            Guardar Cambios

          </button>

        </div>

      </form>

    </div>

  </div>

</div>