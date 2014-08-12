<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACSO_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ACSO_ID),array('view','id'=>$data->ACSO_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACSO_NUMERO')); ?>:</b>
	<?php echo CHtml::encode($data->ACSO_NUMERO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACSO_DESCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->ACSO_DESCRIPCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACSO_URL')); ?>:</b>
	<?php echo CHtml::encode($data->ACSO_URL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACSO_RESPUESTA')); ?>:</b>
	<?php echo CHtml::encode($data->ACSO_RESPUESTA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACSO_FUENTE')); ?>:</b>
	<?php echo CHtml::encode($data->ACSO_FUENTE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACSO_ESTADOPM')); ?>:</b>
	<?php echo CHtml::encode($data->ACSO_ESTADOPM); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('ACIN_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ACIN_ID); ?>
	<br />

	*/ ?>

</div>