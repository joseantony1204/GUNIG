<?php
  $pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf','P', 'pt', 'A4', true, 'UTF-8');
  ini_set("memory_limit","1024M"); 
  set_time_limit(0);
  
  $phpNumToLetterPath = Yii::getPathOfAlias('ext');
  include($phpNumToLetterPath . DIRECTORY_SEPARATOR . 'CNumeroaLetra.php');
  $NumberToLetters = new EnLetras();
  
  
  // Extend the TCPDF class to create custom Header and Footer
  class MYPDF extends TCPDF {

  // Page footer
  public function Footer() {
    // Set font		
    $this->SetFont('times', 'K', 11);
	$user = strtolower(Yii::app()->user->nombres);
    $nameUser = ucwords(ucfirst($user));
	$txt ='
    <table width="100%" border="0" align="center">
	 
	 <tr>
	   <th colspan="5" align="left"><font size="6">Proyectó : '.$nameUser.'</font></th>
     </tr>
	 <tr>
      <th width="10%" rowspan="2"><font size="8">GJ-F-35</font></th>
      <th width="25%" ><font size="7">Tatiana M.</font></th>
	  <th width="25%" ><font size="7">Comité Calidad</font></th>
      <th width="25%" ><font size="7">Carlos A. Robles</font></th>
      <th width="15%" rowspan="2"><font size="8">'.'Pág. '.$this->getAliasNumPage().' / '.$this->getAliasNbPages().'</font></th>
     </tr>
     
	 <tr>
      <th width="25%"><font size="8">ELABOR&Oacute;</font></th>
	  <th width="25%"><font size="8">REVIS&Oacute;</font></th>
      <th width="25%"><font size="8">APROB&Oacute;</font></th>
     </tr>
	 
    </table>';
    $this->Line(15,282,195,282); 
    $this->writeHTML($txt, true, 0, true, 0);
   }
  }
  
  $autor='ING. JOSE ANTONIO GONZALEZ LIÑAN - UNIVERSIDAD DE LA GUAJIRA';    
  $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
  $pdf->SetHeaderData(PDF_HEADER_LOGO, 160, $PDF_HEADER_TITLE, $PDF_HEADER_STRING);
  
    // Fuente de la cabecera y el pie de página
  $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
  $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	
  // Márgenes
  $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
  $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
  $pdf->SetFooterMargin(18);
  $pdf->setPrintFooter(true);
	
  // Saltos de página automáticos.
  $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	
  // Establecer el ratio para las imagenes que se puedan utilizar
  $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
   function NombreMes($m){
   switch ($m){
    case 1: return "Enero";
    case 2: return "Febrero";
    case 3: return "Marzo";
    case 4: return "Abril";
    case 5: return "Mayo";
    case 6: return "Junio";
    case 7: return "Julio";
    case 8: return "Agosto";
    case 9: return "Septiembre";
    case 10: return "Octubre";
    case 11: return "Noviembre";
    case 12: return "Diciembre";
   }
  }
 
  $id = "";  $facultad = "";  $programa = ""; $opcion = "";
  
  if(($_REQUEST["id"]) or ($_REQUEST["facultad"]) or ($_REQUEST["programa"])) {
   $id = $_REQUEST["id"];
   $facultad = $_REQUEST["facultad"];
   $programa = $_REQUEST["programa"];
   $data = $Catedraticoscontratos->downloadContratos($id,$facultad,$programa);
  }else{   
		if($_REQUEST["opcion"]=='all'){
		 $data = $Registros;
		 $nombre = "REPORTE_GENERAL_DE_CONTRATOS_CATEDRÁTICOS";
		}
       }
 
  
  foreach($data as $rows){
  $Catedraticoscontratos = Catedraticoscontratos::model()->findByPk($rows["CACO_ID"]);
 // $Catedraticoscontratos->cargarContrato();
  $Catedraticoscontratos->parametrosContrato();
  $Catedraticoscontratos->generarFooterContratos();
  
  $numero = $Catedraticoscontratos->CACO_NUMORDEN;	
  $dia_contrato = date("d",strtotime($Catedraticoscontratos->CACO_FECHAPROCESO));
  $mes_contrato=NombreMes(date("m",strtotime($Catedraticoscontratos->CACO_FECHAPROCESO)));
  $anio_contrato=$Catedraticoscontratos->CACO_ANIO;  
  $fecha = ''; //$dia_contrato." de ".$mes_contrato." de ".$anio_contrato;
 
  $tipoIdentificacion = $Catedraticoscontratos->rel_personas_naturales_catedraticos->rel_personas_naturales->
  rel_personas->rel_tipos_identificacion->TIID_DESCRIPCION;
  
  $identificacion = $Catedraticoscontratos->rel_personas_naturales_catedraticos->rel_personas_naturales->rel_personas->PERS_IDENTIFICACION;
  
  $expe = strtolower($Catedraticoscontratos->rel_personas_naturales_catedraticos->rel_personas_naturales->PENA_LUGAREXPIDENTIDAD);
  $exp = " de ".ucfirst($expe);
  
  /*inicio parametros del contrato*/
  
  $criteria = new CDbCriteria;
  $criteria->condition = 'CACO_ID = '.$Catedraticoscontratos->CACO_ID;
  $criteria->order = 'CACO_ID ASC';
  $catedras = Catedraticoscatedras::model()->findAll($criteria);
  $listProgramasMateriasHrs = ""; $listPresupuestos = "";
  foreach($catedras as $rows){
   $Catedraticoscatedras = Catedraticoscatedras::model()->findByPk($rows->CACA_ID);
   $Programas = Programas::model()->findByPk($Catedraticoscatedras->PROG_ID);
   $Catedraticospresupuestos = Catedraticospresupuestos::model()->findByPk($Catedraticoscatedras->CAPR_ID);
   $Presupuestos = Presupuestos::model()->findByPk($Catedraticospresupuestos->PRES_ID);
   $listPresupuestos .= $Presupuestos->PRES_NOMBRE.', ';
   $criteria = new CDbCriteria;
   $criteria->condition = 'CACA_ID = '.$Catedraticoscatedras->CACA_ID;
   $criteria->order = 'CAAC_ID ASC';	   
   $Catedratiasignaturascatedr = Catedratiasignaturascatedr::model()->findAll($criteria);	   
   $listAsignaturas = "";
	foreach($Catedratiasignaturascatedr as $row){
	 $Asignaturas = Asignaturas::model()->findByPk($row->ASIG_ID);
	 $listAsignaturas.= $Asignaturas->ASIG_NOMBRE.', ';
	}	
	$listProgramasMateriasHrs .= $Programas->PROG_NOMBRE.': '.$listAsignaturas." con una intensidad de : 
	".strtoupper($NumberToLetters->ValorEnLetras($Catedraticoscatedras->CACA_INTENSIDAD," "))." 
	(".$Catedraticoscatedras->CACA_INTENSIDAD.") horas; ";
	$Catedraticoscontratos->TOTALHORAS = $Catedraticoscontratos->TOTALHORAS +  $Catedraticoscatedras->CACA_INTENSIDAD;
	
	$listMateriasHrs .= $listAsignaturas." con una intensidad de : 
	".strtoupper($NumberToLetters->ValorEnLetras($Catedraticoscatedras->CACA_INTENSIDAD," "))." 
	(".$Catedraticoscatedras->CACA_INTENSIDAD.") horas; ";
	$Catedraticoscontratos->TOTALHORAS = $Catedraticoscontratos->TOTALHORAS +  $Catedraticoscatedras->CACA_INTENSIDAD;  
  }
  $Catedraticoscontratos->LISTAPROGMATHORAS = $listProgramasMateriasHrs;
  $Catedraticoscontratos->LISTAMATHORAS = $listMateriasHrs;  
  $Catedraticoscontratos->LISTPRESUPUESTOS = $listPresupuestos;
   
  /*fin parametros del contrato*/
  
  /* OBTENIENDO EL VALOR DEL CONTRATO */
  $valorContrato = (($Catedraticoscontratos->TOTALHORAS)*($Catedraticoscontratos->rel_personas_naturales_catedraticos->PENC_VALORCATEGORIA));
  $valorContratoLetras = strtoupper($NumberToLetters->ValorEnLetras($valorContrato,"PESOS"));
  $valorContratoCon4xMil = (($valorContrato)+($valorContrato*4/1000));
  
  //***** AÑADIR PAGINA *****//
  $pdf->SetFont('times', 'k', '11', true);
  if($Catedraticoscontratos->CATC_ID==1){
  $pdf->AddPage();
  ///***** CREANDO ARCHIVO *****///
  $html ='
  <table width="100%" border="0">
  <tr>
    <td width="75%">&nbsp;</td>
	<td width="25%" align="center"><strong>CONTRATO No.</strong></td>
  </tr>
  <tr>
    <td width="75%">&nbsp;</td>
	<td width="25%" align="center"><strong>'.$Catedraticoscontratos->CACO_NUMORDEN.'</strong></td>
  </tr>
  
  <tr>
    <td colspan="2">
	<table width="100%" border="0">
      <tr>
        <td width="50%" align="left"><strong>RIOHACHA, </strong></td>
        <td width="50%" rowspan="4" align="center">&nbsp;</td>
      </tr>
	  <tr>
       <td align="left">Profesor (a) </td>
      </tr>
      <tr>
        <td align="left">
		<strong>'.$Catedraticoscontratos->rel_personas_naturales_catedraticos->rel_personas_naturales->PENA_APELLIDOS.'</strong>
		<strong>'.$Catedraticoscontratos->rel_personas_naturales_catedraticos->rel_personas_naturales->PENA_NOMBRES.'</strong>
		</td>
      </tr>
      <tr>
        <td align="left">
		'.$tipoIdentificacion.' No. '.number_format($identificacion).'
		</td>
      </tr>
     </table>
	</td>
  </tr>
  
   <tr>
    <td colspan="2" align="center">
     <div align="justify"><br>
	 Por medio de la presente solicito a usted se  sirva ofrecer sus servicios en la Universidad de la Guajira,
	 como docente  catedrático de la (s) asignatura (s) que se relaciona (n) a continuación.
	 <br>
	 <br><strong>PRIMERA:  OBJETO: HORAS CATEDRA, DE INVESTIGACION Y EXTENSION: </strong>
	 El contratista deberá  dictar<strong> </strong>
	  en la Universidad de la Guajira durante el 
	  <strong>'.$Catedraticoscontratos->rel_personas_naturales_catedraticos->rel_repiodos_academicos->PEAC_NOMBRE.'</strong>	
	  en  la <strong>FACULTAD(es) DE : '.$Catedraticoscontratos->LISTADOFACULTADES.'</strong> 
	  un total de: <strong>('.$Catedraticoscontratos->TOTALHORAS.')  
	  Horas Cátedras,</strong> además de las labores de <strong>investigación y extensión</strong> que les sean solicitadas 
	  por la  institución  para el desarrollo de  
	  proyectos, programas y actividades producto de los mismos. Los docentes  contratados se comprometen a atender 
	  las solicitudes, convocatorias y llamados  a trabajar, desde su perfil profesional, para el fortalecimiento de 
	  <strong>la docencia,</strong> <strong>la investigación y el desarrollo de proyectos institucionales</strong> 
	  que le  sean asignados por la dependencia al cual pertenece. Así mismo por el  Decano de la 
	  <strong>FACULTAD(es) a la cual está adscrito. </strong>
	  
	  <br>En  el/los  Programa(s) de: <strong>'.$Catedraticoscontratos->LISTAPROGMATHORAS.'</strong> 
	  para un total de: 
	  <strong>'.strtoupper($NumberToLetters->ValorEnLetras($Catedraticoscontratos->TOTALHORAS," ")).' ('.$Catedraticoscontratos->TOTALHORAS.') 
	  horas en el Semestre,</strong>   
	  El respectivo horario será fijado por la dirección de programa,  en condición   de profesor catedrático asimilado a la 
	  categoría de <strong>'.$Catedraticoscontratos->rel_personas_naturales_catedraticos->PENC_CATEGORIA.'</strong>, cuya metodología la  
	  vigilará la Dirección  de la universidad.<br><strong>OBLIGACIONES: </strong>
	  <ol>
        <li>Dedicar  el tiempo necesario a las horas de trabajo formativo, reflexivo y de  construcción académica, 
		que demande el ejercicio de su labor, incluyendo el  tiempo de Actividades Programadas en la 
		elaboración del plan estratégico de TIC`S  por la facultad respectiva.</li>
        <li>Dedicar  mínimo dos (2)  Horas de su trabajo formativo  a la semana para la atención y desarrollo   de la   
		Cátedra UNIGUAJIRA de Investigación y para el desarrollo  permanente del Plan Estratégico en Tic`s.</li>
		<li>Tener  pleno dominio en las herramientas básicas informáticas, tales como Office,  acceso a Internet y uso 
		de Correo electrónico institucional y manejo de  herramientas que permitan el desarrollo de su cátedra 
		desde un acompañamiento  virtual a sus estudiantes.</li>
        <li>Incorporar  su capacidad normal de trabajo  de  acuerdo al programa de la asignatura y   
		las instrucciones impartidas por   Decano y el Director de Programa de su respectiva Facultad.</li>
        <li>Presentar  el Proyecto Docente o el Programa de acuerdo a la estrategia que sigue el  Docente para desarrollar lo de su práctica.</li>
        <li>Cumplir  la totalidad de las horas de trabajo formativo, reflexivo y de producción  académica, previstas en el presente contrato.</li>
        <li>Reportar  mensualmente las horas efectivamente impartidas en el trabajo formativo,  reflexivo y de 
		producción académica al final de cada mes en la respectiva  facultad.</li>
        <li>Reportar  oportunamente las Notas a la   Plataforma de Academusoft, con copia física a las 
		Decanaturas  correspondientes para lo de su competencia.</li>
        <li>Asistir  y participar en reuniones que programe la facultad y en todas las actividades  
		anexas a su calidad de docente catedrático en los procesos de mejoramiento de  la calidad de la Educación.</li>
        <li>Participar  activamente en todas las Jornadas académicas que la Universidad disponga, para  
		lo cual deberá dejarse constancia mediante las evidencias del caso.</li>
        <li>Presentar  oportunamente ante la oficina de Talento  Humano los documentos requeridos para 
		le legalización del respectivo contrato.</li>
	 </ol>
	  
	  <strong>SEGUNDA: VALOR Y AFECTACIÓN PRESUPUESTAL DE LA HORA CATEDRA Y FORMA DE PAGO </strong>
	  El pago se realizará una vez se certifique el cumplimiento del objeto contractual, el cual se legalizará 
	  previa certificación del señor Decano de la <strong>Facultad(es) 
	  de : '.$Catedraticoscontratos->LISTADOFACULTADES.'</strong> por cada una de las horas  efectivamente 
	  trabajadas y valoradas,  sin superar lo establecido en el respectivo plan de estudio, y el período 
	  inicialmente aludido. La Universidad le pagará  la suma de 
	  <strong>'.strtoupper($NumberToLetters->ValorEnLetras(
	  $Catedraticoscontratos->rel_personas_naturales_catedraticos->PENC_VALORCATEGORIA,"PESOS")).'
	  ($'.number_format($Catedraticoscontratos->rel_personas_naturales_catedraticos->PENC_VALORCATEGORIA).') MCTE.</strong>, 
	  la hora cátedra para un total de <strong>'.$valorContratoLetras.' ($'.number_format($valorContrato).') MCTE.</strong> 
	  Con cargo a el/los certificado(s) de disponibilidad presupuestal <strong>'.$Catedraticoscontratos->LISTPRESUPUESTOS.'</strong> 
	  valor por el cual se  entiende  incluido el de todas las obligaciones mencionadas. Si el docente <strong>cumple</strong> 
	  la totalidad de horas de trabajo formativo, reflexivo y de  clases previstas en el presente contrato.
	  
	  <br><br><strong>TERCERA:  CLAUSULA DE TERMINACIÓN UNILATERAL: </strong>En cualquier etapa del contrato,  
	  la Universidad tiene la facultad de terminar  anticipadamente el contrato cuando las exigencias 
	  del servicio público lo  requieran o la situación de orden público lo imponga, por muerte o 
	  incapacidad  física permanente del contratista, por interdicción judicial, o cuando a  
	  discrecionalidad del Rector se requiera dar por terminado por hechos que  afecten grave y 
	  notoriamente la ejecución del mismo,  de conformidad con lo previsto en el Capítulo  VII del Acuerdo 025 de 2002. 
	  También es causal de terminación del contrato el  no cumplir con los compromisos académicos estipulados en 
	  las obligaciones contempladas  en los Literales del 1 al 11; según informe presentado por el Decano de la  
	  Facultad en la cual se encuentra Inscrito dicho Docente.
	  <br><br><strong>CUARTA: INHABILIDADES  E INCOMPATIBILIDADES:</strong> El Contratista declarara bajo 
		gravedad de juramento que no se halla inmerso en  ninguna  inhabilidades e incompatibilidad  
		prevista en los artículo <strong>5 del Acuerdo 015 de 2006</strong>, el juramento se  entiende 
		prestado con la firma del presente contrato. so pena de las sanciones  establecidas en la Ley  190 de 1995.
		<br><strong>Nota: El  Docente catedrático que durante el periodo académico de esta vigencia, se  
		vincule en nómina de cualquier entidad del estado deberá reportar la novedad a la Oficina de Talento Humano,  
		para los cambios a que hubiere lugar.</strong><br>
	  
	 </div>
	</td>
  </tr>
  
  <tr>
   <td align="center" colspan="2">
		
	<table width="100%" border="0">
      <tr>
        <td width="50%" align="left"><strong>CONTRATANTE</strong></td>
        <td width="50%" align="left"><strong>CONTRATISTA</strong></td>
      </tr>
	  <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td align="left"><strong>'.$Catedraticoscontratos->rel_contratantes->rel_personas_naturales->PENA_NOMBRES.' 
		  '.$Catedraticoscontratos->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS.'
		  </strong>
		</td>
        <td align="left"><strong>'.$Catedraticoscontratos->rel_personas_naturales_catedraticos->rel_personas_naturales->PENA_APELLIDOS.'</strong>
		 <strong>'.$Catedraticoscontratos->rel_personas_naturales_catedraticos->rel_personas_naturales->PENA_NOMBRES.'</strong>
		</td>
      </tr>
      <tr>
        <td align="left">'.$Catedraticoscontratos->rel_contratantes->
		rel_personas_naturales->rel_personas->rel_tipos_identificacion->TIID_DESCRIPCION.' No. 
		'.number_format($Catedraticoscontratos->rel_contratantes->rel_personas_naturales->rel_personas->PERS_IDENTIFICACION).'
		</td>
        <td align="left">
		'.$Catedraticoscontratos->rel_personas_naturales_catedraticos->
		rel_personas_naturales->rel_personas->rel_tipos_identificacion->TIID_DESCRIPCION.' No. 
		'.number_format($Catedraticoscontratos->rel_personas_naturales_catedraticos->rel_personas_naturales->rel_personas->PERS_IDENTIFICACION).'		
		</td>
      </tr>
	  <tr>
        <td align="left">'.$Catedraticoscontratos->rel_contratantes->PECO_DESCRIPCION.'</td>
        <td align="left">Docente Catedrático</td>
      </tr>
    </table>		
		</td>
	  </tr> 
	  
	  <tr>
	   <td align="left" colspan="2">&nbsp;</td>
	  </tr>
	  
	  <tr>
	   <td colspan="2">	   
	   '.$Catedraticoscontratos->TABLAFOOTER.'
	   </td>
	  </tr>
  
  </table>
  ';
  }elseif($Catedraticoscontratos->CATC_ID==2){
  $pdf->AddPage();
  
    ///***** CREANDO ARCHIVO *****///
  $html ='
  <table width="100%" border="0">
  <tr>
    <td width="75%">&nbsp;</td>
	<td width="25%" align="center"><strong>CONTRATO No.</strong></td>
  </tr>
  <tr>
    <td width="75%">&nbsp;</td>
	<td width="25%" align="center"><strong>'.$Catedraticoscontratos->CACO_NUMORDEN.'</strong></td>
  </tr>
  
  <tr>
    <td colspan="2">
	<table width="100%" border="0">
      <tr>
        <td width="50%" align="left"><strong>RIOHACHA, </strong></td>
        <td width="50%" rowspan="4" align="center">&nbsp;</td>
      </tr>
	  <tr>
       <td align="left">Profesor (a) </td>
      </tr>
      <tr>
        <td align="left">
		<strong>'.$Catedraticoscontratos->rel_personas_naturales_catedraticos->rel_personas_naturales->PENA_APELLIDOS.'</strong>
		<strong>'.$Catedraticoscontratos->rel_personas_naturales_catedraticos->rel_personas_naturales->PENA_NOMBRES.'</strong>
		</td>
      </tr>
      <tr>
        <td align="left">
		'.$tipoIdentificacion.' No. '.number_format($identificacion).'
		</td>
      </tr>
     </table>
	</td>
  </tr>
  
   <tr>
    <td colspan="2" align="center">
     <div align="justify"><br>
	 Por medio de la presente solicito a usted se  sirva ofrecer sus servicios en la Universidad de la Guajira,
	 como docente  catedrático de la (s) asignatura (s) que se relaciona (n) a continuación.
	 <br>
	 <br><strong>PRIMERA:  OBJETO: HORAS CATEDRA, DE INVESTIGACION Y EXTENSION: </strong>
	 El contratista deberá  dictar<strong> </strong>
	  en la Universidad de la Guajira, <strong>el VACACIONAL</strong> programado durante el 
	  <strong>'.$Catedraticoscontratos->rel_personas_naturales_catedraticos->rel_repiodos_academicos->PEAC_NOMBRE.'</strong>	
	  en  la <strong>FACULTAD(es) DE : '.$Catedraticoscontratos->LISTADOFACULTADES.'</strong> 
	  un total de: <strong>('.$Catedraticoscontratos->TOTALHORAS.')
	  Horas Cátedras.</strong>
	  
	  <br>El docente debera dictar : <strong>'.$Catedraticoscontratos->LISTAMATHORAS.'</strong> 
	  para un total de: 
	  <strong>'.strtoupper($NumberToLetters->ValorEnLetras($Catedraticoscontratos->TOTALHORAS," ")).' ('.$Catedraticoscontratos->TOTALHORAS.') 
	  horas.</strong><br>El respectivo horario será fijado por la dirección de programa,  en condición   de profesor catedrático asimilado a la 
	  categoría de <strong>'.$Catedraticoscontratos->rel_personas_naturales_catedraticos->PENC_CATEGORIA.'</strong>, cuya metodología la  
	  vigilará la Dirección  de la universidad.<br><strong>OBLIGACIONES: </strong>
	   
	  <ol>
        <li>Dedicar  el tiempo necesario a las horas de trabajo formativo, reflexivo y de  construcción académica, 
		que demande el ejercicio de su labor, incluyendo el  tiempo de Actividades Programadas en la 
		elaboración del plan estratégico de TIC`S  por la facultad respectiva.</li>
        <li>Dedicar  mínimo dos (2)  Horas de su trabajo formativo  a la semana para la atención y desarrollo   de la   
		Cátedra UNIGUAJIRA de Investigación y para el desarrollo  permanente del Plan Estratégico en Tic`s.</li>
		<li>Tener  pleno dominio en las herramientas básicas informáticas, tales como Office,  acceso a Internet y uso 
		de Correo electrónico institucional y manejo de  herramientas que permitan el desarrollo de su cátedra 
		desde un acompañamiento  virtual a sus estudiantes.</li>
        <li>Incorporar  su capacidad normal de trabajo  de  acuerdo al programa de la asignatura y   
		las instrucciones impartidas por   Decano y el Director de Programa de su respectiva Facultad.</li>
        <li>Presentar  el Proyecto Docente o el Programa de acuerdo a la estrategia que sigue el  Docente para desarrollar lo de su práctica.</li>
        <li>Cumplir  la totalidad de las horas de trabajo formativo, reflexivo y de producción  académica, previstas en el presente contrato.</li>
        <li>Reportar  mensualmente las horas efectivamente impartidas en el trabajo formativo,  reflexivo y de 
		producción académica al final de cada mes en la respectiva  facultad.</li>
        <li>Reportar  oportunamente las Notas a la   Plataforma de Academusoft, con copia física a las 
		Decanaturas  correspondientes para lo de su competencia.</li>
        <li>Asistir  y participar en reuniones que programe la facultad y en todas las actividades  
		anexas a su calidad de docente catedrático en los procesos de mejoramiento de  la calidad de la Educación.</li>
        <li>Participar  activamente en todas las Jornadas académicas que la Universidad disponga, para  
		lo cual deberá dejarse constancia mediante las evidencias del caso.</li>
        <li>Presentar  oportunamente ante la oficina de Talento  Humano los documentos requeridos para 
		le legalización del respectivo contrato.</li>
	 </ol>
	  
	  <strong>SEGUNDA: VALOR Y AFECTACIÓN PRESUPUESTAL DE LA HORA CATEDRA Y FORMA DE PAGO </strong>
	  El pago se realizará una vez se certifique el cumplimiento del objeto contractual, el cual se legalizará 
	  previa certificación del señor Decano de la <strong>Facultad(es) 
	  de : '.$Catedraticoscontratos->LISTADOFACULTADES.'</strong> por cada una de las horas  efectivamente 
	  trabajadas y valoradas,  sin superar lo establecido en el respectivo plan de estudio, y el período 
	  inicialmente aludido. La Universidad le pagará  la suma de 
	  <strong>'.strtoupper($NumberToLetters->ValorEnLetras(
	  $Catedraticoscontratos->rel_personas_naturales_catedraticos->PENC_VALORCATEGORIA,"PESOS")).'
	  ($'.number_format($Catedraticoscontratos->rel_personas_naturales_catedraticos->PENC_VALORCATEGORIA).') MCTE.</strong>, 
	  la hora cátedra para un total de <strong>'.$valorContratoLetras.' ($'.number_format($valorContrato).') MCTE.</strong> 
	  Con cargo a el/los certificado(s) de disponibilidad presupuestal <strong>'.$Catedraticoscontratos->LISTPRESUPUESTOS.'</strong> 
	  valor por el cual se  entiende  incluido el de todas las obligaciones mencionadas. Si el docente <strong>cumple</strong> 
	  la totalidad de horas de trabajo formativo, reflexivo y de  clases previstas en el presente contrato.
	  
	  <br><br><strong>TERCERA:  CLAUSULA DE TERMINACIÓN UNILATERAL: </strong>En cualquier etapa del contrato,  
	  la Universidad tiene la facultad de terminar  anticipadamente el contrato cuando las exigencias 
	  del servicio público lo  requieran o la situación de orden público lo imponga, por muerte o 
	  incapacidad  física permanente del contratista, por interdicción judicial, o cuando a  
	  discrecionalidad del Rector se requiera dar por terminado por hechos que  afecten grave y 
	  notoriamente la ejecución del mismo,  de conformidad con lo previsto en el Capítulo  VII del Acuerdo 025 de 2002. 
	  También es causal de terminación del contrato el  no cumplir con los compromisos académicos estipulados en 
	  las obligaciones contempladas  en los Literales del 1 al 11; según informe presentado por el Decano de la  
	  Facultad en la cual se encuentra Inscrito dicho Docente.
	  <br><br><strong>CUARTA: INHABILIDADES  E INCOMPATIBILIDADES:</strong> El Contratista declarara bajo 
		gravedad de juramento que no se halla inmerso en  ninguna  inhabilidades e incompatibilidad  
		prevista en los artículo <strong>5 del Acuerdo 015 de 2006</strong>, el juramento se  entiende 
		prestado con la firma del presente contrato. so pena de las sanciones  establecidas en la Ley  190 de 1995.
		<br><strong>Nota: El  Docente catedrático que durante el periodo académico de esta vigencia, se  
		vincule en nómina de cualquier entidad del estado deberá reportar la novedad a la Oficina de Talento Humano,  
		para los cambios a que hubiere lugar.</strong><br>
	  
	 </div>
	</td>
  </tr>
  
  <tr>
   <td align="center" colspan="2">
		
	<table width="100%" border="0">
      <tr>
        <td width="50%" align="left"><strong>CONTRATANTE</strong></td>
        <td width="50%" align="left"><strong>CONTRATISTA</strong></td>
      </tr>
	  <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td align="left"><strong>'.$Catedraticoscontratos->rel_contratantes->rel_personas_naturales->PENA_NOMBRES.' 
		  '.$Catedraticoscontratos->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS.'
		  </strong>
		</td>
        <td align="left"><strong>'.$Catedraticoscontratos->rel_personas_naturales_catedraticos->rel_personas_naturales->PENA_APELLIDOS.'</strong>
		 <strong>'.$Catedraticoscontratos->rel_personas_naturales_catedraticos->rel_personas_naturales->PENA_NOMBRES.'</strong>
		</td>
      </tr>
      <tr>
        <td align="left">'.$Catedraticoscontratos->rel_contratantes->
		rel_personas_naturales->rel_personas->rel_tipos_identificacion->TIID_DESCRIPCION.' No. 
		'.number_format($Catedraticoscontratos->rel_contratantes->rel_personas_naturales->rel_personas->PERS_IDENTIFICACION).'
		</td>
        <td align="left">
		'.$Catedraticoscontratos->rel_personas_naturales_catedraticos->
		rel_personas_naturales->rel_personas->rel_tipos_identificacion->TIID_DESCRIPCION.' No. 
		'.number_format($Catedraticoscontratos->rel_personas_naturales_catedraticos->rel_personas_naturales->rel_personas->PERS_IDENTIFICACION).'		
		</td>
      </tr>
	  <tr>
        <td align="left">'.$Catedraticoscontratos->rel_contratantes->PECO_DESCRIPCION.'</td>
        <td align="left">Docente Catedrático</td>
      </tr>
    </table>		
		</td>
	  </tr> 
	  
	  <tr>
	   <td align="left" colspan="2">&nbsp;</td>
	  </tr>
	  
	  <tr>
	   <td colspan="2">	   
	   '.$Catedraticoscontratos->TABLAFOOTER.'
	   </td>
	  </tr>
  
  </table>
  ';
  
  }elseif($Catedraticoscontratos->CATC_ID==3){
  $pdf->AddPage();
  
    ///***** CREANDO ARCHIVO *****///
  $html ='
  <table width="100%" border="0">
  <tr>
    <td width="75%">&nbsp;</td>
	<td width="25%" align="center"><strong>CONTRATO No.</strong></td>
  </tr>
  <tr>
    <td width="75%">&nbsp;</td>
	<td width="25%" align="center"><strong>'.$Catedraticoscontratos->CACO_NUMORDEN.'</strong></td>
  </tr>
  
  <tr>
    <td colspan="2">
	<table width="100%" border="0">
      <tr>
        <td width="50%" align="left"><strong>RIOHACHA, </strong></td>
        <td width="50%" rowspan="4" align="center">&nbsp;</td>
      </tr>
	  <tr>
       <td align="left">Profesor (a) </td>
      </tr>
      <tr>
        <td align="left">
		<strong>'.$Catedraticoscontratos->rel_personas_naturales_catedraticos->rel_personas_naturales->PENA_APELLIDOS.'</strong>
		<strong>'.$Catedraticoscontratos->rel_personas_naturales_catedraticos->rel_personas_naturales->PENA_NOMBRES.'</strong>
		</td>
      </tr>
      <tr>
        <td align="left">
		'.$tipoIdentificacion.' No. '.number_format($identificacion).'
		</td>
      </tr>
     </table>
	</td>
  </tr>
  
   <tr>
    <td colspan="2" align="center">
     <div align="justify"><br>
	 Por medio de la presente solicito a usted se  sirva ofrecer sus servicios en la Universidad de la Guajira,
	 como docente  catedrático de la (s) asignatura (s) que se relaciona (n) a continuación.
	 <br>
	 <br><strong>PRIMERA:  OBJETO: HORAS CATEDRA, DE INVESTIGACION Y EXTENSION: </strong>
	 El contratista deberá  dictar<strong> </strong>
	  en la Universidad de la Guajira, <strong>el PREUNIVERSITARIO</strong> programado durante el 
	  <strong>'.$Catedraticoscontratos->rel_personas_naturales_catedraticos->rel_repiodos_academicos->PEAC_NOMBRE.'</strong>	
	  en  la <strong>FACULTAD(es) DE : '.$Catedraticoscontratos->LISTADOFACULTADES.'</strong> 
	  un total de: <strong>('.$Catedraticoscontratos->TOTALHORAS.') 
	  Horas Cátedras.</strong> 
	  <br>El docente debera dictar : <strong>'.$Catedraticoscontratos->LISTAMATHORAS.'</strong> 
	  para un total de: 
	  <strong>'.strtoupper($NumberToLetters->ValorEnLetras($Catedraticoscontratos->TOTALHORAS," ")).' ('.$Catedraticoscontratos->TOTALHORAS.') 
	  horas.</strong><br>El respectivo horario será fijado por la dirección de programa,  en condición   de profesor catedrático asimilado a la 
	  categoría de <strong>'.$Catedraticoscontratos->rel_personas_naturales_catedraticos->PENC_CATEGORIA.'</strong>, cuya metodología la  
	  vigilará la Dirección  de la universidad.<br><strong>OBLIGACIONES: </strong>
	  <ol>
        <li>Dedicar  el tiempo necesario a las horas de trabajo formativo, reflexivo y de  construcción académica, 
		que demande el ejercicio de su labor, incluyendo el  tiempo de Actividades Programadas en la 
		elaboración del plan estratégico de TIC`S  por la facultad respectiva.</li>
        <li>Dedicar  mínimo dos (2)  Horas de su trabajo formativo  a la semana para la atención y desarrollo   de la   
		Cátedra UNIGUAJIRA de Investigación y para el desarrollo  permanente del Plan Estratégico en Tic`s.</li>
		<li>Tener  pleno dominio en las herramientas básicas informáticas, tales como Office,  acceso a Internet y uso 
		de Correo electrónico institucional y manejo de  herramientas que permitan el desarrollo de su cátedra 
		desde un acompañamiento  virtual a sus estudiantes.</li>
        <li>Incorporar  su capacidad normal de trabajo  de  acuerdo al programa de la asignatura y   
		las instrucciones impartidas por   Decano y el Director de Programa de su respectiva Facultad.</li>
        <li>Presentar  el Proyecto Docente o el Programa de acuerdo a la estrategia que sigue el  Docente para desarrollar lo de su práctica.</li>
        <li>Cumplir  la totalidad de las horas de trabajo formativo, reflexivo y de producción  académica, previstas en el presente contrato.</li>
        <li>Reportar  mensualmente las horas efectivamente impartidas en el trabajo formativo,  reflexivo y de 
		producción académica al final de cada mes en la respectiva  facultad.</li>
        <li>Reportar  oportunamente las Notas a la   Plataforma de Academusoft, con copia física a las 
		Decanaturas  correspondientes para lo de su competencia.</li>
        <li>Asistir  y participar en reuniones que programe la facultad y en todas las actividades  
		anexas a su calidad de docente catedrático en los procesos de mejoramiento de  la calidad de la Educación.</li>
        <li>Participar  activamente en todas las Jornadas académicas que la Universidad disponga, para  
		lo cual deberá dejarse constancia mediante las evidencias del caso.</li>
        <li>Presentar  oportunamente ante la oficina de Talento  Humano los documentos requeridos para 
		le legalización del respectivo contrato.</li>
	 </ol>
	  
	  <strong>SEGUNDA: VALOR Y AFECTACIÓN PRESUPUESTAL DE LA HORA CATEDRA Y FORMA DE PAGO </strong>
	  El pago se realizará una vez se certifique el cumplimiento del objeto contractual, el cual se legalizará 
	  previa certificación del señor Decano de la <strong>Facultad(es) 
	  de : '.$Catedraticoscontratos->LISTADOFACULTADES.'</strong> por cada una de las horas  efectivamente 
	  trabajadas y valoradas,  sin superar lo establecido en el respectivo plan de estudio, y el período 
	  inicialmente aludido. La Universidad le pagará  la suma de 
	  <strong>'.strtoupper($NumberToLetters->ValorEnLetras(
	  $Catedraticoscontratos->rel_personas_naturales_catedraticos->PENC_VALORCATEGORIA,"PESOS")).'
	  ($'.number_format($Catedraticoscontratos->rel_personas_naturales_catedraticos->PENC_VALORCATEGORIA).') MCTE.</strong>, 
	  la hora cátedra para un total de <strong>'.$valorContratoLetras.' ($'.number_format($valorContrato).') MCTE.</strong> 
	  Con cargo a el/los certificado(s) de disponibilidad presupuestal <strong>'.$Catedraticoscontratos->LISTPRESUPUESTOS.'</strong> 
	  valor por el cual se  entiende  incluido el de todas las obligaciones mencionadas. Si el docente <strong>cumple</strong> 
	  la totalidad de horas de trabajo formativo, reflexivo y de  clases previstas en el presente contrato.
	  
	  <br><br><strong>TERCERA:  CLAUSULA DE TERMINACIÓN UNILATERAL: </strong>En cualquier etapa del contrato,  
	  la Universidad tiene la facultad de terminar  anticipadamente el contrato cuando las exigencias 
	  del servicio público lo  requieran o la situación de orden público lo imponga, por muerte o 
	  incapacidad  física permanente del contratista, por interdicción judicial, o cuando a  
	  discrecionalidad del Rector se requiera dar por terminado por hechos que  afecten grave y 
	  notoriamente la ejecución del mismo,  de conformidad con lo previsto en el Capítulo  VII del Acuerdo 025 de 2002. 
	  También es causal de terminación del contrato el  no cumplir con los compromisos académicos estipulados en 
	  las obligaciones contempladas  en los Literales del 1 al 11; según informe presentado por el Decano de la  
	  Facultad en la cual se encuentra Inscrito dicho Docente.
	  <br><br><strong>CUARTA: INHABILIDADES  E INCOMPATIBILIDADES:</strong> El Contratista declarara bajo 
		gravedad de juramento que no se halla inmerso en  ninguna  inhabilidades e incompatibilidad  
		prevista en los artículo <strong>5 del Acuerdo 015 de 2006</strong>, el juramento se  entiende 
		prestado con la firma del presente contrato. so pena de las sanciones  establecidas en la Ley  190 de 1995.
		<br><strong>Nota: El  Docente catedrático que durante el periodo académico de esta vigencia, se  
		vincule en nómina de cualquier entidad del estado deberá reportar la novedad a la Oficina de Talento Humano,  
		para los cambios a que hubiere lugar.</strong><br>
	  
	 </div>
	</td>
  </tr>
  
  <tr>
   <td align="center" colspan="2">
		
	<table width="100%" border="0">
      <tr>
        <td width="50%" align="left"><strong>CONTRATANTE</strong></td>
        <td width="50%" align="left"><strong>CONTRATISTA</strong></td>
      </tr>
	  <tr>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td align="left"><strong>'.$Catedraticoscontratos->rel_contratantes->rel_personas_naturales->PENA_NOMBRES.' 
		  '.$Catedraticoscontratos->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS.'
		  </strong>
		</td>
        <td align="left"><strong>'.$Catedraticoscontratos->rel_personas_naturales_catedraticos->rel_personas_naturales->PENA_APELLIDOS.'</strong>
		 <strong>'.$Catedraticoscontratos->rel_personas_naturales_catedraticos->rel_personas_naturales->PENA_NOMBRES.'</strong>
		</td>
      </tr>
      <tr>
        <td align="left">'.$Catedraticoscontratos->rel_contratantes->
		rel_personas_naturales->rel_personas->rel_tipos_identificacion->TIID_DESCRIPCION.' No. 
		'.number_format($Catedraticoscontratos->rel_contratantes->rel_personas_naturales->rel_personas->PERS_IDENTIFICACION).'
		</td>
        <td align="left">
		'.$Catedraticoscontratos->rel_personas_naturales_catedraticos->
		rel_personas_naturales->rel_personas->rel_tipos_identificacion->TIID_DESCRIPCION.' No. 
		'.number_format($Catedraticoscontratos->rel_personas_naturales_catedraticos->rel_personas_naturales->rel_personas->PERS_IDENTIFICACION).'		
		</td>
      </tr>
	  <tr>
        <td align="left">'.$Catedraticoscontratos->rel_contratantes->PECO_DESCRIPCION.'</td>
        <td align="left">Docente Catedrático</td>
      </tr>
    </table>		
		</td>
	  </tr> 
	  
	  <tr>
	   <td align="left" colspan="2">&nbsp;</td>
	  </tr>
	  
	  <tr>
	   <td colspan="2">	   
	   '.$Catedraticoscontratos->TABLAFOOTER.'
	   </td>
	  </tr>
  
  </table>
  ';
  
  }
   $pdf->writeHTML($html, true, 0, true, 0);
  }
  
  if($id!=""){
    $nombre = "CONTRATOS_CATEDRATICOS_No.".$numero ; 
   }elseif($facultad!=""){
	 $Facultades = Facultades::model()->findByPk($facultad);
     $nombre = "CONTRATOS_CATEDRATICOS_".$Facultades->FACU_NOMBRE;
    }elseif($programa!=""){
	 $Programas = Programas::model()->findByPk($programa);
     $nombre = "CONTRATOS_CATEDRATICOS_".$Programas->PROG_NOMBRE;
    }
  
  $palabrasClaves='CONTRATO, CATEDRÁTICOS, TALENTO HUMANO';
  $Sujeto='CONTRATO CATEDRÁTICOS';
  $NombreDocumento=$nombre; 
  
  $pdf->SetCreator($autor);
  $pdf->SetAuthor($autor);
  $pdf->SetTitle($nombre);
  $pdf->SetSubject($Sujeto);
  $pdf->SetKeywords($palabrasClaves);
  $pdf->Output("$NombreDocumento.pdf", 'D');  
    
  Yii::app()->end();
  
?>