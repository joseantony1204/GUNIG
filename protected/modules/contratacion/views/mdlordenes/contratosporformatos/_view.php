<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('COFO_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->COFO_ID),array('view','id'=>$data->COFO_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CONT_ID')); ?>:</b>
	<?php echo CHtml::encode($data->CONT_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FOCO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->FOCO_ID); ?>
	<br />


</div>