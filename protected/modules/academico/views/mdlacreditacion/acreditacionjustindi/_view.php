<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACJI_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ACJI_ID),array('view','id'=>$data->ACJI_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACJI_DESCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->ACJI_DESCRIPCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACIN_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ACIN_ID); ?>
	<br />


</div>