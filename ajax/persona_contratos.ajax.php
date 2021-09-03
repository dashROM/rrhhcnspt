<?php

require_once "../controladores/personas.controlador.php";
require_once "../modelos/personas.modelo.php";

require_once "../controladores/contratos.controlador.php";
require_once "../modelos/contratos.modelo.php";

require_once "../controladores/cargos.controlador.php";
require_once "../modelos/cargos.modelo.php";

require_once "../controladores/autoridades.controlador.php";
require_once "../modelos/autoridades.modelo.php";

require_once "../controladores/persona_contratos.controlador.php";
require_once "../modelos/persona_contratos.modelo.php";

require_once "../scripts/funciones_auxiliares.script.php";

// require_once('../extensiones/TCPDF-main/tcpdf.php');

require_once('../extensiones/tcpdf/tcpdf.php');

class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'cns-logo.png';
        $this->Image($image_file, 5, 5, 10, '', 'PNG', '', 'T', false, 100, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 14);
        // Titulo
        $this->Cell(0, 0, 'CAJA NACIONAL DE SALUD', 0, 1, 'C', 0, '', 1);
        // Subtitulo
        $this->Cell(0, 0, 'JEFATURA DE RECURSOS HUMANOS', 0, 1, 'C', 0, '', 1);

		// set border width
		$this->SetLineWidth(0.1);

		// set color for cell border
		$this->SetDrawColor(0,0,0);

		// set filling color
		$this->SetFillColor(0,0,0);

		// set cell height ratio
		$this->setCellHeightRatio(0.05);

        $this->Cell(185, 0, '', 'B', 1, 'C', 1, '', 0, false, 'T', 'C');

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

class AjaxPersonaContratos {
	
	public $id_persona_contrato;

	/*=============================================
	MOSTRAR DATOS PERSONA CONTRARTO
	=============================================*/

	public function ajaxMostrarPersonaContrato()	{

		$item = "id_persona_contrato";
		$valor1 = $this->id_persona_contrato;
		$valor2 = null;

		$respuesta = ControladorPersonaContratos::ctrMostrarPersonaContratos($item, $valor1, $valor2);

		echo json_encode($respuesta);

	}

	/*=============================================
	MOSTRAR DATOS DOCUMENTO CONTRARTO
	=============================================*/

	public function ajaxMostrarDocumentoContrato()	{

		$item = "id_persona_contrato";
		$valor = $this->id_persona_contrato;
		
		$respuesta = ControladorPersonaContratos::ctrMostrarDocumentoContrato($item, $valor);

		echo json_encode($respuesta);

	}

	public $id_establecimiento;
	public $id_persona;
	public $id_cargo;
	public $inicio_contrato;
	public $dias_contrato;
	public $fin_contrato;
	public $id_contrato;
	public $id_suplencia;
	public $observaciones_contrato;

	/*=============================================
	NUEVO PERSONA CONTRATO
	=============================================*/

