<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACIN_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ACIN_ID),array('view','id'=>$data->ACIN_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACIN_NUMERO')); ?>:</b>
	<?php echo CHtml::encode($data->ACIN_NUMERO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACIN_DESCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->ACIN_DESCRIPCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACAS_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ACAS_ID); ?>
	<br />


</div>