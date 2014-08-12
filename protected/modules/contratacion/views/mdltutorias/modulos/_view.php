<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('TUMO_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->TUMO_ID),array('view','id'=>$data->TUMO_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TUMO_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->TUMO_NOMBRE); ?>
	<br />


</div>