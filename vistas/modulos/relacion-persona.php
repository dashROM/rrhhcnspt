<?php 

  // Cargar los datos de relacion de novedades
  $item = "id_planilla";
  $valor1 = $parametros[1];
  $valor2 = null;

  $relacion = ControladorPlanillas::ctrMostrarRelacion($item, $valor1, $valor2);

?>

<!-- page content -->
<div class="right_col" role="main">

  <div class="">

    <div class="page-title">

      <div class="title_left">
        <h3>Generar Relación de Novedades</h3>
      </div>

      <div class="title_right">

        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

          <div class="input-group">

            <span class="breadcrumb-item"><a href="<?= SERVERURL; ?>/inicio" class="menu" id="inicio"><i class="fas fa-home"></i> Inicio</a></span>
            <span class="breadcrumb-item active">Generar Relación de Novedades</span>

          </div>

        </div>

      </div>

    </div>

    <div class="clearfix"></div>

    <div class="row">
      
      <div class="col-md-12 col-sm-12 ">
       
        <div class="x_panel">
                  
          <div class="x_title">
          
            <button class="btn btn-round btn-outline-danger btnPDFRelacion" data-toggle="modal" data-target="#modalPDFRelacion" idPlanilla="<?= $parametros[1]; ?>">

              <i class="fas fa-file-pdf"></i>
              Exportar en PDF

            </button>

            <div class="clearfix"></div>

          </div>
        
          <div class="x_content">

            <div class="row">
                
              <div class="col-sm-12">

                <div class="card-header text-center mb-2">
                  
                  <h4 class="m-3 font-weight-bold"><?= strip_tags($relacion["titulo_relacion"]) ; ?></h4> 

                </div>
                            
                <div class="card-box table-responsive">
              
		              <table class="table table-bordered table-striped table-hover" id="tablaRelacionPersona" width="100%">
		                
		                <thead>
		                  
		                  <tr>
		                    <th>#</th>
                        <th>LUGAR</th>
                        <th>PATERNO</th>
                        <th>MATERNO</th>
                        <th>NOMBRE(S)</th>
                        <th>CARNET</th>
                        <th>CARGO</th>
                        <th>INICIO CONTRATO</th>
                        <th>FIN CONTRATO</th>
                        <th>HABER BÁSICO</th>
                        <th>MATRICULA</th>
                        <th>DIAS TRAB.</th>
		                    <th>ACCIONES</th>
		                  </tr>

		                </thead>

		              </table>

		              <input type="hidden" value="<?= $_SESSION['perfil_rrhh']; ?>" id="perfilOculto">

                  <input type="hidden" value="relacion" id="actionPlanilla">

                  <input type="hidden" value="<?= $parametros[1]; ?>" id="idPlanilla">

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
MODAL AGREGAR DIAS TRABAJADOS
======================================-->

<div id="modalAgregarDiasTrabajados" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="agregarDiasTrabajados" aria-hidden="true">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form id="frmAgregarDiasTrabajados">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-modal">

          <h5 class="modal-title" id="agregarDiasTrabajados">Agregar Dias Trabajados</h5>
        
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="btn btn-outline-danger m-0 py-0 px-2">&times;</span>
          </button>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="row mb-3">

            <div class="col-6 col-md-6 col-sm-12">

              <div class="mb-1"><span class="font-weight-bold">Nombre: </span><span id="nombre"></span></div>

              <div class="mb-1"><span class="font-weight-bold">CI: </span><span id="ci"></span></div>

              <div class="mb-1"><span class="font-weight-bold">Cargo: </span><span id="cargo"></span></div>

            </div>

            <div class="col-6 col-md-6 col-sm-12">

              <div class="mb-1"><span class="font-weight-bold">Inicio de Contrato: </span><span id="inicio_contrato"></span></div>

              <div class="mb-1"><span class="font-weight-bold">Fin de Contrato: </span><span id="fin_contrato"></span></div>

            </div>

          </div>

          <div class="row">

            <div class="col-md-12 col-sm-12">

              Campos Obligatorios<i class="fas fa-asterisk asterisk mt-2"></i>
              
            </div>

          </div>
          
          <div class="row">

            <div class="col-md-3 col-sm-4 col-xs-6">

              <!-- ENTRADA PARA LOS DIAS TRABAJADOS -->
            
              <div class="form-group">
                
                <label  for="nuevoDiasTrab">DIAS TRAB.<i class="fas fa-asterisk asterisk"></i></label>
                <input type="number" min="0" max="30" class="form-control" id="nuevoDiasTrab" name="nuevoDiasTrab">

              </div>

            </div>

            <div class="col-md-3 col-sm-4 col-xs-6">

              <!-- ENTRADA PARA EL HABER BÁSICOO -->

              <div class="form-group">
                
                <label  for="nuevoHaberBasico">HABER BÁSICO</label>
                <input type="text" class="form-control" id="nuevoHaberBasico" name="nuevoHaberBasico" readonly="">

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <input type="hidden" id="idPlanillaPersona" name="idPlanillaPersona" value="">

          <button type="button" class="btn btn-round btn-outline-danger float-left" data-dismiss="modal">

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
VENTANA MODAL PARA MOSTRAR RELACION DE NOVEDADES EN PDF
======================================-->

<div id="ver-pdf" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="RelacionPDF" aria-hidden="true">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-modal">

          <h5 class="modal-title" id="RelacionPDF">PDF Generado</h5>
        
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

          <button type="button" lass="btn btn-round btn-outline-danger btnCerrar float-left" data-dismiss="modal">

            <i class="fas fa-times"></i>
            Cerrar

          </button>

        </div>

    </div>

  </div>

</div>