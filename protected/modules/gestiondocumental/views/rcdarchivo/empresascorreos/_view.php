<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('EMCO_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->EMCO_ID),array('view','id'=>$data->EMCO_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EMCO_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->EMCO_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EMCO_TELEFONO')); ?>:</b>
	<?php echo CHtml::encode($data->EMCO_TELEFONO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EMCO_DIRECCION')); ?>:</b>
	<?php echo CHtml::encode($data->EMCO_DIRECCION); ?>
	<br />


</div>