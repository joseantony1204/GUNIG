<?php
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'Cpanel Contratacion'=>array('/contratacion/ordenescpanel/index'),
	'Detalles del contrato',
);

?>

<?php 
$numero = $model->rel_contrato->CONT_NUMORDEN; 
$tipo = $model->rel_contrato->tICO->TICO_NOMBRE;
$clase = $model->rel_contrato->cLCO->CLCO_NOMBRE;
$anio = $model->rel_contrato->CONT_ANIO; 
?>


<table width="70%" border="0" align="center" class="" style="white-space-collapse:collapse">
  <tr>
    <td colspan="4"><table width="820" border="0" align="center"> <fieldset>  
      <tr>
        <td width="60" align="left"><?php         
		      $imageUrl = Yii::app()->request->baseUrl . '/images/settings.png';
			  echo $image = CHtml::image($imageUrl);
		    ?></fieldset></td>
        <td width="498" align="left"><strong style="border-bottom-style:groove">   ADMINISTRADOR DE INFORMES DE CONTRATACIÓN </strong></td>
        <td width="80" align="center">&nbsp;   </td>
        <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Volver al Cpanel');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('/contratacion/ordenescpanel/index',),$htmlOptions ); 
?>         
</td>
        <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlordenes/informes/admin',),$htmlOptions ); 
?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="4"> 
    <fieldset>  
 
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
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_inf_contratoria.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Informe de Contratatación para la Contraloría');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlordenes/informes/contraloria',),$htmlOptions ); 
	?></td>
      <td width="6%">&nbsp;</td>
      <td width="20%"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_inf_gen.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Relación de Contratos');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlordenes/informes/contratos',),$htmlOptions ); 
	?></td>
      <td width="6%">&nbsp;</td>
      <td width="20%">&nbsp;</td>
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
      <td width="20%">&nbsp;</td>
      <td width="6%">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="21">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
  </tr>
    <tr>
      <td height="24">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
