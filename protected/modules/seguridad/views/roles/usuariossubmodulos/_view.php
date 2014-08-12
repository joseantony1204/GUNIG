<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('USSM_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->USSM_ID),array('view','id'=>$data->USSM_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USSM_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->USSM_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USSM_URL')); ?>:</b>
	<?php echo CHtml::encode($data->USSM_URL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USMO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->USMO_ID); ?>
	<br />


</div>