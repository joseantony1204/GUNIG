<?php
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'cpanel Tutorias'=>array('tutoriascpanel/'),
	'Contratos Tutorias'=>array('mdltutorias/tutoriascontratos/admin'),
	'Tutorias del Contrato'=>array('mdltutorias/tutorias/detail','id'=>$model->TUCO_ID),
	'Actualizar',
);
?>
<table width="60" border="0" align="left" class="">
  <tr>
    <td><table width="820" border="0" align="center">
      <tr>
        <td width="60" align="left">
        <?php  $imageUrl = Yii::app()->request->baseUrl . '/images/user.png'; echo $image = CHtml::image($imageUrl);   ?>
        </td>
        <td align="left">
        <strong style="border-bottom-style:groove">PROCESO DE ACTUALIZACIÒN DE REGISTROS [ 
		TUTORIAS  : Editar ] </strong></td>
        <td width="80" align="center">
		<?php		 
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Regresar');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltutorias/tutorias/detail','id'=>$model->TUCO_ID),$htmlOptions ); 
        ?></td>
        <td width="80" align="center">
        <?php         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltutorias/tutorias/update','id'=>$model->TUTO_ID),$htmlOptions ); 
		 ?>
        
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><p><?php echo $this->renderPartial('_form', array('model'=>$model,'Tutoriascontratos'=>$Tutoriascontratos)); ?></p></td>
  </tr>
</table>
