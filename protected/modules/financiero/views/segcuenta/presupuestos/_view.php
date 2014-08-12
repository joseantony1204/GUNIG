<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('PRES_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->PRES_ID),array('view','id'=>$data->PRES_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PRES_NUM_CERTIFICADO')); ?>:</b>
	<?php echo CHtml::encode($data->PRES_NUM_CERTIFICADO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PRES_DESCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->PRES_DESCRIPCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PRES_SECCION')); ?>:</b>
	<?php echo CHtml::encode($data->PRES_SECCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PRES_CODIGO')); ?>:</b>
	<?php echo CHtml::encode($data->PRES_CODIGO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PRES_MONTO')); ?>:</b>
	<?php echo CHtml::encode($data->PRES_MONTO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PRES_FECHA_VIGENCIA')); ?>:</b>
	<?php echo CHtml::encode($data->PRES_FECHA_VIGENCIA); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('PRES_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->PRES_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PRES_FECHA_INGRESO')); ?>:</b>
	<?php echo CHtml::encode($data->PRES_FECHA_INGRESO); ?>
	<br />

	*/ ?>

</div>