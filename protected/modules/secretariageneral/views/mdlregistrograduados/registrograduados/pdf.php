<?php
$mPDF1 = Yii::app()->ePdf->mpdf();
$mPDF1->mirrorMargins = 1;

 $autor='ING. TATIANA KATHERINE MONTOYA ZABALETA - UNIVERSIDAD DE LA GUAJIRA';  
  $titulo="REPORTE INDIVIDUAL DE GRADUADOS";
  $palabrasClaves='REGISTRO GRADUADOS, UNIGUAJIRA, SECRETARIA GENERAL';
  $Sujeto='REGISTRO GRADUADOS';
  $NombreDocumento=$titulo;
 $mPDF1->SetCreator($autor);
  $mPDF1->SetAuthor($autor);
  $mPDF1->SetTitle($titulo);
  $mPDF1->SetSubject($Sujeto);
  $mPDF1->SetKeywords($palabrasClaves);
  
 /* $id = "";
  if($_REQUEST["id"]){
   $id = $_REQUEST["id"];
  }
  $model=new Registrograduados;
  $model->REGR_ID=$id;
  $model=$model->search($model->REGR_ID);
*/
?>

<?php $fechaActual=date("Y-m-d");
       $rectores=new Rectores;
		  $Secretarios=new Secretariosgenerales;
		  $Decanos=new Decanos;
		   $folios=new Folios;
		   $titulos=new Titulos;
		   $graduados=new Graduados;
		   $titulostrabajos=new Titulostrabajosgrados;
		   $nivele=new Nivelesestudios;
		   $facultades=new Facultades;
		   $programas=new Programas;
		   $sedes=new Sedes;
		   $jornadas=new Jornadas;
		   $sexos=new Sexos;
		   $fechas=new Fechasgrados;
		   $SEGE_ID=$Secretarios->getSecretarioporFechaGrado($fechaActual);
		   $Secretarios->getNombreSecretarios($SEGE_ID);
		   $dia=Yii::app()->dateformatter->format("d",$fechaActual);
			$mes=Yii::app()->dateformatter->format("MM",$fechaActual);
			$año=Yii::app()->dateformatter->format("yyyy",$fechaActual);
			$nombreMes=$fechas->getNombreMes($mes);
			
			if(($Secretarios->getSexoSecretarios($SEGE_ID))=='M')$Dsecretarios=' EL Suscricto secretario general';
 else $Dsecretarios='La suscricta secretaria general';

		  
	/* $imageUrl = Yii::app()->request->baseUrl . '/images/plantillapdf/logo.png';
$image = CHtml::image($imageUrl); 	 */  
?>
<?php 
$header = '
<table width="100%"><tr>
<td align="center">'.$image.'
</td>
</tr></table>
<br/>';

$mPDF1->SetHTMLHeader($header);
$html = '
<style>
table.detail-view .null
{
	color: pink;
}

table.detail-view
{
	background: white;
	border-collapse: collapse;
	width: 100%;
	margin: 0;
}

table.detail-view th, table.detail-view td
{
	font-size: 0.9em;
	border: 1px white solid;
	padding: 0.3em 0.6em;
	vertical-align: top;
}

table.detail-view th
{
	text-align: right;
	width: 160px;
}

table.detail-view tr.odd
{
	background:#E5F1F4;
}

table.detail-view tr.even
{
	background:#F8F8F8;
}

table.detail-view tr.odd th
{
}

