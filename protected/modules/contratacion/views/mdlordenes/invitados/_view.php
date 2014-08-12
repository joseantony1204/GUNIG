<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('INVI_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->INVI_ID),array('view','id'=>$data->INVI_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('INVI_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->INVI_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('INVI_DIRECCION')); ?>:</b>
	<?php echo CHtml::encode($data->INVI_DIRECCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('INVI_LUGAR')); ?>:</b>
	<?php echo CHtml::encode($data->INVI_LUGAR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('INVI_TELEFONO')); ?>:</b>
	<?php echo CHtml::encode($data->INVI_TELEFONO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('INV_DESCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->INV_DESCRIPCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MOOR_ID')); ?>:</b>
	<?php echo CHtml::encode($data->MOOR_ID); ?>
	<br />


</div>