<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('HTDO_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->HTDO_ID),array('view','id'=>$data->HTDO_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HTDO_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->HTDO_NOMBRE); ?>
	<br />


</div>