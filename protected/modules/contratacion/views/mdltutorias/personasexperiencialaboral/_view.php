<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('PEEL_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->PEEL_ID),array('view','id'=>$data->PEEL_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PEEL_EMPRESA')); ?>:</b>
	<?php echo CHtml::encode($data->PEEL_EMPRESA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PEEL_TELEFONOEMPRESA')); ?>:</b>
	<?php echo CHtml::encode($data->PEEL_TELEFONOEMPRESA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PEEL_CARGO')); ?>:</b>
	<?php echo CHtml::encode($data->PEEL_CARGO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PEEL_FECHAINICIO')); ?>:</b>
	<?php echo CHtml::encode($data->PEEL_FECHAINICIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PEEL_FECHAFINAL')); ?>:</b>
	<?php echo CHtml::encode($data->PEEL_FECHAFINAL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PEEL_ACTUALMENTE')); ?>:</b>
	<?php echo CHtml::encode($data->PEEL_ACTUALMENTE); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_ID); ?>
	<br />

	*/ ?>

</div>