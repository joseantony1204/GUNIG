<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('PRCA_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->PRCA_ID),array('view','id'=>$data->PRCA_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PENA_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PENA_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TICD_ID')); ?>:</b>
	<?php echo CHtml::encode($data->TICD_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PEAC_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PEAC_ID); ?>
	<br />


</div>