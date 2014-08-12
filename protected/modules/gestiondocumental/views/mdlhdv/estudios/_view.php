<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ESTU_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ESTU_ID),array('view','id'=>$data->ESTU_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ESTU_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->ESTU_NOMBRE); ?>
	<br />


</div>