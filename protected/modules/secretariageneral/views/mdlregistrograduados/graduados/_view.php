<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('GRAD_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->GRAD_ID),array('view','id'=>$data->GRAD_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GRAD_CEDULA')); ?>:</b>
	<?php echo CHtml::encode($data->GRAD_CEDULA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GRAD_FECHA_EXPEDICION')); ?>:</b>
	<?php echo CHtml::encode($data->GRAD_FECHA_EXPEDICION); ?>
	<br />
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('GRAD_LUGAR_EXPEDICION')); ?>:</b>
	<?php echo CHtml::encode($data->GRAD_LUGAR_EXPEDICION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GRAD_NOMBRES')); ?>:</b>
	<?php echo CHtml::encode($data->GRAD_NOMBRES); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GRAD_PRIMER_APELLIDO')); ?>:</b>
	<?php echo CHtml::encode($data->GRAD_PRIMER_APELLIDO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GRAD_SEGUNDO_APELLIDO')); ?>:</b>
	<?php echo CHtml::encode($data->GRAD_SEGUNDO_APELLIDO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GRAD_FECHA_NACIMIENTO')); ?>:</b>
	<?php echo CHtml::encode($data->GRAD_FECHA_NACIMIENTO); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('GRAD_SEXO')); ?>:</b>
	<?php echo CHtml::encode($data->GRAD_SEXO); ?>
	<br />

	*/ ?>

</div>