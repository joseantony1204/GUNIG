<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCFO_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->FCFO_ID),array('view','id'=>$data->FCFO_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CONT_ID')); ?>:</b>
	<?php echo CHtml::encode($data->CONT_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FCCO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->FCCO_ID); ?>
	<br />


</div>