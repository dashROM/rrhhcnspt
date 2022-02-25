<?php

require_once "../controladores/planillas.controlador.php";
require_once "../controladores/planillas_personas.controlador.php";
require_once "../controladores/autoridades.controlador.php";

require_once "../modelos/planillas.modelo.php";
require_once "../modelos/planillas_personas.modelo.php";
require_once "../modelos/autoridades.modelo.php";


require_once('../extensiones/tcpdf/tcpdf.php');

class MYPDF extends TCPDF {

	public $id_planilla;

	public $headerPlanilla = false;

	//Page header

    public function Header() {

        if ($this->headerPlanilla === true) {

        	// Set font
	        $this->SetFont('helvetica', 'B', 10);
        	// Titul
	        $this->Cell(0, 0, '                    CAJA NACIONAL DE SALUD', 0, 1, 'C', 0, '', 1);
	        // Subtitulo
	        $this->Cell(0, 0, '                    SECC. PLANILLAS REG.', 0, 1, 'C', 0, '', 1);
	        $this->Cell(0, 0, '                    Potosí -0- Bolivia', 0, 1, 'C', 0, '', 1);
            
	        // Logo
	        $image_file = K_PATH_IMAGES.'cns-logo-actual.jpg';
	        $this->Image($image_file, 5, 5, 15, '', 'PNG', '', 'T', false, 100, '', false, false, 0, false, false, false);


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

	        $this->Cell(265, 0, '', 'B', 1, 'C', 1, '', 0, false, 'T', 'C');
            
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
			$this->write2DBarcode($codeContents, 'QRCODE,L', 250, 3, 18, 18, $style, 'N');

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
		CALCULOS PARA PLANILLAS
		=============================================*/

		$total_ganado = ($this->haber_basico * $this->dias_trabajados)/30;

		$desc_afp = $total_ganado * 0.1271;

		// var_dump($desc_afp);

		$total_desc = $desc_afp;

		$liquido_pagable = $total_ganado - $total_desc;


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

						font-size: 28px;
						margin: 4px;
						padding: 4px;

					}

					.font-weight-bold {

						font-weight: bold;

					}


					.titulo {

						text-align: center;
						line-height: 6px;
						margin: 1px;

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

				

				<h3 class="titulo">'.$planilla["titulo_relacion"].'</h3>

				<div class="body_planilla">

					<table>
		                    
	                    <tr>
							<td width="25px" align="center" class="linea_simple">#</td>
							<td width="65px" align="center" class="linea_simple">LUGAR</td>
							<td width="80px" class="linea_simple">PATERNO</td>
							<td width="80px" class="linea_simple">MATERNO</td>
							<td width="120px" class="linea_simple">NOMBRE(S)</td>
							<td width="80px" align="center" class="linea_simple">CARNET</td>
							<td width="130px" align="center" class="linea_simple">CARGO</td>
							<td width="80px" align="center" class="linea_simple">INICIO CONTRATO</td>
							<td width="75px" align="center" class="linea_simple">FIN CONTRATO</td>
							<td width="65px" align="center" class="linea_simple">HABER BÁSICO</td>
							<td width="80px" align="center" class="linea_simple">MATRICULA</td>
							<td width="50px" align="center" class="linea_simple">DIAS TRAB.</td>
		                </tr>';
		                
					for ($i = 0; $i < count($datos_planilla); $i++) {

	                	$content .= '
	                	<tr>
	                		<td width="25px" align="center" class="linea_punteada">'.($i+1).'</td>
	                		<td width="65px" class="linea_punteada">'.$datos_planilla[$i]["abrev_establecimiento"].'</td>
	                		<td width="80px" class="linea_punteada">'.$datos_planilla[$i]["paterno_persona"].'</td>
	                		<td width="80px" class="linea_punteada">'.$datos_planilla[$i]["materno_persona"].'</td>
	                		<td width="120px" class="linea_punteada">'.$datos_planilla[$i]["nombre_persona"].'</td>
	                		<td width="80px" class="linea_punteada">'.$datos_planilla[$i]["ci_persona"].'</td>
	                		<td width="130px" class="linea_punteada">'.$datos_planilla[$i]["nombre_cargo"].'</td>
	                		<td width="80px" align="center" class="linea_punteada">'.date("d/m/Y", strtotime($datos_planilla[$i]["inicio_contrato"])).'</td>
	                		<td width="75px" align="center" class="linea_punteada">'.date("d/m/Y", strtotime($datos_planilla[$i]["fin_contrato"])).'</td>
	                		<td width="65px" align="right" class="linea_punteada">'.number_format($datos_planilla[$i]["haber_basico"], 2, ",", ".").'</td>
	                		<td width="80px" align="right" class="linea_punteada">'.$datos_planilla[$i]["matricula_persona"].'</td>
	                		<td width="50px" align="center" class="linea_punteada">'.$datos_planilla[$i]["dias_trabajados"].'</td>
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
			    			<td width="150px" align="center">'.$secre_personal['nombre_autoridad'].'<br><label class="font-weight-bold">'.$secre_personal['puesto'].'</label></td>
			    			<td width="190px" align="center">'.$supervisor_admin['nombre_autoridad'].'<br><label class="font-weight-bold">'.$supervisor_admin['puesto'].'</label></td>
			    			<td width="200px" align="center">'.$jefe_contabilidad['nombre_autoridad'].'<br><label class="font-weight-bold">'.$jefe_contabilidad['puesto'].'</label></td>
			    			<td width="200px" align="center">'.$jefe_servicios['nombre_autoridad'].'<br><label class="font-weight-bold">'.$jefe_servicios['puesto'].'</label></td>
			    			<td width="200px" align="center">'.$admin_regional['nombre_autoridad'].'<br><label class="font-weight-bold">'.$admin_regional['puesto'].'</label></td>
			    		</tr>
			    	</table>

			    </div>

			</body>

			</html>';
			
		// Reconociendo la estructura HTML
		$pdf->writeHTML($content, true, 0, true, true);	

		$pdf->lastPage();

		$pdf->output('../temp/relacion-'.$valor1.'.pdf', 'F');

	}


	/*=============================================
	GENERAR BOLETA EMPLEADO EN PDF 
	=============================================*/

	public function ajaxMostrarBoletaPersonaPDF()	{

		/*=============================================
	   	TRAEMOS LOS DATOS DE PLANILLA EMPLEADO
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
		$pdf->SetMargins(15, 5, 15, 0);

		$pdf->SetHeaderMargin(5);
		$pdf->SetFooterMargin(5);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, 5);

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

			<body>';

			// for ($i=0; $i < 4; $i++) { 

			$content .= '

				<div class="content" border="1">

					<div style="line-height: 0px;">

						<table cellpadding="8px" cellspacing="0px">
				    		<tr>

				    			<td>

				    				<h3 class="titulo" style="line-height: 2px;">BOLETAS DE PAGO</h3>

									<h4 class="titulo" style="line-height: 2px;">'.$planilla["nombre_contrato"].'</h4>

								</td>

							</tr>

						</table>

					</div>

					<div class="header_boleta">
				    	<table>
				    		<tr>
				    			<td width="75px"></td>
				    			<td colspan="2">Detalle de pago por el Mes de: <b>'.strtoupper($mes).' '.$planilla["gestion_planilla"].'</b></td>
				    			<td></td>
				    			<td>Dias Trabajados:'.$planilla_persona_contrato["dias_trabajados"].'</td>
				    		</tr>
				    		<tr>
				    			<td></td>
				    			<td width="115px">'.$planilla_persona_contrato["paterno_persona"].'</td>
				    			<td width="115px">'.$planilla_persona_contrato["materno_persona"].'</td>
				    			<td width="120px">'.$planilla_persona_contrato["nombre_persona"].'</td>
				    			<td width="115px"></td>
				    		</tr>

				    		<tr>
				    			<th></th>
				    			<th width="115px" class="datos-personales">AP. PATERNO</th>
				    			<th width="115px" class="datos-personales">AP. MATERNO</th>
				    			<th width="120px" class="datos-personales">NOMBRE(S)</th>
				    			<th width="115px" class="datos-personales"></th>
				    		</tr>
				    		<tr>
				    			<td></td>
				    			<td colspan="3"><u>Haberes</u>:</td>
				    			<td>Detalle General</td>
				    		</tr>
				    		<tr>
				    			<td></td>
				    			<td colspan="3">Sueldo</td>
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
				    			<td align="right" style="border-bottom: 3px double #000">'.number_format($planilla_persona_contrato["liquido_pagable"], 2, ",", ".").'</td>
				    		</tr>

				    	</table>
				    	<br><br>

				    </div>

				    <div style="text-align: center;" height="10px">
					
						<h4 class="firma">RECIBIDO CONFORME</h4>

					</div>

				</div>
				<br><br>';

			// }

			$content .= '

			</body>

			</html>';

		// Reconociendo la estructura HTML
		$pdf->writeHTML($content, true, false, true, false, '');

		// Insertando el Logo
		$image_file = K_PATH_IMAGES.'cns-logo-simple.png';

		$pdf->Image($image_file, 18, 10, 15, '', 'PNG', '', 'T', false, 100, '', false, false, 0, false, false, false);

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
		$codeContents = 'COD. BOLETA: '.$this->id_planilla_persona_contrato."\n";

		// insertando el código QR
		$pdf->write2DBarcode($codeContents, 'QRCODE,L', 175, 8, 20, 20, $style, 'N');	

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
		$valor = "SUPERVISOR ADM. | RR.HH.";

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
		$pdf->SetMargins(5, 15, 5, 0);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// mostrando encabezado
		$pdf->setPrintHeader(true);
		// ocultando pie de pagina
		$pdf->setPrintFooter(false);

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

						font-size: 28px;
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

				<div class="content">

					<div class="header_planilla">
					
						<h3 class="titulo">'.$planilla["titulo_planilla"].'</h3>

					</div>
					<div class="body_planilla">

						<table>
			                    
		                    <tr>
								<td width="15px" align="center" class="linea_simple">#</td>
								<td width="55px" align="center" class="linea_simple">LUGAR</td>
								<td width="80px" class="linea_simple">PATERNO</td>
								<td width="80px" class="linea_simple">MATERNO</td>
								<td width="110px" class="linea_simple">NOMBRE(S)</td>
								<td width="80px" align="center" class="linea_simple">CARNET</td>
								<td width="120px" align="center" class="linea_simple">CARGO</td>
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
		                		<td width="15px" align="center" class="linea_punteada">'.($i+1).'</td>
		                		<td width="55px" align="center" class="linea_punteada">'.$datos_planilla[$i]["abrev_establecimiento"].'</td>
		                		<td width="80px" class="linea_punteada">'.$datos_planilla[$i]["paterno_persona"].'</td>
		                		<td width="80px" class="linea_punteada">'.$datos_planilla[$i]["materno_persona"].'</td>
		                		<td width="110px" class="linea_punteada">'.$datos_planilla[$i]["nombre_persona"].'</td>
		                		<td width="80px" class="linea_punteada">'.$datos_planilla[$i]["ci_persona"].'</td>
		                		<td width="120px" class="linea_punteada">'.$datos_planilla[$i]["nombre_cargo"].'</td>
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
			                    <td align="center" class="linea_simple font-weight-bold" colspan="9">TOTAL GENERAL</td>
			                    <td align="right" class="linea_simple font-weight-bold">'.number_format($totales_planilla["total_ganado"], 2, ",", ".").'</td>
			                    <td align="right" class="linea_simple font-weight-bold">'.number_format($totales_planilla["desc_afp"], 2, ",", ".").'</td>
			                    <td align="right" class="linea_simple font-weight-bold">'.number_format($totales_planilla["total_desc"], 2, ",", ".").'</td>
			                    <td align="right" class="linea_simple font-weight-bold">'.number_format($totales_planilla["liquido_pagable"], 2, ",", ".").'</td>
			                </tr>
					    	<br><br>
					    	<tr>
			                    <td class="font-weight-bold" colspan="13"><u>RESUMEN GENERAL</u></td>
			                </tr>
			                <tr>
			                    <td class="font-weight-bold" colspan="12">MES GANADO</td>
			                    <td align="right" colspan="1">'.number_format($totales_planilla["total_ganado"], 2, ",", ".").'</td>
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
			                    <td align="right" style="border-top: 1px solid #000; border-bottom: 3px double #000" colspan="3">'.number_format($totales_planilla["total_ganado"], 2, ",", ".").'</td>
			                </tr>';

			            $content .= '

				    	</table>

				    </div>
				    <br><br><br><br><br><br>
				    <div class="footer_planilla">
				    	
				    	<table>
				    		<tr>
				    			<td align="center">'.$enc_planillas['nombre_autoridad'].'<br><label class="font-weight-bold">'.$enc_planillas['puesto'].'</label></td>
				    			<td align="center">'.$supervisor_admin['nombre_autoridad'].'<br><label class="font-weight-bold">'.$supervisor_admin['puesto'].'</label></td>
				    			<td align="center">'.$jefe_contabilidad['nombre_autoridad'].'<br><label class="font-weight-bold">'.$jefe_contabilidad['puesto'].'</label></td>
				    			<td align="center">'.$jefe_servicios['nombre_autoridad'].'<br><label class="font-weight-bold">'.$jefe_servicios['puesto'].'</label></td>
				    			<td align="center">'.$admin_regional['nombre_autoridad'].'<br><label class="font-weight-bold">'.$admin_regional['puesto'].'</label></td>
				    		</tr>
				    	</table>

				    </div>

				</div>

			</body>

			</html>';
			
		// Reconociendo la estructura HTML
		$pdf->writeHTML($content, true, false, true, false, '');

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
		$pdf->write2DBarcode($codeContents, 'QRCODE,L', 250, 3, 18, 18, $style, 'N');

		$pdf->lastPage();

		$pdf->output('../temp/planilla-'.$valor1.'.pdf', 'F');

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

	$boletaEmpleadoPDF = new AjaxPlanillasPersonas();
	$boletaEmpleadoPDF -> id_planilla_persona_contrato = $_POST["id_planilla_persona_contrato"];
	$boletaEmpleadoPDF -> ajaxMostrarBoletaPersonaPDF();

}

/*=============================================
GENERAR PLANILLA EN PDF 
=============================================*/

if (isset($_POST["generarPlanillaPDF"])) {

	$generarPlanillaPDF = new AjaxPlanillasPersonas();
	$generarPlanillaPDF -> id_planilla = $_POST["id_planilla"];
	$generarPlanillaPDF -> ajaxMostrarPlanillaPDF();

}