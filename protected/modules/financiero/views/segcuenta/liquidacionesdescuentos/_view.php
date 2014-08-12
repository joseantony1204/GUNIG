<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('LIDE_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->LIDE_ID),array('view','id'=>$data->LIDE_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LIDE_TARIFA')); ?>:</b>
	<?php echo CHtml::encode($data->LIDE_TARIFA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LIQU_ID')); ?>:</b>
	<?php echo CHtml::encode($data->LIQU_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DESC_ID')); ?>:</b>
	<?php echo CHtml::encode($data->DESC_ID); ?>
	<br />


</div>