	public function ajaxNuevoPersonaContrato()	{


		// TRAEMOS DATOS DE PERSONA
		$item = "id_persona";
		$valor1 = $this->id_persona;
		$valor2 = null;

		$persona = ControladorPersonas::ctrMostrarPersonas($item, $valor1, $valor2);

		// TRAEMOS DATOS DE CONTRATO
		$item = "id_contrato";
		$valor = $this->id_contrato;

		$contrato = ControladorContratos::ctrMostrarContratos($item, $valor);

		// TRAEMOS DATOS DE CARGO
		$item = "id_cargo";
		$valor = $this->id_cargo;

		$cargo = ControladorCargos::ctrMostrarCargos($item, $valor);

		// TRAEMOS DATOS DE AUTORIDADES-ADMINISTRADOR REGIONAL
		$item = "puesto";
		$valor = "ADMINISTRADOR(A) REGIONAL C.N.S.";

		$admin_regional = ControladorAutoridades::ctrMostrarAdministradorRegional($item, $valor);

		// SI TIPO DE CONTRATO ES SUPLENCIA SE GUARDA EL TIPO DE SUPLENCIA 
		if ($this->id_contrato != 1) {

			$suplencia = 5;
			
		} else {

			$suplencia = $this->id_suplencia;

		}		

		$haber_literal = FuncionesAuxiliares::convertir($cargo['haber_basico']);

		$documento_contrato = '<h2 style="text-align:center"><u><strong>CONTRATO DE TRABAJO</strong></u></h2><p style="text-align:right"><strong>N&ordf; 360/2021</strong></p><p style="text-align:justify">Conste por el presente Contrato de Trabajo <strong>a '.$contrato['nombre_contrato'].', </strong>suscrito entre la <strong>CAJA NACIONAL DE SALUD</strong>, y el señor(a) <strong>'.$persona['paterno_persona'].' '.$persona['materno_persona'].' '.$persona['nombre_persona'].'</strong> Sujetándose al tenor de las siguientes cláusulas:</p><p style="text-align:justify"><strong><u>P R I M E R A</u>: (DE LAS PARTES). - </strong>Intervienen en la suscripción del presente Contrato, por una parte, del <strong>'.$admin_regional['nombre_autoridad'].'</strong>, en su condición de ADMINISTRADOR REGIONAL de la Caja Nacional de Salud nombrado según Testimonio No. 458/2019 de fecha 04 de diciembre de 2019 años, quien en adelante se denominarán <strong>“LA CAJA NACIONAL DE SALUD REGIONAL POTOSI”</strong>; y por la otra, el <strong>Sr.(a) '.$persona['paterno_persona'].' '.$persona['materno_persona'].' '.$persona['nombre_persona'].'</strong> mayor de edad y hábil por derecho, con C.I. No. <strong>'.$persona['ci_persona'].'</strong> expedida en <strong>'.$persona['ext_ci_persona'].', </strong>vecino de esta ciudad y con capacidad jurídica plena que en adelante se denominará el <strong>“CONTRATADO(A)”.</strong></p><p style="text-align:justify"><strong><u>S E G U N D A</u>: (DEL OBJETO). - </strong>El presente contrato <strong>a '.$contrato['nombre_contrato'].'</strong> es realizado en el estado de EMERGENCIA SANITARIA por la pandemia COVID-19, que tiene por objeto la prestación de servicios del <strong>CONTRATADO(A), </strong>como <strong>'.$cargo['nombre_cargo'].' (NIVEL '.$cargo['nivel_salarial'].')</strong>, con cargo a la partida 12100 del “Programa Gestión de Riesgos No. 96”, de igual manera el <strong>CONTRATADO(A) </strong>se obliga a cumplir con idoneidad y capacidad, acatando para ello todas aquellas funciones en horarios definidos y trabajos que les sean encomendados de acuerdo a necesidades de servicio.</p><p style="text-align:justify"><strong><u>T E R C E R A</u>: (DE LA VIGENCIA). - </strong>El presente Contrato tendrá una vigencia de <strong>'.$this->dias_contrato.' días</strong>, la relación de trabajo se inicia el día '.$this->inicio_contrato.' y finaliza en forma impostergable el día '.$this->fin_contrato.'.</p><p style="text-align:justify">Por sus características de eventualidad, y a fin de prevenir la tácita reconducción del presente Contrato, se deja claramente establecido la prohibición de que el <strong>CONTRATADO(A) </strong>continúe prestando servicios una vez concluida la fecha de vigencia prevista en la presente cláusula, exceptuándose los casos en los que el <strong>CONTRATADO(A) </strong>posea autorización expresa y escrita de autoridad competente.</p><p style="text-align:justify"><strong><u>C U A R T A</u>: (DEL SALARIO). - </strong>El salario que percibirá el <strong>CONTRATADO(A) </strong>está sujeto a la previsión presupuestaria establecida para el efecto, correspondiendo al monto de <strong>Bs. '.$cargo['haber_basico'].' ('.$haber_literal.') </strong>mensuales conforme al nivel y cargo para el que fue contratado, pago que contempla todos los beneficios colaterales según presupuesto. A pagarse mensualmente, <strong>LA CAJA </strong>actuará como agente de retención de los descuentos establecidos por ley sobre el total ganado.</p><p style="text-align:justify"><strong><u>Q U I N T A</u>: (DE LA JORNADA DE TRABAJO). - </strong>El <strong>CONTRATADO(A) </strong>desempeñara funciones en una Jornada laboral de <strong>'.$cargo['hrs_semanales'].' horas semanales, </strong>pudiendo <strong>LA CAJA </strong>durante ese tiempo efectivo de trabajo disponer que el <strong>CONTRATADO(A) </strong>preste sus servicios en el lugar que se requiera.</p><p style="text-align:justify"><strong><u>S E X T A: (DE LAS OBLIGACIONES)</u>. -</strong> El <strong>CONTRATADO(A) </strong>se obliga a prestar sus servicios con eficiencia, eficacia, excelencia y responsabilidad en beneficio de la Institución, respetando instancias superiores, conducto regular y organización institucional.</p><p style="text-align:justify">Asimismo, el <strong>CONTRATADO(A) </strong>declara expresamente que conoce la labor a desempeñar y que es apto para ello, obligándose a comunicar a su Jefe inmediato superior, cualquier situación especial, irregular o anormal que se presente en el desarrollo sus actividades y que perjudique o pueda ir en desmedro a la institución.</p><p style="text-align:justify"><strong><u>S E P T I M A</u>: (DE LA NORMATIVA LEGAL). – </strong>Tanto <strong>LA CAJA </strong>como el <strong>CONTRATADO(A) </strong>se sujetarán a disposiciones vigentes establecidas en Ley General del Trabajo, Código de Seguridad Social, Ley N° 1178 y su Sistemas de administración y control gubernamentales. Reglamento de la Responsabilidad por la Función Pública aprobado mediante Decreto Supremo N° 23318-A y Decreto Supremo N° 26237, Estatuto Orgánico de la Caja Nacional de Salud, Reglamento Interno de Trabajo de la Caja Nacional de Salud y demás normativa institucional.</p><p style="text-align:justify">Asimismo, forma parte integrante del presente contrato el Formulario de Compatibilidad de Carga Horaria, Fuente Laboral y Nepotismo suscrito por el <strong>CONTRATADO(A).</strong></p><p style="text-align:justify"><strong><u>O C T A V A</u>: (DE LA RESCISIÓN DEL CONTRATO). - </strong>El presente contrato será rescindido por las causales señaladas en el Art. 16° de la Ley General del Trabajo (…a) perjuicio material causado con intención en los instrumentos de trabajo, b) Revelación de secretos industriales, c) Omisiones o imprudencias que afecten a la seguridad o higiene industrial, d) Inasistencia injustificada de más de seis días continuos, e) Incumplimiento total o parcial del convenio, f) Retiro Voluntario, g) Robo o hurto por el trabajador …), Art. 9° de su Decreto Reglamentario, Ley N° 1178 y sus Decretos Reglamentarios, causales descritas en el Reglamento Interno de Trabajo de la Caja Nacional de Salud, y en caso de evaluación negativa o insatisfactoria.</p><p style="text-align:justify">Además de las causales descritas por renuncia, para cuyo efecto el <strong>CONTRATADO(A) </strong>deberá comunicar su intención a <strong>LA CAJA </strong>con treinta (30) días de anticipación, teniendo obligación de entregar el trabajo que tuviera pendiente a satisfacción.</p><p style="text-align:justify"><strong><u>N O V E N A</u>: (DE LA CONFORMIDAD). – La Caja Nacional de Salud </strong>representada por el '.$admin_regional['nombre_autoridad'].' Administrador Regional, así como el Sr.(a) <strong>'.$persona['paterno_persona'].' '.$persona['materno_persona'].' '.$persona['nombre_persona'].'</strong>, damos nuestra conformidad con todas y cada una de las cláusulas que anteceden en el presente contrato, obligándonos a su fiel cumplimiento, firmando en señal de conformidad en cinco ejemplares del mismo tenor.</p><p>&nbsp;</p><p class="ql-align-center">Potosi, xx de xxxxxx del 202x</p><p><br></p>';


		$datos = array("id_establecimiento" 	 => $this->id_establecimiento,						
				       "id_persona"     		 => $this->id_persona,
				       "id_cargo"   	       	 => $this->id_cargo,
				       "inicio_contrato"  		 => $this->inicio_contrato,
				       "dias_contrato"			 => $this->dias_contrato,
				       "fin_contrato"            => $this->fin_contrato,
				       "id_contrato"   	         => $this->id_contrato,
				       "id_suplencia"   	     => $suplencia,
				       "estado_contrato"		 => 0,
				       "observaciones_contrato"  => rtrim(mb_strtoupper($this->observaciones_contrato,'utf-8')),
				       "documento_contrato" 	 => $documento_contrato,
		);	


		// var_dump($suplencia);

		$respuesta = ControladorPersonaContratos::ctrNuevoPersonaContrato($datos);

		echo $respuesta;

	}

