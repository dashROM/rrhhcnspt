<!-- page content -->
<div class="right_col" role="main">

  <div class="">

    <div class="page-title">

      <div class="title_left">

         <h3> Administrar Planillas</h3>
        
      </div>

      <div class="title_right">

        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

          <div class="input-group">

            <span class="breadcrumb-item"><a href="<?= SERVERURL; ?>/inicio" class="menu" id="inicio"><i class="fas fa-home"></i> Inicio</a></span>
            <span class="breadcrumb-item active">Administrar Planillas</span>

          </div>

        </div>

      </div>

    </div>

    <div class="clearfix"></div>

    <div class="row">
      
      <div class="col-md-12 col-sm-12 ">
       
        <div class="x_panel">
                  
          <div class="x_title">
          <!-- 
            <button class="btn btn-round btn-outline-success btnAgregarRelacion" data-toggle="modal" data-target="#modalAgregarRelacion">

              <i class="fas fa-plus"></i>
              Agregar Relación Novedades

            </button> -->

            <div class="clearfix"></div>

          </div>
        
          <div class="x_content">

            <div class="row">
                
              <div class="col-sm-12">
                            
                <div class="card-box table-responsive">
            
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

                  <input type="hidden" value="planilla" id="actionPlanilla">

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
MODAL EDITAR RELACION DE NOVEDADES
======================================-->

<div id="modalEditarPlanilla" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editarPlanilla" aria-hidden="true">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form id="frmEditarPlanilla">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-modal">

          <h5 class="modal-title" id="editarPlanilla">Editar Título Planilla</h5>
        
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

                <label  for="tituloPlanilla">TÍTULO</label>
                <textarea type="text" class="form-control mayuscula" id="tituloPlanilla" name="tituloPlanilla" placeholder="Ingresar Título de Planilla" value=""></textarea>

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