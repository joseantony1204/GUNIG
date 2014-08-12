<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACJF_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ACJF_ID),array('view','id'=>$data->ACJF_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACJF_DESCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->ACJF_DESCRIPCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACFA_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ACFA_ID); ?>
	<br />


</div>