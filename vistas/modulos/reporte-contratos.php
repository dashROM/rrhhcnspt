<!-- page content -->
<div class="right_col" role="main">

  <div class="">

    <div class="page-title">

      <div class="title_left">

        <h3>Reporte Contratos</h3>

      </div>

      <div class="title_right">

        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

          <div class="input-group">

            <span class="breadcrumb-item"><a href="<?= SERVERURL; ?>/inicio" class="menu" id="inicio"><i class="fas fa-home"></i> Inicio</a></span>
            <span class="breadcrumb-item active">Reporte contratos</span>

          </div>

        </div>

      </div>

    </div>

    <div class="clearfix"></div>

    <div class="row">
      
      <div class="col-md-12 col-sm-12">
       
        <div class="x_panel">

          <div class="x_title">

            <form id="frmReportePersonaContrato">

              <div class="row">
                <label class="font-weight-bold col-md-3 offset-md-2 col-form-label" for="reporteTipoContrato">SELECCIONE UN GRUPO DE CONTRATO</label>
                <div class="col-md-4">
                  <select class="form-control selectpicker show-tick" id="reporteTipoContrato" name="reporteTipoContrato" data-size="5" title="Elegir...">
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
              </div>

              <div class="row">
                <label class="font-weight-bold col-md-3 offset-md-2 col-form-label" for="reporteGestionContrato">SELECCIONE UNA GESTION</label>
                <div class="col-md-2">
                  <select class="form-control selectpicker show-tick mr-2" id="reporteGestionContrato" name="reporteGestionContrato" data-size="5" title="Elegir...">
                    <?php 

                      for ($i = date("Y"); $i >= 2020 ; $i--) { 
                        
                        echo '<option value="'.$i.'">'.$i.'</option>';

                      } 

                    ?>
                  </select>
                </div>
              </div>

              <div class="row form-inline justify-content-center">

                <button type="button" class="btn btn-primary px-2 btnReporteContarto">
              
                  <i class="fas fa-search"></i> Buscar
                
                </button>  

                <!-- <button type="button" class="btn btn-danger px-2 btnReporteGestionContartoPDF">
              
                  <i class="fas fa-file-pdf"></i></i> Exportar PDF
                
                </button> -->  
              </div>

            </form>

            <div class="clearfix"></div>

          </div>
        
          <div class="x_content d-none" id="tablaReporte">

            <div class="row">

              <div class="col-sm-12">

                <div class="tituloTabla">

                  <h3>Listado de Contratos</h3>

                </div>
                            
                <div class="card-box table-responsive">
            
                  <table class="table table-bordered table-striped table-hover" id="tablaReportePersonaContratos" width="100%">
                    
                    <thead>
                      
                      <tr>
                        <th>NRO. CONTR.</th>
                        <th>APELLIDOS Y NOMBRES</th>
                        <th>NRO. CI</th>
                        <th>FECHA NACIM.</th>
                        <th>MATRICULA</th>
                        <th>ESTABL. CONTRATO</th>
                        <th>TIPO CONTRATACION</th>
                        <th>CARGO</th>
                        <th>HABER BASICO</th>
                        <th>INICIO CONTRATO</th>
                        <th>FIN CONTRATO</th>
                        <th>DIAS CONTRATO</th>
                      </tr>

                    </thead>

                  </table>

                </div>
          
              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>
  
</div>