	/*=============================================
	EDITAR PERSONA CONTRATO
	=============================================*/

	public function ajaxEditarPersonaContrato() {

		// TRAEMOS DATOS DE PERSONA
		$item = "id_persona";
		$valor1 = $this->id_persona;
		$valor2 = null;

		$persona = ControladorPersonas::ctrMostrarPersonas($item, $valor1, $valor2);

		// TRAEMOS DATOS DE CONTRATO
		$item = "id_contrato";
		$valor = $this->id_contrato;

		$contrato = ControladorContratos::ctrMostrarContratos($item, $valor);

		// TRAEMOS DATOS DE CARGO
		$item = "id_cargo";
		$valor = $this->id_cargo;

		$cargo = ControladorCargos::ctrMostrarCargos($item, $valor);

		// TRAEMOS DATOS DE AUTORIDADES-ADMINISTRADOR REGIONAL
		$item = "puesto";
		$valor = "ADMINISTRADOR(A) REGIONAL C.N.S.";

		$admin_regional = ControladorAutoridades::ctrMostrarAdministradorRegional($item, $valor);

		// SI TIPO DE CONTRATO ES SUPLENCIA SE GUARDA EL TIPO DE SUPLENCIA 
		if ($this->id_contrato != 1) {

			$suplencia = 5;
			
		} else {

			$suplencia = $this->id_suplencia;

		}	

		$haber_literal = FuncionesAuxiliares::convertir($cargo['haber_basico']);

		$documento_contrato = '<h2 style="text-align:center"><u><strong>CONTRATO DE TRABAJO</strong></u></h2><p style="text-align:right"><strong>N&ordf; 360/2021</strong></p><p style="text-align:justify">Conste por el presente Contrato de Trabajo <strong>a '.$contrato['nombre_contrato'].', </strong>suscrito entre la <strong>CAJA NACIONAL DE SALUD</strong>, y el señor(a) <strong>'.$persona['paterno_persona'].' '.$persona['materno_persona'].' '.$persona['nombre_persona'].'</strong> Sujetándose al tenor de las siguientes cláusulas:</p><p style="text-align:justify"><strong><u>P R I M E R A</u>: (DE LAS PARTES). - </strong>Intervienen en la suscripción del presente Contrato, por una parte, del <strong>'.$admin_regional['nombre_autoridad'].'</strong>, en su condición de ADMINISTRADOR REGIONAL de la Caja Nacional de Salud nombrado según Testimonio No. 458/2019 de fecha 04 de diciembre de 2019 años, quien en adelante se denominarán <strong>“LA CAJA NACIONAL DE SALUD REGIONAL POTOSI”</strong>; y por la otra, el <strong>Sr.(a) '.$persona['paterno_persona'].' '.$persona['materno_persona'].' '.$persona['nombre_persona'].'</strong> mayor de edad y hábil por derecho, con C.I. No. <strong>'.$persona['ci_persona'].'</strong> expedida en <strong>'.$persona['ext_ci_persona'].', </strong>vecino de esta ciudad y con capacidad jurídica plena que en adelante se denominará el <strong>“CONTRATADO(A)”.</strong></p><p style="text-align:justify"><strong><u>S E G U N D A</u>: (DEL OBJETO). - </strong>El presente contrato <strong>a '.$contrato['nombre_contrato'].'</strong> es realizado en el estado de EMERGENCIA SANITARIA por la pandemia COVID-19, que tiene por objeto la prestación de servicios del <strong>CONTRATADO(A), </strong>como <strong>'.$cargo['nombre_cargo'].' (NIVEL '.$cargo['nivel_salarial'].')</strong>, con cargo a la partida 12100 del “Programa Gestión de Riesgos No. 96”, de igual manera el <strong>CONTRATADO(A) </strong>se obliga a cumplir con idoneidad y capacidad, acatando para ello todas aquellas funciones en horarios definidos y trabajos que les sean encomendados de acuerdo a necesidades de servicio.</p><p style="text-align:justify"><strong><u>T E R C E R A</u>: (DE LA VIGENCIA). - </strong>El presente Contrato tendrá una vigencia de <strong>'.$this->dias_contrato.' días</strong>, la relación de trabajo se inicia el día '.$this->inicio_contrato.' y finaliza en forma impostergable el día '.$this->fin_contrato.'.</p><p style="text-align:justify">Por sus características de eventualidad, y a fin de prevenir la tácita reconducción del presente Contrato, se deja claramente establecido la prohibición de que el <strong>CONTRATADO(A) </strong>continúe prestando servicios una vez concluida la fecha de vigencia prevista en la presente cláusula, exceptuándose los casos en los que el <strong>CONTRATADO(A) </strong>posea autorización expresa y escrita de autoridad competente.</p><p style="text-align:justify"><strong><u>C U A R T A</u>: (DEL SALARIO). - </strong>El salario que percibirá el <strong>CONTRATADO(A) </strong>está sujeto a la previsión presupuestaria establecida para el efecto, correspondiendo al monto de <strong>Bs. '.$cargo['haber_basico'].' ('.$haber_literal.') </strong>mensuales conforme al nivel y cargo para el que fue contratado, pago que contempla todos los beneficios colaterales según presupuesto. A pagarse mensualmente, <strong>LA CAJA </strong>actuará como agente de retención de los descuentos establecidos por ley sobre el total ganado.</p><p style="text-align:justify"><strong><u>Q U I N T A</u>: (DE LA JORNADA DE TRABAJO). - </strong>El <strong>CONTRATADO(A) </strong>desempeñara funciones en una Jornada laboral de <strong>'.$cargo['hrs_semanales'].' horas semanales, </strong>pudiendo <strong>LA CAJA </strong>durante ese tiempo efectivo de trabajo disponer que el <strong>CONTRATADO(A) </strong>preste sus servicios en el lugar que se requiera.</p><p style="text-align:justify"><strong><u>S E X T A: (DE LAS OBLIGACIONES)</u>. -</strong> El <strong>CONTRATADO(A) </strong>se obliga a prestar sus servicios con eficiencia, eficacia, excelencia y responsabilidad en beneficio de la Institución, respetando instancias superiores, conducto regular y organización institucional.</p><p style="text-align:justify">Asimismo, el <strong>CONTRATADO(A) </strong>declara expresamente que conoce la labor a desempeñar y que es apto para ello, obligándose a comunicar a su Jefe inmediato superior, cualquier situación especial, irregular o anormal que se presente en el desarrollo sus actividades y que perjudique o pueda ir en desmedro a la institución.</p><p style="text-align:justify"><strong><u>S E P T I M A</u>: (DE LA NORMATIVA LEGAL). – </strong>Tanto <strong>LA CAJA </strong>como el <strong>CONTRATADO(A) </strong>se sujetarán a disposiciones vigentes establecidas en Ley General del Trabajo, Código de Seguridad Social, Ley N° 1178 y su Sistemas de administración y control gubernamentales. Reglamento de la Responsabilidad por la Función Pública aprobado mediante Decreto Supremo N° 23318-A y Decreto Supremo N° 26237, Estatuto Orgánico de la Caja Nacional de Salud, Reglamento Interno de Trabajo de la Caja Nacional de Salud y demás normativa institucional.</p><p style="text-align:justify">Asimismo, forma parte integrante del presente contrato el Formulario de Compatibilidad de Carga Horaria, Fuente Laboral y Nepotismo suscrito por el <strong>CONTRATADO(A).</strong></p><p style="text-align:justify"><strong><u>O C T A V A</u>: (DE LA RESCISIÓN DEL CONTRATO). - </strong>El presente contrato será rescindido por las causales señaladas en el Art. 16° de la Ley General del Trabajo (…a) perjuicio material causado con intención en los instrumentos de trabajo, b) Revelación de secretos industriales, c) Omisiones o imprudencias que afecten a la seguridad o higiene industrial, d) Inasistencia injustificada de más de seis días continuos, e) Incumplimiento total o parcial del convenio, f) Retiro Voluntario, g) Robo o hurto por el trabajador …), Art. 9° de su Decreto Reglamentario, Ley N° 1178 y sus Decretos Reglamentarios, causales descritas en el Reglamento Interno de Trabajo de la Caja Nacional de Salud, y en caso de evaluación negativa o insatisfactoria.</p><p style="text-align:justify">Además de las causales descritas por renuncia, para cuyo efecto el <strong>CONTRATADO(A) </strong>deberá comunicar su intención a <strong>LA CAJA </strong>con treinta (30) días de anticipación, teniendo obligación de entregar el trabajo que tuviera pendiente a satisfacción.</p><p style="text-align:justify"><strong><u>N O V E N A</u>: (DE LA CONFORMIDAD). – La Caja Nacional de Salud </strong>representada por el '.$admin_regional['nombre_autoridad'].' Administrador Regional, así como el Sr.(a) <strong>'.$persona['paterno_persona'].' '.$persona['materno_persona'].' '.$persona['nombre_persona'].'</strong>, damos nuestra conformidad con todas y cada una de las cláusulas que anteceden en el presente contrato, obligándonos a su fiel cumplimiento, firmando en señal de conformidad en cinco ejemplares del mismo tenor.</p><p>&nbsp;</p><p class="ql-align-center">Potosi, xx de xxxxxx del 202x</p><p><br></p>';	

		$datos = array("id_establecimiento"       => $this->id_establecimiento,
				       "id_persona"     		  => $this->id_persona,
				       "id_cargo"   	          => $this->id_cargo,
				       "inicio_contrato"          => $this->inicio_contrato,
				       "dias_contrato"			  => $this->dias_contrato,
				       "fin_contrato"   	      => $this->fin_contrato,
				       "id_contrato"   	          => $this->id_contrato,
				       "id_suplencia"   	      => $suplencia,
				       "observaciones_contrato"	  => mb_strtoupper($this->observaciones_contrato,'utf-8'),
					   "documento_contrato" 	  => $documento_contrato,
					   "id_persona_contrato"   	  => $this->id_persona_contrato,
		);	

	  // var_dump($datos);

		$respuesta = ControladorPersonaContratos::ctrEditarPersonaContrato($datos);

		echo $respuesta;

	}

