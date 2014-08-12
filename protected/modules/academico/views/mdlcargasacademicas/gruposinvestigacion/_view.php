<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('GRIN_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->GRIN_ID),array('view','id'=>$data->GRIN_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GRIN_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->GRIN_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CAGI_ID')); ?>:</b>
	<?php echo CHtml::encode($data->CAGI_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GRIN_ANIO_CALIFICACION')); ?>:</b>
	<?php echo CHtml::encode($data->GRIN_ANIO_CALIFICACION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GRIN_GRUPLAC')); ?>:</b>
	<?php echo CHtml::encode($data->GRIN_GRUPLAC); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PENA_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PENA_ID); ?>
	<br />


</div>