<?php

require_once "../controladores/personas.controlador.php";
require_once "../modelos/personas.modelo.php";

require_once "../controladores/contratos.controlador.php";
require_once "../modelos/contratos.modelo.php";

require_once "../controladores/suplencias.controlador.php";
require_once "../modelos/suplencias.modelo.php";

require_once "../controladores/cargos.controlador.php";
require_once "../modelos/cargos.modelo.php";

require_once "../controladores/establecimientos.controlador.php";
require_once "../modelos/establecimientos.modelo.php";

require_once "../controladores/autoridades.controlador.php";
require_once "../modelos/autoridades.modelo.php";

require_once "../controladores/persona_contratos.controlador.php";
require_once "../modelos/persona_contratos.modelo.php";

require_once "../scripts/funciones_auxiliares.script.php";

// require_once('../extensiones/TCPDF-main/tcpdf.php');

require_once('../extensiones/tcpdf/tcpdf.php');

class MYPDF extends TCPDF {

	public $codContrato;

	public $headerContrato = false;

    //Page header
    public function Header() {

    	if ($this->headerContrato === true) { 

    		// Set font
	        $this->SetFont('helvetica', 'B', 14);
	        // Titulo
	        $this->Cell(0, 0, 'CAJA NACIONAL DE SALUD', 0, 1, 'C', 0, '', 1);
	        // Subtitulo
	        $this->Cell(0, 0, 'CONTRATO DE TRABAJO A PLAZO FIJO', 0, 1, 'C', 0, '', 1);

	        // Logo
	        $image_file = K_PATH_IMAGES.'cns-logo-simple.png';
	        $this->Image($image_file, 10, 6, 16, '', 'PNG', '', 'T', false, 100, '', false, false, 0, false, false, false);

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

			// Datos a mostrar en el código QR
			$codeContents = 'COD. CONTRATO: '.$this->codContrato."\n";

			// insertando el código QR
			$this->write2DBarcode($codeContents, 'QRCODE,L', 190, 5, 30, 30, $style, 'N');	

			// set border width
			// $this->SetLineWidth(0.1);

			// set color for cell border
			// $this->SetDrawColor(0,0,0);

			// set filling color
			// $this->SetFillColor(0,0,0);

			// set cell height ratio
			// $this->setCellHeightRatio(0.02);

	        // $this->Cell(194, 0, '', 0, false, 'C', 1, '', 0, false, 'T', 'C');

    	} else {

    		// Set font
	        $this->SetFont('helvetica', 'B', 14);
	        // Titulo
	        $this->Cell(0, 0, 'CAJA NACIONAL DE SALUD', 0, 1, 'C', 0, '', 1);
	        // Subtitulo
	        $this->Cell(0, 0, 'JEFATURA DE RECURSOS HUMANOS REGIONAL', 0, 1, 'C', 0, '', 1);

	        // Logo
	        $image_file = K_PATH_IMAGES.'cns-logo-simple.png';
	        $this->Image($image_file, 10, 6, 13, '', 'PNG', '', 'T', false, 100, '', false, false, 0, false, false, false);

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

			// Datos a mostrar en el código QR
			$codeContents = 'COD. CONTRATO: '.$this->codContrato."\n";

			// insertando el código QR
			$this->write2DBarcode($codeContents, 'QRCODE,L', 190, 5, 30, 30, $style, 'N');	

			// set border width
			$this->SetLineWidth(0.1);

			// set color for cell border
			$this->SetDrawColor(0,0,0);

			// set filling color
			$this->SetFillColor(0,0,0);

			// set cell height ratio
			$this->setCellHeightRatio(0.02);

	        $this->Cell(194, 0, '', 0, false, 'C', 1, '', 0, false, 'T', 'C');

    	}

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

	public $id_lugar;
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

		// VERIFICAR SI YA TIENE MAS DE DOS CONTRATOS

		$item = "id_persona";
		$valor = $this->id_persona;

		$cantidad_persona_contrato = ControladorPersonaContratos::ctrCantidadPersonaContratos($item, $valor);

		if ($cantidad_persona_contrato["numero_filas"] < 2) {
			
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

			// TRAEMOS DATOS DE ESTABLECIMIENTO
			$item = "id_establecimiento";
			$valor = $this->id_establecimiento;

			$establecimiento = ControladorEstablecimientos::ctrMostrarEstablecimientos($item, $valor);

			/*=============================================
		   	TRAEMOS LOS DATOS DE AUTORIDADES
		    =============================================*/

			// TRAEMOS DATOS DE AUTORIDADES-ADMINISTRADOR REGIONAL
			$item = "puesto";
			$valor = "ADMINISTRADOR(A) REGIONAL C.N.S.";

			$admin_regional = ControladorAutoridades::ctrMostrarAutoridades($item, $valor);

			// TRAEMOS DATOS DE AUTORIDADES-JEFE MEDICO
			$item = "puesto";
			$valor = "JEFE MEDICO REGIONAL";

			$jefe_medico = ControladorAutoridades::ctrMostrarAutoridades($item, $valor);

			// TRAEMOS DATOS DE AUTORIDADES-SUPERVISOR ADMINISTRATIVO
			$item = "puesto";
			$valor = "SUPERVISOR ADM. | RR.HH.";

			$supervisor_admin = ControladorAutoridades::ctrMostrarAutoridades($item, $valor);

			// TRAEMOS DATOS DE AUTORIDADES-JEFE DE CONTABILIDAD REGIONAL
			$item = "puesto";
			$valor = "JEFE CONTABILIDAD REG.";

			$jefe_contabilidad = ControladorAutoridades::ctrMostrarAutoridades($item, $valor);

			// OPTENEMOS EL ULTIMO CODIGO DE CONTRATO DE ACUERDO AL TIPO DE CONTRATO Y CARGO

			$item1 = "codigo";
			$cog_contrato = $contrato['codigo'];

			$item2 = "grupo_cargo";
			$grupo_cargo = $cargo['grupo_cargo'];

			$ultimo_cod_contrato = ControladorPersonaContratos::ctrUltimoCodigoContrato($item1, $cog_contrato, $item2, $grupo_cargo);

			if ($ultimo_cod_contrato == null) {

				$codigo = 1;
				
				$cod_contrato = "JRH-".$contrato['codigo']."-".$cargo['grupo_cargo']."-1";

			} else {

				$codigo = $ultimo_cod_contrato['nro_cod_contrato'] + 1;

				$cod_contrato = "JRH-".$contrato['codigo']."-".$cargo['grupo_cargo']."-".$codigo;

			}

			// echo $cod_contrato;

			// SI TIPO DE CONTRATO ES SUPLENCIA SE GUARDA EL TIPO DE SUPLENCIA 
			if ($this->id_contrato != 1) {

				$suplencia = 5;

				$haber_literal = FuncionesAuxiliares::convertir($cargo['haber_basico']);

				if ($this->id_contrato == 2) {

					$documento_contrato = '<p style="text-align:right"><strong>MAT: '.$persona['matricula_persona'].'</strong></p><p style="text-align:justify">Conste por el presente Contrato de Trabajo a Plazo Fijo, suscrito entre la <strong>CAJA NACIONAL DE SALUD</strong>, y el/la Sr(a). <strong>'.$persona['nombre_persona'].' '.$persona['paterno_persona'].' '.$persona['materno_persona'].'</strong>, sujet&aacute;ndose al tenor de las siguientes cl&aacute;usulas:</p><p style="text-align:justify"><strong><u>P R I M E R A</u>: (DE LAS PARTES). - </strong>Intervienen en la suscripci&oacute;n del presente Contrato, por una parte, el/la <strong>'.$admin_regional['nombre_autoridad'].'</strong>, en su condici&oacute;n de Administrador(a) Regional a. i. de la Caja Nacional de Salud, nombrado mediante Testimonio No. <strong>284/2021</strong> de fecha <strong>14-09-2021</strong>, quien en adelante se denominar&aacute;n <strong>LA CAJA;</strong> y por la otra, el/la <strong>Sr(a). '.$persona['nombre_persona'].' '.$persona['paterno_persona'].' '.$persona['materno_persona'].'</strong>, quien es mayor de edad, h&aacute;bil por derecho, con C.I. <strong>N&ordm; '.$persona['ci_persona'].'</strong>, expedida en <strong>'.$persona['ext_ci_persona'].'</strong>, estado civil <strong>soltero(a)</strong>, domiciliado(a) en la <strong>'.$persona['direccion_persona'].'</strong>, Cel <strong>'.$persona['telefono_persona'].'</strong>, que en adelante se denominar&aacute; <strong>EL CONTRATADO(A).</strong></p><p style="text-align:justify"><strong><u>S E G U N D A</u>: (DEL OBJETO). - </strong>El presente contrato a Plazo Fijo tiene por objeto la prestaci&oacute;n de servicios del <strong>CONTRATADO(A)</strong> por Necesidad de Servicios, en <strong>'.$establecimiento['nombre_establecimiento'].'</strong> o en el <strong>Centro Establecimiento donde se requiera de sus servicios</strong>, como <strong>'.$cargo['nombre_cargo'].'</strong> Nivel <strong>('.$cargo['nivel_salarial'].')</strong>, con cargo a la partida No 12100 (Personal Eventual) del Programa 72 (Bienes y Servicios), en cumplimiento a Resoluci&oacute;n Ministerial ....... y Memor&aacute;ndum Instructivo N&ordm; 8299 de fecha 24-12-2019 de la Gerencia General.</p><p style="text-align:justify"><strong><u>T E R C E R A</u>: (DE LA VIGENCIA). - </strong>El presente Contrato tendr&aacute; una vigencia a partir del '.date("d-m-Y", strtotime($this->inicio_contrato)).' hasta el '.date("d-m-Y", strtotime($this->fin_contrato)).', indefectiblemente.</p><p style="text-align:justify">Por sus caracter&iacute;sticas de eventualidad, y a fin de prevenir la t&aacute;cita reconducci&oacute;n del presente Contrato, se deja claramente establecido la prohibici&oacute;n de que el <strong>CONTRATADO(A) </strong>contin&uacute;e prestando servicios una vez concluida la fecha de vigencia prevista en la presente cl&aacute;usula; exceptu&aacute;ndose los casos en los que el <strong>CONTRATADO(A) </strong>posea autorizaci&oacute;n expresa y escrita de autoridad competente, para el efecto.</p><p style="text-align:justify"><strong><u>C U A R T A</u>: (DE LAS CONDICIONES). - </strong>Con la finalidad de evitar responsabilidades contempladas en normas de actual vigencia (Ley General del Trabajo, Decreto Ley 16187 de 16-02-1979, Resolucion del Honorable Directorio N&ordm; 095/2015 y partida presupuestaria 12100 - Gesti&oacute;n 2021, no podr&aacute; suscribirse <strong>TERCER CONTRATO EVENTUAL</strong>, ya que implicar&iacute;a la adquisici&oacute;n de derechos laborales. </p><p style="text-align:justify">Asimismo, en funci&oacute;n a la naturaleza del presente contrato, se deja claramente establecido que no se aplicar&aacute; la inamovilidad laboral de la madre o padre progenitores, reglamentado por el D.S. N&ordm; 0012 de 19 de febrero de 2009.</p><p style="text-align:justify"><strong><u>Q U I N T A</u>: (DEL SALARIO). - </strong>De acuerdo a Resolucion de Directorio No 095/2019 de fecha 04-07-2019 en la cual aprueba la nueva Escala salarial del Personal Eventual de la C.N.S., expresada en el cuadro de equivalencia, considerando la Escala Salarial Gesti&oacute;n 2019, aprobada con Resoluci&oacute;n Ministerial N&ordm; 443 de fecha 22-05-2019 del Ministerio de Econom&iacute;a y Finanzas P&uacute;blicas, Par. II Art. 48 de la Constituci&oacute;n Pol&iacute;tica del Estado, el salario que percibir&aacute; el <strong>CONTRATADO(A) </strong>est&aacute; sujeto a la previsi&oacute;n presupuestaria establecida; correspondiendo a <strong>Bs. '.number_format($cargo['haber_basico'], 2, ",", ".").' ('.$haber_literal.') </strong>mensuales, conforme al nivel y cargo para el que fue contratado, pago que contempla todos los beneficios colaterales, seg&uacute;n presupuesto. </p><p style="text-align:justify">Mensualmente, <strong>LA CAJA </strong>actuar&aacute; como agente de retenci&oacute;n de los descuentos establecidos por ley sobre el total ganado.</p><p style="text-align:justify"><strong><u>S E X T A</u>: (DE LA JORNADA DE TRABAJO). - </strong>El <strong>CONTRATADO(A) </strong>desempe&ntilde;ara funciones en una Jornada laboral de <strong>'.$cargo['hrs_semanales'].' horas semanales</strong> o de acuerdo a requerimiento institucional, pudiendo <strong>LA CAJA </strong>durante ese tiempo efectivo de trabajo disponer que el <strong>CONTRATADO(A) </strong>preste sus servicios en el lugar que se requiera, acatando para ello todas aquellas funciones en horarios definidos y trabajos que le sean encomendados de acuerdo a necesidades de servicio.</p><p style="text-align:justify"><strong><u>S E P T I M A</u>: (OBLIGACION DEL CONTRATADO). -</strong> Se obliga a prestar sus servicios con eficiencia, eficacia, excelencia, idoneidad, capacidad y responsabilidad en beneficio de la Instituci&oacute;n, respetando instancias superiores, conducto regular y organizaci&oacute;n Institucional.</p><p style="text-align:justify">El <strong>CONTRATADO(A) </strong>declara expresamente que conoce la labor a desempe&ntilde;ar y que es apto para ello, oblig&aacute;ndose a comunicar a su jefe inmediato superior, cualquier situaci&oacute;n especial, irregular o anormal que se presente en el desarrollo sus actividades y que perjudique o pueda ir en desmedro a la Instituci&oacute;n.</p><p style="text-align:justify">Asimismo, El <strong>CONTRATADO(A)</strong> a momento del cese de funciones deber&aacute; proceder a la devoluci&oacute;n de todos los activos que le fueron entregados, as&iacute;&nbsp;como de dejar en orden y al d&iacute;a el trabajo que le fuere entregado, hasta el &uacute;ltimo d&iacute;a que figura en el contrato.</p><p style="text-align:justify"><strong><u>O C T A V A</u>: (DE LA AUTORIZACI&Oacute;N DE VIAJES). - </strong>El trabajador(a) podr&aacute; realizar viajes oficiales al interior del Pa&iacute;s, previa Autorizaci&oacute;n de Autoridades Ejecutivas de la C.N.S., debiendo la Instituci&oacute;n asignarle los pasajes y vi&aacute;ticos, seg&uacute;n lo establecido en el D.S. N&ordm; 1788 de 07-11-2013 y Normativa Institucional Vigente. </p><p style="text-align:justify"><strong><u>N O V E N A</u>: (DE LA NORMATIVA LEGAL). &ndash; </strong>Tanto <strong>LA CAJA </strong>como el <strong>CONTRATADO(A) </strong>se sujetar&aacute;n a disposiciones vigentes establecidas en Ley General del Trabajo, C&oacute;digo de Seguridad Social, Ley N&deg; 1178, Reglamento de la Responsabilidad por la Funci&oacute;n P&uacute;blica aprobado mediante Decreto Supremo N&ordm; 23318-A y Decreto Supremo N&deg; 26237, Estatuto Org&aacute;nico de la Caja Nacional de Salud, Reglamento Interno de Trabajo de la Caja Nacional de Salud y dem&aacute;s normativa institucional.</p><p style="text-align:justify">Asimismo, forma parte integrante del presente contrato el Acta Notarial de Declaraci&oacute;n de Compatibilidad Funcionaria, Formulario Descriptivo de Parentesco y Normas Legales Aplicables suscrito por el <strong>CONTRATADO(A) </strong>aprobado mediante Resoluci&oacute;n de Directorio N&ordm; 027/2012 de 09-02-2012.</p><p style="text-align:justify"><strong><u>D E C I M A</u>: (DE LA RESCISI&Oacute;N DEL CONTRATO). - </strong>El presente contrato ser&aacute; rescindido por las causales se&ntilde;aladas en el Art. 16 de la Ley General del Trabajo, Incs. a) perjuicio material causado con intenci&oacute;n en los instrumentos de trabajo; b) Revelaci&oacute;n de secretos industriales; c) Omisiones o imprudencias que afecten a la seguridad o higiene industrial; e) Incumplimiento total o parcial del convenio; g) Robo o hurto por el trabajador, Art. 9 de su Decreto Reglamentario de la Ley General del Trabajo Incs. a) Perjuicio material causado con intenci&oacute;n en las maquinas, productos o mercader&iacute;as;; b) Revelaci&oacute;n de secretos industriales; c) Omisiones e imprudencias que afecten a la higiene y seguridad industrial; e) Incumplimiento total o parcial del contrato de trabajo <u>o del reglamento interno de la empresa</u>; g) Abuso de confianza, robo, hurto por el trabajador; h) Vias de hecho, injurias o conducta inmoral del trabajador, i) Abandono en masa del trabajo, siempre que los trabajadores no obedecieran a la intimidaci&oacute;n de la autoridad competente, Ley N&ordm; 1178, y sus Decretos Reglamentarios, Ley N&ordm; 004, causales descritas en el Art. 81 y 86 del Reglamento Interno de Trabajo de la Caja Nacional de Salud, y <strong>en caso de evaluaci&oacute;n negativa o insatisfactoria</strong>.</p><p style="text-align:justify">Adem&aacute;s, de las causales descritas por renuncia, para cuyo efecto el <strong>CONTRATADO(A) </strong>deber&aacute; comunicar su intenci&oacute;n a <strong>LA CAJA </strong>con treinta (30) d&iacute;as de anticipaci&oacute;n, a efectos de determinarse Aceptaci&oacute;n por Administracion Regional de la Caja Nacional de Salud, teniendo la obligaci&oacute;n de entregar el trabajo que tuviera pendiente a satisfacci&oacute;n, los activos fijos, de conformidad al Art. 32 del D.S. 26115 de 16 de mayo de 2001.</p><p style="text-align:justify"><strong><u>U N D E C I M A</u>: (DE LA CONFORMIDAD). &ndash; La Caja Nacional de Salud </strong>representada por  el/la <strong>'.$admin_regional['nombre_autoridad'].'</strong> Administrador(a) Regional a. i., as&iacute; como el/la Sr(a). <strong>'.$persona['nombre_persona'].' '.$persona['paterno_persona'].' '.$persona['materno_persona'].'</strong>, damos nuestra conformidad con todas y cada una de las cl&aacute;usulas que anteceden en el presente Contrato, oblig&aacute;ndonos a su fiel cumplimiento, firmando en se&ntilde;al de conformidad en cinco ejemplares del mismo tenor.</p><p style="text-align:right">Potos&iacute;, xx de xxxxxx del 202x</p><p style="text-align:right">&nbsp;</p><p style="text-align:right">&nbsp;</p><p style="text-align:right">&nbsp;</p><div><table border="0" cellpadding="1" cellspacing="1" style="margin:auto; width:650px"><tbody><tr><td style="text-align:center">'.$jefe_contabilidad['nombre_autoridad'].'<br /><strong>'.$jefe_contabilidad['puesto'].'</strong></td><td style="text-align:center">'.$jefe_medico['nombre_autoridad'].'<br /><strong>'.$jefe_medico['puesto'].'</strong></td></tr><tr><td colspan="2" style="text-align:center"><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>'.$admin_regional['nombre_autoridad'].'<br /><strong>'.$admin_regional['puesto'].'</strong></td></tr></tbody></table></div>';

				} else {

					$documento_contrato = '<p style="text-align:right"><strong>MAT: '.$persona['matricula_persona'].'</strong></p><p style="text-align:justify">Conste por el presente Contrato de Trabajo a Plazo Fijo, suscrito entre la <strong>CAJA NACIONAL DE SALUD</strong>, y el/la Sr(a). <strong>'.$persona['nombre_persona'].' '.$persona['paterno_persona'].' '.$persona['materno_persona'].'</strong>, sujet&aacute;ndose al tenor de las siguientes cl&aacute;usulas:</p><p style="text-align:justify"><strong><u>P R I M E R A</u>: (DE LAS PARTES). - </strong>Intervienen en la suscripci&oacute;n del presente Contrato, por una parte, el/la <strong>'.$admin_regional['nombre_autoridad'].'</strong>, en su condici&oacute;n de Administrador(a) Regional a. i. de la Caja Nacional de Salud, nombrado mediante Testimonio No. <strong>284/2021</strong> de fecha <strong>14-09-2021</strong>, quien en adelante se denominar&aacute;n <strong>LA CAJA;</strong> y por la otra, el/la <strong>Sr(a). '.$persona['nombre_persona'].' '.$persona['paterno_persona'].' '.$persona['materno_persona'].'</strong>, quien es mayor de edad, h&aacute;bil por derecho, con C.I. <strong>N&ordm; '.$persona['ci_persona'].'</strong>, expedida en <strong>'.$persona['ext_ci_persona'].'</strong>, estado civil <strong>soltero(a)</strong>, domiciliado(a) en la <strong>'.$persona['direccion_persona'].'</strong>, Cel <strong>'.$persona['telefono_persona'].'</strong>, que en adelante se denominar&aacute; <strong>EL CONTRATADO(A).</strong></p><p style="text-align:justify"><strong><u>S E G U N D A</u>: (DEL OBJETO). - </strong>El presente contrato a Plazo Fijo tiene por objeto la prestaci&oacute;n de servicios del <strong>CONTRATADO(A)</strong> por <strong>Necesidad de Servicios y Emergencia Sanitaria COVID-19</strong>, en <strong>'.$establecimiento['nombre_establecimiento'].'</strong> o en el <strong>Centro Establecimiento donde se requiera de sus servicios</strong>, como <strong>'.$cargo['nombre_cargo'].'</strong> Nivel <strong>('.$cargo['nivel_salarial'].')</strong>, con cargo a la partida No 12100 (Personal Eventual) del Programa 72 (Bienes y Servicios), en cumplimiento a Resoluci&oacute;n Ministerial ....... y Memor&aacute;ndum Instructivo N&ordm; 8299 de fecha 24-12-2019 de la Gerencia General.</p><p style="text-align:justify"><strong><u>T E R C E R A</u>: (DE LA VIGENCIA). - </strong>El presente Contrato tendr&aacute; una vigencia a partir del '.date("d-m-Y", strtotime($this->inicio_contrato)).' hasta el '.date("d-m-Y", strtotime($this->fin_contrato)).', indefectiblemente o mientras dure la emergencia sanitaria Decretada por el Gobierno Nacional determinados en el Art. 28 inc. I) II) de la Secci&oacute;n III. Medidas en Contrataciones de la Ley 1359 de Emergencia Sanitaria de 17-02-2021.</p><p style="text-align:justify">Por sus caracter&iacute;sticas de eventualidad, y a fin de prevenir la t&aacute;cita reconducci&oacute;n del presente Contrato, se deja claramente establecido la prohibici&oacute;n de que el <strong>CONTRATADO(A) </strong>contin&uacute;e prestando servicios una vez concluida la fecha de vigencia prevista en la presente cl&aacute;usula; exceptu&aacute;ndose los casos en los que el <strong>CONTRATADO(A) </strong>posea autorizaci&oacute;n expresa y escrita de autoridad competente, para el efecto.</p><p style="text-align:justify"><strong><u>C U A R T A</u>: (DE LAS CONDICIONES). - </strong>Con la finalidad de evitar responsabilidades contempladas en normas de actual vigencia (Ley General del Trabajo, Decreto Ley 16187 de 16-02-1979, Resolucion del Honorable Directorio N&ordm; 095/2015 y partida presupuestaria 12100 - Gesti&oacute;n 2021, no podr&aacute; suscribirse <strong>TERCER CONTRATO EVENTUAL</strong>, ya que implicar&iacute;a la adquisici&oacute;n de derechos laborales. </p><p style="text-align:justify">Asimismo, en funci&oacute;n a la naturaleza del presente contrato, se deja claramente establecido que no se aplicar&aacute; la inamovilidad laboral de la madre o padre progenitores, reglamentado por el D.S. N&ordm; 0012 de 19 de febrero de 2009.</p><p style="text-align:justify"><strong><u>Q U I N T A</u>: (DEL SALARIO). - </strong>De acuerdo a Resolucion de Directorio No 095/2019 de fecha 04-07-2019 en la cual aprueba la nueva Escala salarial del Personal Eventual de la C.N.S., expresada en el cuadro de equivalencia, considerando la Escala Salarial Gesti&oacute;n 2019, aprobada con Resoluci&oacute;n Ministerial N&ordm; 443 de fecha 22-05-2019 del Ministerio de Econom&iacute;a y Finanzas P&uacute;blicas, Par. II Art. 48 de la Constituci&oacute;n Pol&iacute;tica del Estado, el salario que percibir&aacute; el <strong>CONTRATADO(A) </strong>est&aacute; sujeto a la previsi&oacute;n presupuestaria establecida; correspondiendo a <strong>Bs. '.number_format($cargo['haber_basico'], 2, ",", ".").' ('.$haber_literal.') </strong>mensuales, conforme al nivel y cargo para el que fue contratado, pago que contempla todos los beneficios colaterales, seg&uacute;n presupuesto. </p><p style="text-align:justify">Mensualmente, <strong>LA CAJA </strong>actuar&aacute; como agente de retenci&oacute;n de los descuentos establecidos por ley sobre el total ganado.</p><p style="text-align:justify"><strong><u>S E X T A</u>: (DE LA JORNADA DE TRABAJO). - </strong>El <strong>CONTRATADO(A) </strong>desempe&ntilde;ara funciones en una Jornada laboral de <strong>'.$cargo['hrs_semanales'].' horas semanales</strong> o de acuerdo a requerimiento institucional, pudiendo <strong>LA CAJA </strong>durante ese tiempo efectivo de trabajo disponer que el <strong>CONTRATADO(A) </strong>preste sus servicios en el lugar que se requiera, acatando para ello todas aquellas funciones en horarios definidos y trabajos que le sean encomendados de acuerdo a necesidades de servicio.</p><p style="text-align:justify"><strong><u>S E P T I M A</u>: (OBLIGACION DEL CONTRATADO). -</strong> Se obliga a prestar sus servicios con eficiencia, eficacia, excelencia, idoneidad, capacidad y responsabilidad en beneficio de la Instituci&oacute;n, respetando instancias superiores, conducto regular y organizaci&oacute;n Institucional.</p><p style="text-align:justify">El <strong>CONTRATADO(A) </strong>declara expresamente que conoce la labor a desempe&ntilde;ar y que es apto para ello, oblig&aacute;ndose a comunicar a su jefe inmediato superior, cualquier situaci&oacute;n especial, irregular o anormal que se presente en el desarrollo sus actividades y que perjudique o pueda ir en desmedro a la Instituci&oacute;n.</p><p style="text-align:justify">Asimismo, El <strong>CONTRATADO(A)</strong> a momento del cese de funciones deber&aacute; proceder a la devoluci&oacute;n de todos los activos que le fueron entregados, as&iacute;&nbsp;como de dejar en orden y al d&iacute;a el trabajo que le fuere entregado, hasta el &uacute;ltimo d&iacute;a que figura en el contrato.</p><p style="text-align:justify"><strong><u>O C T A V A</u>: (DE LA AUTORIZACI&Oacute;N DE VIAJES). - </strong>El trabajador(a) podr&aacute; realizar viajes oficiales al interior del Pa&iacute;s, previa Autorizaci&oacute;n de Autoridades Ejecutivas de la C.N.S., debiendo la Instituci&oacute;n asignarle los pasajes y vi&aacute;ticos, seg&uacute;n lo establecido en el D.S. N&ordm; 1788 de 07-11-2013 y Normativa Institucional Vigente. </p><p style="text-align:justify"><strong><u>N O V E N A</u>: (DE LA NORMATIVA LEGAL). &ndash; </strong>Tanto <strong>LA CAJA </strong>como el <strong>CONTRATADO(A) </strong>se sujetar&aacute;n a disposiciones vigentes establecidas en Ley General del Trabajo, C&oacute;digo de Seguridad Social, Ley N&deg; 1178, Reglamento de la Responsabilidad por la Funci&oacute;n P&uacute;blica aprobado mediante Decreto Supremo N&ordm; 23318-A y Decreto Supremo N&deg; 26237, Estatuto Org&aacute;nico de la Caja Nacional de Salud, Reglamento Interno de Trabajo de la Caja Nacional de Salud y dem&aacute;s normativa institucional.</p><p style="text-align:justify">Asimismo, forma parte integrante del presente contrato el Acta Notarial de Declaraci&oacute;n de Compatibilidad Funcionaria, Formulario Descriptivo de Parentesco y Normas Legales Aplicables suscrito por el <strong>CONTRATADO(A) </strong>aprobado mediante Resoluci&oacute;n de Directorio N&ordm; 027/2012 de 09-02-2012.</p><p style="text-align:justify"><strong><u>D E C I M A</u>: (DE LA RESCISI&Oacute;N DEL CONTRATO). - </strong>El presente contrato ser&aacute; rescindido por las causales se&ntilde;aladas en el Art. 16 de la Ley General del Trabajo, Incs. a) perjuicio material causado con intenci&oacute;n en los instrumentos de trabajo; b) Revelaci&oacute;n de secretos industriales; c) Omisiones o imprudencias que afecten a la seguridad o higiene industrial; e) Incumplimiento total o parcial del convenio; g) Robo o hurto por el trabajador, Art. 9 de su Decreto Reglamentario de la Ley General del Trabajo Incs. a) Perjuicio material causado con intenci&oacute;n en las maquinas, productos o mercader&iacute;as;; b) Revelaci&oacute;n de secretos industriales; c) Omisiones e imprudencias que afecten a la higiene y seguridad industrial; e) Incumplimiento total o parcial del contrato de trabajo <u>o del reglamento interno de la empresa</u>; g) Abuso de confianza, robo, hurto por el trabajador; h) Vias de hecho, injurias o conducta inmoral del trabajador, i) Abandono en masa del trabajo, siempre que los trabajadores no obedecieran a la intimidaci&oacute;n de la autoridad competente, Ley N&ordm; 1178, y sus Decretos Reglamentarios, Ley N&ordm; 004, causales descritas en el Art. 81 y 86 del Reglamento Interno de Trabajo de la Caja Nacional de Salud, y <strong>en caso de evaluaci&oacute;n negativa o insatisfactoria</strong>.</p><p style="text-align:justify">Adem&aacute;s, de las causales descritas por renuncia, para cuyo efecto el <strong>CONTRATADO(A) </strong>deber&aacute; comunicar su intenci&oacute;n a <strong>LA CAJA </strong>con treinta (30) d&iacute;as de anticipaci&oacute;n, a efectos de determinarse Aceptaci&oacute;n por Administracion Regional de la Caja Nacional de Salud, teniendo la obligaci&oacute;n de entregar el trabajo que tuviera pendiente a satisfacci&oacute;n, los activos fijos, de conformidad al Art. 32 del D.S. 26115 de 16 de mayo de 2001.</p><p style="text-align:justify"><strong><u>U N D E C I M A</u>: (DE LA CONFORMIDAD). &ndash; La Caja Nacional de Salud </strong>representada por  el/la <strong>'.$admin_regional['nombre_autoridad'].'</strong> Administrador(a) Regional a. i., as&iacute; como el/la Sr(a). <strong>'.$persona['nombre_persona'].' '.$persona['paterno_persona'].' '.$persona['materno_persona'].'</strong>, damos nuestra conformidad con todas y cada una de las cl&aacute;usulas que anteceden en el presente Contrato, oblig&aacute;ndonos a su fiel cumplimiento, firmando en se&ntilde;al de conformidad en cinco ejemplares del mismo tenor.</p><p style="text-align:right">Potos&iacute;, xx de xxxxxx del 202x</p><p style="text-align:right">&nbsp;</p><p style="text-align:right">&nbsp;</p><p style="text-align:right">&nbsp;</p><div><table border="0" cellpadding="1" cellspacing="1" style="margin:auto; width:650px"><tbody><tr><td style="text-align:center">'.$jefe_contabilidad['nombre_autoridad'].'<br /><strong>'.$jefe_contabilidad['puesto'].'</strong></td><td style="text-align:center">'.$jefe_medico['nombre_autoridad'].'<br /><strong>'.$jefe_medico['puesto'].'</strong></td></tr><tr><td colspan="2" style="text-align:center"><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>'.$admin_regional['nombre_autoridad'].'<br /><strong>'.$admin_regional['puesto'].'</strong></td></tr></tbody></table></div>';

				}
				
			} else {

				$suplencia = $this->id_suplencia;

				// TRAEMOS DATOS DE SUPLENCIA
				$item = "id_suplencia";

				$datos_suplencia = ControladorSuplencias::ctrMostrarSuplencias($item, $suplencia);



				$documento_contrato = '<h1 style="text-align:center"><strong>MEMORANDUM NO. JRH-MED-016-21</strong></h1><p><strong>DE:&nbsp;</strong> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;JEFATURA DE PERSONAL REGIONAL</p><p><strong>A:</strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; DR. '.$persona["nombre_persona"].' '.$persona["paterno_persona"].' '.$persona["materno_persona"].'</p><p><strong>REF.:&nbsp;</strong> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SUPLENCIA ('.$datos_suplencia["tipo_suplencia"].')</p><p><strong>FECHA:&nbsp; &nbsp;</strong> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; POTOSI, 6 de marzo de 2021</p><hr /><p>&nbsp;</p><p>Doctor(a):</p><p>En cumplimiento a Instrucciones de Administraci&oacute;n Regional y de acuerdo a solicitud de la DIRECCION DE HOSPITAL OBRERO N&deg; 5 con CITE DHO-CT-66-21 ('.$datos_suplencia["tipo_suplencia"].') usted deber&aacute; cumplir SUPLENCIA ('.$datos_suplencia["tipo_suplencia"].') de DR. JOSE LUIS MARTINEZ MARQUEZ a partir del '.date("d-m-Y", strtotime($this->inicio_contrato)).' al '.date("d-m-Y", strtotime($this->fin_contrato)).' en el horario de 09:00 a 12:00 y 14:00 a 17:00 con un sueldo de '.number_format($cargo['haber_basico'], 2, ",", ".").' Bs. Con todas las obligaciones y responsabilidades inherentes al cargo</p><p>Con este motivo, saludamos a usted atentamente.</p><p style="text-align:right">&nbsp;</p><p style="text-align:right">&nbsp;</p><p style="text-align:right">&nbsp;</p><div><table border="0" cellpadding="1" cellspacing="1" style="margin:auto; width:650px"><tbody><tr><td style="text-align:center">'.$supervisor_admin["nombre_autoridad"].'<br /><strong>'.$supervisor_admin["puesto"].'</strong></td><td style="text-align:center">'.$jefe_medico["nombre_autoridad"].'<br /><strong>'.$jefe_medico["puesto"].'</strong></td></tr><tr><td colspan="2" style="text-align:center"><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>'.$admin_regional["nombre_autoridad"].'<br /><strong>'.$admin_regional["puesto"].'</strong></td></tr></tbody></table></div>';

			}	

			$datos = array(	"id_lugar" 	 			 => $this->id_lugar,
							"id_establecimiento" 	 => $this->id_establecimiento,							
					        "id_persona"     		 => $this->id_persona,
					        "id_cargo"   	       	 => $this->id_cargo,
					        "inicio_contrato"  		 => $this->inicio_contrato,
					        "dias_contrato"			 => $this->dias_contrato,
					        "fin_contrato"           => $this->fin_contrato,
					        "id_contrato"   	     => $this->id_contrato,
					        "id_suplencia"   	     => $suplencia,
					        "estado_contrato"		 => 0,
					        "observaciones_contrato" => rtrim(mb_strtoupper($this->observaciones_contrato,'utf-8')),
					        "documento_contrato" 	 => $documento_contrato,
					        "nro_cod_contrato"   	 => $codigo,
					        "cod_contrato"   	     => $cod_contrato
			);	


			$respuesta = ControladorPersonaContratos::ctrNuevoPersonaContrato($datos);

			echo $respuesta;

		} else {

			$respuesta = $cantidad_persona_contrato["numero_filas"];

			echo $respuesta;

		}
		

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

		// TRAEMOS DATOS DE ESTABLECIMIENTO
		$item = "id_establecimiento";
		$valor = $this->id_establecimiento;

		$establecimiento = ControladorEstablecimientos::ctrMostrarEstablecimientos($item, $valor);

		/*=============================================
	   	TRAEMOS LOS DATOS DE AUTORIDADES
	    =============================================*/

		// TRAEMOS DATOS DE AUTORIDADES-ADMINISTRADOR REGIONAL
		$item = "puesto";
		$valor = "ADMINISTRADOR(A) REGIONAL C.N.S.";

		$admin_regional = ControladorAutoridades::ctrMostrarAutoridades($item, $valor);

		// TRAEMOS DATOS DE AUTORIDADES-JEFE MEDICO
		$item = "puesto";
		$valor = "JEFE MEDICO REGIONAL";

		$jefe_medico = ControladorAutoridades::ctrMostrarAutoridades($item, $valor);

		// TRAEMOS DATOS DE AUTORIDADES-SUPERVISOR ADMINISTRATIVO
		$item = "puesto";
		$valor = "SUPERVISOR ADM. | RR.HH.";

		$supervisor_admin = ControladorAutoridades::ctrMostrarAutoridades($item, $valor);

		// TRAEMOS DATOS DE AUTORIDADES-JEFE DE CONTABILIDAD REGIONAL
		$item = "puesto";
		$valor = "JEFE CONTABILIDAD REG.";

		$jefe_contabilidad = ControladorAutoridades::ctrMostrarAutoridades($item, $valor);

		// OPTENEMOS EL ULTIMO CODIGO DE CONTRATO DE ACUERDO AL TIPO DE CONTRATO Y CARGO

		$item1 = "codigo";
		$cog_contrato = $contrato['codigo'];

		$item2 = "grupo_cargo";
		$grupo_cargo = $cargo['grupo_cargo'];

		$ultimo_cod_contrato = ControladorPersonaContratos::ctrUltimoCodigoContrato($item1, $cog_contrato, $item2, $grupo_cargo);

		if ($ultimo_cod_contrato == null) {

			$codigo = 1;
			
			$cod_contrato = "JRH-".$contrato['codigo']."-".$cargo['grupo_cargo']."-1";

		} else {

			$codigo = $ultimo_cod_contrato['nro_cod_contrato'] + 1;

			$cod_contrato = "JRH-".$contrato['codigo']."-".$cargo['grupo_cargo']."-".$codigo;

		}

		// SI TIPO DE CONTRATO ES SUPLENCIA SE GUARDA EL TIPO DE SUPLENCIA 
		if ($this->id_contrato != 1) {

			$suplencia = 5;

			$haber_literal = FuncionesAuxiliares::convertir($cargo['haber_basico']);

			if ($this->id_contrato == 2) {

				$documento_contrato = '<p style="text-align:right"><strong>MAT: '.$persona['matricula_persona'].'</strong></p><p style="text-align:justify">Conste por el presente Contrato de Trabajo a Plazo Fijo, suscrito entre la <strong>CAJA NACIONAL DE SALUD</strong>, y el/la Sr(a). <strong>'.$persona['nombre_persona'].' '.$persona['paterno_persona'].' '.$persona['materno_persona'].'</strong>, sujet&aacute;ndose al tenor de las siguientes cl&aacute;usulas:</p><p style="text-align:justify"><strong><u>P R I M E R A</u>: (DE LAS PARTES). - </strong>Intervienen en la suscripci&oacute;n del presente Contrato, por una parte, el/la <strong>'.$admin_regional['nombre_autoridad'].'</strong>, en su condici&oacute;n de Administrador(a) Regional a. i. de la Caja Nacional de Salud, nombrado mediante Testimonio No. <strong>284/2021</strong> de fecha <strong>14-09-2021</strong>, quien en adelante se denominar&aacute;n <strong>LA CAJA;</strong> y por la otra, el/la <strong>Sr(a). '.$persona['nombre_persona'].' '.$persona['paterno_persona'].' '.$persona['materno_persona'].'</strong>, quien es mayor de edad, h&aacute;bil por derecho, con C.I. <strong>N&ordm; '.$persona['ci_persona'].'</strong>, expedida en <strong>'.$persona['ext_ci_persona'].'</strong>, estado civil <strong>soltero(a)</strong>, domiciliado(a) en la <strong>'.$persona['direccion_persona'].'</strong>, Cel <strong>'.$persona['telefono_persona'].'</strong>, que en adelante se denominar&aacute; <strong>EL CONTRATADO(A).</strong></p><p style="text-align:justify"><strong><u>S E G U N D A</u>: (DEL OBJETO). - </strong>El presente contrato a Plazo Fijo tiene por objeto la prestaci&oacute;n de servicios del <strong>CONTRATADO(A)</strong> por Necesidad de Servicios, en <strong>'.$establecimiento['nombre_establecimiento'].'</strong> o en el <strong>Centro Establecimiento donde se requiera de sus servicios</strong>, como <strong>'.$cargo['nombre_cargo'].'</strong> Nivel <strong>('.$cargo['nivel_salarial'].')</strong>, con cargo a la partida No 12100 (Personal Eventual) del Programa 72 (Bienes y Servicios), en cumplimiento a Resoluci&oacute;n Ministerial ....... y Memor&aacute;ndum Instructivo N&ordm; 8299 de fecha 24-12-2019 de la Gerencia General.</p><p style="text-align:justify"><strong><u>T E R C E R A</u>: (DE LA VIGENCIA). - </strong>El presente Contrato tendr&aacute; una vigencia a partir del '.date("d-m-Y", strtotime($this->inicio_contrato)).' hasta el '.date("d-m-Y", strtotime($this->fin_contrato)).', indefectiblemente.</p><p style="text-align:justify">Por sus caracter&iacute;sticas de eventualidad, y a fin de prevenir la t&aacute;cita reconducci&oacute;n del presente Contrato, se deja claramente establecido la prohibici&oacute;n de que el <strong>CONTRATADO(A) </strong>contin&uacute;e prestando servicios una vez concluida la fecha de vigencia prevista en la presente cl&aacute;usula; exceptu&aacute;ndose los casos en los que el <strong>CONTRATADO(A) </strong>posea autorizaci&oacute;n expresa y escrita de autoridad competente, para el efecto.</p><p style="text-align:justify"><strong><u>C U A R T A</u>: (DE LAS CONDICIONES). - </strong>Con la finalidad de evitar responsabilidades contempladas en normas de actual vigencia (Ley General del Trabajo, Decreto Ley 16187 de 16-02-1979, Resolucion del Honorable Directorio N&ordm; 095/2015 y partida presupuestaria 12100 - Gesti&oacute;n 2021, no podr&aacute; suscribirse <strong>TERCER CONTRATO EVENTUAL</strong>, ya que implicar&iacute;a la adquisici&oacute;n de derechos laborales. </p><p style="text-align:justify">Asimismo, en funci&oacute;n a la naturaleza del presente contrato, se deja claramente establecido que no se aplicar&aacute; la inamovilidad laboral de la madre o padre progenitores, reglamentado por el D.S. N&ordm; 0012 de 19 de febrero de 2009.</p><p style="text-align:justify"><strong><u>Q U I N T A</u>: (DEL SALARIO). - </strong>De acuerdo a Resolucion de Directorio No 095/2019 de fecha 04-07-2019 en la cual aprueba la nueva Escala salarial del Personal Eventual de la C.N.S., expresada en el cuadro de equivalencia, considerando la Escala Salarial Gesti&oacute;n 2019, aprobada con Resoluci&oacute;n Ministerial N&ordm; 443 de fecha 22-05-2019 del Ministerio de Econom&iacute;a y Finanzas P&uacute;blicas, Par. II Art. 48 de la Constituci&oacute;n Pol&iacute;tica del Estado, el salario que percibir&aacute; el <strong>CONTRATADO(A) </strong>est&aacute; sujeto a la previsi&oacute;n presupuestaria establecida; correspondiendo a <strong>Bs. '.number_format($cargo['haber_basico'], 2, ",", ".").' ('.$haber_literal.') </strong>mensuales, conforme al nivel y cargo para el que fue contratado, pago que contempla todos los beneficios colaterales, seg&uacute;n presupuesto. </p><p style="text-align:justify">Mensualmente, <strong>LA CAJA </strong>actuar&aacute; como agente de retenci&oacute;n de los descuentos establecidos por ley sobre el total ganado.</p><p style="text-align:justify"><strong><u>S E X T A</u>: (DE LA JORNADA DE TRABAJO). - </strong>El <strong>CONTRATADO(A) </strong>desempe&ntilde;ara funciones en una Jornada laboral de <strong>'.$cargo['hrs_semanales'].' horas semanales</strong> o de acuerdo a requerimiento institucional, pudiendo <strong>LA CAJA </strong>durante ese tiempo efectivo de trabajo disponer que el <strong>CONTRATADO(A) </strong>preste sus servicios en el lugar que se requiera, acatando para ello todas aquellas funciones en horarios definidos y trabajos que le sean encomendados de acuerdo a necesidades de servicio.</p><p style="text-align:justify"><strong><u>S E P T I M A</u>: (OBLIGACION DEL CONTRATADO). -</strong> Se obliga a prestar sus servicios con eficiencia, eficacia, excelencia, idoneidad, capacidad y responsabilidad en beneficio de la Instituci&oacute;n, respetando instancias superiores, conducto regular y organizaci&oacute;n Institucional.</p><p style="text-align:justify">El <strong>CONTRATADO(A) </strong>declara expresamente que conoce la labor a desempe&ntilde;ar y que es apto para ello, oblig&aacute;ndose a comunicar a su jefe inmediato superior, cualquier situaci&oacute;n especial, irregular o anormal que se presente en el desarrollo sus actividades y que perjudique o pueda ir en desmedro a la Instituci&oacute;n.</p><p style="text-align:justify">Asimismo, El <strong>CONTRATADO(A)</strong> a momento del cese de funciones deber&aacute; proceder a la devoluci&oacute;n de todos los activos que le fueron entregados, as&iacute;&nbsp;como de dejar en orden y al d&iacute;a el trabajo que le fuere entregado, hasta el &uacute;ltimo d&iacute;a que figura en el contrato.</p><p style="text-align:justify"><strong><u>O C T A V A</u>: (DE LA AUTORIZACI&Oacute;N DE VIAJES). - </strong>El trabajador(a) podr&aacute; realizar viajes oficiales al interior del Pa&iacute;s, previa Autorizaci&oacute;n de Autoridades Ejecutivas de la C.N.S., debiendo la Instituci&oacute;n asignarle los pasajes y vi&aacute;ticos, seg&uacute;n lo establecido en el D.S. N&ordm; 1788 de 07-11-2013 y Normativa Institucional Vigente. </p><p style="text-align:justify"><strong><u>N O V E N A</u>: (DE LA NORMATIVA LEGAL). &ndash; </strong>Tanto <strong>LA CAJA </strong>como el <strong>CONTRATADO(A) </strong>se sujetar&aacute;n a disposiciones vigentes establecidas en Ley General del Trabajo, C&oacute;digo de Seguridad Social, Ley N&deg; 1178, Reglamento de la Responsabilidad por la Funci&oacute;n P&uacute;blica aprobado mediante Decreto Supremo N&ordm; 23318-A y Decreto Supremo N&deg; 26237, Estatuto Org&aacute;nico de la Caja Nacional de Salud, Reglamento Interno de Trabajo de la Caja Nacional de Salud y dem&aacute;s normativa institucional.</p><p style="text-align:justify">Asimismo, forma parte integrante del presente contrato el Acta Notarial de Declaraci&oacute;n de Compatibilidad Funcionaria, Formulario Descriptivo de Parentesco y Normas Legales Aplicables suscrito por el <strong>CONTRATADO(A) </strong>aprobado mediante Resoluci&oacute;n de Directorio N&ordm; 027/2012 de 09-02-2012.</p><p style="text-align:justify"><strong><u>D E C I M A</u>: (DE LA RESCISI&Oacute;N DEL CONTRATO). - </strong>El presente contrato ser&aacute; rescindido por las causales se&ntilde;aladas en el Art. 16 de la Ley General del Trabajo, Incs. a) perjuicio material causado con intenci&oacute;n en los instrumentos de trabajo; b) Revelaci&oacute;n de secretos industriales; c) Omisiones o imprudencias que afecten a la seguridad o higiene industrial; e) Incumplimiento total o parcial del convenio; g) Robo o hurto por el trabajador, Art. 9 de su Decreto Reglamentario de la Ley General del Trabajo Incs. a) Perjuicio material causado con intenci&oacute;n en las maquinas, productos o mercader&iacute;as;; b) Revelaci&oacute;n de secretos industriales; c) Omisiones e imprudencias que afecten a la higiene y seguridad industrial; e) Incumplimiento total o parcial del contrato de trabajo <u>o del reglamento interno de la empresa</u>; g) Abuso de confianza, robo, hurto por el trabajador; h) Vias de hecho, injurias o conducta inmoral del trabajador, i) Abandono en masa del trabajo, siempre que los trabajadores no obedecieran a la intimidaci&oacute;n de la autoridad competente, Ley N&ordm; 1178, y sus Decretos Reglamentarios, Ley N&ordm; 004, causales descritas en el Art. 81 y 86 del Reglamento Interno de Trabajo de la Caja Nacional de Salud, y <strong>en caso de evaluaci&oacute;n negativa o insatisfactoria</strong>.</p><p style="text-align:justify">Adem&aacute;s, de las causales descritas por renuncia, para cuyo efecto el <strong>CONTRATADO(A) </strong>deber&aacute; comunicar su intenci&oacute;n a <strong>LA CAJA </strong>con treinta (30) d&iacute;as de anticipaci&oacute;n, a efectos de determinarse Aceptaci&oacute;n por Administracion Regional de la Caja Nacional de Salud, teniendo la obligaci&oacute;n de entregar el trabajo que tuviera pendiente a satisfacci&oacute;n, los activos fijos, de conformidad al Art. 32 del D.S. 26115 de 16 de mayo de 2001.</p><p style="text-align:justify"><strong><u>U N D E C I M A</u>: (DE LA CONFORMIDAD). &ndash; La Caja Nacional de Salud </strong>representada por  el/la <strong>'.$admin_regional['nombre_autoridad'].'</strong> Administrador(a) Regional a. i., as&iacute; como el/la Sr(a). <strong>'.$persona['nombre_persona'].' '.$persona['paterno_persona'].' '.$persona['materno_persona'].'</strong>, damos nuestra conformidad con todas y cada una de las cl&aacute;usulas que anteceden en el presente Contrato, oblig&aacute;ndonos a su fiel cumplimiento, firmando en se&ntilde;al de conformidad en cinco ejemplares del mismo tenor.</p><p style="text-align:right">Potos&iacute;, xx de xxxxxx del 202x</p><p style="text-align:right">&nbsp;</p><p style="text-align:right">&nbsp;</p><p style="text-align:right">&nbsp;</p><div><table border="0" cellpadding="1" cellspacing="1" style="margin:auto; width:650px"><tbody><tr><td style="text-align:center">'.$jefe_contabilidad['nombre_autoridad'].'<br /><strong>'.$jefe_contabilidad['puesto'].'</strong></td><td style="text-align:center">'.$jefe_medico['nombre_autoridad'].'<br /><strong>'.$jefe_medico['puesto'].'</strong></td></tr><tr><td colspan="2" style="text-align:center"><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>'.$admin_regional['nombre_autoridad'].'<br /><strong>'.$admin_regional['puesto'].'</strong></td></tr></tbody></table></div>';

			} else {

				$documento_contrato = '<p style="text-align:right"><strong>MAT: '.$persona['matricula_persona'].'</strong></p><p style="text-align:justify">Conste por el presente Contrato de Trabajo a Plazo Fijo, suscrito entre la <strong>CAJA NACIONAL DE SALUD</strong>, y el/la Sr(a). <strong>'.$persona['nombre_persona'].' '.$persona['paterno_persona'].' '.$persona['materno_persona'].'</strong>, sujet&aacute;ndose al tenor de las siguientes cl&aacute;usulas:</p><p style="text-align:justify"><strong><u>P R I M E R A</u>: (DE LAS PARTES). - </strong>Intervienen en la suscripci&oacute;n del presente Contrato, por una parte, <strong>'.$admin_regional['nombre_autoridad'].'</strong>, en su condici&oacute;n de Administrador(a) Regional a. i. de la Caja Nacional de Salud, nombrado mediante Testimonio No. <strong>284/2021</strong> de fecha <strong>14-09-2021</strong>, quien en adelante se denominar&aacute;n <strong>LA CAJA;</strong> y por la otra, el/la <strong>Sr(a). '.$persona['nombre_persona'].' '.$persona['paterno_persona'].' '.$persona['materno_persona'].'</strong>, quien es mayor de edad, h&aacute;bil por derecho, con C.I. <strong>N&ordm; '.$persona['ci_persona'].'</strong>, expedida en <strong>'.$persona['ext_ci_persona'].'</strong>, estado civil <strong>soltero(a)</strong>, domiciliado(a) en la <strong>'.$persona['direccion_persona'].'</strong>, Cel <strong>'.$persona['telefono_persona'].'</strong>, que en adelante se denominar&aacute; <strong>EL CONTRATADO(A).</strong></p><p style="text-align:justify"><strong><u>S E G U N D A</u>: (DEL OBJETO). - </strong>El presente contrato a Plazo Fijo tiene por objeto la prestaci&oacute;n de servicios del <strong>CONTRATADO(A)</strong> por <strong>Necesidad de Servicios y Emergencia Sanitaria COVID-19</strong>, en <strong>'.$establecimiento['nombre_establecimiento'].'</strong> o en el <strong>Centro Establecimiento donde se requiera de sus servicios</strong>, como <strong>'.$cargo['nombre_cargo'].'</strong> Nivel <strong>('.$cargo['nivel_salarial'].')</strong>, con cargo a la partida No 12100 (Personal Eventual) del Programa 72 (Bienes y Servicios), en cumplimiento a Resoluci&oacute;n Ministerial ....... y Memor&aacute;ndum Instructivo N&ordm; 8299 de fecha 24-12-2019 de la Gerencia General.</p><p style="text-align:justify"><strong><u>T E R C E R A</u>: (DE LA VIGENCIA). - </strong>El presente Contrato tendr&aacute; una vigencia a partir del '.date("d-m-Y", strtotime($this->inicio_contrato)).' hasta el '.date("d-m-Y", strtotime($this->fin_contrato)).', indefectiblemente o mientras dure la emergencia sanitaria Decretada por el Gobierno Nacional determinados en el Art. 28 inc. I) II) de la Secci&oacute;n III. Medidas en Contrataciones de la Ley 1359 de Emergencia Sanitaria de 17-02-2021.</p><p style="text-align:justify">Por sus caracter&iacute;sticas de eventualidad, y a fin de prevenir la t&aacute;cita reconducci&oacute;n del presente Contrato, se deja claramente establecido la prohibici&oacute;n de que el <strong>CONTRATADO(A) </strong>contin&uacute;e prestando servicios una vez concluida la fecha de vigencia prevista en la presente cl&aacute;usula; exceptu&aacute;ndose los casos en los que el <strong>CONTRATADO(A) </strong>posea autorizaci&oacute;n expresa y escrita de autoridad competente, para el efecto.</p><p style="text-align:justify"><strong><u>C U A R T A</u>: (DE LAS CONDICIONES). - </strong>Con la finalidad de evitar responsabilidades contempladas en normas de actual vigencia (Ley General del Trabajo, Decreto Ley 16187 de 16-02-1979, Resolucion del Honorable Directorio N&ordm; 095/2015 y partida presupuestaria 12100 - Gesti&oacute;n 2021, no podr&aacute; suscribirse <strong>TERCER CONTRATO EVENTUAL</strong>, ya que implicar&iacute;a la adquisici&oacute;n de derechos laborales. </p><p style="text-align:justify">Asimismo, en funci&oacute;n a la naturaleza del presente contrato, se deja claramente establecido que no se aplicar&aacute; la inamovilidad laboral de la madre o padre progenitores, reglamentado por el D.S. N&ordm; 0012 de 19 de febrero de 2009.</p><p style="text-align:justify"><strong><u>Q U I N T A</u>: (DEL SALARIO). - </strong>De acuerdo a Resolucion de Directorio No 095/2019 de fecha 04-07-2019 en la cual aprueba la nueva Escala salarial del Personal Eventual de la C.N.S., expresada en el cuadro de equivalencia, considerando la Escala Salarial Gesti&oacute;n 2019, aprobada con Resoluci&oacute;n Ministerial N&ordm; 443 de fecha 22-05-2019 del Ministerio de Econom&iacute;a y Finanzas P&uacute;blicas, Par. II Art. 48 de la Constituci&oacute;n Pol&iacute;tica del Estado, el salario que percibir&aacute; el <strong>CONTRATADO(A) </strong>est&aacute; sujeto a la previsi&oacute;n presupuestaria establecida; correspondiendo a <strong>Bs. '.number_format($cargo['haber_basico'], 2, ",", ".").' ('.$haber_literal.') </strong>mensuales, conforme al nivel y cargo para el que fue contratado, pago que contempla todos los beneficios colaterales, seg&uacute;n presupuesto. </p><p style="text-align:justify">Mensualmente, <strong>LA CAJA </strong>actuar&aacute; como agente de retenci&oacute;n de los descuentos establecidos por ley sobre el total ganado.</p><p style="text-align:justify"><strong><u>S E X T A</u>: (DE LA JORNADA DE TRABAJO). - </strong>El <strong>CONTRATADO(A) </strong>desempe&ntilde;ara funciones en una Jornada laboral de <strong>'.$cargo['hrs_semanales'].' horas semanales</strong> o de acuerdo a requerimiento institucional, pudiendo <strong>LA CAJA </strong>durante ese tiempo efectivo de trabajo disponer que el <strong>CONTRATADO(A) </strong>preste sus servicios en el lugar que se requiera, acatando para ello todas aquellas funciones en horarios definidos y trabajos que le sean encomendados de acuerdo a necesidades de servicio.</p><p style="text-align:justify"><strong><u>S E P T I M A</u>: (OBLIGACION DEL CONTRATADO). -</strong> Se obliga a prestar sus servicios con eficiencia, eficacia, excelencia, idoneidad, capacidad y responsabilidad en beneficio de la Instituci&oacute;n, respetando instancias superiores, conducto regular y organizaci&oacute;n Institucional.</p><p style="text-align:justify">El <strong>CONTRATADO(A) </strong>declara expresamente que conoce la labor a desempe&ntilde;ar y que es apto para ello, oblig&aacute;ndose a comunicar a su jefe inmediato superior, cualquier situaci&oacute;n especial, irregular o anormal que se presente en el desarrollo sus actividades y que perjudique o pueda ir en desmedro a la Instituci&oacute;n.</p><p style="text-align:justify">Asimismo, El <strong>CONTRATADO(A)</strong> a momento del cese de funciones deber&aacute; proceder a la devoluci&oacute;n de todos los activos que le fueron entregados, as&iacute;&nbsp;como de dejar en orden y al d&iacute;a el trabajo que le fuere entregado, hasta el &uacute;ltimo d&iacute;a que figura en el contrato.</p><p style="text-align:justify"><strong><u>O C T A V A</u>: (DE LA AUTORIZACI&Oacute;N DE VIAJES). - </strong>El trabajador(a) podr&aacute; realizar viajes oficiales al interior del Pa&iacute;s, previa Autorizaci&oacute;n de Autoridades Ejecutivas de la C.N.S., debiendo la Instituci&oacute;n asignarle los pasajes y vi&aacute;ticos, seg&uacute;n lo establecido en el D.S. N&ordm; 1788 de 07-11-2013 y Normativa Institucional Vigente. </p><p style="text-align:justify"><strong><u>N O V E N A</u>: (DE LA NORMATIVA LEGAL). &ndash; </strong>Tanto <strong>LA CAJA </strong>como el <strong>CONTRATADO(A) </strong>se sujetar&aacute;n a disposiciones vigentes establecidas en Ley General del Trabajo, C&oacute;digo de Seguridad Social, Ley N&deg; 1178, Reglamento de la Responsabilidad por la Funci&oacute;n P&uacute;blica aprobado mediante Decreto Supremo N&ordm; 23318-A y Decreto Supremo N&deg; 26237, Estatuto Org&aacute;nico de la Caja Nacional de Salud, Reglamento Interno de Trabajo de la Caja Nacional de Salud y dem&aacute;s normativa institucional.</p><p style="text-align:justify">Asimismo, forma parte integrante del presente contrato el Acta Notarial de Declaraci&oacute;n de Compatibilidad Funcionaria, Formulario Descriptivo de Parentesco y Normas Legales Aplicables suscrito por el <strong>CONTRATADO(A) </strong>aprobado mediante Resoluci&oacute;n de Directorio N&ordm; 027/2012 de 09-02-2012.</p><p style="text-align:justify"><strong><u>D E C I M A</u>: (DE LA RESCISI&Oacute;N DEL CONTRATO). - </strong>El presente contrato ser&aacute; rescindido por las causales se&ntilde;aladas en el Art. 16 de la Ley General del Trabajo, Incs. a) perjuicio material causado con intenci&oacute;n en los instrumentos de trabajo; b) Revelaci&oacute;n de secretos industriales; c) Omisiones o imprudencias que afecten a la seguridad o higiene industrial; e) Incumplimiento total o parcial del convenio; g) Robo o hurto por el trabajador, Art. 9 de su Decreto Reglamentario de la Ley General del Trabajo Incs. a) Perjuicio material causado con intenci&oacute;n en las maquinas, productos o mercader&iacute;as;; b) Revelaci&oacute;n de secretos industriales; c) Omisiones e imprudencias que afecten a la higiene y seguridad industrial; e) Incumplimiento total o parcial del contrato de trabajo <u>o del reglamento interno de la empresa</u>; g) Abuso de confianza, robo, hurto por el trabajador; h) Vias de hecho, injurias o conducta inmoral del trabajador, i) Abandono en masa del trabajo, siempre que los trabajadores no obedecieran a la intimidaci&oacute;n de la autoridad competente, Ley N&ordm; 1178, y sus Decretos Reglamentarios, Ley N&ordm; 004, causales descritas en el Art. 81 y 86 del Reglamento Interno de Trabajo de la Caja Nacional de Salud, y <strong>en caso de evaluaci&oacute;n negativa o insatisfactoria</strong>.</p><p style="text-align:justify">Adem&aacute;s, de las causales descritas por renuncia, para cuyo efecto el <strong>CONTRATADO(A) </strong>deber&aacute; comunicar su intenci&oacute;n a <strong>LA CAJA </strong>con treinta (30) d&iacute;as de anticipaci&oacute;n, a efectos de determinarse Aceptaci&oacute;n por Administracion Regional de la Caja Nacional de Salud, teniendo la obligaci&oacute;n de entregar el trabajo que tuviera pendiente a satisfacci&oacute;n, los activos fijos, de conformidad al Art. 32 del D.S. 26115 de 16 de mayo de 2001.</p><p style="text-align:justify"><strong><u>U N D E C I M A</u>: (DE LA CONFORMIDAD). &ndash; La Caja Nacional de Salud </strong>representada por  el/la <strong>'.$admin_regional['nombre_autoridad'].'</strong> Administrador(a) Regional a. i., as&iacute; como el/la Sr(a). <strong>'.$persona['nombre_persona'].' '.$persona['paterno_persona'].' '.$persona['materno_persona'].'</strong>, damos nuestra conformidad con todas y cada una de las cl&aacute;usulas que anteceden en el presente Contrato, oblig&aacute;ndonos a su fiel cumplimiento, firmando en se&ntilde;al de conformidad en cinco ejemplares del mismo tenor.</p><p style="text-align:right">Potos&iacute;, xx de xxxxxx del 202x</p><p style="text-align:right">&nbsp;</p><p style="text-align:right">&nbsp;</p><p style="text-align:right">&nbsp;</p><div><table border="0" cellpadding="1" cellspacing="1" style="margin:auto; width:650px"><tbody><tr><td style="text-align:center">'.$jefe_contabilidad['nombre_autoridad'].'<br /><strong>'.$jefe_contabilidad['puesto'].'</strong></td><td style="text-align:center">'.$jefe_medico['nombre_autoridad'].'<br /><strong>'.$jefe_medico['puesto'].'</strong></td></tr><tr><td colspan="2" style="text-align:center"><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>'.$admin_regional['nombre_autoridad'].'<br /><strong>'.$admin_regional['puesto'].'</strong></td></tr></tbody></table></div>';

			}
			
		} else {

			$suplencia = $this->id_suplencia;

			// TRAEMOS DATOS DE SUPLENCIA
			$item = "id_suplencia";

			$datos_suplencia = ControladorSuplencias::ctrMostrarSuplencias($item, $suplencia);

			$documento_contrato = '<h1 style="text-align:center"><strong>MEMORANDUM NO. JRH-MED-016-21</strong></h1><p><strong>DE:&nbsp;</strong> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;JEFATURA DE PERSONAL REGIONAL</p><p><strong>A:</strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; DR. '.$persona["nombre_persona"].' '.$persona["paterno_persona"].' '.$persona["materno_persona"].'</p><p><strong>REF.:&nbsp;</strong> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SUPLENCIA ('.$datos_suplencia["tipo_suplencia"].')</p><p><strong>FECHA:&nbsp; &nbsp;</strong> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; POTOSI, 6 de marzo de 2021</p><hr /><p>&nbsp;</p><p>Doctor(a):</p><p>En cumplimiento a Instrucciones de Administraci&oacute;n Regional y de acuerdo a solicitud de la DIRECCION DE HOSPITAL OBRERO N&deg; 5 con CITE DHO-CT-66-21 ('.$datos_suplencia["tipo_suplencia"].') usted deber&aacute; cumplir SUPLENCIA ('.$datos_suplencia["tipo_suplencia"].') de DR. JOSE LUIS MARTINEZ MARQUEZ a partir del '.date("d-m-Y", strtotime($this->inicio_contrato)).' al '.date("d-m-Y", strtotime($this->fin_contrato)).' en el horario de 09:00 a 12:00 y 14:00 a 17:00 con un sueldo de '.number_format($cargo['haber_basico'], 2, ",", ".").' Bs. Con todas las obligaciones y responsabilidades inherentes al cargo</p><p>Con este motivo, saludamos a usted atentamente.</p><p style="text-align:right">&nbsp;</p><p style="text-align:right">&nbsp;</p><p style="text-align:right">&nbsp;</p><div><table border="0" cellpadding="1" cellspacing="1" style="margin:auto; width:650px"><tbody><tr><td style="text-align:center">'.$supervisor_admin["nombre_autoridad"].'<br /><strong>'.$supervisor_admin["puesto"].'</strong></td><td style="text-align:center">'.$jefe_medico["nombre_autoridad"].'<br /><strong>'.$jefe_medico["puesto"].'</strong></td></tr><tr><td colspan="2" style="text-align:center"><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>'.$admin_regional["nombre_autoridad"].'<br /><strong>'.$admin_regional["puesto"].'</strong></td></tr></tbody></table></div>';

		}	

		$datos = array( "id_lugar"				   => $this->id_lugar,
						"id_establecimiento"       => $this->id_establecimiento,
				        "id_persona"     		   => $this->id_persona,
				        "id_cargo"   	           => $this->id_cargo,
				        "inicio_contrato"          => $this->inicio_contrato,
				        "dias_contrato"			   => $this->dias_contrato,
				        "fin_contrato"   	       => $this->fin_contrato,
				        "id_contrato"   	       => $this->id_contrato,
				        "id_suplencia"   	       => $suplencia,
				        "observaciones_contrato"   => mb_strtoupper($this->observaciones_contrato,'utf-8'),
					    "documento_contrato" 	   => $documento_contrato,
					    "nro_cod_contrato"   	   => $codigo,
					    "cod_contrato"   	       => $cod_contrato,
					    "id_persona_contrato"      => $this->id_persona_contrato,
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
					   "documento_contrato"		=> $this->documento_contrato,
		);	

	  // var_dump($datos);

		$respuesta = ControladorPersonaContratos::ctrEditarDocumentoContrato($datos);

		echo $respuesta;

	}

