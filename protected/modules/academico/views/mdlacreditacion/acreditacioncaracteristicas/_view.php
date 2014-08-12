<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACCA_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ACCA_ID),array('view','id'=>$data->ACCA_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACCA_NUMERO')); ?>:</b>
	<?php echo CHtml::encode($data->ACCA_NUMERO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACCA_DESCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->ACCA_DESCRIPCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACFA_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ACFA_ID); ?>
	<br />


</div>