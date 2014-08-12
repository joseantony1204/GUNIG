<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('TICD_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->TICD_ID),array('view','id'=>$data->TICD_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TICD_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->TICD_NOMBRE); ?>
	<br />


</div>