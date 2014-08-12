<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('TUTO_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->TUTO_ID),array('view','id'=>$data->TUTO_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TUTO_INTENSIDAD')); ?>:</b>
	<?php echo CHtml::encode($data->TUTO_INTENSIDAD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TUTO_VALOR')); ?>:</b>
	<?php echo CHtml::encode($data->TUTO_VALOR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TUTO_PLAZO')); ?>:</b>
	<?php echo CHtml::encode($data->TUTO_PLAZO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TUSP_ID')); ?>:</b>
	<?php echo CHtml::encode($data->TUSP_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SEDE_ID')); ?>:</b>
	<?php echo CHtml::encode($data->SEDE_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PRES_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PRES_ID); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('CONT_ID')); ?>:</b>
	<?php echo CHtml::encode($data->CONT_ID); ?>
	<br />

	*/ ?>

</div>