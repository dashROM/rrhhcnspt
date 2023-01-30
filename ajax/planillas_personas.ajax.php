<?php

require_once "../controladores/planillas.controlador.php";
require_once "../controladores/planillas_personas.controlador.php";
require_once "../controladores/autoridades.controlador.php";

require_once "../modelos/planillas.modelo.php";
require_once "../modelos/planillas_personas.modelo.php";
require_once "../modelos/autoridades.modelo.php";

// require_once('../extensiones/tcpdf/tcpdf.php');
require_once "../extensiones/TCPDF-main/tcpdf.php";

class MYPDF extends TCPDF {

	public $id_planilla;
	public $mes_planilla;
	public $gestion_planilla;
	public $id_planilla_persona_contrato;
	public $paterno_persona;
	public $materno_persona;
	public $nombre_persona;
	public $dias_trabajados;
	public $headerPlanilla = false;

	//Page header

    public function Header() {

        if ($this->headerPlanilla === true) {

        	// Set font
	        $this->SetFont('helvetica', 'B', 10);
        	// Titul
	        $this->Cell(0, 0, 'CAJA NACIONAL DE SALUD', 0, 1, 'C', 0, '', 1);
	        // Subtitulo
	        $this->Cell(0, 8, 'SECC. PLANILLAS REG.', 0, 1, 'C', 0, '', 1);
	        $this->Cell(0, 3, 'Potosí -0- Bolivia', 0, 1, 'C', 0, '', 1);

	         // set border width
			$this->SetLineWidth(0.05);

			// set color for cell border
			$this->SetDrawColor(0,0,0);

			// set filling color
			$this->SetFillColor(0,0,0);

			// set cell height ratio
			$this->setCellHeightRatio(0.025);

	        $this->Cell(285, 0, '', 'B', 1, 'C', 1, '', 0, false, 'T', 'C');
            
	        // Logo
	        $image_file = K_PATH_IMAGES.'cns-logo-actual.jpg';
	        $this->Image($image_file, 5, 5, 12, '', 'JPG', '', 'T', false, 100, '', false, false, 0, false, false, false);

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
			$codeContents = 'COD. PLANILLA: '.$this->id_planilla."\n"."MES PLANILLA: ".$this->mes_planilla."\n"."GESTION PLANILLA: ".$this->gestion_planilla;

			// insertando el código QR
			$this->write2DBarcode($codeContents, 'QRCODE,L', 275, 3, 18, 18, $style, 'N');


        } elseif ($this->headerBoleta === true) {
            
	        // Logo
	        $image_file = K_PATH_IMAGES.'cns-logo-actual.jpg';
	        $this->Image($image_file, 2, 6, 20, '', 'JPG', '', 'T', false, 100, '', false, false, 0, false, false, false);

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
			$codeContents = 'COD. BOLETA: '.$this->id_planilla_persona_contrato."\n"."MES PLANILLA: ".$this->mes_planilla."\n"."GESTION PLANILLA: ".$this->gestion_planilla."\n"."NOMBRE: ".$this->nombre_persona."\n"."A. PATERNO: ".$this->paterno_persona."\n"."A. MATERNO: ".$this->materno_persona."\n"."DIAS TRAB.: ".$this->dias_trabajados;

			// insertando el código QR
			$this->write2DBarcode($codeContents, 'QRCODE,L', 185, 5, 30, 30, $style, 'N');

	        // Imagen Marca de Agua
	        $image_file2 = K_PATH_IMAGES.'cns-marca-agua.jpg';
	        $this->Image($image_file2, 70, 10, 80, '', 'JPG', '', '', false, 300, '', false, false, 0);

	        // Set font
	        $this->SetFont('helvetica', '', 7);

	        $this->MultiCell(185, 5, 'Boleta Generada Por el Sistema de Recursos Humanos CNS Regional Potosí', 0, 'L', 0, 0, 3, 130, true);

	        // Set font
	        $this->SetFont('helvetica', 'B', 12);

        } else {

        	// Set font
	        $this->SetFont('helvetica', 'B', 12);
	        // Titulo
	        $this->Cell(0, 0, 'CAJA NACIONAL DE SALUD', 0, 1, 'C', 0, '', 1);
	        // Subtitulo
	        $this->Cell(0, 10, 'JEFATURA DE RECURSOS HUMANOS', 0, 1, 'C', 0, '', 1);
	        $this->Cell(0, 5, 'Potosí *-* Bolivia', 0, 1, 'C', 0, '', 1);

	        // set border width
			$this->SetLineWidth(0.05);

			// set color for cell border

			$this->SetDrawColor(0,0,0);

			// set filling color
			$this->SetFillColor(0,0,0);

			// set cell height ratio
			$this->setCellHeightRatio(0.025);

	        $this->Cell(285, 0, '', 'B', 1, 'C', 1, '', 0, false, 'T', 'C');
            
            // Logo
	        $image_file = K_PATH_IMAGES.'cns-logo-actual.jpg';
	        $this->Image($image_file, 5, 5, 12, '', 'JPG', '', 'T', false, 100, '', false, false, 0, false, false, false);

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
			$codeContents = 'COD. RELACION DE NOVEDADES: '.$this->id_planilla."\n";

			// insertando el código QR
			$this->write2DBarcode($codeContents, 'QRCODE,L', 270, 3, 30, 30, $style, 'N');

        } 

    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

class AjaxPlanillasPersonas {
	  
	public $id_planilla_persona_contrato; 

	/*=============================================
	MOSTRAR DATOS DE RELACION DE NOVEDADES DE PERSONAL
	=============================================*/

	public function mostrarRelacionNovedadesPersona()	{

		$item = "id_planilla_persona_contrato";
		$valor = $this->id_planilla_persona_contrato;

		$respuesta = ControladorPlanillasPersonas::ctrMostrarRelacionNovedadesPersona($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	MOSTRAR DATOS DE RELACION DE NOVEDADES DE PERSONAL COMPLETO
	=============================================*/

	public function ajaxMostrarRelacionNovedadesPersonaCompleto()	{

		$item = "id_planilla_persona_contrato";
		$valor = $this->id_planilla_persona_contrato;

		$respuesta = ControladorPlanillasEmpleados::ctrMostrarRelacionPersonaCompleto($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	MOSTRAR TOTALES DE UNA PLANILLAS EMPLEADOS
	=============================================*/

	public function ajaxMostrarTotalesPlanillaEmpleado()	{

		$item = "id_planilla";
		$valor = $this->id_planilla;

		$respuesta = ControladorPlanillasPersonas::ctrMostrarTotalesPlanillaEmpleado($item, $valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	CREAR DATOS DE IMPORTES PARA LA PLANILLA EMPLEADOS
	=============================================*/
	
	public $dias_trabajados; 
	public $haber_basico; 

	public function ajaxAgregarDiasTrabajados()	{

		/*=============================================
		OPTENEMOS DATOS DE PERSONA SEGUN PLANILLA PERSONA CONTRATO
		=============================================*/

		$item = "id_planilla_persona_contrato";
		$valor = $this->id_planilla_persona_contrato;

		$respuesta = ControladorPlanillasPersonas::ctrMostrarRelacionNovedadesPersona($item, $valor);

		/*=============================================
		CALCULAMOS LA EDAD DE LA PERSONA
		=============================================*/

		$fecha_nacimiento = new DateTime($respuesta["fecha_nacimiento"]);
		$hoy = new DateTime();
		$edad = $hoy->diff($fecha_nacimiento);

		// var_dump ($edad->y);

		/*=============================================
		CALCULOS PARA PLANILLAS
		=============================================*/

		$total_ganado = round(($this->haber_basico * $this->dias_trabajados)/30,2);

		if ($edad->y < 65) {

			$desc_afp = round($total_ganado * 0.1271,2);

		} else {

			$desc_afp = round($total_ganado * 0.11,2);

		}

		$total_desc = $desc_afp;

		$liquido_pagable = round($total_ganado - $total_desc,2);


		/*=============================================
		ALMACENANDO LOS DATOS EN LA BD
		=============================================*/

		$datos = array( "dias_trabajados"	   			=> $this->dias_trabajados,
		                "total_ganado"	   			    => $total_ganado,
		                "desc_afp"	   			        => $desc_afp,
		                "total_desc"	   			    => $total_desc,
		                "liquido_pagable"	   			=> $liquido_pagable, 
						"id_planilla_persona_contrato"  => $this->id_planilla_persona_contrato,
						);	

		$respuesta = ControladorPlanillasPersonas::ctrAgregarDiasTrabajados($datos);

		echo $respuesta;

	}

	/*=============================================
	GENERAR RELACION DE NOVEDADES EN PDF 
	=============================================*/

	public function ajaxMostrarRelacionPDF() {			

		/*=============================================
	   	TRAEMOS LOS DATOS DE PLANILLA
	    =============================================*/

		$item = "id_planilla";
		$valor1 = $this->id_planilla;
		$valor2 = null;

		$planilla = ControladorPlanillas::ctrMostrarPlanilla($item, $valor1, $valor2);

		// Convertir numero de Mes a su valor literal
		setlocale(LC_TIME, 'spanish');
		$numero = $planilla["mes_planilla"];
		$dateObj   = DateTime::createFromFormat('!m', $numero);
		$mes = strftime('%B', $dateObj->getTimestamp());

		/*=============================================
	   	TRAEMOS LOS DATOS DE PLANILLA RELACION DE NOVEDADES
	    =============================================*/

		$datos_planilla = ControladorPlanillas::ctrMostrarGenerarRelacion($item, $valor1, $valor2);

		/*=============================================
	   	TRAEMOS LOS DATOS DE AUTORIDADES
	    =============================================*/

		// TRAEMOS DATOS DE AUTORIDADES-ADMINISTRADOR REGIONAL
		$item = "puesto";
		$valor = "ADMINISTRADOR(A) REGIONAL C.N.S.";

		$admin_regional = ControladorAutoridades::ctrMostrarAutoridades($item, $valor);

		// TRAEMOS DATOS DE AUTORIDADES-SUPERVISOR ADMINISTRATIVO
		$item = "puesto";
		$valor = "SUPERVISOR ADM. I RR.HH.";

		$supervisor_admin = ControladorAutoridades::ctrMostrarAutoridades($item, $valor);

		// TRAEMOS DATOS DE AUTORIDADES-JEFE SERVICIOS GENERALES
		$item = "puesto";
		$valor = "JEFE SERVICIOS GENERALES";

		$jefe_servicios = ControladorAutoridades::ctrMostrarAutoridades($item, $valor);

		// TRAEMOS DATOS DE AUTORIDADES-JEFE DE CONTABILIDAD REGIONAL
		$item = "puesto";
		$valor = "JEFE CONTABILIDAD REG.";

		$jefe_contabilidad = ControladorAutoridades::ctrMostrarAutoridades($item, $valor);

		// TRAEMOS DATOS DE AUTORIDADES-SECRETARIA DE PERSONAL REGIONAL
		$item = "puesto";
		$valor = "STRIA. DE PERS. REG";

		$secre_personal = ControladorAutoridades::ctrMostrarAutoridades($item, $valor);

		// Extend the TCPDF class to create custom Header and Footer

		$pdf = new MYPDF('L', 'mm', 'Letter', true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('CNS Potosí');
		$pdf->SetTitle('Relacion Novedades-'.$valor1);
		$pdf->SetSubject('Planilla de pago CNS');
		$pdf->SetKeywords('TCPDF, PDF, CNS, Reporte, Relacion Novedades, Planilla');

		// set font
		$pdf->SetFont('Helvetica', '', 8);
	
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(5, PDF_MARGIN_TOP, 5, 10);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// Envio datos al encabezado
		// $pdf->id_planilla = $this->id_planilla;

		// seleccion que encabezado se elije
		$pdf->headerPlanilla = false;

		// ---------------------------------------------------------

		// add a page
		$pdf->AddPage();

		$content = '';

		  	$content = '

		  	<html lang="es">
			<head>

				<style>
					
					body {

						font-size: 10px;
						margin: 4px;
						padding: 4px;

					}

					.font-weight-bold {

						font-weight: bold;

					}


					.titulo {

						text-align: center;
						line-height: 14px;
						margin: 1px;

					}

					.datos-personales {

						border-top: 1px solid #000; 
						border-bottom: 1px solid #000;
					}

					.firma {

						width: 250px; 
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

				<h3 class="titulo">'.$planilla["titulo_relacion"].'</h3>

				<div class="body_planilla">

					<table>
		                    
	                    <tr>
							<td width="25px" align="center" class="linea_simple">#</td>
							<td width="75px" align="center" class="linea_simple">LUGAR</td>
							<td width="80px" class="linea_simple">PATERNO</td>
							<td width="80px" class="linea_simple">MATERNO</td>
							<td width="140px" class="linea_simple">NOMBRE(S)</td>
							<td width="80px" align="center" class="linea_simple">CARNET</td>
							<td width="160px" align="center" class="linea_simple">CARGO</td>
							<td width="80px" align="center" class="linea_simple">INICIO CONTRATO</td>
							<td width="75px" align="center" class="linea_simple">FIN CONTRATO</td>
							<td width="65px" align="center" class="linea_simple">HABER BÁSICO</td>
							<td width="85px" align="center" class="linea_simple">MATRICULA</td>
							<td width="55px" align="center" class="linea_simple">DIAS TRAB.</td>
		                </tr>';
		                
					for ($i = 0; $i < count($datos_planilla); $i++) {

	                	$content .= '
	                	<tr>
	                		<td width="25px" align="center" class="linea_punteada">'.($i+1).'</td>
	                		<td width="75px" class="linea_punteada">'.$datos_planilla[$i]["abrev_establecimiento"].'</td>
	                		<td width="80px" class="linea_punteada">'.$datos_planilla[$i]["paterno_persona"].'</td>
	                		<td width="80px" class="linea_punteada">'.$datos_planilla[$i]["materno_persona"].'</td>
	                		<td width="140px" class="linea_punteada">'.$datos_planilla[$i]["nombre_persona"].'</td>
	                		<td width="80px" class="linea_punteada">'.$datos_planilla[$i]["ci_persona"].'</td>
	                		<td width="160px" class="linea_punteada">'.$datos_planilla[$i]["nombre_cargo"].'</td>
	                		<td width="80px" align="center" class="linea_punteada">'.date("d/m/Y", strtotime($datos_planilla[$i]["inicio_contrato"])).'</td>
	                		<td width="75px" align="center" class="linea_punteada">'.date("d/m/Y", strtotime($datos_planilla[$i]["fin_contrato"])).'</td>
	                		<td width="65px" align="right" class="linea_punteada">'.number_format($datos_planilla[$i]["haber_basico"], 2, ",", ".").'</td>
	                		<td width="85px" align="right" class="linea_punteada">'.$datos_planilla[$i]["matricula_persona"].'</td>
	                		<td width="55px" align="center" class="linea_punteada">'.$datos_planilla[$i]["dias_trabajados"].'</td>
	                	</tr>';

	                }			                

			    	$content .= '
			    	</table>

			    </div>
			    
			    <p><br><p/>
			    <p><br><p/>
			    <p><br><p/>
			    
			    <div class="footer_planilla">
			    	
			    	<table>
			    		<tr>
			    			<td width="240px" align="center">'.$secre_personal['nombre_autoridad'].'<br><label class="font-weight-bold">'.$secre_personal['puesto'].'</label></td>
			    			<td width="240px" align="center">'.$supervisor_admin['nombre_autoridad'].'<br><label class="font-weight-bold">'.$supervisor_admin['puesto'].'</label></td>
			    			<td width="240px" align="center">'.$jefe_contabilidad['nombre_autoridad'].'<br><label class="font-weight-bold">'.$jefe_contabilidad['puesto'].'</label></td>
			    			<td width="240px" align="center">'.$jefe_servicios['nombre_autoridad'].'<br><label class="font-weight-bold">'.$jefe_servicios['puesto'].'</label></td>
			    			<td width="240px" align="center">'.$admin_regional['nombre_autoridad'].'<br><label class="font-weight-bold">'.$admin_regional['puesto'].'</label></td>
			    		</tr>
			    	</table>

			    </div>

			</body>

			</html>';
			
		// Reconociendo la estructura HTML
		$pdf->writeHTML($content, true, 0, true, true);	

		$pdf->lastPage();

		$pdf->output(__DIR__ .'/temp/relacion-'.$valor1.'.pdf', 'F');

	}


	/*=============================================
	GENERAR BOLETA EMPLEADO EN PDF 
	=============================================*/

	public function ajaxMostrarBoletaPersonaPDF()	{

		/*=============================================
	   	TRAEMOS LOS DATOS DE PLANILLA PERSONA
	    =============================================*/
			
		$item = "id_planilla_persona_contrato";
		$valor = $this->id_planilla_persona_contrato;

		$planilla_persona_contrato = ControladorPlanillasPersonas::ctrMostrarPlanillaPersonasCompleto($item, $valor);

		/*=============================================
	   	TRAEMOS LOS DATOS DE PLANILLA
	    =============================================*/
			
		$item = "id_planilla";
		$valor1 = $planilla_persona_contrato["id_planilla"];
		$valor2 = null;

		$planilla = ControladorPlanillas::ctrMostrarPlanilla($item, $valor1, $valor2);

		// Convertir numero de Mes a su valor literal
		setlocale(LC_TIME, 'spanish');
		$numero = $planilla["mes_planilla"];
		$dateObj   = DateTime::createFromFormat('!m', $numero);
		$mes = strftime('%B', $dateObj->getTimestamp());

		// Extend the TCPDF class to create custom Header and Footer

		// $pdf = new MYPDF('L', 'mm', array(215.9, 139.5), true, 'UTF-8', false);

		$pdf = new MYPDF('P', 'mm', 'Letter', true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('CNS Potosí');
		$pdf->SetTitle('Boleta-'.$valor);
		$pdf->SetSubject('Boleta de pago CNS');
		$pdf->SetKeywords('TCPDF, PDF, CNS, Reporte, Boleta, Planilla');

		$pdf->setPrintHeader(false); 
		$pdf->setPrintFooter(false);

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(1, 0, 1, 0);

		$pdf->SetHeaderMargin(0);
		$pdf->SetFooterMargin(0);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, 0);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// ---------------------------------------------------------

		// for ($i = 0; $i < 4; $i++) { 

			$content = '';

			$content .= '

		  	<html lang="es">
			<head>

				<style>
					
					body {
						font-size: 10px;
						margin: 2px;
						padding: 2px;
					}

					.content div{

						line-height: 20px;

					}

					.font-weight-bold {

						font-weight: bold;

					}

					.titulo {

						font-size: 20px;
						text-align: center;
						line-height: 6px;

					}

					.datos-personales {

						border-top: 1px solid #000; 
						border-bottom: 1px solid #000;
					}

					.texto-resaltado {

						font-weight: bold;
						font-size: 15px;

					}

					.firma {

						border-top: 1px dashed #000; 
						margin-left: auto; 
						margin-right: auto;

					}

					.footer_boleta {
 
						text-align: center;
						margin: 0px;
						padding: 0px;
						line-height: 2px;

					}
					

				</style>

			</head>

			<body>';

			$content .= '

			<div class="content" border="1">

				<div style="line-height: 0px; padding: 0px">

					<table cellpadding="5px" cellspacing="0px">
			    		<tr>

			    			<td width="150px"></td>

							<td width="580px" align="center">

			    				<h3 class="titulo" style="line-height: 10px;">BOLETAS DE PAGO</h3>

								<h4 class="titulo" style="line-height: 12px;">'.$planilla["nombre_contrato"].' - '.$planilla["proposito_contrato"].'</h4>

							</td>

						</tr>

					</table>

				</div>

				<div class="header_boleta">
			    	<table>
			    		<tr>
			    			<td width="150px"></td>
			    			<td width="330px" colspan="2">Detalle de pago por el Mes de: <label class="texto-resaltado">'.strtoupper($mes).' '.$planilla["gestion_planilla"].'</label></td>
			    			<td width="180px" align="right">Dias Trabajados: <label class="texto-resaltado">'.$planilla_persona_contrato["dias_trabajados"].'</label></td>
			    			<td></td>
			    		</tr>
			    		<tr>
			    			<td></td>
			    			<td width="125px"><b>'.$planilla_persona_contrato["paterno_persona"].'</b></td>
			    			<td width="125px"><b>'.$planilla_persona_contrato["materno_persona"].'</b></td>
			    			<td width="150px"><b>'.$planilla_persona_contrato["nombre_persona"].'</b></td>
			    			<td width="125px"></td>
			    		</tr>

			    		<tr>
			    			<th></th>
			    			<th width="125px" class="datos-personales">AP. PATERNO</th>
			    			<th width="125px" class="datos-personales">AP. MATERNO</th>
			    			<th width="150px" class="datos-personales">NOMBRE(S)</th>
			    			<th width="125px" class="datos-personales"></th>
			    		</tr>
			    		<tr>
			    			<td></td>
			    			<td colspan="3">Total Ganado</td>
			    			<td align="right">'.number_format($planilla_persona_contrato["total_ganado"], 2, ",", ".").'</td>
			    		</tr>
			    		<tr>
			    			<td colspan="5"></td>
			    		</tr>
			    		<tr>
			    			<td></td>
			    			<td colspan="2" align="right">Total Ganado Bs.</td>
			    			<td></td>
			    			<td align="right" style="border-top: 1px solid #000">'.number_format($planilla_persona_contrato["total_ganado"], 2, ",", ".").'</td>
			    		</tr>
			    		<tr>
			    			<td></td>
			    			<td colspan="3"><u>Descuentos</u>:</td>
			    			<td></td>
			    		</tr>
			    		<tr>
			    			<td></td>
			    			<td colspan="3">A.F.P.S. 12,71%</td>
			    			<td align="right">'.number_format($planilla_persona_contrato["desc_afp"], 2, ",", ".").'</td>
			    		</tr>
			    		<tr>
			    			<td colspan="5"></td>
			    		</tr>
			    		<tr>
			    			<td></td>
			    			<td colspan="2" align="right">Total Descuentos Bs.</td>
			    			<td></td>
			    			<td align="right" style="border-bottom: 1px solid #000">'.number_format($planilla_persona_contrato["total_desc"], 2, ",", ".").'</td>
			    		</tr>
			    		<tr>
			    			<td></td>
			    			<td colspan="2" align="right">LIQUIDO PAGABLE Bs.</td>
			    			<td></td>
			    			<td align="right" style="border-bottom: 3px double #000"><label class="texto-resaltado">'.number_format($planilla_persona_contrato["liquido_pagable"], 2, ",", ".").'</label></td>
			    		</tr>

			    	</table>

			    </div>

			    <div class="footer_boleta">

			    	<table cellpadding="5px" cellspacing="0px" border="0">
			    		<tr>

			    			<td width="140px"></td>

			    			<td></td>

							<td>

			    				<h4 class="firma">RECIBIDO CONFORME</h4>

							</td>

							<td></td>

						</tr>

					</table>

				</div>

			</div>';

		    $content .= '

			</body>

			</html>';

		    // seleccion que encabezado se elije
			$pdf->headerBoleta = true;

		    $pdf->id_planilla_persona_contrato = $this->id_planilla_persona_contrato;

		    $pdf->mes_planilla = strtoupper($mes);

		    $pdf->gestion_planilla = $planilla["gestion_planilla"];

		    $pdf->paterno_persona = $planilla_persona_contrato["paterno_persona"];

		    $pdf->materno_persona = $planilla_persona_contrato["materno_persona"];

		    $pdf->nombre_persona = $planilla_persona_contrato["nombre_persona"];

			$pdf->dias_trabajados = $planilla_persona_contrato["dias_trabajados"];		    

		    // add a page
			$pdf->AddPage();

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
			$codeContents = 'COD. BOLETA: '.$pdf->id_planilla_persona_contrato."\n"."MES PLANILLA: ".$pdf->mes_planilla."\n"."GESTION PLANILLA: ".$pdf->gestion_planilla."\n"."NOMBRE: ".$pdf->nombre_persona."\n"."A. PATERNO: ".$pdf->paterno_persona."\n"."A. MATERNO: ".$pdf->materno_persona."\n"."DIAS TRAB.: ".$pdf->dias_trabajados;

			// Logo
	        $image_file = K_PATH_IMAGES.'cns-logo-actual.jpg';
	        $pdf->Image($image_file, 4, 8, 20, '', 'JPG', '', 'T', false, 100, '', false, false, 0, false, false, false);

	        // insertando el código QR
			$pdf->write2DBarcode($codeContents, 'QRCODE,L', 2, 105, 30, 30, $style, 'N');

			// set border width
			$pdf->SetLineWidth(0.3);

		    $pdf->line(35,6,35,137);

	        // Imagen Marca de Agua
	        $image_file2 = K_PATH_IMAGES.'cns-marca-agua.jpg';
	        $pdf->Image($image_file2, 95, 51, 46, '', '', '', '', false, 300, '', false, false, 0);

	        // Set font
	        $pdf->SetFont('helvetica', '', 7);

	        $pdf->MultiCell(185, 5, 'Boleta Generada Por el Sistema de Recursos Humanos CNS Regional Potosí', 0, 'L', 0, 0, 118, 130, true);

	        // Reconociendo la estructura HTML
			// $pdf->writeHTML($content, true, false, true, false, '');
			$pdf->writeHTMLCell( '', '', 1, 3, $content, 0, 0, 0, true, '');

			// Logo
	        $image_file = K_PATH_IMAGES.'cns-logo-actual.jpg';
	        $pdf->Image($image_file, 4, 162, 20, '', 'JPG', '', 'T', false, 100, '', false, false, 0, false, false, false);

	       	// insertando el código QR
			$pdf->write2DBarcode($codeContents, 'QRCODE,L', 2, 258, 30, 30, $style, 'N');

			$pdf->MultiCell(185, 5, 'Boleta Generada Por el Sistema de Recursos Humanos CNS Regional Potosí', 0, 'L', 0, 0, 118, 284, true);

			// Reconociendo la estructura HTML
			// $pdf->writeHTML($content, true, false, true, false, '');
			$pdf->writeHTMLCell( '', '', 1, 157, $content, 0, 0, 0, true, '');

			// set border width
			$pdf->SetLineWidth(0.3);

		    $pdf->line(35,160,35,291);

		// }

		// $codeContents = 'COD. BOLETA: '.$this->id_planilla_persona_contrato."\n";

		$pdf->lastPage();

		$pdf->output(__DIR__ .'/temp/boleta-'.$valor.'.pdf', 'F');

	}

	/*=============================================
	GENERAR BOLETAS EN PDF 
	=============================================*/

	public function ajaxMostrarBoletasPDF()	{

		/*=============================================
	   	TRAEMOS LOS DATOS DE PLANILLA
	    =============================================*/

		$item = "id_planilla";
		$valor1 = $this->id_planilla;		
		$valor2 = null;

		$planilla = ControladorPlanillas::ctrMostrarPlanilla($item, $valor1, $valor2);

		/*=============================================
	   	TRAEMOS LOS DATOS DE PLANILLA PERSONA
	    =============================================*/
		
		$datos_planilla = ControladorPlanillas::ctrMostrarGenerarPlanilla($item, $valor1, $valor2);

		// Convertir numero de Mes a su valor literal
		setlocale(LC_TIME, 'spanish');
		$numero = $planilla["mes_planilla"];
		$dateObj   = DateTime::createFromFormat('!m', $numero);
		$mes = strftime('%B', $dateObj->getTimestamp());

		// Extend the TCPDF class to create custom Header and Footer

		$pdf = new MYPDF('L', 'mm', array(215.9, 139.5), true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('CNS Potosí');
		$pdf->SetTitle('Boletas-'.$valor1);
		$pdf->SetSubject('Boletas de pago CNS');
		$pdf->SetKeywords('TCPDF, PDF, CNS, Reporte, Boleta, Planilla');

		// $pdf->setPrintHeader(false); 
		$pdf->setPrintFooter(false);

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(0, 0, 0, 0);

		$pdf->SetHeaderMargin(0);
		$pdf->SetFooterMargin(0);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, 0);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// ---------------------------------------------------------

		for ($i = 1; $i < count($datos_planilla); $i++) { 

			$content = '';

			$content .= '

		  	<html lang="es">
			<head>

				<style>
					
					body {
						font-size: 10px;
						margin: 2px;
						padding: 2px;
					}

					.content div{

						line-height: 20px;

					}

					.font-weight-bold {

						font-weight: bold;

					}

					.titulo {

						font-size: 20px;
						text-align: center;
						line-height: 6px;

					}

					.datos-personales {

						border-top: 1px solid #000; 
						border-bottom: 1px solid #000;
					}

					.texto-resaltado {

						font-weight: bold;
						font-size: 15px;

					}

					.firma {

						border-top: 1px dashed #000; 
						margin-left: auto; 
						margin-right: auto;

					}

					.footer_boleta {
 
						text-align: center;
						margin: 0px;
						padding: 0px;
						line-height: 2px;

					}
					

				</style>

			</head>

			<body>';

			$content .= '

			<div class="content" border="1">

				<div style="line-height: 0px; padding: 0px">

					<table cellpadding="5px" cellspacing="0px">
			    		<tr>

							<td>

			    				<h3 class="titulo" style="line-height: 10px;">BOLETAS DE PAGO</h3>

								<h4 class="titulo" style="line-height: 12px;">'.$planilla["nombre_contrato"].' - '.$planilla["proposito_contrato"].'</h4>

							</td>

						</tr>

					</table>

				</div>

				<div class="header_boleta">
			    	<table>
						<tr>
			    			<td width="90px"></td>
			    			<td width="330px" colspan="2">Detalle de pago por el Mes de: <label class="texto-resaltado">'.strtoupper($mes).' '.$planilla["gestion_planilla"].'</label></td>
			    			<td width="180px" align="right">Dias Trabajados: <label class="texto-resaltado">'.$datos_planilla[$i]["dias_trabajados"].'</label></td>
			    			<td></td>
			    		</tr>
			    		<tr>
			    			<td></td>
			    			<td width="125px"><b>'.$planilla_persona_contrato["paterno_persona"].'</b></td>
			    			<td width="125px"><b>'.$planilla_persona_contrato["materno_persona"].'</b></td>
			    			<td width="150px"><b>'.$planilla_persona_contrato["nombre_persona"].'</b></td>
			    			<td width="125px"></td>
			    		</tr>

			    		<tr>
			    			<th></th>
			    			<th width="125px" class="datos-personales">AP. PATERNO</th>
			    			<th width="125px" class="datos-personales">AP. MATERNO</th>
			    			<th width="150px" class="datos-personales">NOMBRE(S)</th>
			    			<th width="125px" class="datos-personales"></th>
			    		</tr>
			    		<tr>
			    			<td></td>
			    			<td colspan="3">Sueldo</td>
			    			<td align="right">'.number_format($datos_planilla[$i]["total_ganado"], 2, ",", ".").'</td>
			    		</tr>
			    		<tr>
			    			<td colspan="5"></td>
			    		</tr>
			    		<tr>
			    			<td></td>
			    			<td colspan="2" align="right">Total Ganado Bs.</td>
			    			<td></td>
			    			<td align="right" style="border-top: 1px solid #000">'.number_format($datos_planilla[$i]["total_ganado"], 2, ",", ".").'</td>
			    		</tr>
			    		<tr>
			    			<td></td>
			    			<td colspan="3"><u>Descuentos</u>:</td>
			    			<td></td>
			    		</tr>
			    		<tr>
			    			<td></td>
			    			<td colspan="3">A.F.P.S. 12,71%</td>
			    			<td align="right">'.number_format($datos_planilla[$i]["desc_afp"], 2, ",", ".").'</td>
			    		</tr>
			    		<tr>
			    			<td colspan="5"></td>
			    		</tr>
			    		<tr>
			    			<td></td>
			    			<td colspan="2" align="right">Total Descuentos Bs.</td>
			    			<td></td>
			    			<td align="right" style="border-bottom: 1px solid #000">'.number_format($datos_planilla[$i]["total_desc"], 2, ",", ".").'</td>
			    		</tr>
			    		<tr>
			    			<td></td>
			    			<td colspan="2" align="right">LIQUIDO PAGABLE Bs.</td>
			    			<td></td>
			    			<td align="right" style="border-bottom: 3px double #000"><label class="texto-resaltado">'.number_format($datos_planilla[$i]["liquido_pagable"], 2, ",", ".").'</label></td>
			    		</tr>

			    	</table>

			    </div>

			    <div class="footer_boleta">

			    	<table cellpadding="5px" cellspacing="0px" border="1">
			    		<tr>

			    			<td></td>

							<td>

			    				<h4 class="firma">RECIBIDO CONFORME</h4>

							</td>

							<td></td>

						</tr>

					</table>

				</div>

			</div>';

		    $content .= '

			</body>

			</html>';

		    // seleccion que encabezado se elije
			$pdf->headerBoleta = true;

		    $pdf->id_planilla_persona_contrato = $datos_planilla[$i]["id_planilla_persona_contrato"];

		    $pdf->mes_planilla = strtoupper($mes);

		    $pdf->gestion_planilla = $planilla["gestion_planilla"];

		    $pdf->paterno_persona = $datos_planilla[$i]["paterno_persona"];

		    $pdf->materno_persona = $datos_planilla[$i]["materno_persona"];

		    $pdf->nombre_persona = $datos_planilla[$i]["nombre_persona"];

			$pdf->dias_trabajados = $datos_planilla[$i]["dias_trabajados"];	

		    // add a page
			$pdf->AddPage();

			// Reconociendo la estructura HTML
			$pdf->writeHTML($content, true, false, true, false, '');

			// Insertando el Logo
			// $pdf->Image($image_file, 18, 8+$j, 15, '', 'JPG', '', 'T', false, 100, '', false, false, 0, false, false, false);

			//	Datos a mostrar en el código QR
			// $codeContents = 'COD. BOLETA: '.$datos_planilla[$i]["id_planilla_persona_contrato"]."\n";

			// insertando el código QR
			// $pdf->write2DBarcode($codeContents, 'QRCODE,L', 190, 8 + $j, 20, 0, $style, 'N');	

			// $j = $j+125;

		}

		$pdf->lastPage();

		$pdf->output(__DIR__ .'/temp/boletas-'.$valor1.'.pdf', 'F');

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

		$planilla = ControladorPlanillas::ctrMostrarPlanilla($item, $valor1, $valor2);

		// Convertir numero de Mes a su valor literal
		setlocale(LC_TIME, 'spanish');
		$numero = $planilla["mes_planilla"];
		$dateObj   = DateTime::createFromFormat('!m', $numero);
		$mes = strftime('%B', $dateObj->getTimestamp());

		/*=============================================
	   	TRAEMOS LOS DATOS DE PLANILLA EMPLEADOS
	    =============================================*/

		$datos_planilla = ControladorPlanillas::ctrMostrarGenerarPlanilla($item, $valor1, $valor2);

		/*=============================================
	   	TRAEMOS LOS DATOS DE AUTORIDADES
	    =============================================*/

		// TRAEMOS DATOS DE AUTORIDADES-ADMINISTRADOR REGIONAL
		$item = "puesto";
		$valor = "ADMINISTRADOR(A) REGIONAL C.N.S.";

		$admin_regional = ControladorAutoridades::ctrMostrarAutoridades($item, $valor);

				// TRAEMOS DATOS DE AUTORIDADES-SUPERVISOR ADMINISTRATIVO
		$item = "puesto";
		$valor = "SUPERVISOR ADM. I RR.HH.";

		$supervisor_admin = ControladorAutoridades::ctrMostrarAutoridades($item, $valor);

		// TRAEMOS DATOS DE AUTORIDADES-JEFE SERVICIOS GENERALES
		$item = "puesto";
		$valor = "JEFE SERVICIOS GENERALES";

		$jefe_servicios = ControladorAutoridades::ctrMostrarAutoridades($item, $valor);

		// TRAEMOS DATOS DE AUTORIDADES-JEFE DE CONTABILIDAD REGIONAL
		$item = "puesto";
		$valor = "JEFE CONTABILIDAD REG.";

		$jefe_contabilidad = ControladorAutoridades::ctrMostrarAutoridades($item, $valor);

		// TRAEMOS DATOS DE AUTORIDADES-SECRETARIA DE PERSONAL REGIONAL
		$item = "puesto";
		$valor = "ENC. PLANILLAS";

		$enc_planillas = ControladorAutoridades::ctrMostrarAutoridades($item, $valor);

		// Extend the TCPDF class to create custom Header and Footer

		$pdf = new MYPDF('L', 'mm', 'Letter', true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('CNS Potosí');
		$pdf->SetTitle('Planilla-'.$valor1);
		$pdf->SetSubject('Planilla de pago CNS');
		$pdf->SetKeywords('TCPDF, PDF, CNS, Reporte, Pago, Planilla');

		// set font
		$pdf->SetFont('Helvetica', '', 8);
	
		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(5, PDF_MARGIN_TOP, 5, 10);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// CONVERTIR NUMERO DE MES A SU VALOR LITERAL
		setlocale(LC_TIME, 'spanish');
		$numero = $planilla["mes_planilla"];
		$dateObj   = DateTime::createFromFormat('!m', $numero);
		$mes = strftime('%B', $dateObj->getTimestamp());

		// Envio datos al encabezado
		$pdf->id_planilla = $this->id_planilla;
		$pdf->mes_planilla = strtoupper($mes);
		$pdf->gestion_planilla = $planilla["gestion_planilla"];

		// seleccion que encabezado se elije
		$pdf->headerPlanilla = true;

		// ---------------------------------------------------------

		// add a page
		$pdf->AddPage();

		$content = '';

		  	$content .= '

		  	<html lang="es">
			<head>

				<style>
					
					body {

						font-size: 10px;
						margin: 4px;
						padding: 4px;

					}

					.header_planilla {

						margin: 0;
						padding 0;

					}

					.font-weight-bold {

						font-weight: bold;

					}

					.titulo {

						text-align: center;
						line-height: 5px;

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
						font-weight: bold;

					}

					.linea_punteada {

						border-bottom: 1px dashed #d0d0d0;
						
					}

				</style>

			</head>

			<body>

				<h3 class="titulo">'.$planilla["titulo_planilla"].'</h3>

				<div class="body_planilla">

					<table>
		                    
	                    <tr>
							<td width="25px" align="center" class="linea_simple">#</td>
							<td width="70px" align="center" class="linea_simple">LUGAR</td>
							<td width="80px" class="linea_simple">PATERNO</td>
							<td width="80px" class="linea_simple">MATERNO</td>
							<td width="110px" class="linea_simple">NOMBRE(S)</td>
							<td width="55px" align="center" class="linea_simple">CI</td>
							<td width="30px" align="center" class="linea_simple">EXT CI</td>
							<td width="160px" align="center" class="linea_simple">CARGO</td>
							<td width="70px" align="center" class="linea_simple">HABER BÁSICO</td>
							<td width="50px" align="center" class="linea_simple">DIAS TRAB.</td>
							<td width="70px" align="center" class="linea_simple">TOTAL GANADO</td>
							<td width="65px" align="center" class="linea_simple">PREVISION AFP</td>
							<td width="70px" align="center" class="linea_simple">TOTAL DESC.</td>
							<td width="70px" align="center" class="linea_simple">LIQUIDO PAGABLE</td>
		                </tr>';
		                
					for ($i = 0; $i < count($datos_planilla); $i++) {

	                	$content .= '
	                	<tr>
	                		<td width="25px" align="center" class="linea_punteada">'.($i+1).'</td>
	                		<td width="70px" class="linea_punteada">'.$datos_planilla[$i]["abrev_establecimiento"].'</td>
	                		<td width="80px" class="linea_punteada">'.$datos_planilla[$i]["paterno_persona"].'</td>
	                		<td width="80px" class="linea_punteada">'.$datos_planilla[$i]["materno_persona"].'</td>
	                		<td width="110px" class="linea_punteada">'.$datos_planilla[$i]["nombre_persona"].'</td>
	                		<td width="55px" align="right" class="linea_punteada">'.$datos_planilla[$i]["ci_persona"].'</td>
	                		<td width="30px" align="center" class="linea_punteada">'.$datos_planilla[$i]["ext_ci_persona"].'</td>
	                		<td width="160px" class="linea_punteada">'.$datos_planilla[$i]["nombre_cargo"].'</td>
	                		<td width="70px" align="right" class="linea_punteada">'.number_format($datos_planilla[$i]["haber_basico"], 2, ",", ".").'</td>
	                		<td width="50px" align="center" class="linea_punteada">'.$datos_planilla[$i]["dias_trabajados"].'</td>
	                		<td width="70px" align="right" class="linea_punteada">'.number_format($datos_planilla[$i]["total_ganado"], 2, ",", ".").'</td>
	                		<td width="65px" align="right" class="linea_punteada">'.number_format($datos_planilla[$i]["desc_afp"], 2, ",", ".").'</td>
	                		<td width="70px" align="right" class="linea_punteada">'.number_format($datos_planilla[$i]["total_desc"], 2, ",", ".").'</td>
	                		<td width="70px" align="right" class="linea_punteada">'.number_format($datos_planilla[$i]["liquido_pagable"], 2, ",", ".").'</td>
	                	</tr>';

	                }

                    $item = "id_planilla";
                    $valor = $planilla['id_planilla'];

                    $totales_planilla = ControladorPlanillasPersonas::ctrMostrarTotalesPlanillaPersonas($item, $valor);

					$content .= '
		              
		                <tr>
		                    <td align="center" class="linea_simple font-weight-bold" colspan="10">TOTAL GENERAL</td>
		                    <td align="right" class="linea_simple font-weight-bold">'.number_format($totales_planilla["total_ganado"], 2, ",", ".").'</td>
		                    <td align="right" class="linea_simple font-weight-bold">'.number_format($totales_planilla["desc_afp"], 2, ",", ".").'</td>
		                    <td align="right" class="linea_simple font-weight-bold">'.number_format($totales_planilla["total_desc"], 2, ",", ".").'</td>
		                    <td align="right" class="linea_simple font-weight-bold">'.number_format($totales_planilla["liquido_pagable"], 2, ",", ".").'</td>
		                </tr>
				    	<br><br>
				    	<tr>
		                    <td class="font-weight-bold" colspan="14" style="font-size: 14px"><u>RESUMEN GENERAL</u></td>
		                </tr>
		                <tr>
		                    <td class="font-weight-bold" colspan="13">MES GANADO</td>
		                    <td align="right" colspan="1">'.number_format($totales_planilla["total_ganado"], 2, ",", ".").'</td>
		                </tr>
		                <tr>
		                    <td class="font-weight-bold" colspan="8">PREVISION A.F.P.</td>
		                    <td align="right" colspan="2">'.number_format($totales_planilla["desc_afp"], 2, ",", ".").'</td>
		                </tr>
		                <tr>
		                    <td class="font-weight-bold" colspan="10">TOTAL DESCUENTO</td>
		                    <td align="right">'.number_format($totales_planilla["total_desc"], 2, ",", ".").'</td>
		                </tr>
		                <tr>
		                    <td class="font-weight-bold" colspan="10">LIQUIDO PAGABLE</td>
		                    <td align="right">'.number_format($totales_planilla["liquido_pagable"], 2, ",", ".").'</td>
		                </tr>
		                <tr>
		                    <td class="font-weight-bold" colspan="10"></td>
		                    <td align="right" style="border-top: 1px solid #000; border-bottom: 3px double #000">'.number_format($totales_planilla["total_ganado"], 2, ",", ".").'</td>
		                    <td align="right" style="border-top: 1px solid #000; border-bottom: 3px double #000" colspan="3">'.number_format($totales_planilla["total_ganado"], 2, ",", ".").'</td>
		                </tr>';

		            $content .= '

			    	</table>

			    </div>

			    <p><br><p/>
			    <p><br><p/>
			    <p><br><p/>

			    <div class="footer_planilla">
			    	
			    	

			    </div>

			</body>

			</html>';
			
		// Reconociendo la estructura HTML
		$pdf->writeHTML($content, true, false, true, false, '');

		$pdf->lastPage();

		$pdf->output(__DIR__ .'/temp/planilla-'.$valor1.'.pdf', 'F');

	}


}

/*=============================================
MOSTRAR DATOS DE RELACION DE NOVEDADES DE PERSONA
=============================================*/

if (isset($_POST["mostrarRelacionNovedadesPersona"])) {

	$mostrarRelacionPersona = new AjaxPlanillasPersonas();
	$mostrarRelacionPersona -> id_planilla_persona_contrato = $_POST["id_planilla_persona_contrato"];
	$mostrarRelacionPersona -> mostrarRelacionNovedadesPersona();

}

/*=============================================
MOSTRAR DATOS DE PLANILLAS EMPLEADOS
=============================================*/

// if (isset($_POST["mostrarPlanillaEmpleadoCompleto"])) {

// 	$mostrarPlanillasEmpleados = new AjaxPlanillasPersonas();
// 	$mostrarPlanillasEmpleados -> id_planilla_empleado = $_POST["id_planilla_empleado"];
// 	$mostrarPlanillasEmpleados -> ajaxMostrarPlanillaEmpleadoCompleto();

// }

/*=============================================
MOSTRAR DATOS DE PLANILLAS EMPLEADOS
=============================================*/

// if (isset($_POST["mostrarTotalesPlanillaEmpleado"])) {

// 	$mostrarTotalesPlanillasEmpleados = new AjaxPlanillasPersonas();
// 	$mostrarTotalesPlanillasEmpleados -> id_planilla = $_POST["id_planilla"];
// 	$mostrarTotalesPlanillasEmpleados -> ajaxMostrarTotalesPlanillaEmpleado();

// }

/*=============================================
AGREGAR DIAS TRABAJADOS EN LA TABLA
=============================================*/

if (isset($_POST["agregarDiasTrabajados"])) {

	$agregarDias = new AjaxPlanillasPersonas();
	$agregarDias -> dias_trabajados = $_POST["nuevoDiasTrab"];
	$agregarDias -> haber_basico = $_POST["nuevoHaberBasico"];
	$agregarDias -> id_planilla_persona_contrato = $_POST["idPlanillaPersona"];
	$agregarDias -> ajaxAgregarDiasTrabajados();

}

/*=============================================
GENERAR BOLETA RELACION DE NOVEDADES EN PDF 
=============================================*/

if (isset($_POST["generarRelacionPDF"])) {

	$generarPlanillaPDF = new AjaxPlanillasPersonas();
	$generarPlanillaPDF -> id_planilla = $_POST["id_planilla"];
	$generarPlanillaPDF -> ajaxMostrarRelacionPDF();

}

/*=============================================
GENERAR BOLETA EN PDF 
=============================================*/

if (isset($_POST["boletaPersonaPDF"])) {

	$boletaPersonaPDF = new AjaxPlanillasPersonas();
	$boletaPersonaPDF -> id_planilla_persona_contrato = $_POST["id_planilla_persona_contrato"];
	$boletaPersonaPDF -> ajaxMostrarBoletaPersonaPDF();

}

/*=============================================
GENERAR BOLETAS EN PDF 
=============================================*/

if (isset($_POST["boletasPDF"])) {

	$boletasPDF = new AjaxPlanillasPersonas();
	$boletasPDF -> id_planilla = $_POST["id_planilla"];
	$boletasPDF -> ajaxMostrarBoletasPDF();

}

/*=============================================
GENERAR PLANILLA EN PDF 
=============================================*/

if (isset($_POST["generarPlanillaPDF"])) {

	$generarPlanillaPDF = new AjaxPlanillasPersonas();
	$generarPlanillaPDF -> id_planilla = $_POST["id_planilla"];
	$generarPlanillaPDF -> ajaxMostrarPlanillaPDF();

}