<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('SUPE_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->SUPE_ID),array('view','id'=>$data->SUPE_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CONT_ID')); ?>:</b>
	<?php echo CHtml::encode($data->CONT_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CARG_ID')); ?>:</b>
	<?php echo CHtml::encode($data->CARG_ID); ?>
	<br />


</div>