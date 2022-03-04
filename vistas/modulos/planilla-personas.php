<?php 

  // Cargar los datos de relacion de novedades
  $item = "id_planilla";
  $valor1 = $parametros[1];
  $valor2 = null;

  $planilla = ControladorPlanillas::ctrMostrarPlanilla($item, $valor1, $valor2);

?>

<!-- page content -->
<div class="right_col" role="main">

  <div class="">

    <div class="page-title">

      <div class="title_left">

        <h3>Generar Planilla de Sueldos y Salarios</h3>

      </div>

      <div class="title_right">

        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

          <div class="input-group">

            <span class="breadcrumb-item"><a href="<?= SERVERURL; ?>/inicio" class="menu" id="inicio"><i class="fas fa-home"></i> Inicio</a></span>
            <span class="breadcrumb-item"><a href="<?= SERVERURL; ?>/planillas" class="menu" id="planillas"></i> Administrar Planillas</a></span>
            <span class="breadcrumb-item active">Generar Planilla</span>

          </div>

        </div>

      </div>

    </div>

    <div class="clearfix"></div>

    <div class="row">
      
      <div class="col-md-12 col-sm-12 ">
       
        <div class="x_panel">
                  
          <div class="x_title">
          
            <button class="btn btn-round btn-outline-danger btnPDFPlanilla" data-toggle="modal" data-target="#modalPDFPlanilla" idPlanilla="<?= $parametros[1]; ?>">

              <i class="fas fa-file-pdf"></i>
              Exportar Planilla en PDF

            </button>

            <button class="btn btn-round btn-outline-danger btnPDFBoletas" data-toggle="modal" data-target="#modalPDFBoleta" idPlanilla="<?= $parametros[1]; ?>">

              <i class="fas fa-file-pdf"></i>
              Exportar Boletas en PDF

            </button>

            <div class="clearfix"></div>

          </div>
        
          <div class="x_content">

            <div class="row">
                
              <div class="col-sm-12">

                <div class="card-header text-center mb-2">
                  
                  <h4 class="m-3 font-weight-bold"><?= strip_tags($planilla["titulo_planilla"]) ; ?></h4>

                </div>
                            
                <div class="card-box table-responsive">
              
		              <table class="table table-bordered table-striped table-hover" id="tablaPlanillaPersona" width="100%">
		                
		                <thead>
		                  
		                   <tr>
                        <th>#</th>
                        <th>LUGAR</th>
                        <th>PATERNO</th>
                        <th>MATERNO</th>
                        <th>NOMBRE(S)</th>
                        <th>CARNET</th>
                        <th>CARGO</th>
                        <th>HABER BÁSICO</th>
                        <th>DIAS TRAB.</th>
                        <th>TOTAL GANADO</th>
                        <th>PREVISION AFP</th>
                        <!-- <th>SOLIDARIO 0,50%</th> -->
                        <th>TOTAL DESC.</th>
                        <th>LIQUIDO PAGABLE</th>
                        <th>ACCIONES</th>
                      </tr>

		                </thead>

                     <?php 

                      $item = "id_planilla";
                      $valor = $planilla['id_planilla'];

                      $totalesPlanilla = ControladorPlanillasPersonas::ctrMostrarTotalesPlanillaPersonas($item, $valor);

                    ?>

                    <tfoot>
                      <th colspan="9">TOTAL GENERAL</th>
                      <th class="totalGanadoT"><?= number_format($totalesPlanilla["total_ganado"], 2, ",", ".") ?></th>
                      <th class="descAFPT"><?= number_format($totalesPlanilla["desc_afp"], 2, ",", ".") ?></th>
                      <!-- <th class="descSolidarioT"><?= number_format($totalesPlanilla["desc_solidario"], 2, ",", ".") ?></th> -->
                      <th class="totalDescT"><?= number_format($totalesPlanilla["total_desc"], 2, ",", ".") ?></th>
                      <th class="liquidoPagableT"><?= number_format($totalesPlanilla["liquido_pagable"], 2, ",", ".") ?></th>
                      <th></th>
                    </tfoot>

		              </table>

		              <input type="hidden" value="<?= $_SESSION['perfil_rrhh']; ?>" id="perfilOculto">

                  <input type="hidden" value="planilla" id="actionPlanilla">

                  <input type="hidden" value="<?= $parametros[1]; ?>" id="idPlanilla">

             		</div>

                <div>

                  <div class="form-row">       
                      
                    <div class="col-md-12">
                      
                      <label><u>RESUMEN GENERAL</u></label>
                     
                    </div>

                  </div>  

                  <div class="form-row">       
                      
                    <div class="col-md-10">
                      
                      <label class="mb-0">MES GANADO</label>
                     
                    </div>

                    <div class="col-md-1 text-right totalGanadoT">
                      
                      <?= number_format($totalesPlanilla["total_ganado"], 2, ",", ".") ?>
                     
                    </div>

                  </div> 

                  <div class="form-row">       
                      
                    <div class="col-md-6">
                      
                      <label class="mb-0">PREVISION AFP</label>
                     
                    </div>

                    <div class="col-md-1 text-right descAFPT">
                      
                      <?= number_format($totalesPlanilla["desc_afp"], 2, ",", ".") ?>
                     
                    </div>

                  </div> 

                  <!-- <div class="form-row">       
                      
                    <div class="col-md-6">
                      
                      <label class="mb-0">SOLIDARIO 0,50%</label>
                     
                    </div>

                    <div class="col-md-1 text-right descSolidarioT" style="border-bottom: 1px solid #000">
                      
                      <?= number_format($totalesPlanilla["desc_solidario"], 2, ",", ".") ?>
                     
                    </div>

                  </div>  -->

                  <div class="form-row">       
                      
                    <div class="col-md-7">
                      
                      <label class="mb-0">TOTAL DESCUENTO</label>
                     
                    </div>

                    <div class="col-md-1 text-right totalDescT">
                      
                      <?= number_format($totalesPlanilla["total_desc"], 2, ",", ".") ?>
                     
                    </div>

                  </div>       

                  <div class="form-row">       
                      
                    <div class="col-md-7">
                      
                      <label class="mb-0">LIQUIDO PAGABLE</label>
                     
                    </div>

                    <div class="col-md-1 text-right liquidoPagableT">
                      
                      <?= number_format($totalesPlanilla["liquido_pagable"], 2, ",", ".") ?>
                     
                    </div>

                  </div>     

                  <div class="form-row">       
                      
                    <div class="col-md-7">
                     
                    </div>

                    <div class="col-md-1 text-right" style="border-top: 1px solid #000; border-bottom: 3px double #000">
                      
                      <label class="mb-0 totalGanadoT"><?= number_format($totalesPlanilla["total_ganado"], 2, ",", ".") ?></label>
                     
                    </div>

                     <div class="col-md-3 text-right" style="border-top: 1px solid #000; border-bottom: 3px double #000;">
                      
                      <label class="mb-0 totalGanadoT"><?= number_format($totalesPlanilla["total_ganado"], 2, ",", ".") ?></label>
                     
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
<!-- /page content -->


<!--=====================================
VENTANA MODAL PARA MOSTRAR PLANILLA EN PDF
======================================-->

<div id="ver-pdf" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="PlanillaPDF" aria-hidden="true">
  
  <div class="modal-dialog modal-xl">

    <div class="modal-content">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-modal">

          <h5 class="modal-title" id="PlanillaPDF">PDF Generado</h5>
        
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