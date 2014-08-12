<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACEX_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ACEX_ID),array('view','id'=>$data->ACEX_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACEX_ACTIVIDAD_EXTENCION')); ?>:</b>
	<?php echo CHtml::encode($data->ACEX_ACTIVIDAD_EXTENCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACEX_HORAS_DEDICACION_SEMANAL')); ?>:</b>
	<?php echo CHtml::encode($data->ACEX_HORAS_DEDICACION_SEMANAL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PEAC_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PEAC_ID); ?>
	<br />


</div>