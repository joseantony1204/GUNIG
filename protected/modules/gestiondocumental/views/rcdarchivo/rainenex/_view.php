<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('RIEE_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->RIEE_ID),array('view','id'=>$data->RIEE_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ENEX_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ENEX_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RAIN_ID')); ?>:</b>
	<?php echo CHtml::encode($data->RAIN_ID); ?>
	<br />


</div>