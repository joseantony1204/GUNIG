<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('EMCE_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->EMCE_ID),array('view','id'=>$data->EMCE_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MOOR_ID')); ?>:</b>
	<?php echo CHtml::encode($data->MOOR_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EVCR_ID')); ?>:</b>
	<?php echo CHtml::encode($data->EVCR_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EVES_ID')); ?>:</b>
	<?php echo CHtml::encode($data->EVES_ID); ?>
	<br />


</div>