	public $documento_contrato;

	/*=============================================
	EDITAR DOCUMENTO CONTRATO
	=============================================*/

	public function ajaxEditarDocumentoContrato() {

		$datos = array("id_persona_contrato"   	=> $this->id_persona_contrato,
									 "documento_contrato"			=> $this->documento_contrato,
		);	

	  // var_dump($datos);

		$respuesta = ControladorPersonaContratos::ctrEditarDocumentoContrato($datos);

		echo $respuesta;

	}

	/*=============================================
	MOSTRAR EN PDF FICHA CONTROL Y SEGUIMIENTO
	=============================================*/

	public function ajaxMostrarDocumentoContratolPDF()	{

	    /*=============================================
	    TRAEMOS LOS DATOS DE PERSONA CONTRATO
	    =============================================*/

  		$item = "id_persona_contrato";
		$valor = $this->id_persona_contrato;
		
		$respuesta = ControladorPersonaContratos::ctrMostrarDocumentoContrato($item, $valor);

		// var_dump($respuesta['documento_contrato']);

		// Extend the TCPDF class to create custom Header and Footer

		$pdf = new MYPDF('P', 'mm', 'letter', true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('CNS Potosí');
		$pdf->SetTitle('contrato-'.$valor);
		$pdf->SetSubject('Contrato de Trabajo');
		$pdf->SetKeywords('TCPDF, PDF, CNS, Reporte, Contrato de Trabajo');

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// ocultando pie de pagina
		$pdf->SetPrintFooter(FALSE);

		// ---------------------------------------------------------

		// set font
		$pdf->SetFont('Helvetica', '', 10);

		// add a page
		$pdf->AddPage();

		$content = $respuesta['documento_contrato'];
			
		// Reconociendo la estructura HTML
		//$pdf->writeHTML($content, true, 0, true, true);
		$pdf->writeHTML($content, true, false, true, false, '');

		// Insertando el Logo
		// $image_file = K_PATH_IMAGES.'cns-logo-simple.png';

		// $pdf->Image($image_file, 8, 10, 13, '', 'PNG', '', 'T', false, 100, '', false, false, 0, false, false, false);

		// Estilos necesarios para el Codigo QR
		// $style = array(
		//     'border' => 0,
		//     'vpadding' => 'auto',
		//     'hpadding' => 'auto',
		//     'fgcolor' => array(0,0,0),
		//     'bgcolor' => false, //array(255,255,255)
		//     'module_width' => 1, // width of a single module in points
		//     'module_height' => 1 // height of a single module in points
		// );

		//	Datos a mostrar en el código QR
		// $codeContents = 'COD. FICHA: '.$this->idFicha."\n";

		// insertando el código QR
		// $pdf->write2DBarcode($codeContents, 'QRCODE,L', 190, 8 + $n, 15, 15, $style, 'N');	

		$pdf->lastPage();

		$pdf->output('../temp/contrato-'.$valor.'.pdf', 'F');

	}

	public $file;

	/*=============================================
	ELIMINADO REPORTE PDF GENERADO
	=============================================*/

	public function ajaxEliminarReportePDF()	{
		
		$file = $this->file;

		unlink('../'.$file);

	}

}

/*=============================================
MOSTRAR PERSONA CONTRATO
=============================================*/

if (isset($_POST["mostrarPersonaContrato"])) {
	
	$personaContrato = new AjaxPersonaContratos();

	$personaContrato -> id_persona_contrato = $_POST["id_persona_contrato"];

	$personaContrato-> ajaxMostrarPersonaContrato();

}

/*=============================================
MOSTRAR DOCUMENTO CONTRATO
=============================================*/

if (isset($_POST["mostrarDocumentoContrato"])) {
	
	$personaContrato = new AjaxPersonaContratos();

	$personaContrato -> id_persona_contrato = $_POST["id_persona_contrato"];

	$personaContrato-> ajaxMostrarDocumentoContrato();

}

/*=============================================
NUEVO PERSONA CONTRATO
=============================================*/

if (isset($_POST["nuevoPersonaContratos"])) {

	$nuevoPersonaContrato = new AjaxPersonaContratos();

	$nuevoPersonaContrato -> id_establecimiento = $_POST["nuevoEstablecimiento"];
	$nuevoPersonaContrato -> id_persona = $_POST["nuevoIdPersona"];
	$nuevoPersonaContrato -> id_cargo = $_POST["nuevoCargoEmpleado"];
	$nuevoPersonaContrato -> inicio_contrato = $_POST["nuevoFechaInicio"];
	$nuevoPersonaContrato -> dias_contrato = $_POST["nuevoDiasContrato"];
	$nuevoPersonaContrato -> fin_contrato = $_POST["nuevoFechaFin"];
	$nuevoPersonaContrato -> id_contrato = $_POST["nuevoTipoContrato"];
	$nuevoPersonaContrato -> id_suplencia = $_POST["nuevoTipoSuplencia"];
	$nuevoPersonaContrato -> observaciones_contrato = $_POST["nuevoObservacionesContrato"];

	$nuevoPersonaContrato -> ajaxNuevoPersonaContrato();

}

/*=============================================
EDITAR PERSONA CONTRATO
=============================================*/

if (isset($_POST["editarPersonaContrato"])) {

	$editarPersonaContrato = new AjaxPersonaContratos();

	$editarPersonaContrato -> id_establecimiento = $_POST["editarEstablecimiento"];
	$editarPersonaContrato -> id_persona = $_POST["editarIdPersona"];
	$editarPersonaContrato -> id_cargo = $_POST["editarCargoEmpleado"];
	$editarPersonaContrato -> inicio_contrato = $_POST["editarFechaInicio"];
	$editarPersonaContrato -> dias_contrato = $_POST["editarDiasContrato"];
	$editarPersonaContrato -> fin_contrato = $_POST["editarFechaFin"];
	$editarPersonaContrato -> id_contrato = $_POST["editarTipoContrato"];
	$editarPersonaContrato -> id_suplencia = $_POST["editarTipoSuplencia"];
	$editarPersonaContrato -> observaciones_contrato = $_POST["editarObservacionesContrato"];
	$editarPersonaContrato -> id_persona_contrato = $_POST["editarIdPersonaContrato"];

	$editarPersonaContrato -> ajaxEditarPersonaContrato();

}

/*=============================================
EDITAR DOCUMENTO CONTRATO
=============================================*/

if (isset($_POST["editarDocumentoContrato"])) {

	$editarDocumentoContrato = new AjaxPersonaContratos();

	$editarDocumentoContrato -> id_persona_contrato = $_POST["editarIdDocumentoContrato"];	
	$editarDocumentoContrato -> documento_contrato = $_POST["documento"];

	$editarDocumentoContrato -> ajaxEditarDocumentoContrato();

}

/*=============================================
VER DOCUMENTO CONTRATO EN PDF
=============================================*/

if (isset($_POST["ContratoPDF"])) {

	$editarDocumentoContrato = new AjaxPersonaContratos();

	$editarDocumentoContrato -> id_persona_contrato = $_POST["id_persona_contrato"];	

	$editarDocumentoContrato -> ajaxMostrarDocumentoContratolPDF();

}

/*=============================================
ELIMINAR EL PDF TEMPORAL DE REPORTE GENERADO
=============================================*/

if (isset($_POST["eliminarPDF"])) {

	$reportesContrato = new AjaxPersonaContratos();

	$reportesContrato -> file = $_POST["url"];

	$reportesContrato -> ajaxEliminarReportePDF();

}

/*=============================================
NUEVO USUARIO
=============================================*/

if (isset($_POST["cargarArchivoContrato"])) {

	$archivoContrato = new AjaxPersonaContratos();
	$archivoContrato -> id_persona_contrato = $_POST["editarIdArchivoContrato"];
	$archivoContrato -> archivo_contrato = $_POST["archivoContrato"];
	$archivoContrato -> ajaxNuevoUsuario();

}