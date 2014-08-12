<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('EVOB_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->EVOB_ID),array('view','id'=>$data->EVOB_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MOOR_ID')); ?>:</b>
	<?php echo CHtml::encode($data->MOOR_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EVOB_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->EVOB_NOMBRE); ?>
	<br />


</div>