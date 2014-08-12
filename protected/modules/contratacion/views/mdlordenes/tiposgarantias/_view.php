<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIGA_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->TIGA_ID),array('view','id'=>$data->TIGA_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIGA_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->TIGA_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIGA_TEXTOINICIAL')); ?>:</b>
	<?php echo CHtml::encode($data->TIGA_TEXTOINICIAL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIGA_TEXTOMEDIO')); ?>:</b>
	<?php echo CHtml::encode($data->TIGA_TEXTOMEDIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIGA_TEXTOFINAL')); ?>:</b>
	<?php echo CHtml::encode($data->TIGA_TEXTOFINAL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FOCO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->FOCO_ID); ?>
	<br />


</div>