<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('PENA_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->PENA_ID),array('view','id'=>$data->PENA_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PENA_NOMBRES')); ?>:</b>
	<?php echo CHtml::encode($data->PENA_NOMBRES); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PENA_APELLIDOS')); ?>:</b>
	<?php echo CHtml::encode($data->PENA_APELLIDOS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PENA_LUGAREXPIDENTIDAD')); ?>:</b>
	<?php echo CHtml::encode($data->PENA_LUGAREXPIDENTIDAD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PENA_FECHAEXPIDENTIDAD')); ?>:</b>
	<?php echo CHtml::encode($data->PENA_FECHAEXPIDENTIDAD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PENA_FECHANACIMIENTO')); ?>:</b>
	<?php echo CHtml::encode($data->PENA_FECHANACIMIENTO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_ID); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('PAIS_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PAIS_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DEPA_ID')); ?>:</b>
	<?php echo CHtml::encode($data->DEPA_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MUNI_ID')); ?>:</b>
	<?php echo CHtml::encode($data->MUNI_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SEXO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->SEXO_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ESCI_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ESCI_ID); ?>
	<br />

	*/ ?>

</div>