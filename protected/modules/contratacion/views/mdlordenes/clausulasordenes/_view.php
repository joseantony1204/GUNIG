<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CLOR_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CLOR_ID),array('view','id'=>$data->CLOR_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CLOR_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->CLOR_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CLAU_ID')); ?>:</b>
	<?php echo CHtml::encode($data->CLAU_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FOCO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->FOCO_ID); ?>
	<br />


</div>