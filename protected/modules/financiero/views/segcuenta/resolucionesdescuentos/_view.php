<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('REDE_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->REDE_ID),array('view','id'=>$data->REDE_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('REDE_TARIFA')); ?>:</b>
	<?php echo CHtml::encode($data->REDE_TARIFA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DESC_ID')); ?>:</b>
	<?php echo CHtml::encode($data->DESC_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RESO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->RESO_ID); ?>
	<br />


</div>