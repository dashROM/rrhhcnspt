/*=============================================
VALIDANDO DATOS DE NUEVA PERSONA
=============================================*/
$("#frmReportePersonaContrato").validate({

  	rules: {
  		reporteTipoContrato : { required: true},
   		reporteGestionContrato : { required: true}, 		  
  	},

  	messages: {
		reporteTipoContrato : "Elija una opción de contrato",
		reporteGestionContrato : "Elija una gestion",
	},

});

/*=============================================
GENERANDO EL REPORTE DE CONTRATOS FILTRADO POR TIPO DE CONTRATO Y GESTION
=============================================*/

$(document).on("click", ".btnReporteContarto", function() {

	if ($("#frmReportePersonaContrato").valid()) {

		$('#tablaReportePersonaContratos').remove();
		$('#tablaReportePersonaContratos_wrapper').remove();

		$("#tablaReporte").append(

			  '<table class="table table-bordered table-striped table-hover" id="tablaReportePersonaContratos" width="100%">'+
		        
		        '<thead>'+
		          
		          '<tr>'+
		            '<th>NRO. CONTR.</th>'+
		            '<th>APELLIDOS Y NOMBRES</th>'+
		            '<th>NRO. CI</th>'+
		            '<th>FECHA NACIM.</th>'+
		            '<th>MATRICULA</th>'+
		            '<th>ESTABL. CONTRATO</th>'+
		            '<th>TIPO CONTRATACION</th>'+
		            '<th>CARGO</th>'+
		            '<th>HABER BASICO</th>'+
		            '<th>INICIO CONTRATO</th>'+
		            '<th>FIN CONTRATO</th>'+
		            '<th>DIAS CONTRATO</th>'+
		          '</tr>'+

		        '</thead>'+
		        
		      '</table>'  

	  );       		

		/*=============================================
		CARGAR LA TABLA DINÁMICA DE PERSONA CONTRATOS
		=============================================*/

		$idContrato = $("#reporteTipoContrato").val();
		$gestionContrato = $("#reporteGestionContrato").val();	

		$("#tablaReporte").removeClass("d-none");

		var tablaReportePersonaContratos = $('#tablaReportePersonaContratos').DataTable({

			"ajax": {
				url: "ajax/datatable-reportes.ajax.php",
				data: { 'idContrato' : $idContrato, 'gestionContrato' : $gestionContrato, 'reportePersonaContratos' : 'reportePersonaContratos' },
				type: "post"
			},

			"deferRender": true,

			"processing" : true,

			"language": {

				"sProcessing":     "Procesando...",
				"sLengthMenu":     "Mostrar _MENU_ registros",
				"sZeroRecords":    "No se encontraron resultados",
				"sEmptyTable":     "Ningún dato disponible en esta tabla",
				"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
				"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
				"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix":    "",
				"sSearch":         "Buscar:",
				"sUrl":            "",
				"sInfoThousands":  ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
				"sFirst":    "Primero",
				"sLast":     "Último",
				"sNext":     "Siguiente",
				"sPrevious": "Anterior"
				},
				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
				
			},

			"lengthChange": false,

			"searching": true,

			"ordering": false, 

			"info": true,

			//para usar los botones   
	        "responsive": true,

			"dom": 'Bfrtilp',       
		        
		    "buttons":[ 
				{
					extend:    'excelHtml5',
					title: 	   'CONTRATOS CNS REGIONAL POTOSI GESTION '+$gestionContrato,
					text:      '<i class="fas fa-file-excel"></i> Generar EXCEL',
					titleAttr: 'Exportar a Excel',
					className: 'btn btn-round btn-success'
				},
				// {
				// 	extend:    		'pdfHtml5',
	   //      download: 		'open',
				// 	orientation: 	'landscape',
				// 	text:      		'<i class="fas fa-file-pdf"></i> Generar PDF',
				// 	title: 				'CONTRATOS CNS REGIONAL POTOSI GESTION '+$gestionContrato,
				// 	titleAttr: 		'Exportar a PDF',
				// 	className: 		'btn btn-round btn-danger'
				// },
				// {
				// 	extend:    'print',
				// 	text:      '<i class="fa fa-print"></i> Imprimir',
				// 	titleAttr: 'Imprimir',
				// 	className: 'btn btn-info'
				// },
			]

		});

	} 

});