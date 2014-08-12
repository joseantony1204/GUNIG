<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('NECE_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->NECE_ID),array('view','id'=>$data->NECE_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NECE_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->NECE_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MOOR_ID')); ?>:</b>
	<?php echo CHtml::encode($data->MOOR_ID); ?>
	<br />


</div>