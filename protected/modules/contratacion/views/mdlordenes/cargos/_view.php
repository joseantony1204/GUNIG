<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CARG_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CARG_ID),array('view','id'=>$data->CARG_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CARG_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->CARG_NOMBRE); ?>
	<br />


</div>