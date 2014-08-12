<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('USMO_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->USMO_ID),array('view','id'=>$data->USMO_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USMO_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->USMO_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USMO_URL')); ?>:</b>
	<?php echo CHtml::encode($data->USMO_URL); ?>
	<br />


</div>