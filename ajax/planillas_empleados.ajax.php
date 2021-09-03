<?php

require_once "../controladores/planillas.controlador.php";
require_once "../controladores/planillas_empleados.controlador.php";

require_once "../modelos/planillas.modelo.php";
require_once "../modelos/planillas_empleados.modelo.php";

require_once('../extensiones/tcpdf/tcpdf.php');

class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'cns-logo-simple.png';
        $this->Image($image_file, 5, 5, 15, '', 'PNG', '', 'T', false, 100, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 10);
        // Titulo
        $this->Cell(0, 0, '   CAJA NACIONAL DE SALUD', 0, 1, 'L', 0, '', 1);
        // Subtitulo
        $this->Cell(0, 0, '                      SECC. PLANILLAS REG.', 0, 1, 'L', 0, '', 1);
        $this->Cell(0, 0, '                          Potosí -0- Bolivia', 0, 1, 'L', 0, '', 1);

	}

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

class AjaxPlanillasEmpleados {
	 
	public $id_planilla; 
	public $id_planilla_empleado; 

	/*=============================================
	MOSTRAR DATOS DE PLANILLAS EMPLEADOS
	=============================================*/

	public function ajaxMostrarPlanillaEmpleado()	{

		$item = "id_planilla_empleado";
		$valor = $this->id_planilla_empleado;

		$respuesta = ControladorPlanillasEmpleados::ctrMostrarPlanillaEmpleado($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	MOSTRAR DATOS DE PLANILLAS EMPLEADOS COMPLETO
	=============================================*/

	public function ajaxMostrarPlanillaEmpleadoCompleto()	{

		$item = "id_planilla_empleado";
		$valor = $this->id_planilla_empleado;

		$respuesta = ControladorPlanillasEmpleados::ctrMostrarPlanillaEmpleadoCompleto($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	MOSTRAR TOTALES DE UNA PLANILLAS EMPLEADOS
	=============================================*/

	public function ajaxMostrarTotalesPlanillaEmpleado()	{

		$item = "id_planilla";
		$valor = $this->id_planilla;

		$respuesta = ControladorPlanillasEmpleados::ctrMostrarTotalesPlanillaEmpleado($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	CREAR DATOS DE IMPORTES PARA LA PLANILLA EMPLEADOS
	=============================================*/
	
	public $dias_trabajados; 
	public $total_ganado;
	public $desc_afp; 
	public $desc_solidario; 
	public $total_desc; 
	public $liquido_pagable; 

	public function ajaxAgregarImportes()	{

		/*=============================================
		ALMACENANDO LOS DATOS EN LA BD
		=============================================*/

		$datos = array( "dias_trabajados"	   => $this->dias_trabajados, 
						"total_ganado"         => $this->total_ganado,
						"desc_afp"             => $this->desc_afp,
						"desc_solidario"       => $this->desc_solidario,
						"total_desc"           => $this->total_desc,
						"liquido_pagable"      => $this->liquido_pagable,
						"id_planilla_empleado" => $this->id_planilla_empleado,
						);	

		// var_dump($datos);

		$respuesta = ControladorPlanillasEmpleados::ctrAgregarImportes($datos);

		echo $respuesta;

	}

	/*=============================================
	GENERAR BOLETA EMPLEADO EN PDF 
	=============================================*/

	public function ajaxMostrarBoletaEmpleadoPDF()	{

		/*=============================================
	   	TRAEMOS LOS DATOS DE PLANILLA EMPLEADO
	    =============================================*/
			
		$item = "id_planilla_empleado";
		$valor = $this->id_planilla_empleado;

		$planilla_empleado = ControladorPlanillasEmpleados::ctrMostrarPlanillaEmpleadoCompleto($item, $valor);

		/*=============================================
	   	TRAEMOS LOS DATOS DE PLANILLA
	    =============================================*/
			
		$item = "id_planilla";
		$valor1 = $planilla_empleado["id_planilla"];
		$valor2 = null;

		$planilla = ControladorPlanillas::ctrMostrarPlanillas($item, $valor1, $valor2);

		// Convertir numero de Mes a su valor literal
		setlocale(LC_TIME, 'spanish');
		$numero = $planilla["mes_planilla"];
		$dateObj   = DateTime::createFromFormat('!m', $numero);
		$mes = strftime('%B', $dateObj->getTimestamp());

		// Extend the TCPDF class to create custom Header and Footer

		$pdf = new MYPDF('P', 'mm', 'A5', true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('CNS Potosí');
		$pdf->SetTitle('Boleta-'.$valor);
		$pdf->SetSubject('Boleta de pago CNS');
		$pdf->SetKeywords('TCPDF, PDF, CNS, Reporte,Boleta, Planilla');

		$pdf->setPrintHeader(false); 
		$pdf->setPrintFooter(false);

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(5, 5, 5, 0);
		$pdf->SetAutoPageBreak(true, 5); 
		$pdf->SetHeaderMargin(5);
		$pdf->SetFooterMargin(5);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// ---------------------------------------------------------

		// set font
		$pdf->SetFont('Helvetica', '', 8);

		$pdf->SetPrintFooter(false);

		// add a page
		$pdf->AddPage();

		$content = '';

		  	$content .= '

		  	<html lang="es">
			<head>

				<style>
					
					body {
						font-size: 28px;
						margin: 4px;
						padding: 4px;
					}

					.content div{

							line-height: 6px;

						}

					.font-weight-bold {

						font-weight: bold;

					}

					.titulo {

						text-align: center;
						line-height: 3px;

					}

					.datos-personales {

						border-top: 1px solid #000; 
						border-bottom: 1px solid #000;
					}

					.firma {

						width: 200px; 
						border-top: 1px dashed #000; 
						margin-left: auto; 
						margin-right: auto;

					}

				</style>

			</head>

			<body>

				<div class="content" border="1">

					<div style="line-height: 0px;">
					
						<h3 class="titulo" style="line-height: 4px;">BOLETAS DE PAGO</h3>

						<h4 class="titulo">'.$planilla["tipo_contrato"].'</h4>

					</div>

					<div class="header_boleta">
				    	<table>
				    		<tr>
				    			<td colspan="2">Detalle de pago por el Mes de:</td>
				    			<td><b>'.strtoupper($mes).' '.$planilla["gestion_planilla"].'</b></td>
				    			<td></td>
				    		</tr>
				    		<tr>
				    			<td>Dias Trabajados:</td>
				    			<td>'.$planilla_empleado["dias_trabajados"].'</td>
				    			<td colspan="2"></td>
				    		</tr>
				    		<tr>
				    			<td colspan="4"></td>
				    		</tr>
				    		<tr>
				    			<td>'.$planilla_empleado["paterno_empleado"].'</td>
				    			<td>'.$planilla_empleado["materno_empleado"].'</td>
				    			<td>'.$planilla_empleado["nombre_empleado"].'</td>
				    			<td></td>
				    		</tr>

				    		<tr>
				    			<th width="115px" class="datos-personales">AP. PATERNO</th>
				    			<th width="115px" class="datos-personales">AP. MATERNO</th>
				    			<th width="120px" class="datos-personales">NOMBRE(S)</th>
				    			<th width="115px" class="datos-personales"></th>
				    		</tr>
				    		<tr>
				    			<td colspan="3"><u>Haberes</u>:</td>
				    			<td>Detalle General</td>
				    		</tr>
				    		<tr>
				    			<td colspan="4"></td>
				    		</tr>
				    		<tr>
				    			<td colspan="3">Sueldo</td>
				    			<td align="right">'.number_format($planilla_empleado["total_ganado"], 2, ",", ".").'</td>
				    		</tr>
				    		<tr>
				    			<td colspan="3">Bono de Antigüedad</td>
				    			<td></td>
				    		</tr>
				    		<tr>
				    			<td colspan="3">Domingos y Feriado</td>
				    			<td></td>
				    		</tr>
				    		<tr>
				    			<td colspan="3">P.TG.B. RIESG.</td>
				    			<td></td>
				    		</tr>
				    		<tr>
				    			<td colspan="3">Trabajo Nocturno</td>
				    			<td></td>
				    		</tr>
				    		<tr>
				    			<td colspan="3">Escalafón</td>
				    			<td></td>
				    		</tr>
				    		<tr>
				    			<td colspan="3">Categ. Profesional</td>
				    			<td></td>
				    		</tr>
				    		<tr>
				    			<td></td>
				    		</tr>
				    		<tr>
				    			<td colspan="2" align="right">Total Ganado Bs.</td>
				    			<td></td>
				    			<td align="right" style="border-top: 1px solid #000">'.number_format($planilla_empleado["total_ganado"], 2, ",", ".").'</td>
				    		</tr>
				    		<tr>
				    			<td colspan="4"></td>
				    		</tr>
				    		<tr>
				    			<td colspan="3"><u>Descuentos</u>:</td>
				    			<td></td>
				    		</tr>
				    		<tr>
				    			<td colspan="4"></td>
				    		</tr>
				    		<tr>
				    			<td colspan="3">A.F.P.S. 12,71%</td>
				    			<td align="right">'.number_format($planilla_empleado["desc_afp"], 2, ",", ".").'</td>
				    		</tr>
				    		<tr>
				    			<td colspan="3">Seguro Salud F.</td>
				    			<td align="right"></td>
				    		</tr>
				    		<tr>
				    			<td colspan="3">Comcipo</td>
				    			<td align="right"></td>
				    		</tr>
				    		<tr>
				    			<td colspan="4"></td>
				    		</tr>
				    		<tr>
				    			<td colspan="2" align="right">Total Descuentos Bs.</td>
				    			<td></td>
				    			<td align="right" style="border-bottom: 1px solid #000">'.number_format($planilla_empleado["total_desc"], 2, ",", ".").'</td>
				    		</tr>
				    		<tr>
				    			<td colspan="2" align="right">LIQUIDO PAGABLE Bs.</td>
				    			<td></td>
				    			<td align="right" style="border-bottom: 3px double #000">'.number_format($planilla_empleado["liquido_pagable"], 2, ",", ".").'</td>
				    		</tr>

				    	</table>
				    	<br><br>

				    </div>

				    <div style="text-align: center; margin-top: 150px;">
					
						<h4 class="firma">RECIBIDO CONFORME</h4>

					</div>

				</div>

			</body>

			</html>';
			
		// Reconociendo la estructura HTML
		$pdf->writeHTML($content, true, 0, true, true);

		// Insertando el Logo
		$image_file = K_PATH_IMAGES.'cns-logo-simple.png';

		$pdf->Image($image_file, 13, 9, 13, '', 'PNG', '', 'T', false, 100, '', false, false, 0, false, false, false);

		// Estilos necesarios para el Codigo QR
		$style = array(
		    'border' => 0,
		    'vpadding' => 'auto',
		    'hpadding' => 'auto',
		    'fgcolor' => array(0,0,0),
		    'bgcolor' => false, //array(255,255,255)
		    'module_width' => 1, // width of a single module in points
		    'module_height' => 1 // height of a single module in points
		);

		//	Datos a mostrar en el código QR
		$codeContents = 'COD. BOLETA: '.$this->id_planilla_empleado."\n";

		// insertando el código QR
		$pdf->write2DBarcode($codeContents, 'QRCODE,L', 120, 8, 15, 15, $style, 'N');	

		$pdf->lastPage();

		$pdf->output('../temp/boleta-'.$valor.'.pdf', 'F');

	}

	/*=============================================
	GENERAR PLANILLA EN PDF 
	=============================================*/

	public function ajaxMostrarPlanillaPDF() {			

		/*=============================================
	   	TRAEMOS LOS DATOS DE PLANILLA
	    =============================================*/

		$item = "id_planilla";
		$valor1 = $this->id_planilla;
		$valor2 = null;

		$planilla = ControladorPlanillas::ctrMostrarPlanillas($item, $valor1, $valor2);

		// Convertir numero de Mes a su valor literal
		setlocale(LC_TIME, 'spanish');
		$numero = $planilla["mes_planilla"];
		$dateObj   = DateTime::createFromFormat('!m', $numero);
		$mes = strftime('%B', $dateObj->getTimestamp());

		/*=============================================
	   	TRAEMOS LOS DATOS DE PLANILLA EMPLEADOS
	    =============================================*/

		$datos_planilla = ControladorPlanillas::ctrMostrarGenerarPlanilla($item, $valor1, $valor2);

		// Extend the TCPDF class to create custom Header and Footer

		$pdf = new MYPDF('L', 'mm', 'Letter', true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('CNS Potosí');
		$pdf->SetTitle('Planilla-'.$valor1);
		$pdf->SetSubject('Planilla de pago CNS');
		$pdf->SetKeywords('TCPDF, PDF, CNS, Reporte, Pago, Planilla');
	
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(5, 15, 5, 0);
		$pdf->SetAutoPageBreak(true, 5); 
		$pdf->SetHeaderMargin(5);
		$pdf->SetFooterMargin(5);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// ---------------------------------------------------------

		// set font
		$pdf->SetFont('Helvetica', '', 8);

		$pdf->SetPrintFooter(false);

		// add a page
		$pdf->AddPage();

		$content = '';

		  	$content .= '

		  	<html lang="es">
			<head>

				<style>
					
					body {

						font-size: 28px;
						margin: 4px;
						padding: 4px;

					}

					.font-weight-bold {

						font-weight: bold;

					}

					.titulo {

						text-align: center;
						line-height: 3px;

					}

					.datos-personales {

						border-top: 1px solid #000; 
						border-bottom: 1px solid #000;
					}

					.firma {

						width: 200px; 
						border-top: 1px dashed #000; 
						margin-left: auto; 
						margin-right: auto;

					}

					.linea_simple {

						border-top: 1px solid #000; 
						border-bottom: 1px solid #000;

					}

					.linea_punteada {

						border-bottom: 1px dashed #d0d0d0;
						
					}

				</style>

			</head>

			<body>

				<div class="content">

					<div class="header_planilla">
					
						<h3 class="titulo" style="line-height: 5px">'.$planilla["titulo_planilla"].' CORRESPONDIENTE AL MES DE '.strtoupper($mes).' '.$planilla["gestion_planilla"].'</h3>


					</div>
					<div class="body_planilla">

						<table>
			                    
		                    <tr>
								<td width="15px" align="center" class="linea_simple">#</td>
								<td width="55px" align="center" class="linea_simple">LUGAR</td>
								<td width="80px" class="linea_simple">PATERNO</td>
								<td width="80px" class="linea_simple">MATERNO</td>
								<td width="80px" class="linea_simple">NOMBRE(S)</td>
								<td width="80px" align="center" class="linea_simple">CARNET</td>
								<td width="120px" align="center" class="linea_simple">CARGO</td>
								<td width="65px" align="center" class="linea_simple">HABER BÁSICO</td>
								<td width="50px" align="center" class="linea_simple">DIAS TRAB.</td>
								<td width="65px" align="center" class="linea_simple">TOTAL GANADO</td>
								<td width="60px" align="center" class="linea_simple">PREVISION AFP</td>
								<td width="65px" align="center" class="linea_simple">TOTAL DESC.</td>
								<td width="65px" align="center" class="linea_simple">LIQUIDO PAGABLE</td>
			                </tr>';
			                
						for ($i = 0; $i < count($datos_planilla); $i++) {

		                	$content .= '
		                	<tr>
		                		<td width="15px" align="center" class="linea_punteada">'.($i+1).'</td>
		                		<td width="55px" align="center" class="linea_punteada">'.$datos_planilla[$i]["abrev_establecimiento"].'</td>
		                		<td width="80px" class="linea_punteada">'.$datos_planilla[$i]["paterno_empleado"].'</td>
		                		<td width="80px" class="linea_punteada">'.$datos_planilla[$i]["materno_empleado"].'</td>
		                		<td width="80px" class="linea_punteada">'.$datos_planilla[$i]["nombre_empleado"].'</td>
		                		<td width="80px" class="linea_punteada">'.$datos_planilla[$i]["ci_empleado"].'</td>
		                		<td width="120px" class="linea_punteada">'.$datos_planilla[$i]["nombre_cargo"].'</td>
		                		<td width="65px" align="right" class="linea_punteada">'.number_format($datos_planilla[$i]["haber_basico"], 2, ",", ".").'</td>
		                		<td width="50px" align="center" class="linea_punteada">'.$datos_planilla[$i]["dias_trabajados"].'</td>
		                		<td width="65px" align="right" class="linea_punteada">'.number_format($datos_planilla[$i]["total_ganado"], 2, ",", ".").'</td>
		                		<td width="60px" align="right" class="linea_punteada">'.number_format($datos_planilla[$i]["desc_afp"], 2, ",", ".").'</td>
		                		<td width="65px" align="right" class="linea_punteada">'.number_format($datos_planilla[$i]["total_desc"], 2, ",", ".").'</td>
		                		<td width="65px" align="right" class="linea_punteada">'.number_format($datos_planilla[$i]["liquido_pagable"], 2, ",", ".").'</td>
		                	</tr>';

		                }

	                    $item = "id_planilla";
	                    $valor = $planilla['id_planilla'];

	                    $totales_planilla = ControladorPlanillasEmpleados::ctrMostrarTotalesPlanillaEmpleado($item, $valor);

		                $content .= '
			              
			                <tr>
			                    <td align="center" class="linea_simple font-weight-bold" colspan="9">TOTAL GENERAL</td>
			                    <td align="right" class="linea_simple font-weight-bold">'.number_format($totales_planilla["total_ganado"], 2, ",", ".").'</td>
			                    <td align="right" class="linea_simple font-weight-bold">'.number_format($totales_planilla["desc_afp"], 2, ",", ".").'</td>
			                    <td align="right" class="linea_simple font-weight-bold">'.number_format($totales_planilla["total_desc"], 2, ",", ".").'</td>
			                    <td align="right" class="linea_simple font-weight-bold">'.number_format($totales_planilla["liquido_pagable"], 2, ",", ".").'</td>
			                </tr>
					    	<br><br>
					    	<tr>
			                    <td class="font-weight-bold" colspan="14"><u>RESUMEN GENERAL</u></td>
			                </tr>
			                <tr>
			                    <td class="font-weight-bold" colspan="12">MES GANADO</td>
			                    <td align="right" colspan="2">'.number_format($totales_planilla["total_ganado"], 2, ",", ".").'</td>
			                </tr>
			                <tr>
			                    <td class="font-weight-bold" colspan="8">PREVISION A.F.P.</td>
			                    <td align="right">'.number_format($totales_planilla["desc_afp"], 2, ",", ".").'</td>
			                </tr>
			                <tr>
			                    <td class="font-weight-bold" colspan="9">TOTAL DESCUENTO</td>
			                    <td align="right">'.number_format($totales_planilla["total_desc"], 2, ",", ".").'</td>
			                </tr>
			                <tr>
			                    <td class="font-weight-bold" colspan="9">LIQUIDO PAGABLE</td>
			                    <td align="right">'.number_format($totales_planilla["liquido_pagable"], 2, ",", ".").'</td>
			                </tr>
			                <tr>
			                    <td class="font-weight-bold" colspan="9"></td>
			                    <td align="right" style="border-top: 1px solid #000; border-bottom: 3px double #000">'.number_format($totales_planilla["total_ganado"], 2, ",", ".").'</td>
			                    <td align="right" style="border-top: 1px solid #000; border-bottom: 3px double #000" colspan="4">'.number_format($totales_planilla["total_ganado"], 2, ",", ".").'</td>
			                </tr>

				    	</table>

				    </div>
				    <br><br><br><br><br><br>
				    <div class="footer_planilla">
				    	
				    	<table>
				    		<tr>
				    			<td align="center">SR. SALUSTIO MORALES C.<br><label class="font-weight-bold">ENC. DE PLANILLAS</label></td>
				    			<td align="center">SR. J. MANUEL MEDINA LIMACHI<br><label class="font-weight-bold">SUPERVISOR ADMINISTRATIVO I</label></td>
				    			<td align="center">LIC JUAN C. CALLAPINO J.<br><label class="font-weight-bold">ENC. DE CONTABILIDAD</label></td>
				    			<td align="center">LIC. RICARDO MIRANDA MICHEL<br><label class="font-weight-bold">JEFE SERV. GENERALES</label></td>
				    			<td align="center">DR. ARMANDO SARDINAS CRUZ<br><label class="font-weight-bold">ADMINISTRADOR REGIONAL</label></td>
				    		</tr>
				    	</table>

				    </div>

				</div>

			</body>

			</html>';
			
		// Reconociendo la estructura HTML
		$pdf->writeHTML($content, true, 0, true, true);


		// Estilos necesarios para el Codigo QR
		$style = array(
		    'border' => 0,
		    'vpadding' => 'auto',
		    'hpadding' => 'auto',
		    'fgcolor' => array(0,0,0),
		    'bgcolor' => false, //array(255,255,255)
		    'module_width' => 1, // width of a single module in points
		    'module_height' => 1 // height of a single module in points
		);

		//	Datos a mostrar en el código QR
		$codeContents = 'COD. PLANILLA: '.$this->id_planilla."\n";

		// insertando el código QR
		$pdf->write2DBarcode($codeContents, 'QRCODE,L', 250, 8, 15, 15, $style, 'N');	

		$pdf->lastPage();

		$pdf->output('../temp/planilla-'.$valor1.'.pdf', 'F');

	}


}

/*=============================================
MOSTRAR DATOS DE PLANILLAS EMPLEADOS
=============================================*/

if (isset($_POST["mostrarPlanillaEmpleado"])) {

	$mostrarPlanillasEmpleados = new AjaxPlanillasEmpleados();
	$mostrarPlanillasEmpleados -> id_planilla_empleado = $_POST["id_planilla_empleado"];
	$mostrarPlanillasEmpleados -> ajaxMostrarPlanillaEmpleado();

}

/*=============================================
MOSTRAR DATOS DE PLANILLAS EMPLEADOS
=============================================*/

if (isset($_POST["mostrarPlanillaEmpleadoCompleto"])) {

	$mostrarPlanillasEmpleados = new AjaxPlanillasEmpleados();
	$mostrarPlanillasEmpleados -> id_planilla_empleado = $_POST["id_planilla_empleado"];
	$mostrarPlanillasEmpleados -> ajaxMostrarPlanillaEmpleadoCompleto();

}

/*=============================================
MOSTRAR DATOS DE PLANILLAS EMPLEADOS
=============================================*/

if (isset($_POST["mostrarTotalesPlanillaEmpleado"])) {

	$mostrarTotalesPlanillasEmpleados = new AjaxPlanillasEmpleados();
	$mostrarTotalesPlanillasEmpleados -> id_planilla = $_POST["id_planilla"];
	$mostrarTotalesPlanillasEmpleados -> ajaxMostrarTotalesPlanillaEmpleado();

}

/*=============================================
CREAR DATOS DE PERSONA CONTACTO EN LA FICHA EPIDEMIOLOGICA
=============================================*/

if (isset($_POST["agregarImportes"])) {

	$agregarImportes = new AjaxPlanillasEmpleados();
	$agregarImportes -> dias_trabajados = $_POST["dias_trabajados"];
	$agregarImportes -> total_ganado = $_POST["total_ganado"];
	$agregarImportes -> desc_afp = $_POST["desc_afp"];
	// $agregarImportes -> desc_solidario = $_POST["desc_solidario"];
	$agregarImportes -> total_desc = $_POST["total_desc"];
	$agregarImportes -> liquido_pagable = $_POST["liquido_pagable"];
	$agregarImportes -> id_planilla_empleado = $_POST["id_planilla_empleado"];
	$agregarImportes -> ajaxAgregarImportes();

}

/*=============================================
GENERAR BOLETA EMPLEADO EN PDF 
=============================================*/

if (isset($_POST["boletaEmpleadoPDF"])) {

	$boletaEmpleadoPDF = new AjaxPlanillasEmpleados();
	$boletaEmpleadoPDF -> id_planilla_empleado = $_POST["id_planilla_empleado"];
	$boletaEmpleadoPDF -> ajaxMostrarBoletaEmpleadoPDF();

}

if (isset($_POST["generarPlanillaPDF"])) {

	$generarPlanillaPDF = new AjaxPlanillasEmpleados();
	$generarPlanillaPDF -> id_planilla = $_POST["id_planilla"];
	$generarPlanillaPDF -> ajaxMostrarPlanillaPDF();

}