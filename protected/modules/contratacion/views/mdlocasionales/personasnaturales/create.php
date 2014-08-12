<?php
Yii::app()->homeUrl = array('/contratacion/');
$this->breadcrumbs=array(
	'Modulo Contratación'=>array('/contratacion/'),
	'Panel'=>array('/contratacion/ocasionalescpanel/'),
	'Personas Naturales'=>array('mdlocasionales/personasnaturales/admin'),
	'Crear',
);
?>
<table width="60" border="0" align="left" class="">
  <tr>
    <td><table width="820" border="0" align="center">
      <tr>
        <td width="60" align="left">
        <?php
            $imageUrl = Yii::app()->request->baseUrl . '/images/user.png';
            $image = CHtml::image($imageUrl);
			echo $image;
			?>
        </td>
        <td align="left">
        <strong style="border-bottom-style:groove">PROCESO DE CREACIÒN DE REGISTROS [ 
		PERSONAS NATURALES  : Nuevo ] </strong></td>
        <td width="80" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Regresar');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlocasionales/personasnaturales/admin',),$htmlOptions ); 
?>         
		         
        </td>
        <td width="80" align="center">
        <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlocasionales/personasnaturales/create',),$htmlOptions ); 
?>         
		          </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><p><?php echo $this->renderPartial('_form', array('Personasnaturales'=>$Personasnaturales,
	                                                      'Personas'=>$Personas)); ?></p>
    </td>
  </tr>
</table>
