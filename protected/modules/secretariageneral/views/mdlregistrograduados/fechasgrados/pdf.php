<?php
  $pdf = Yii::createComponent('application.extensions.tcpdftati.ETcPdf','P', 'mm', 'Letter', true, 'UTF-8');
 // ini_set("memory_limit","1024M"); 
  set_time_limit(0);
  
   $phpNumToLetterPath = Yii::getPathOfAlias('ext');
  include($phpNumToLetterPath . DIRECTORY_SEPARATOR . 'CNumeroaLetra.php');
  $NumberToLetters = new EnLetras();

 $id = "";
  if($_REQUEST["id"]){
   $id = $_REQUEST["id"];
  }
  
  
  $autor='ING. TATIANA KATHERINE MONTOYA ZABALETA - UNIVERSIDAD DE LA GUAJIRA';  
  $titulo="GENERACION DE ACTAS DE GRADO POR CEREMONIA";
  $palabrasClaves='ACTAS, GRADO, SECRETARIA GENERAL';
  $Sujeto='ACTAS DE GRADO';
  $NombreDocumento=$titulo;
  
  $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
 $pdf->SetHeaderData(PDF_HEADER_LOGO, 160, $PDF_HEADER_TITLE, false);
 // Información referente al PDF
  $pdf->SetCreator($autor);
  $pdf->SetAuthor($autor);
  $pdf->SetTitle($titulo);
  $pdf->SetSubject($Sujeto);
  $pdf->SetKeywords($palabrasClaves);
  $pdf->SetMargins(15,79,15);
  
  
   
    // Fuente de la cabecera y el pie de página
  //$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
  //$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	
  // Márgenes
 // $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
  //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
  //$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
  $pdf->setPrintFooter(false);
  $pdf->SetHeaderData(false);
  $pdf->setPrintHeader(false); 
	
  // Saltos de página automáticos.
  $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	
  // Establecer el ratio para las imagenes que se puedan utilizar
  $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
  //$pdf->SetFont('times', 'K', 11);
  
	  
	
$registroGraduados= new Registrograduados;
$registroGraduados->FEGR_ID=$id;
$dataprovaider=$registroGraduados->search($registroGraduados->FEGR_ID, true);

$folios= new Folios;
$graduados= new Graduados;
$rectores= new Rectores;
$decanos= new Decanos;
$secretarios= new Secretariosgenerales;
$titulos= new Titulos;
$graduados= new Graduados;
$programas= new Programas;
$codigosicfes = new Codigosicfes;
$sedes= new Sedes;
$fechasgrados= new Fechasgrados;
$facultades= new Facultades;
$titulostrabajosgrados= new Titulostrabajosgrados;