	/*=============================================
	MOSTRAR EN PDF FICHA CONTROL Y SEGUIMIENTO
	=============================================*/

	public function ajaxMostrarDocumentoContratoPDF()	{

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
		$pdf->SetMargins(10, PDF_MARGIN_TOP, 10, 10);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// ocultando pie de pagina
		$pdf->SetPrintFooter(FALSE);

		// Envio codigo de contrato al encabezado
		$pdf->codContrato = $valor;

		// seleccion que encabezado se elije
		$pdf->headerContrato = false;


		// ---------------------------------------------------------

		// set font
		$pdf->SetFont('helvetica', '', 9);

		// add a page
		$pdf->AddPage();

		// // Estilos necesarios para el Codigo QR
		// $style = array(
		//     'border' => 0,
		//     'vpadding' => 'auto',
		//     'hpadding' => 'auto',
		//     'fgcolor' => array(0,0,0),
		//     'bgcolor' => false, //array(255,255,255)
		//     'module_width' => 1, // width of a single module in points
		//     'module_height' => 1 // height of a single module in points
		// );

		// // Datos a mostrar en el código QR
		// $codeContents = 'COD. CONTRATO: '.$this->id_persona_contrato."\n";

		// // insertando el código QR
		// $pdf->write2DBarcode($codeContents, 'QRCODE,L', 190, 5, 15, 15, $style, 'N');	

		$content = $respuesta['documento_contrato'];
			
		// Reconociendo la estructura HTML
		//$pdf->writeHTML($content, true, 0, true, true);
		$pdf->writeHTML($content, true, false, true, false, '');

		// Insertando el Logo
		// $image_file = K_PATH_IMAGES.'cns-logo-simple.png';

		// $pdf->Image($image_file, 8, 10, 13, '', 'PNG', '', 'T', false, 100, '', false, false, 0, false, false, false);

		$pdf->lastPage();

		$pdf->output('../temp/contrato-'.$valor.'.pdf', 'F');

	}

