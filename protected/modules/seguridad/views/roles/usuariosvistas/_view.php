<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('USVI_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->USVI_ID),array('view','id'=>$data->USVI_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USVI_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->USVI_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USVI_URL')); ?>:</b>
	<?php echo CHtml::encode($data->USVI_URL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USCO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->USCO_ID); ?>
	<br />


</div>
