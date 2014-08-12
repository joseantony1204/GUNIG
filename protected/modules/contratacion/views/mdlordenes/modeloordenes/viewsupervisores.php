<?php
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'Cpanel Contratacion'=>array('/contratacion/ordenescpanel/index'),
	'Contratos'=>array('/contratacion/mdlordenes/modeloordenes/adminsupervisores'),
	'Evaluacion',
	//$_POST['supervisor']
);


$numero=$model->rel_contrato->CONT_NUMORDEN;
$clase=$model->rel_contrato->cLCO->CLCO_NOMBRE;
$tipo=$model->rel_contrato->tICO->TICO_NOMBRE;
$anio=$model->rel_contrato->CONT_ANIO;

?>




<table width="70%" border="0" align="center" class="" style="white-space-collapse:collapse">
  <tr>
    <td colspan="4"><table width="820" border="0" align="center"> <fieldset>  
      <tr>
        <td width="60" align="left"><?php         
		      $imageUrl = Yii::app()->request->baseUrl . '/images/settings.png';
			  echo $image = CHtml::image($imageUrl);
		    ?></fieldset></td>
        <td width="498" align="left"><strong style="border-bottom-style:groove">  [ <?php echo $tipo ?> <?php echo $numero ?> DE <?php echo $clase ?>   DE  <?php echo $anio ?>]   </strong></td>
        <td width="80" align="center">&nbsp;   </td>
        <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Regresar');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlordenes/modeloordenes/adminsupervisores',),$htmlOptions ); 
?>
</td>
        <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlordenes/modeloordenes/viewsupervisores','id'=>$model->MOOR_ID),$htmlOptions ); 
?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="4"> 
    <fieldset>  
  <strong>OBJETO DEL CONTRATO:</strong> <?php  echo  $model->MOOR_OBJETO;  ?>.   
	</fieldset>  
    </td>
  </tr>
  
  </table>
<table width="70%" border="0" align="center" class="" style="white-space-collapse:collapse">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="20%"><?php
	

	
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_evaluacion.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'REALIZAR EVALUACION DEL CONTRATO U ORDEN');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlordenes/evamodeloscriterios/detail','id'=>$model->MOOR_ID,),$htmlOptions ); 

	?></td>
      <td width="6%">&nbsp;</td>
      <td width="20%"><?php
	

	
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_eva_observacion.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'REGISTRO DE OBSERVACIONES Y DEVOLUCIONES');
	 $image = CHtml::image($imageUrl);
	echo CHtml::link($image, array('mdlordenes/evaobservaciones/admin','id'=>$model->MOOR_ID,),$htmlOptions );  

	?></td>
      <td width="6%">&nbsp;</td>
      <td width="20%"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_eva_pdf.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Generar Invitaciones del Contrato');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlordenes/modeloordenes/evaluacion','id'=>$model->MOOR_ID,),$htmlOptions ); 
	?></td>
      <td width="6%">&nbsp;</td>
      <td width="20%">&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  </table>
