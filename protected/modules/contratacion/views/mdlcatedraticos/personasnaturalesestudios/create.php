<?php
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'Panel'=>array('catedraticoscpanel/'),
	'Personas Naturales'=>array('mdlcatedraticos/personasnaturales/admin/'),
	'Hoja de vida'=>array('mdlcatedraticos/personasnaturales/view/','id'=>$model->PENA_ID),
	'Estudios'=>array('admin','id'=>$model->PENA_ID),
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
        <strong style="border-bottom-style:groove">PROCESO DE CREACIÒN DE REGISTROS [ ESTUDIOS
		  : Nuevo ] </strong></td>
        <td width="80" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Regresar');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcatedraticos/personasnaturalesestudios/admin','id'=>$model->PENA_ID),$htmlOptions ); 
?>         
		         
        </td>
        <td width="80" align="center">
        <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcatedraticos/personasnaturalesestudios/create','id'=>$model->PENA_ID),$htmlOptions ); 
?>         
		          </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><p><?php echo $this->renderPartial('_form', array('model'=>$model)); ?></p></td>
  </tr>
</table>
