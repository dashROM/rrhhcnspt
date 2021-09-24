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