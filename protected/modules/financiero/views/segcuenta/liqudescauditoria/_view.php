<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('LDAU_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->LDAU_ID),array('view','id'=>$data->LDAU_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LDAU_TARIFA')); ?>:</b>
	<?php echo CHtml::encode($data->LDAU_TARIFA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LDAU_ACCION')); ?>:</b>
	<?php echo CHtml::encode($data->LDAU_ACCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LDAU_FECHAPROCESO')); ?>:</b>
	<?php echo CHtml::encode($data->LDAU_FECHAPROCESO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LIQU_ID')); ?>:</b>
	<?php echo CHtml::encode($data->LIQU_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DESC_ID')); ?>:</b>
	<?php echo CHtml::encode($data->DESC_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USUA_ID')); ?>:</b>
	<?php echo CHtml::encode($data->USUA_ID); ?>
	<br />


</div>