<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('MENS_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->MENS_ID),array('view','id'=>$data->MENS_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PENA_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PEND_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MENS_DESCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->MENS_DESCRIPCION); ?>
	<br />


</div>