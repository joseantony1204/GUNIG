<?php
Yii::app()->homeUrl = array('/gestiondocumental/');
$this->breadcrumbs=array(
	'Modulo Gestión Documental'=>array('/gestiondocumental/'),
	'Panel'=>array('hdvcpanel/'),
	'Personas Naturales'=>array('admin'),
	'Hoja de vida'=>array('mdlhdv/personasnaturales/view', 'id'=>$Personasnaturales->PENA_ID),
	'Digitalizacion Hoja De Vida'=>array('admin','id'=>$model->PERS_ID),
	'Actualizar',
);
?>
<table width="60" border="0" align="left" class="">
  <tr>
    <td><table width="820" border="0" align="center">
      <tr>
        <td width="60" align="left">
            <?php 			 
			 $imageUrl = Yii::app()->request->baseUrl . '/images/archivos.png';
			  echo $image = CHtml::image($imageUrl); 
			  ?>         
			         </td>
        <td align="left">
        <strong style="border-bottom-style:groove">PROCESO DE ACTUALIZACIÒN DE REGISTROS [ 
		SUBIR DOCUMENTOS  : Editar ] </strong></td>
        <td width="80" align="center">
         <?php         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Regresar');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlhdv/hdvexpedientedocumentos/admin','id'=>$model->PERS_ID),$htmlOptions ); 
        ?>         
		         
        </td>
        <td width="80" align="center">
        <?php         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Actualizaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlhdv/hdvexpedientedocumentos/update','id'=>$model->HEXD_ID),$htmlOptions ); 
        ?>         
		          </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><p><?php echo $this->renderPartial('_form', array('model'=>$model)); ?></p></td>
  </tr>
</table>
