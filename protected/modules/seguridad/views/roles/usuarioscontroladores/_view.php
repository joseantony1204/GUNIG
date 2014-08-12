<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('USCO_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->USCO_ID),array('view','id'=>$data->USCO_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USCO_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->USCO_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USCO_URL')); ?>:</b>
	<?php echo CHtml::encode($data->USCO_URL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USSM_ID')); ?>:</b>
	<?php echo CHtml::encode($data->USSM_ID); ?>
	<br />


</div>