	public $file;

	/*=============================================
	ELIMINADO REPORTE TEMPORAL PDF GENERADO 
	=============================================*/

	public function ajaxEliminarReportePDF()	{
		
		$file = $this->file;

		unlink($file);

	}

	public $archivo_contrato;
	public $archivo_actual;

	/*=============================================
	GUARDAR EL ARCHIVO CONTRATO EN LA BASE DE DATOS
	=============================================*/

	public function ajaxGuardarArchivoContrato()	{

		$ruta = $this->archivo_actual;

		if (isset($this->archivo_contrato["tmp_name"]) && $this->archivo_contrato["tmp_name"] != "") {

			/*=============================================
			PRIMERO PREGUNTAMOS SI EXISTE OTRA ARCHIVO EN LA BD
			=============================================*/

			if (!empty($this->archivo_actual)) {

				unlink($this->archivo_actual);

			}

			if ($this->archivo_contrato["type"] == "application/pdf") {

				$aleatorio = mt_rand(100000,999999);

				$ruta = "../vistas/pdf/contratos/".$aleatorio.".pdf";

				move_uploaded_file($this->archivo_contrato["tmp_name"], $ruta);

			}

			$datos = array( "archivo_contrato"     	=> $ruta,
							"id_persona_contrato"   => $this->id_persona_contrato,
			);

			// var_dump($datos);	

			$respuesta = ControladorPersonaContratos::ctrGuardarArchivoContrato($datos);

			echo $respuesta;

		}

	}

