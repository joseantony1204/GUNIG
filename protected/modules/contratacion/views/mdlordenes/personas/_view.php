<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_IDENTIFICACION')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->PERS_IDENTIFICACION),array('view','id'=>$data->PERS_IDENTIFICACION)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_EXP_DOCUMENTO')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_EXP_DOCUMENTO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_NOMBRES')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_NOMBRES); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_APELLIDOS')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_APELLIDOS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_SEXO')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_SEXO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_EMAIL')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_EMAIL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_DIRECCION')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_DIRECCION); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_TELEFONO')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_TELEFONO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_FECHA_NACIMIENTO')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_FECHA_NACIMIENTO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_LUGAR_NACIMIENTO')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_LUGAR_NACIMIENTO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_FECHA_INGRESO')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_FECHA_INGRESO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIDO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->TIDO_ID); ?>
	<br />

	*/ ?>

</div>