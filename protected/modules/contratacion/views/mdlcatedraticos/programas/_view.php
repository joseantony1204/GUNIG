<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('PROG_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->PROG_ID),array('view','id'=>$data->PROG_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PROG_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->PROG_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FACU_ID')); ?>:</b>
	<?php echo CHtml::encode($data->FACU_ID); ?>
	<br />


</div>