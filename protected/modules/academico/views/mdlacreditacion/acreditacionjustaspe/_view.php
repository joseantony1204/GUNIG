<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACJA_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ACJA_ID),array('view','id'=>$data->ACJA_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACJA_DESCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->ACJA_DESCRIPCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACAS_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ACAS_ID); ?>
	<br />


</div>