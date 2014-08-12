<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ESCA_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ESCA_ID),array('view','id'=>$data->ESCA_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ESCA_RUTA')); ?>:</b>
	<?php echo CHtml::encode($data->ESCA_RUTA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RESO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->LIRE_ID); ?>
	<br />


</div>