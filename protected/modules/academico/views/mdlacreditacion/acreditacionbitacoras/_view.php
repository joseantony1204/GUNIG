<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACBI_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ACBI_ID),array('view','id'=>$data->ACBI_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACBI_NUMERO')); ?>:</b>
	<?php echo CHtml::encode($data->ACBI_NUMERO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACBI_FECHA')); ?>:</b>
	<?php echo CHtml::encode($data->ACBI_FECHA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACPR_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ACPR_ID); ?>
	<br />


</div>