<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('EXDO_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->EXDO_ID),array('view','id'=>$data->EXDO_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EXDO_RUTA')); ?>:</b>
	<?php echo CHtml::encode($data->EXDO_RUTA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EXDO_FECHAINGRESO')); ?>:</b>
	<?php echo CHtml::encode($data->EXDO_FECHAINGRESO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EXDO_FECHAVENCIMIENTO')); ?>:</b>
	<?php echo CHtml::encode($data->EXDO_FECHAVENCIMIENTO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CONT_ID')); ?>:</b>
	<?php echo CHtml::encode($data->CONT_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIDO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->TIDO_ID); ?>
	<br />


</div>