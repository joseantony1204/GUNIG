<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('PROR_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->PROR_ID),array('view','id'=>$data->PROR_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MOOR_ID')); ?>:</b>
	<?php echo CHtml::encode($data->MOOR_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PRES_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PRES_ID); ?>
	<br />


</div>