<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('RECI_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->RECI_ID),array('view','id'=>$data->RECI_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RECI_FECHA')); ?>:</b>
	<?php echo CHtml::encode($data->RECI_FECHA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PENA_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PENA_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RAIN_ID')); ?>:</b>
	<?php echo CHtml::encode($data->RAIN_ID); ?>
	<br />


</div>