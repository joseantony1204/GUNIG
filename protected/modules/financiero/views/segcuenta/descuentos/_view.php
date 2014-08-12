<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('DESC_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->DESC_ID),array('view','id'=>$data->DESC_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DESC_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->DESC_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIDE_ID')); ?>:</b>
	<?php echo CHtml::encode($data->TIDE_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('APDE_ID')); ?>:</b>
	<?php echo CHtml::encode($data->APDE_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ESDE_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ESDE_ID); ?>
	<br />


</div>