<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('TUPR_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->TUPR_ID),array('view','id'=>$data->TUPR_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TUPR_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->TUPR_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TUPR_SUPERVISOR')); ?>:</b>
	<?php echo CHtml::encode($data->TUPR_SUPERVISOR); ?>
	<br />


</div>