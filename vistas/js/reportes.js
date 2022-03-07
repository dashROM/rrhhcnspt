$(document).on("change", "#reporteGestionContrato", function() {

	$('#tablaReportePersonaContratos').remove();
	$('#tablaReportePersonaContratos_wrapper').remove();

	$("#tablaReporte").append(

		  '<table class="table table-bordered table-striped table-hover" id="tablaReportePersonaContratos" width="100%">'+
	        
	        '<thead>'+
	          
	          '<tr>'+
	            '<th>NRO. CONTR.</th>'+
	            '<th>GESTION CONTRATO</th>'+
	            '<th>APELLIDOS Y NOMBRES</th>'+
	            '<th>NRO. CI</th>'+
	            '<th>FECHA NACIM.</th>'+
	            '<th>MATRICULA</th>'+
	            '<th>ESTABL. CONTRATO</th>'+
	            '<th>CONTRATO</th>'+
	            '<th>TIPO CONTRATACION</th>'+
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

	$gestionContrato = $("#reporteGestionContrato").val();
	console.log("$gestionContrato", $gestionContrato);

	$("#tablaReporte").removeClass("d-none");

	var tablaReportePersonaContratos = $('#tablaReportePersonaContratos').DataTable({

		"ajax": {
			url: "ajax/datatable-reportes.ajax.php",
			data: { 'gestionContrato' : $gestionContrato, 'reportePersonaContratos' : 'reportePersonaContratos' },
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
			{
				extend:    		'pdfHtml5',
        download: 		'open',
				orientation: 	'landscape',
				text:      		'<i class="fas fa-file-pdf"></i> Generar PDF',
				title: 				'CONTRATOS CNS REGIONAL POTOSI GESTION '+$gestionContrato,
				titleAttr: 		'Exportar a PDF',
				className: 		'btn btn-round btn-danger'
			},
			// {
			// 	extend:    'print',
			// 	text:      '<i class="fa fa-print"></i> Imprimir',
			// 	titleAttr: 'Imprimir',
			// 	className: 'btn btn-info'
			// },
		]

	});

});