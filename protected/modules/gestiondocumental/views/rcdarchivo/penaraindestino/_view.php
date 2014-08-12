<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('PNRD_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->PNRD_ID),array('view','id'=>$data->PNRD_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PEND_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PEND_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RAIN_ID')); ?>:</b>
	<?php echo CHtml::encode($data->RAIN_ID); ?>
	<br />


</div>