<?php
Yii::app()->homeUrl = array('/contratacion/');
$this->breadcrumbs=array(
	'Modulo Contratación'=>array('/contratacion/'),
	'Panel'=>array('/contratacion/ocasionalescpanel/'),
	'Docentes Ocasionales'=>array('mdlocasionales/persnaturalesocasionales/admin'),
	'Crear',
);
?>
<table width="60%" border="0" align="left" class="">
  <tr>
    <td><table width="100%" border="0" align="center">
      <tr>
        <td width="17" align="left">
            <?php 			 
			 $imageUrl = Yii::app()->request->baseUrl . '/images/user.png';
			  echo $image = CHtml::image($imageUrl); 
			  ?>         
			         </td>
        <td width="625" align="left">
        <strong style="border-bottom-style:groove">PROCESO DE CREACIÒN DE REGISTROS [ 
		DOCENTES OCASIONALES  : Nuevo ] </strong></td>
        <td width="80" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Regresar');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlocasionales/persnaturalesocasionales/admin',),$htmlOptions ); 
?>         
		         
        </td>
        <td width="80" align="center">
        <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlocasionales/persnaturalesocasionales/create',
		                                'id'=>$Persnaturalesocasionales->PENA_ID),$htmlOptions ); 
?>         
		          </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><p><?php echo $this->renderPartial('_form', array(
	                                                      'Persnaturalesocasionales'=>$Persnaturalesocasionales,
														  'Ocasionalescontratos'=>$Ocasionalescontratos)); ?></p>
    </td>
  </tr>
</table>
