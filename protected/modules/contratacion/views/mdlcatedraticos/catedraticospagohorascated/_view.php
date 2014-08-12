<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CACA_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CACA_ID),array('view','id'=>$data->CACA_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CPHC_ID')); ?>:</b>
	<?php echo CHtml::encode($data->CPHC_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CPHC_HORASPAGADAS')); ?>:</b>
	<?php echo CHtml::encode($data->CPHC_HORASPAGADAS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CPHC_HORASRESTANTES')); ?>:</b>
	<?php echo CHtml::encode($data->CPHC_HORASRESTANTES); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CPHC_HORASXPAGAR')); ?>:</b>
	<?php echo CHtml::encode($data->CPHC_HORASXPAGAR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CPHC_PORCPAGADO')); ?>:</b>
	<?php echo CHtml::encode($data->CPHC_PORCPAGADO); ?>
	<br />


</div>