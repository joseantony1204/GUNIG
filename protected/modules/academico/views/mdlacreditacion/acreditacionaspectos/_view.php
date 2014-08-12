<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACAS_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ACAS_ID),array('view','id'=>$data->ACAS_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACAS_NUMERO')); ?>:</b>
	<?php echo CHtml::encode($data->ACAS_NUMERO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACAS_DESCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->ACAS_DESCRIPCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACCA_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ACCA_ID); ?>
	<br />


</div>