<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('PECO_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->PECO_ID),array('view','id'=>$data->PECO_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PECO_DESCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->PECO_DESCRIPCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PECO_FECHAINICIO')); ?>:</b>
	<?php echo CHtml::encode($data->PECO_FECHAINICIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PECO_FECHAFINAL')); ?>:</b>
	<?php echo CHtml::encode($data->PECO_FECHAFINAL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PENA_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PENA_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('REAC_ID')); ?>:</b>
	<?php echo CHtml::encode($data->REAC_ID); ?>
	<br />


</div>