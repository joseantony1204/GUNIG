<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('FOCO_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->FOCO_ID),array('view','id'=>$data->FOCO_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FOCO_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->FOCO_NOMBRE); ?>
	<br />


</div>