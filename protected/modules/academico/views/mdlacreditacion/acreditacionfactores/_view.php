<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACFA_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ACFA_ID),array('view','id'=>$data->ACFA_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACFA_NUMERO')); ?>:</b>
	<?php echo CHtml::encode($data->ACFA_NUMERO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACFA_DESCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->ACFA_DESCRIPCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACBI_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ACBI_ID); ?>
	<br />


</div>