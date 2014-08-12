<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ENEX_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ENEX_ID),array('view','id'=>$data->ENEX_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ENEX_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->ENEX_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ENEX_CIUDAD')); ?>:</b>
	<?php echo CHtml::encode($data->ENEX_CIUDAD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ENEX_TELEFONO')); ?>:</b>
	<?php echo CHtml::encode($data->ENEX_TELEFONO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ENEX_DIRECCION')); ?>:</b>
	<?php echo CHtml::encode($data->ENEX_DIRECCION); ?>
	<br />


</div>