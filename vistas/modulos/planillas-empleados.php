<?php 

  // Cargar los datos de planilla
  $item = "id_planilla";
  $valor1 = $_GET["idPlanilla"];
  $valor2 = null;

  $planilla = ControladorPlanillas::ctrMostrarPlanillas($item, $valor1, $valor2);

  // Convertir numero de Mes a su valor literal
  setlocale(LC_TIME, 'spanish');
  $numero = $planilla["mes_planilla"];
  $dateObj   = DateTime::createFromFormat('!m', $numero);
  $mes = strftime('%B', $dateObj->getTimestamp());


?>
<div class="content-wrapper">

  <div class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1 class="m-0 text-dark">

            Generar Planilla

          </h1>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="inicio" class="menu" id="inicio"><i class="fas fa-home"></i> Inicio</a></li>

            <li class="breadcrumb-item active">Generar Planilla</li>

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
        
              <h5 class="text-center"><?= $planilla["titulo_planilla"]." CORRESPONDIENTE AL MES DE ".strtoupper($mes)." ".$planilla["gestion_planilla"] ?></h5>

            </div>
        
            <div class="card-body">

              <div>

                <!-- <button class="btn btn-success btnPlanillaImpositiva" idPlanilla="<?= $_GET["idPlanilla"] ?>">

                  <i class="fas fa-file-alt"></i>
                  Ver Planilla Impositiva

                </button> -->

                <a class="btn btn-info btnGenerarPlanilla text-white mb-2 float-right" idPlanilla="<?= $_GET["idPlanilla"]?>">

                  <i class="fas fa-file-pdf"></i>
                  Imprimir Planilla PDF

                </a>

                <a class="btn btn-info btnGenerarBoletas text-white mr-2 mb-2 float-right" idPlanilla="<?= $_GET["idPlanilla"]?>">

                  <i class="fas fa-file-pdf"></i>
                  Imprimir Boletas PDF

                </a>

              </div>

              <div class="table-responsive">
                
                <table class="table table-bordered table-striped table-hover" id="tablaGenerarPlanilla" width="100%">
                
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

                    $totalesPlanilla = ControladorPlanillasEmpleados::ctrMostrarTotalesPlanillaEmpleado($item, $valor);

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

              </div>

              <div>
                
                <input type="hidden" value="<?= $_SESSION['perfil']; ?>" id="perfilOculto">
                <input type="hidden" value="<?= $planilla['id_planilla']; ?>" id="idPlanilla">

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
    
  </section>
  
</div>

<!--=====================================
MODAL GENERAL IMPORTES
======================================-->

<div id="modalGenerarImportes" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="generarImportes" aria-hidden="true">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form id="frmAgregarImportes" onsubmit="return false">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-gradient-success">

          <h5 class="modal-title" id="generarImportes">Generar Importes</h5>
        
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

            <!-- ENTRADA PARA LOS DIAS TRABAJADOS -->
            
            <div class="form-group col-md-2">
              
              <label  for="nuevoDiasTrab">DIAS TRAB.<span class="text-danger font-weight-bold"> *</span></label>
              <input type="number" min="0" max="30" class="form-control mayuscula" id="nuevoDiasTrab" name="nuevoDiasTrab">

            </div>

            <!-- ENTRADA PARA EL HABER BÁSICOO -->

            <div class="form-group col-md-3">
              
              <label  for="nuevoHaberBasico">HABER BÁSICO</label>
              <input type="text" class="form-control mayuscula" id="nuevoHaberBasico" name="nuevoHaberBasico" readonly="">

            </div>

            <!-- ENTRADA PARA EL TOTAL GANADO -->

            <div class="form-group col-md-3">
              
              <label  for="nuevoTotalGanado">TOTAL GANADO</label>
              <input type="text" class="form-control mayuscula" id="nuevoTotalGanado" name="nuevoTotalGanado" readonly>

            </div>

          </div>

          <div class="form-row">

            <!-- ENTRADA PARA EL DESCUENTO AFP -->

            <div class="form-group col-md-3">
              
              <label  for="nuevoDescAFP">AFP PREVISIÓN</label>
              <input type="text" class="form-control mayuscula" id="nuevoDescAFP" name="nuevoDescAFP" readonly>

            </div>

            <!-- ENTRADA PARA EL DESCUENTO SOLIDARIO -->

            <!-- <div class="form-group col-md-3">
              
              <label  for="nuevoDescSolidario">SOLIDARIO 0,50%</label>
              <input type="text" class="form-control mayuscula" id="nuevoDescSolidario" name="nuevoDescSolidario" readonly>

            </div> -->

            <!-- ENTRADA PARA EL TOTAL DESCUENTO -->

            <div class="form-group col-md-3">
              
              <label  for="nuevoTotalDesc">TOTAL DESCUENTO</label>
              <input type="number" class="form-control mayuscula" id="nuevoTotalDesc" name="nuevoTotalDesc" readonly>

            </div>

             <!-- ENTRADA PARA EL LIQUIDO PAGABLE -->

            <div class="form-group col-md-3">
              
              <label  for="nuevoLiquidoPagable">LIQUIDO PAGABLE</label>
              <input type="number" class="form-control mayuscula" id="nuevoLiquidoPagable" name="nuevoLiquidoPagable" readonly>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <input type="hidden" id="idPlanillaEmpleado" value="">

          <button type="button" class="btn btn-default btnCerrar float-left" data-dismiss="modal">

            <i class="fas fa-times"></i>
            Cerrar

          </button>

          <button type="button" class="btn btn-success btnGuardar">

            <i class="fas fa-save"></i>
            Guardar Datos

          </button>

        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR GENERAR IMPORTES
======================================-->

<div id="modalEditarMovEmpleado" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modificarMovEmpleado" aria-hidden="true">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" onsubmit="return false">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-gradient-success">

          <h5 class="modal-title" id="modificarMovEmpleado">Editar Movimiento Empleado</h5>
        
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default btnCerrar float-left" data-dismiss="modal">

            <i class="fas fa-times"></i>
            Cerrar

          </button>

          <button type="submit" class="btn btn-success">

            <i class="fas fa-save"></i>
            Guardar Cambios

          </button>

        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
VENTANA MODAL PARA MOSTRAR BOLETA PDF
======================================-->

<div id="ver-pdf" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="boletaPDF" aria-hidden="true">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-gradient-success">

          <h5 class="modal-title" id="boletaPDF">PDF Generado</h5>
        
          <button type="button" class="close btnCerrarReporte" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
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

          <button type="button" class="btn btn-default float-left btnCerrarReporte" data-dismiss="modal">

            <i class="fas fa-times"></i>
            Cerrar

          </button>

        </div>

    </div>

  </div>

</div>