	/*=============================================
	VALIDAR ARCHIVO CONTRATO
	=============================================*/

	public $estado_contrato;

	public function ajaxValidarArchivoContrato() {
		
		$tabla = "persona_contratos";

		$item1 = "estado_contrato";
		$valor1 = $this->estado_contrato;

		$item2 = "id_persona_contrato";
		$valor2 = $this->id_persona_contrato;

		$respuesta = ModeloPersonaContratos::mdlActualizarContratoPersona($tabla, $item1, $valor1, $item2, $valor2);

	}

	public $documento_ampliacion;
	public $documento_actual;

	/*=============================================
	AMPLIAR PERSONA CONTRATO
	=============================================*/

	public function ajaxAmpliarPersonaContrato() {

		$ruta = $this->documento_actual;

		if (isset($this->documento_ampliacion["tmp_name"]) && $this->documento_ampliacion["tmp_name"] != "") {

			/*=============================================
			PRIMERO PREGUNTAMOS SI EXISTE OTRA ARCHIVO EN LA BD
			=============================================*/

			if (!empty($this->documento_actual)) {

				unlink($this->documento_actual);

			}

			if ($this->documento_ampliacion["type"] == "application/pdf") {

				$aleatorio = mt_rand(100000,999999);

				$ruta = "../vistas/pdf/documento_ampliacion/".$aleatorio.".pdf";

				move_uploaded_file($this->documento_ampliacion["tmp_name"], $ruta);

			}

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

			// TRAEMOS DATOS DE ESTABLECIMIENTO
			$item = "id_establecimiento";
			$valor = $this->id_establecimiento;

			$establecimiento = ControladorEstablecimientos::ctrMostrarEstablecimientos($item, $valor);

			/*=============================================
		   	TRAEMOS LOS DATOS DE AUTORIDADES
		    =============================================*/

			// TRAEMOS DATOS DE AUTORIDADES-ADMINISTRADOR REGIONAL
			$item = "puesto";
			$valor = "ADMINISTRADOR(A) REGIONAL C.N.S.";

			$admin_regional = ControladorAutoridades::ctrMostrarAutoridades($item, $valor);

			// TRAEMOS DATOS DE AUTORIDADES-JEFE MEDICO
			$item = "puesto";
			$valor = "JEFE MEDICO REGIONAL";

			$jefe_medico = ControladorAutoridades::ctrMostrarAutoridades($item, $valor);

			// TRAEMOS DATOS DE AUTORIDADES-SUPERVISOR ADMINISTRATIVO
			$item = "puesto";
			$valor = "SUPERVISOR ADM. | RR.HH.";

			$supervisor_admin = ControladorAutoridades::ctrMostrarAutoridades($item, $valor);

			// TRAEMOS DATOS DE AUTORIDADES-JEFE DE CONTABILIDAD REGIONAL
			$item = "puesto";
			$valor = "JEFE CONTABILIDAD REG.";

			$jefe_contabilidad = ControladorAutoridades::ctrMostrarAutoridades($item, $valor);


			// SI TIPO DE CONTRATO ES SUPLENCIA SE GUARDA EL TIPO DE SUPLENCIA 
			if ($this->id_contrato != 1) {

				$suplencia = 5;

				$haber_literal = FuncionesAuxiliares::convertir($cargo['haber_basico']);

				if ($this->id_contrato == 2) {

					$documento_contrato = '<p style="text-align:right"><strong>MAT: '.$persona['matricula_persona'].'</strong></p><p style="text-align:justify">Conste por el presente Contrato de Trabajo a Plazo Fijo, suscrito entre la <strong>CAJA NACIONAL DE SALUD</strong>, y el/la Sr(a). <strong>'.$persona['nombre_persona'].' '.$persona['paterno_persona'].' '.$persona['materno_persona'].'</strong>, sujet&aacute;ndose al tenor de las siguientes cl&aacute;usulas:</p><p style="text-align:justify"><strong><u>P R I M E R A</u>: (DE LAS PARTES). - </strong>Intervienen en la suscripci&oacute;n del presente Contrato, por una parte, el/la <strong>'.$admin_regional['nombre_autoridad'].'</strong>, en su condici&oacute;n de Administrador(a) Regional a. i. de la Caja Nacional de Salud, nombrado mediante Testimonio No. <strong>284/2021</strong> de fecha <strong>14-09-2021</strong>, quien en adelante se denominar&aacute;n <strong>LA CAJA;</strong> y por la otra, el/la <strong>Sr(a). '.$persona['nombre_persona'].' '.$persona['paterno_persona'].' '.$persona['materno_persona'].'</strong>, quien es mayor de edad, h&aacute;bil por derecho, con C.I. <strong>N&ordm; '.$persona['ci_persona'].'</strong>, expedida en <strong>'.$persona['ext_ci_persona'].'</strong>, estado civil <strong>soltero(a)</strong>, domiciliado(a) en la <strong>'.$persona['direccion_persona'].'</strong>, Cel <strong>'.$persona['telefono_persona'].'</strong>, que en adelante se denominar&aacute; <strong>EL CONTRATADO(A).</strong></p><p style="text-align:justify"><strong><u>S E G U N D A</u>: (DEL OBJETO). - </strong>El presente contrato a Plazo Fijo tiene por objeto la prestaci&oacute;n de servicios del <strong>CONTRATADO(A)</strong> por Necesidad de Servicios, en <strong>'.$establecimiento['nombre_establecimiento'].'</strong> o en el <strong>Centro Establecimiento donde se requiera de sus servicios</strong>, como <strong>'.$cargo['nombre_cargo'].'</strong> Nivel <strong>('.$cargo['nivel_salarial'].')</strong>, con cargo a la partida No 12100 (Personal Eventual) del Programa 72 (Bienes y Servicios), en cumplimiento a Resoluci&oacute;n Ministerial ....... y Memor&aacute;ndum Instructivo N&ordm; 8299 de fecha 24-12-2019 de la Gerencia General.</p><p style="text-align:justify"><strong><u>T E R C E R A</u>: (DE LA VIGENCIA). - </strong>El presente Contrato tendr&aacute; una vigencia a partir del '.date("d-m-Y", strtotime($this->inicio_contrato)).' hasta el '.date("d-m-Y", strtotime($this->fin_contrato)).', indefectiblemente.</p><p style="text-align:justify">Por sus caracter&iacute;sticas de eventualidad, y a fin de prevenir la t&aacute;cita reconducci&oacute;n del presente Contrato, se deja claramente establecido la prohibici&oacute;n de que el <strong>CONTRATADO(A) </strong>contin&uacute;e prestando servicios una vez concluida la fecha de vigencia prevista en la presente cl&aacute;usula; exceptu&aacute;ndose los casos en los que el <strong>CONTRATADO(A) </strong>posea autorizaci&oacute;n expresa y escrita de autoridad competente, para el efecto.</p><p style="text-align:justify"><strong><u>C U A R T A</u>: (DE LAS CONDICIONES). - </strong>Con la finalidad de evitar responsabilidades contempladas en normas de actual vigencia (Ley General del Trabajo, Decreto Ley 16187 de 16-02-1979, Resolucion del Honorable Directorio N&ordm; 095/2015 y partida presupuestaria 12100 - Gesti&oacute;n 2021, no podr&aacute; suscribirse <strong>TERCER CONTRATO EVENTUAL</strong>, ya que implicar&iacute;a la adquisici&oacute;n de derechos laborales. </p><p style="text-align:justify">Asimismo, en funci&oacute;n a la naturaleza del presente contrato, se deja claramente establecido que no se aplicar&aacute; la inamovilidad laboral de la madre o padre progenitores, reglamentado por el D.S. N&ordm; 0012 de 19 de febrero de 2009.</p><p style="text-align:justify"><strong><u>Q U I N T A</u>: (DEL SALARIO). - </strong>De acuerdo a Resolucion de Directorio No 095/2019 de fecha 04-07-2019 en la cual aprueba la nueva Escala salarial del Personal Eventual de la C.N.S., expresada en el cuadro de equivalencia, considerando la Escala Salarial Gesti&oacute;n 2019, aprobada con Resoluci&oacute;n Ministerial N&ordm; 443 de fecha 22-05-2019 del Ministerio de Econom&iacute;a y Finanzas P&uacute;blicas, Par. II Art. 48 de la Constituci&oacute;n Pol&iacute;tica del Estado, el salario que percibir&aacute; el <strong>CONTRATADO(A) </strong>est&aacute; sujeto a la previsi&oacute;n presupuestaria establecida; correspondiendo a <strong>Bs. '.number_format($cargo['haber_basico'], 2, ",", ".").' ('.$haber_literal.') </strong>mensuales, conforme al nivel y cargo para el que fue contratado, pago que contempla todos los beneficios colaterales, seg&uacute;n presupuesto. </p><p style="text-align:justify">Mensualmente, <strong>LA CAJA </strong>actuar&aacute; como agente de retenci&oacute;n de los descuentos establecidos por ley sobre el total ganado.</p><p style="text-align:justify"><strong><u>S E X T A</u>: (DE LA JORNADA DE TRABAJO). - </strong>El <strong>CONTRATADO(A) </strong>desempe&ntilde;ara funciones en una Jornada laboral de <strong>'.$cargo['hrs_semanales'].' horas semanales</strong> o de acuerdo a requerimiento institucional, pudiendo <strong>LA CAJA </strong>durante ese tiempo efectivo de trabajo disponer que el <strong>CONTRATADO(A) </strong>preste sus servicios en el lugar que se requiera, acatando para ello todas aquellas funciones en horarios definidos y trabajos que le sean encomendados de acuerdo a necesidades de servicio.</p><p style="text-align:justify"><strong><u>S E P T I M A</u>: (OBLIGACION DEL CONTRATADO). -</strong> Se obliga a prestar sus servicios con eficiencia, eficacia, excelencia, idoneidad, capacidad y responsabilidad en beneficio de la Instituci&oacute;n, respetando instancias superiores, conducto regular y organizaci&oacute;n Institucional.</p><p style="text-align:justify">El <strong>CONTRATADO(A) </strong>declara expresamente que conoce la labor a desempe&ntilde;ar y que es apto para ello, oblig&aacute;ndose a comunicar a su jefe inmediato superior, cualquier situaci&oacute;n especial, irregular o anormal que se presente en el desarrollo sus actividades y que perjudique o pueda ir en desmedro a la Instituci&oacute;n.</p><p style="text-align:justify">Asimismo, El <strong>CONTRATADO(A)</strong> a momento del cese de funciones deber&aacute; proceder a la devoluci&oacute;n de todos los activos que le fueron entregados, as&iacute;&nbsp;como de dejar en orden y al d&iacute;a el trabajo que le fuere entregado, hasta el &uacute;ltimo d&iacute;a que figura en el contrato.</p><p style="text-align:justify"><strong><u>O C T A V A</u>: (DE LA AUTORIZACI&Oacute;N DE VIAJES). - </strong>El trabajador(a) podr&aacute; realizar viajes oficiales al interior del Pa&iacute;s, previa Autorizaci&oacute;n de Autoridades Ejecutivas de la C.N.S., debiendo la Instituci&oacute;n asignarle los pasajes y vi&aacute;ticos, seg&uacute;n lo establecido en el D.S. N&ordm; 1788 de 07-11-2013 y Normativa Institucional Vigente. </p><p style="text-align:justify"><strong><u>N O V E N A</u>: (DE LA NORMATIVA LEGAL). &ndash; </strong>Tanto <strong>LA CAJA </strong>como el <strong>CONTRATADO(A) </strong>se sujetar&aacute;n a disposiciones vigentes establecidas en Ley General del Trabajo, C&oacute;digo de Seguridad Social, Ley N&deg; 1178, Reglamento de la Responsabilidad por la Funci&oacute;n P&uacute;blica aprobado mediante Decreto Supremo N&ordm; 23318-A y Decreto Supremo N&deg; 26237, Estatuto Org&aacute;nico de la Caja Nacional de Salud, Reglamento Interno de Trabajo de la Caja Nacional de Salud y dem&aacute;s normativa institucional.</p><p style="text-align:justify">Asimismo, forma parte integrante del presente contrato el Acta Notarial de Declaraci&oacute;n de Compatibilidad Funcionaria, Formulario Descriptivo de Parentesco y Normas Legales Aplicables suscrito por el <strong>CONTRATADO(A) </strong>aprobado mediante Resoluci&oacute;n de Directorio N&ordm; 027/2012 de 09-02-2012.</p><p style="text-align:justify"><strong><u>D E C I M A</u>: (DE LA RESCISI&Oacute;N DEL CONTRATO). - </strong>El presente contrato ser&aacute; rescindido por las causales se&ntilde;aladas en el Art. 16 de la Ley General del Trabajo, Incs. a) perjuicio material causado con intenci&oacute;n en los instrumentos de trabajo; b) Revelaci&oacute;n de secretos industriales; c) Omisiones o imprudencias que afecten a la seguridad o higiene industrial; e) Incumplimiento total o parcial del convenio; g) Robo o hurto por el trabajador, Art. 9 de su Decreto Reglamentario de la Ley General del Trabajo Incs. a) Perjuicio material causado con intenci&oacute;n en las maquinas, productos o mercader&iacute;as;; b) Revelaci&oacute;n de secretos industriales; c) Omisiones e imprudencias que afecten a la higiene y seguridad industrial; e) Incumplimiento total o parcial del contrato de trabajo <u>o del reglamento interno de la empresa</u>; g) Abuso de confianza, robo, hurto por el trabajador; h) Vias de hecho, injurias o conducta inmoral del trabajador, i) Abandono en masa del trabajo, siempre que los trabajadores no obedecieran a la intimidaci&oacute;n de la autoridad competente, Ley N&ordm; 1178, y sus Decretos Reglamentarios, Ley N&ordm; 004, causales descritas en el Art. 81 y 86 del Reglamento Interno de Trabajo de la Caja Nacional de Salud, y <strong>en caso de evaluaci&oacute;n negativa o insatisfactoria</strong>.</p><p style="text-align:justify">Adem&aacute;s, de las causales descritas por renuncia, para cuyo efecto el <strong>CONTRATADO(A) </strong>deber&aacute; comunicar su intenci&oacute;n a <strong>LA CAJA </strong>con treinta (30) d&iacute;as de anticipaci&oacute;n, a efectos de determinarse Aceptaci&oacute;n por Administracion Regional de la Caja Nacional de Salud, teniendo la obligaci&oacute;n de entregar el trabajo que tuviera pendiente a satisfacci&oacute;n, los activos fijos, de conformidad al Art. 32 del D.S. 26115 de 16 de mayo de 2001.</p><p style="text-align:justify"><strong><u>U N D E C I M A</u>: (DE LA CONFORMIDAD). &ndash; La Caja Nacional de Salud </strong>representada por  el/la <strong>'.$admin_regional['nombre_autoridad'].'</strong> Administrador(a) Regional a. i., as&iacute; como el/la Sr(a). <strong>'.$persona['nombre_persona'].' '.$persona['paterno_persona'].' '.$persona['materno_persona'].'</strong>, damos nuestra conformidad con todas y cada una de las cl&aacute;usulas que anteceden en el presente Contrato, oblig&aacute;ndonos a su fiel cumplimiento, firmando en se&ntilde;al de conformidad en cinco ejemplares del mismo tenor.</p><p style="text-align:right">Potos&iacute;, xx de xxxxxx del 202x</p><p style="text-align:right">&nbsp;</p><p style="text-align:right">&nbsp;</p><p style="text-align:right">&nbsp;</p><div><table border="0" cellpadding="1" cellspacing="1" style="margin:auto; width:650px"><tbody><tr><td style="text-align:center">'.$jefe_contabilidad['nombre_autoridad'].'<br /><strong>'.$jefe_contabilidad['puesto'].'</strong></td><td style="text-align:center">'.$jefe_medico['nombre_autoridad'].'<br /><strong>'.$jefe_medico['puesto'].'</strong></td></tr><tr><td colspan="2" style="text-align:center"><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>'.$admin_regional['nombre_autoridad'].'<br /><strong>'.$admin_regional['puesto'].'</strong></td></tr></tbody></table></div>';

				} else {

					$documento_contrato = '<p style="text-align:right"><strong>MAT: '.$persona['matricula_persona'].'</strong></p><p style="text-align:justify">Conste por el presente Contrato de Trabajo a Plazo Fijo, suscrito entre la <strong>CAJA NACIONAL DE SALUD</strong>, y el/la Sr(a). <strong>'.$persona['nombre_persona'].' '.$persona['paterno_persona'].' '.$persona['materno_persona'].'</strong>, sujet&aacute;ndose al tenor de las siguientes cl&aacute;usulas:</p><p style="text-align:justify"><strong><u>P R I M E R A</u>: (DE LAS PARTES). - </strong>Intervienen en la suscripci&oacute;n del presente Contrato, por una parte, <strong>'.$admin_regional['nombre_autoridad'].'</strong>, en su condici&oacute;n de Administrador(a) Regional a. i. de la Caja Nacional de Salud, nombrado mediante Testimonio No. <strong>284/2021</strong> de fecha <strong>14-09-2021</strong>, quien en adelante se denominar&aacute;n <strong>LA CAJA;</strong> y por la otra, el/la <strong>Sr(a). '.$persona['nombre_persona'].' '.$persona['paterno_persona'].' '.$persona['materno_persona'].'</strong>, quien es mayor de edad, h&aacute;bil por derecho, con C.I. <strong>N&ordm; '.$persona['ci_persona'].'</strong>, expedida en <strong>'.$persona['ext_ci_persona'].'</strong>, estado civil <strong>soltero(a)</strong>, domiciliado(a) en la <strong>'.$persona['direccion_persona'].'</strong>, Cel <strong>'.$persona['telefono_persona'].'</strong>, que en adelante se denominar&aacute; <strong>EL CONTRATADO(A).</strong></p><p style="text-align:justify"><strong><u>S E G U N D A</u>: (DEL OBJETO). - </strong>El presente contrato a Plazo Fijo tiene por objeto la prestaci&oacute;n de servicios del <strong>CONTRATADO(A)</strong> por <strong>Necesidad de Servicios y Emergencia Sanitaria COVID-19</strong>, en <strong>'.$establecimiento['nombre_establecimiento'].'</strong> o en el <strong>Centro Establecimiento donde se requiera de sus servicios</strong>, como <strong>'.$cargo['nombre_cargo'].'</strong> Nivel <strong>('.$cargo['nivel_salarial'].')</strong>, con cargo a la partida No 12100 (Personal Eventual) del Programa 72 (Bienes y Servicios), en cumplimiento a Resoluci&oacute;n Ministerial ....... y Memor&aacute;ndum Instructivo N&ordm; 8299 de fecha 24-12-2019 de la Gerencia General.</p><p style="text-align:justify"><strong><u>T E R C E R A</u>: (DE LA VIGENCIA). - </strong>El presente Contrato tendr&aacute; una vigencia a partir del '.date("d-m-Y", strtotime($this->inicio_contrato)).' hasta el '.date("d-m-Y", strtotime($this->fin_contrato)).', indefectiblemente o mientras dure la emergencia sanitaria Decretada por el Gobierno Nacional determinados en el Art. 28 inc. I) II) de la Secci&oacute;n III. Medidas en Contrataciones de la Ley 1359 de Emergencia Sanitaria de 17-02-2021.</p><p style="text-align:justify">Por sus caracter&iacute;sticas de eventualidad, y a fin de prevenir la t&aacute;cita reconducci&oacute;n del presente Contrato, se deja claramente establecido la prohibici&oacute;n de que el <strong>CONTRATADO(A) </strong>contin&uacute;e prestando servicios una vez concluida la fecha de vigencia prevista en la presente cl&aacute;usula; exceptu&aacute;ndose los casos en los que el <strong>CONTRATADO(A) </strong>posea autorizaci&oacute;n expresa y escrita de autoridad competente, para el efecto.</p><p style="text-align:justify"><strong><u>C U A R T A</u>: (DE LAS CONDICIONES). - </strong>Con la finalidad de evitar responsabilidades contempladas en normas de actual vigencia (Ley General del Trabajo, Decreto Ley 16187 de 16-02-1979, Resolucion del Honorable Directorio N&ordm; 095/2015 y partida presupuestaria 12100 - Gesti&oacute;n 2021, no podr&aacute; suscribirse <strong>TERCER CONTRATO EVENTUAL</strong>, ya que implicar&iacute;a la adquisici&oacute;n de derechos laborales. </p><p style="text-align:justify">Asimismo, en funci&oacute;n a la naturaleza del presente contrato, se deja claramente establecido que no se aplicar&aacute; la inamovilidad laboral de la madre o padre progenitores, reglamentado por el D.S. N&ordm; 0012 de 19 de febrero de 2009.</p><p style="text-align:justify"><strong><u>Q U I N T A</u>: (DEL SALARIO). - </strong>De acuerdo a Resolucion de Directorio No 095/2019 de fecha 04-07-2019 en la cual aprueba la nueva Escala salarial del Personal Eventual de la C.N.S., expresada en el cuadro de equivalencia, considerando la Escala Salarial Gesti&oacute;n 2019, aprobada con Resoluci&oacute;n Ministerial N&ordm; 443 de fecha 22-05-2019 del Ministerio de Econom&iacute;a y Finanzas P&uacute;blicas, Par. II Art. 48 de la Constituci&oacute;n Pol&iacute;tica del Estado, el salario que percibir&aacute; el <strong>CONTRATADO(A) </strong>est&aacute; sujeto a la previsi&oacute;n presupuestaria establecida; correspondiendo a <strong>Bs. '.number_format($cargo['haber_basico'], 2, ",", ".").' ('.$haber_literal.') </strong>mensuales, conforme al nivel y cargo para el que fue contratado, pago que contempla todos los beneficios colaterales, seg&uacute;n presupuesto. </p><p style="text-align:justify">Mensualmente, <strong>LA CAJA </strong>actuar&aacute; como agente de retenci&oacute;n de los descuentos establecidos por ley sobre el total ganado.</p><p style="text-align:justify"><strong><u>S E X T A</u>: (DE LA JORNADA DE TRABAJO). - </strong>El <strong>CONTRATADO(A) </strong>desempe&ntilde;ara funciones en una Jornada laboral de <strong>'.$cargo['hrs_semanales'].' horas semanales</strong> o de acuerdo a requerimiento institucional, pudiendo <strong>LA CAJA </strong>durante ese tiempo efectivo de trabajo disponer que el <strong>CONTRATADO(A) </strong>preste sus servicios en el lugar que se requiera, acatando para ello todas aquellas funciones en horarios definidos y trabajos que le sean encomendados de acuerdo a necesidades de servicio.</p><p style="text-align:justify"><strong><u>S E P T I M A</u>: (OBLIGACION DEL CONTRATADO). -</strong> Se obliga a prestar sus servicios con eficiencia, eficacia, excelencia, idoneidad, capacidad y responsabilidad en beneficio de la Instituci&oacute;n, respetando instancias superiores, conducto regular y organizaci&oacute;n Institucional.</p><p style="text-align:justify">El <strong>CONTRATADO(A) </strong>declara expresamente que conoce la labor a desempe&ntilde;ar y que es apto para ello, oblig&aacute;ndose a comunicar a su jefe inmediato superior, cualquier situaci&oacute;n especial, irregular o anormal que se presente en el desarrollo sus actividades y que perjudique o pueda ir en desmedro a la Instituci&oacute;n.</p><p style="text-align:justify">Asimismo, El <strong>CONTRATADO(A)</strong> a momento del cese de funciones deber&aacute; proceder a la devoluci&oacute;n de todos los activos que le fueron entregados, as&iacute;&nbsp;como de dejar en orden y al d&iacute;a el trabajo que le fuere entregado, hasta el &uacute;ltimo d&iacute;a que figura en el contrato.</p><p style="text-align:justify"><strong><u>O C T A V A</u>: (DE LA AUTORIZACI&Oacute;N DE VIAJES). - </strong>El trabajador(a) podr&aacute; realizar viajes oficiales al interior del Pa&iacute;s, previa Autorizaci&oacute;n de Autoridades Ejecutivas de la C.N.S., debiendo la Instituci&oacute;n asignarle los pasajes y vi&aacute;ticos, seg&uacute;n lo establecido en el D.S. N&ordm; 1788 de 07-11-2013 y Normativa Institucional Vigente. </p><p style="text-align:justify"><strong><u>N O V E N A</u>: (DE LA NORMATIVA LEGAL). &ndash; </strong>Tanto <strong>LA CAJA </strong>como el <strong>CONTRATADO(A) </strong>se sujetar&aacute;n a disposiciones vigentes establecidas en Ley General del Trabajo, C&oacute;digo de Seguridad Social, Ley N&deg; 1178, Reglamento de la Responsabilidad por la Funci&oacute;n P&uacute;blica aprobado mediante Decreto Supremo N&ordm; 23318-A y Decreto Supremo N&deg; 26237, Estatuto Org&aacute;nico de la Caja Nacional de Salud, Reglamento Interno de Trabajo de la Caja Nacional de Salud y dem&aacute;s normativa institucional.</p><p style="text-align:justify">Asimismo, forma parte integrante del presente contrato el Acta Notarial de Declaraci&oacute;n de Compatibilidad Funcionaria, Formulario Descriptivo de Parentesco y Normas Legales Aplicables suscrito por el <strong>CONTRATADO(A) </strong>aprobado mediante Resoluci&oacute;n de Directorio N&ordm; 027/2012 de 09-02-2012.</p><p style="text-align:justify"><strong><u>D E C I M A</u>: (DE LA RESCISI&Oacute;N DEL CONTRATO). - </strong>El presente contrato ser&aacute; rescindido por las causales se&ntilde;aladas en el Art. 16 de la Ley General del Trabajo, Incs. a) perjuicio material causado con intenci&oacute;n en los instrumentos de trabajo; b) Revelaci&oacute;n de secretos industriales; c) Omisiones o imprudencias que afecten a la seguridad o higiene industrial; e) Incumplimiento total o parcial del convenio; g) Robo o hurto por el trabajador, Art. 9 de su Decreto Reglamentario de la Ley General del Trabajo Incs. a) Perjuicio material causado con intenci&oacute;n en las maquinas, productos o mercader&iacute;as;; b) Revelaci&oacute;n de secretos industriales; c) Omisiones e imprudencias que afecten a la higiene y seguridad industrial; e) Incumplimiento total o parcial del contrato de trabajo <u>o del reglamento interno de la empresa</u>; g) Abuso de confianza, robo, hurto por el trabajador; h) Vias de hecho, injurias o conducta inmoral del trabajador, i) Abandono en masa del trabajo, siempre que los trabajadores no obedecieran a la intimidaci&oacute;n de la autoridad competente, Ley N&ordm; 1178, y sus Decretos Reglamentarios, Ley N&ordm; 004, causales descritas en el Art. 81 y 86 del Reglamento Interno de Trabajo de la Caja Nacional de Salud, y <strong>en caso de evaluaci&oacute;n negativa o insatisfactoria</strong>.</p><p style="text-align:justify">Adem&aacute;s, de las causales descritas por renuncia, para cuyo efecto el <strong>CONTRATADO(A) </strong>deber&aacute; comunicar su intenci&oacute;n a <strong>LA CAJA </strong>con treinta (30) d&iacute;as de anticipaci&oacute;n, a efectos de determinarse Aceptaci&oacute;n por Administracion Regional de la Caja Nacional de Salud, teniendo la obligaci&oacute;n de entregar el trabajo que tuviera pendiente a satisfacci&oacute;n, los activos fijos, de conformidad al Art. 32 del D.S. 26115 de 16 de mayo de 2001.</p><p style="text-align:justify"><strong><u>U N D E C I M A</u>: (DE LA CONFORMIDAD). &ndash; La Caja Nacional de Salud </strong>representada por  el/la <strong>'.$admin_regional['nombre_autoridad'].'</strong> Administrador(a) Regional a. i., as&iacute; como el/la Sr(a). <strong>'.$persona['nombre_persona'].' '.$persona['paterno_persona'].' '.$persona['materno_persona'].'</strong>, damos nuestra conformidad con todas y cada una de las cl&aacute;usulas que anteceden en el presente Contrato, oblig&aacute;ndonos a su fiel cumplimiento, firmando en se&ntilde;al de conformidad en cinco ejemplares del mismo tenor.</p><p style="text-align:right">Potos&iacute;, xx de xxxxxx del 202x</p><p style="text-align:right">&nbsp;</p><p style="text-align:right">&nbsp;</p><p style="text-align:right">&nbsp;</p><div><table border="0" cellpadding="1" cellspacing="1" style="margin:auto; width:650px"><tbody><tr><td style="text-align:center">'.$jefe_contabilidad['nombre_autoridad'].'<br /><strong>'.$jefe_contabilidad['puesto'].'</strong></td><td style="text-align:center">'.$jefe_medico['nombre_autoridad'].'<br /><strong>'.$jefe_medico['puesto'].'</strong></td></tr><tr><td colspan="2" style="text-align:center"><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>'.$admin_regional['nombre_autoridad'].'<br /><strong>'.$admin_regional['puesto'].'</strong></td></tr></tbody></table></div>';

				}
				
			} else {

				$suplencia = $this->id_suplencia;

				// TRAEMOS DATOS DE SUPLENCIA
				$item = "id_suplencia";

				$datos_suplencia = ControladorSuplencias::ctrMostrarSuplencias($item, $suplencia);

				$documento_contrato = '<h1 style="text-align:center"><strong>MEMORANDUM NO. JRH-MED-016-21</strong></h1><p><strong>DE:&nbsp;</strong> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;JEFATURA DE PERSONAL REGIONAL</p><p><strong>A:</strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; DR. '.$persona["nombre_persona"].' '.$persona["paterno_persona"].' '.$persona["materno_persona"].'</p><p><strong>REF.:&nbsp;</strong> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; SUPLENCIA ('.$datos_suplencia["tipo_suplencia"].')</p><p><strong>FECHA:&nbsp; &nbsp;</strong> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; POTOSI, 6 de marzo de 2021</p><hr /><p>&nbsp;</p><p>Doctor(a):</p><p>En cumplimiento a Instrucciones de Administraci&oacute;n Regional y de acuerdo a solicitud de la DIRECCION DE HOSPITAL OBRERO N&deg; 5 con CITE DHO-CT-66-21 ('.$datos_suplencia["tipo_suplencia"].') usted deber&aacute; cumplir SUPLENCIA ('.$datos_suplencia["tipo_suplencia"].') de DR. JOSE LUIS MARTINEZ MARQUEZ a partir del '.date("d-m-Y", strtotime($this->inicio_contrato)).' al '.date("d-m-Y", strtotime($this->fin_contrato)).' en el horario de 09:00 a 12:00 y 14:00 a 17:00 con un sueldo de '.number_format($cargo['haber_basico'], 2, ",", ".").' Bs. Con todas las obligaciones y responsabilidades inherentes al cargo</p><p>Con este motivo, saludamos a usted atentamente.</p><p style="text-align:right">&nbsp;</p><p style="text-align:right">&nbsp;</p><p style="text-align:right">&nbsp;</p><div><table border="0" cellpadding="1" cellspacing="1" style="margin:auto; width:650px"><tbody><tr><td style="text-align:center">'.$supervisor_admin["nombre_autoridad"].'<br /><strong>'.$supervisor_admin["puesto"].'</strong></td><td style="text-align:center">'.$jefe_medico["nombre_autoridad"].'<br /><strong>'.$jefe_medico["puesto"].'</strong></td></tr><tr><td colspan="2" style="text-align:center"><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>'.$admin_regional["nombre_autoridad"].'<br /><strong>'.$admin_regional["puesto"].'</strong></td></tr></tbody></table></div>';

			}	


			$datos = array( "dias_contrato"   	    => $this->dias_contrato,
							"fin_contrato"   	    => $this->fin_contrato,
							"ampliacion"			=> 1,
					        "ant_fin_contrato"   	=> $this->ant_fin_contrato,
					        "documento_contrato" 	=> $documento_contrato,
					       	"documento_ampliacion" 	=> $ruta,
						    "id_persona_contrato"   => $this->id_persona_contrato,
			);	

		  // var_dump($datos);

			$respuesta = ControladorPersonaContratos::ctrAmpliarPersonaContrato($datos);

			echo $respuesta;

		}

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

	$nuevoPersonaContrato -> id_lugar = $_POST["nuevoLugar"];
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

	$editarPersonaContrato -> id_lugar = $_POST["editarLugar"];
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

	$editarDocumentoContrato -> ajaxMostrarDocumentoContratoPDF();

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
GUARDAR ARCHIVO 
=============================================*/

if (isset($_POST["guardarArchivoContrato"])) {

	$archivoContrato = new AjaxPersonaContratos();

	$archivoContrato -> id_persona_contrato = $_POST["editarIdArchivoContrato"];
	$archivoContrato -> archivo_contrato = $_FILES["archivoContrato"];
	$archivoContrato -> archivo_actual = $_POST["archivoActual"];

	$archivoContrato -> ajaxGuardarArchivoContrato();

}

/*=============================================
ACTIVAR USUARIO
=============================================*/

if (isset($_POST["validarArchivoContrato"])) {

	$validarArchivoContrato = new AjaxPersonaContratos();

	$validarArchivoContrato -> estado_contrato = $_POST["estado_contrato"];
	$validarArchivoContrato -> id_persona_contrato = $_POST["id_persona_contrato"];

	$validarArchivoContrato -> ajaxValidarArchivoContrato();

}

/*=============================================
AMPLIAR PERSONA CONTRATO
=============================================*/

if (isset($_POST["ampliarPersonaContrato"])) {

	$ampliarPersonaContrato = new AjaxPersonaContratos();

	$ampliarPersonaContrato -> id_lugar = $_POST["ampliarIdLugar"];
	$ampliarPersonaContrato -> id_establecimiento = $_POST["ampliarIdEstablecimiento"];
	$ampliarPersonaContrato -> id_persona = $_POST["ampliarIdPersona"];
	$ampliarPersonaContrato -> id_cargo = $_POST["ampliarIdCargo"];
	$ampliarPersonaContrato -> inicio_contrato = $_POST["ampliarFechaInicio"];
	$ampliarPersonaContrato -> dias_contrato = $_POST["ampliarDiasContrato"];
	$ampliarPersonaContrato -> fin_contrato = $_POST["ampliarFechaFin"];
	$ampliarPersonaContrato -> id_contrato = $_POST["ampliarIdContrato"];
	$ampliarPersonaContrato -> id_suplencia = $_POST["ampliarIdSuplencia"];
	$ampliarPersonaContrato -> observaciones_contrato = $_POST["ampliarObservacionesContrato"];
	$ampliarPersonaContrato -> id_persona_contrato = $_POST["ampliarIdPersonaContrato"];	
	$ampliarPersonaContrato -> ant_fin_contrato = $_POST["antFechaFin"];
	$ampliarPersonaContrato -> documento_ampliacion = $_FILES["documentoAmpliacion"];
	$ampliarPersonaContrato -> documento_actual = $_POST["documentoActual"];

	$ampliarPersonaContrato -> ajaxAmpliarPersonaContrato();

}