$modelArray=$dataprovaider->getData(true);
//exit(var_dump($modelArray));
$tamaño = sizeof($modelArray);
//exit(var_dump($tamaño));
foreach($modelArray as $array){
$SedeCeremonia=ucfirst(strtolower($fechasgrados->getNombreSedeCeremonia($array["FEGR_ID"])));
$idSedeCeremonia=$fechasgrados->getIdSedeCeremonia($array["FEGR_ID"]);
if($idSedeCeremonia==1) $lugarexpeciion="Capital del Departamento de La Guajira";
elseif($idSedeCeremonia==3)$lugarexpeciion="Capital del Departamento de Cordoba";
elseif($idSedeCeremonia==10)$lugarexpeciion="Municipio del Departamento de Bolivar";
elseif($idSedeCeremonia<>1)$lugarexpeciion="Municipio del Departamento de La Guajira";

$fechagrado=$fechasgrados->FechaGrado($array["FEGR_ID"]);
$dia=Yii::app()->dateformatter->format("d",$fechagrado);
$mes=Yii::app()->dateformatter->format("MM",$fechagrado);
$año=Yii::app()->dateformatter->format("yyyy",$fechagrado);
$nombreMes=$fechasgrados->getNombreMes($mes);
$diaEnLetras= ucfirst(strtolower($NumberToLetters->ValorEnLetras($dia,'')));
 $nombreRector= strtoupper($rectores->getNombreRector($array["RECT_ID"]));
 $nombreDecano= strtoupper($decanos->getNombreDecanos($array["DECA_ID"]));
 $nombreSecretario= strtoupper($secretarios->getNombreSecretarios($array["SEGE_ID"]));
$nombreFacultad=$facultades->getNombreFacultad($array["FACU_ID"]);

$sexoRec=$rectores->getSexoRector($array["RECT_ID"]);
if($sexoRec=='M'){
$Drector='el Doctor'; 
$Drector2='El Rector';
$Drector3='Rector';
}
else{
$Drector=' la Doctora'; 
$Drector2='La Rector';
$Drector3='Rectora';
}

if($decanos->getSexoDecano($array["DECA_ID"])=='M'){$Ddecano='Decano';}else{$Ddecano='Decana';}

if($secretarios->getSexoSecretarios($array["SEGE_ID"])=='M'){$Dsecretarios='Secretario';}else{$Dsecretarios='Secretaria';}

$nombreGraduado=strtoupper($graduados->getNombreGraduado($array["GRAD_ID"]));
$nombreTitulo=strtoupper($titulos->getNombreTitulo($array["TITU_ID"]));
$cedulaGraduado2=$graduados->getCedulaGraduado($array["GRAD_ID"]);
  $cedulaGraduado=number_format($cedulaGraduado2,0,',','.');
 $cicfes= $codigosicfes->getCodigoicfes($array["COIC_ID"]);
    $resolucionu= $codigosicfes->getResolucionU($array["COIC_ID"]);
	
    if($cicfes==""){
		$resolucionu=$resolucionu;
		 }else{
			 $resolucionu=$resolucionu.', bajo el Código No. '.$cicfes;
			 
			 }
   $resolucionIcfes= $codigosicfes->getResolucionIcfes($array["COIC_ID"]);
  $titulotrabajo=strtoupper($titulostrabajosgrados->getTitulotrabajogrado($array["TITG_ID"]));
  $numfolio=$folios->getFolio($array["FOLI_ID"]);
 
?>
<?php
 $content='
<p align="right"><strong></strong><strong>No.<u>'.$array["REGR_ACTA"].'</u></strong></p>
<p align="justify">En '.$SedeCeremonia.', '.$lugarexpeciion.',  a los '.$diaEnLetras.' ('.$dia.') días del mes de '.$nombreMes.' del año '.$año.', se reunieron en la Ciudadela Universitaria '.$Drector.' '.$nombreRector.'<strong> </strong>en su calidad de Rector de la Institución, '.$nombreDecano.' '.$Ddecano.' de la Facultad de '.$nombreFacultad.' y '.$nombreSecretario.'<strong> </strong>'.$Dsecretarios.' General, con el objeto de otorgar el título  profesional de <strong>'.$nombreTitulo.'</strong>, a <strong>'.$nombreGraduado.'</strong> con Cédula de Ciudadanía Número '.$cedulaGraduado.' expedida en '.$graduados->getLugarExpedicionCedula($array["GRAD_ID"]).'. El graduado terminó sus estudios de acuerdo con los reglamentos según consta en  los respectivos registros de la   Facultad de '.$nombreFacultad.' y presentó el Trabajo de Grado titulado: <strong>&ldquo;'.$titulotrabajo.'&rdquo;. </strong>La Universidad de La Guajira por intermedio de  su Representante Legal '.$Drector2.', previo juramento en rigor y en virtud de '.$resolucionu.' y '.$resolucionIcfes.', otorga el título profesional de <strong>'.$nombreTitulo.'</strong> a <strong>'.$nombreGraduado.'</strong> haciéndole entrega del correspondiente Diploma.  El presente se encuentra registrado en el Libro  de Actas No. '.$array["LIBR_ID"].' Folio '.$numfolio.'. <br/><br/>
Este documento se firma sin borrones ni  enmendaduras.<br/><br/>
Para constancia se firma,<br/><br/>
<strong>'.$nombreRector.'</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>'.$nombreDecano.'</strong><br />
'.$Drector3.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$Ddecano.'<br/>
</p>
<p align="center"><strong>'.$nombreSecretario.'</strong><br />
  '.$Dsecretarios.' General </p>'; 
 $pdf->AddPage();
$pdf->writeHTML($content, true, 0, true, 0); 
 }

$pdf->SetFont('times', 'K', 10);
$pdf->Output("$NombreDocumento.pdf", 'D'); 
     
  Yii::app()->end();
  
?>

