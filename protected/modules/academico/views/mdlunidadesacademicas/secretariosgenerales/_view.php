<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('SEGE_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->SEGE_ID),array('view','id'=>$data->SEGE_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PENA_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PENA_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SEGE_FECHA_INICIO')); ?>:</b>
	<?php echo CHtml::encode($data->SEGE_FECHA_INICIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SEGE_FECHA_FIN')); ?>:</b>
	<?php echo CHtml::encode($data->SEGE_FECHA_FIN); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SEGE_ESTADO')); ?>:</b>
	<?php echo CHtml::encode($data->SEGE_ESTADO); ?>
	<br />


</div>