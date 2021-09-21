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
          
            <button class="btn btn-round btn-outline-danger btnPDFRelacion" data-toggle="modal" data-target="#modalPDFRelacion">

              <i class="fas fa-file-pdf"></i>
              Exportar en PDF

            </button>

            <div class="clearfix"></div>

          </div>
        
          <div class="x_content">

            <div class="row">
                
              <div class="col-sm-12">

                <div class="card-header text-center mb-2">
                  
                  <h4> <?= strip_tags($relacion["titulo_relacion"]) ; ?></h4> 

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