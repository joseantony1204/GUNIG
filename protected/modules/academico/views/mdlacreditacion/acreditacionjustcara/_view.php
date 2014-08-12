<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACJC_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ACJC_ID),array('view','id'=>$data->ACJC_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACJC_DESCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->ACJC_DESCRIPCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACCA_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ACCA_ID); ?>
	<br />


</div>