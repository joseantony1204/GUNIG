<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CAGI_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CAGI_ID),array('view','id'=>$data->CAGI_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CAGI_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->CAGI_NOMBRE); ?>
	<br />


</div>