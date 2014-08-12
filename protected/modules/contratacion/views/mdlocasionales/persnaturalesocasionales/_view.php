<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('PENO_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->PENO_ID),array('view','id'=>$data->PENO_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PENO_FECHAINGRESO')); ?>:</b>
	<?php echo CHtml::encode($data->PENO_FECHAINGRESO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PENO_PUNTOS')); ?>:</b>
	<?php echo CHtml::encode($data->PENO_PUNTOS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PENO_SUELDO')); ?>:</b>
	<?php echo CHtml::encode($data->PENO_SUELDO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PENA_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PENA_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PEAC_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PEAC_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FACU_ID')); ?>:</b>
	<?php echo CHtml::encode($data->FACU_ID); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('VAPU_ID')); ?>:</b>
	<?php echo CHtml::encode($data->VAPU_ID); ?>
	<br />

	*/ ?>

</div>