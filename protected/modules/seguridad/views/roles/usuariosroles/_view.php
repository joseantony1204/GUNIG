<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('USRO_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->USRO_ID),array('view','id'=>$data->USRO_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USRO_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->USRO_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USMO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->USMO_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USSM_ID')); ?>:</b>
	<?php echo CHtml::encode($data->USSM_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USCO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->USCO_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USVI_ID')); ?>:</b>
	<?php echo CHtml::encode($data->USVI_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USPU_ID')); ?>:</b>
	<?php echo CHtml::encode($data->USPU_ID); ?>
	<br />


</div>