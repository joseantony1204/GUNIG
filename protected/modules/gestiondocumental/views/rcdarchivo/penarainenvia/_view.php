<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('PNRE_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->PNRE_ID),array('view','id'=>$data->PNRE_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PEND_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PEND_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RAIN_ID')); ?>:</b>
	<?php echo CHtml::encode($data->RAIN_ID); ?>
	<br />


</div>