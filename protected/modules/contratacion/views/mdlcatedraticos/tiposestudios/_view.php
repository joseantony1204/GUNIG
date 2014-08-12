<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIES_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->TIES_ID),array('view','id'=>$data->TIES_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIES_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->TIES_NOMBRE); ?>
	<br />


</div>