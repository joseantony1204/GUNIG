<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACIN_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ACIN_ID),array('view','id'=>$data->ACIN_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GRIN_ID')); ?>:</b>
	<?php echo CHtml::encode($data->GRIN_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PEAC_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PEAC_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACIN_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->ACIN_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACIN_HORAS_DEDICACION_SEMANAL')); ?>:</b>
	<?php echo CHtml::encode($data->ACIN_HORAS_DEDICACION_SEMANAL); ?>
	<br />


</div>