table.detail-view tr.even th
{
}
</style>
<br/><br/><br/><br/><br/><br/>
<h3 align="center">'.$Dsecretarios.' de la universidad de La Guajira certifica:<br/> Que la persona relacionada a continuación es graduado(a) de esta institción tal como se detalla:</h3>
<br/>
<table class="detail-view" id="yw0"><tbody>
<tr class="odd"><th>'.$model->getAttributeLabel('NIES_ID').'</th><td>'.$nivele->getNombreNivel($model->NIES_ID).'</td></tr>
<tr class="odd"><th>'.$model->getAttributeLabel('LIBR_ID').'</th><td>'.$model->LIBR_ID.'</td></tr>
<tr class="even"><th>'.$model->getAttributeLabel('FOLI_ID').'</th><td>'.$folios->getFolio($model->FOLI_ID).'</td></tr>
<tr class="odd"><th>'.$model->getAttributeLabel('REGR_ACTA').'</th><td>'.$model->REGR_ACTA.'</td></tr>
<tr class="even"><th>'.$model->getAttributeLabel('FEGR_ID').'</th><td>'.Yii::app()->dateformatter->format("dd-MM-yyyy",$fechas->FechaGrado($model->FEGR_ID)).'</td></tr>
<tr class="odd"><th>'.$model->getAttributeLabel('TITU_ID').'</th><td>'.$titulos->getNombreTitulo($model->TITU_ID).'</td></tr>
<tr class="even"><th>'.$model->getAttributeLabel('GRAD_CEDULA').'</th><td>'.number_format($graduados->getCedulaGraduado($model->GRAD_ID)).' de '.$graduados->getLugarExpedicionCedula($model->GRAD_ID).'</td></tr>
<tr class="odd"><th>'.$model->getAttributeLabel('GRAD_NOMBRES').'</th><td>'.$graduados->getNombreGraduado($model->GRAD_ID).'</td></tr>
<tr class="even"><th>'.$model->getAttributeLabel('TITG_ID').'</th><td>'.$titulostrabajos->getTitulotrabajogrado($model->TITG_ID).'</td></tr>
<tr class="even"><th>'.$model->getAttributeLabel('RECT_ID').'</th><td>'.$rectores->getNombreRector($model->RECT_ID).'</td></tr>
<tr class="odd"><th>'.$model->getAttributeLabel('DECA_ID').'</th><td>'.$Decanos->getNombreDecanos($model->DECA_ID).'</td></tr>
<tr class="even"><th>'.$model->getAttributeLabel('SEGE_ID').'</th><td>'.$Secretarios->getNombreSecretarios($model->SEGE_ID).'</td></tr>
<tr class="odd"><th>'.$model->getAttributeLabel('FACU_ID').'</th><td>'.$facultades->getNombreFacultad($model->FACU_ID).'</td></tr>
<tr class="even"><th>'.$model->getAttributeLabel('PROG_ID').'</th><td>'.$programas->getNombrePrograma($model->PROG_ID).'</td></tr>
<tr class="odd"><th>'.$model->getAttributeLabel('SEDE_ID').'</th><td>'.$sedes->getNombreSedes($model->SEDE_ID).'</td></tr>
<tr class="odd"><th>'.$model->getAttributeLabel('JORN_ID').'</th><td>'.$jornadas->getNombreJornadas($model->JORN_ID).'</td></tr>
<tr class="even"><th>'.$model->getAttributeLabel('GRAD_SEXO').'</th><td>'.$graduados->getNombreSexoGraduado($model->GRAD_ID).'</td></tr>
</tbody></table><br/> <br/>
 <div align="right">Se expide la presente a los '.$dia.' de '.$nombreMes.' de '.$año.'</div>
<br/><br/>
<div align="left">Fiel copia de su original<br />
'.$Secretarios->getNombreSecretarios($SEGE_ID).'<br/>
Secretaria General<br/></div>
<br/><br/><br/>
                                                                                                                               
<div align="right"><span style="font-size:11px">Revisado por: Beronica Maestre Daza <br/> Desarrollado por:Tatiana Montoya Zabaleta</span></div>
';
// $footer = '<div align="rigth"><img src="'.Yii::app()->request->baseUrl.'/images/plantillapdf/footer2.png" width="100%" /></div>';
// $mPDF1->SetHTMLFooter($footer);
$mPDF1->WriteHTML($html);
$nombreDocuemento=$fechaActual."-RegistroGraduado Cedula-".$graduados->getCedulaGraduado($model->GRAD_ID);
$mPDF1->Output("$nombreDocuemento.pdf", 'I');
exit;
?>


