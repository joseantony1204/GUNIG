<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('RDAU_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->RDAU_ID),array('view','id'=>$data->RDAU_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RDAU_TARIFA')); ?>:</b>
	<?php echo CHtml::encode($data->RDAU_TARIFA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RDAU_ACCION')); ?>:</b>
	<?php echo CHtml::encode($data->RDAU_ACCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RDAU_FECHAPROCESO')); ?>:</b>
	<?php echo CHtml::encode($data->RDAU_FECHAPROCESO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RESO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->RESO_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DESC_ID')); ?>:</b>
	<?php echo CHtml::encode($data->DESC_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USUA_ID')); ?>:</b>
	<?php echo CHtml::encode($data->USUA_ID); ?>
	<br />


</div>