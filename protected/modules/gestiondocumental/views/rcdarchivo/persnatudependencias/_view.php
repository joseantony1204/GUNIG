<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('PEND_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->PEND_ID),array('view','id'=>$data->PEND_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DEPE_ID')); ?>:</b>
	<?php echo CHtml::encode($data->DEPE_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PENA_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PENA_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CARG_ID')); ?>:</b>
	<?php echo CHtml::encode($data->CARG_ID); ?>
	<br />


</div>