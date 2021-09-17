<!-- page content -->
<div class="right_col" role="main">

  <div class="">

    <div class="page-title">

      <div class="title_left">
        <h3>Relación de Novedades</h3>
      </div>

      <div class="title_right">

        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

          <div class="input-group">

            <span class="breadcrumb-item"><a href="<?= SERVERURL; ?>/inicio" class="menu" id="inicio"><i class="fas fa-home"></i> Inicio</a></span>
            <span class="breadcrumb-item active">Relación de Novedades</span>

          </div>

        </div>

      </div>

    </div>

    <div class="clearfix"></div>

    <div class="row">
      
      <div class="col-md-12 col-sm-12 ">
       
        <div class="x_panel">
                  
          <div class="x_title">
          
            <button class="btn btn-round btn-outline-success btnAgregarRelacion" data-toggle="modal" data-target="#modalAgregarRelacion">

              <i class="fas fa-plus"></i>
              Agregar Relación Novedades

            </button>

            <div class="clearfix"></div>

          </div>
        
          <div class="x_content">

            <div class="row">
                
              <div class="col-sm-12">
                            
                <div class="card-box table-responsive">
              
		              <table class="table table-bordered table-striped dt-responsive table-hover" id="tablaRelacion" width="100%">
		                
		                <thead>
		                  
		                  <tr>
		                    <th>#</th>
		                    <th>TÍTULO</th>
		                    <th>MES</th>
		                    <th>GESTIÓN</th>
		                    <th>TIPO CONTRATO</th>
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
MODAL AGREGAR NUEVA RELACION DE NOVEDADES
======================================-->

<div id="modalAgregarRelacion" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="agregarRelacion" aria-hidden="true">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form id="frmNuevoRelacion">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-modal">

          <h5 class="modal-title" id="agregarRelacion">Agregar Relación de Novedades</h5>
        
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

            <div class="col-md-6 col-sm-6 col-xs-6">

              <!-- ENTRADA PARA EL MES -->

              <div class="form-group">

                <label for="nuevoMes">MES<span class="text-danger"> *</span></label>
	              <select class="custom-select" id="nuevoMes" name="nuevoMes">
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

            </div>

            <div class="col-md-6 col-sm-6 col-xs-6">

              <!-- ENTRADA PARA LA GESTION -->

              <div class="form-group">

               <label for="nuevoGestion">GESTIÓN<span class="text-danger"> *</span></label>
	              <select class="custom-select" id="nuevoGestion" name="nuevoGestion">
	                <option value="">ELEGIR...</option>
	                <option value="<?= date('Y') ?>"><?= date('Y') ?></option>
	                <option value="<?= date('Y')-1 ?>"><?= date('Y')-1 ?></option>
	              </select>

              </div>

            </div>

          </div>

          <div class="row">

            <div class="col-md-6 col-sm-6 col-xs-12">

              <!-- ENTRADA PARA EL NOMBRE -->

              <div class="form-group">

                <label for="nuevoTipoContrato">TIPO DE CONTRATO<span class="text-danger"> *</span></label>
	              <select class="custom-select" id="nuevoTipoContrato" name="nuevoTipoContrato" required>
	                <option value="">ELEGIR...</option>
	                <?php 

	                  $item = null;
	                  $valor = null;

	                  $contratos = ControladorContratos::ctrMostrarContratos($item, $valor);

	                  var_dump($contratos);

	                  foreach ($contratos as $key => $value) {
	                    
	                    echo '<option value="'.$value["id_contrato"].'">'.$value["nombre_contrato"].'</option>';
	                  } 

	                ?>
	              </select>

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
            Guardar

          </button>

        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR RELACION DE NOVEDADES
======================================-->

<div id="modalEditarRelacion" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editarRelacion" aria-hidden="true">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form id="frmEditarRelacion">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-modal">

          <h5 class="modal-title" id="editarRelacion">Agregar Relación de Novedades</h5>
        
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

            <div class="col-md-12 col-sm-12 col-xs-12">

              <!-- ENTRADA PARA EL TITULO -->

              <div class="form-group">

                <label for="tituloRelacion">TÍTULO</label>
                <textarea type="text" class="form-control mayuscula" id="tituloRelacion" name="tituloRelacion"></textarea>

              </div>

            </div>

          </div>     

          <div class="row">

            <div class="col-md-6 col-sm-6 col-xs-6">

              <!-- ENTRADA PARA EL MES -->

              <div class="form-group">

                <label for="editarMes">MES<span class="text-danger"> *</span></label>
                <input type="text" class="form-control" id="editarMes" name="editarMes" value="" readonly="">

              </div>

            </div>

            <div class="col-md-6 col-sm-6 col-xs-6">

              <!-- ENTRADA PARA LA GESTION -->

              <div class="form-group">

                <label for="editarGestion">GESTIÓN<span class="text-danger"> *</span></label>
                <input type="text" class="form-control" id="editarGestion" name="editarGestion" value="" readonly>

              </div>

            </div>

          </div>

          <div class="row">

            <div class="col-md-6 col-sm-6 col-xs-12">

              <!-- ENTRADA PARA EL NOMBRE -->

              <div class="form-group">

                <label for="editarTipoContrato">TIPO DE CONTRATO<span class="text-danger"> *</span></label>
                <input type="text" class="form-control" id="editarTipoContrato" name="editarTipoContrato" value="" readonly="">

              </div>

            </div>

          </div>     

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <input type="hidden" id="editarIdPlanilla" value="">

          <button type="button" class="btn btn-round btn-outline-danger float-left" data-dismiss="modal">

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