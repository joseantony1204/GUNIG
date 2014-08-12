<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACPR_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ACPR_ID),array('view','id'=>$data->ACPR_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACPR_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->ACPR_NOMBRE); ?>
	<br />

	<b><?php /* echo CHtml::encode($data->getAttributeLabel('FACU_ID')); ?>:</b>
	<?php echo CHtml::encode($data->FACU_ID); */ ?>
	<br />


</div>