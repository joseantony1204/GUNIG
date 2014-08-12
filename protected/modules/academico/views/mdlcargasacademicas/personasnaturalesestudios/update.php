<?php
$this->breadcrumbs=array(
	'Modulo Academico'=>array('/academico/'),
	'Menú Academico'=>array('cargasacademicascpanel/'),
	'Personas Naturales'=>array('mdlcargasacademicas/personasnaturales/admin/'),
	'Hoja de vida'=>array('mdlcargasacademicas/personasnaturales/view/','id'=>$model->PENA_ID),
	'Estudios'=>array('admin','id'=>$model->PENA_ID),
	'Actualizar', 
);
?>
<table width="60" border="0" align="left" class="">
  <tr>
    <td><table width="820" border="0" align="center">
      <tr>
        <td width="60" align="left"><img src="/APP_FONDO/images/user.png" alt="" /></td>
        <td align="left">
        <strong style="border-bottom-style:groove">PROCESO DE ACTUALIZACIÒN DE REGISTROS [ 
		PERSONASNATURALESESTUDIOS  : Editar ] </strong></td>
        <td width="80" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Regresar');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcargasacademicas/personasnaturalesestudios/admin','id'=>$model->PENA_ID),$htmlOptions ); 
?>         
		         
        </td>
        <td width="80" align="center">
        <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Actualizaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcargasacademicas/personasnaturalesestudios/update','id'=>$model->PENE_ID),$htmlOptions ); 
?>         
		          </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><p><?php echo $this->renderPartial('_form', array('model'=>$model)); ?></p></td>
  </tr>
</table>
