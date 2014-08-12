<?php
$this->breadcrumbs=array(
	'Modulo Secretaria General'=>array('/secretariageneral/'),
	'Panel Registro Graduados'=>array('registrograduadoscpanel/'),
	'Resoluciones ICFES'=>array('admin'),
	'ver',
);

?>

<table width="70%" border="1" align="left" class="" style="white-space-collapse:collapse">
  <tr>
    <td><table width="820" border="0" align="center">
      <tr>
        <td width="60" align="left"> <?php 			 
			 $imageUrl = Yii::app()->request->baseUrl . '/images/secretariageneral/codigosicfes.png';
			  echo $image = CHtml::image($imageUrl); 
			  ?></td>
        <td width="498" align="left"><strong style="border-bottom-style:groove">VISUALIZACIÒN DE REGISTROS [ NORMAS : Detalles ] </strong></td>
        <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Regresar');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlregistrograduados/codigosicfes/admin',),$htmlOptions ); 
?>         
		 </td>
        <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlregistrograduados/codigosicfes/view','id'=>$model->COIC_ID),$htmlOptions ); 
?>         
		 </td>
        <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/edit.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlregistrograduados/codigosicfes/update','id'=>$model->COIC_ID),$htmlOptions ); 
?>         
		 </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>
<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'COIC_ID',
		'COIC_CODIGO',
		'COIC_NORMA_APROBACION_UNIGUAJIRA',
		'COIC_NORMA_APROBACION_ICFES',
		array(
		'name' =>$model->getAttributeLabel('JORN_ID'),
		'value'=>$model->rel_jornadas->JORN_NOMBRE,
		),
		array(
		'name' =>$model->getAttributeLabel('METO_ID'),
		'value'=>$model->rel_metodologias->METO_NOMBRE,
		),
		array(
		'name' =>$model->getAttributeLabel('TITU_ID'),
		'value'=>$model->rel_titulos->TITU_NOMBRE,
		),
		array(
		'name' =>$model->getAttributeLabel('PROG_ID'),
		'value'=>$model->rel_programas->PROG_NOMBRE,
		),array(
		'name' =>$model->getAttributeLabel('SEDE_ID'),
		'value'=>$model->rel_sedes->SEDE_NOMBRE,
		),
		array(
		'name' =>$model->getAttributeLabel('COIC_FECHA_VENCIMIENTO'),
		'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy",$model->COIC_FECHA_VENCIMIENTO),
		),
		array(
		'name' =>$model->getAttributeLabel('COIC_ESTADO'),
		'value'=>$model->COIC_ESTADO,
		'filter'=>array('1'=> 'ACTIVO', '0' => 'INACTIVO'), 
		),
				
		
	),
)); ?>    
    
    </td>
  </tr>
</table>
