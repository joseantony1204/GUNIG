<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('PEAC_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->PEAC_ID),array('view','id'=>$data->PEAC_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PEAC_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->PEAC_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PEAC_FECHA_INICIO')); ?>:</b>
	<?php echo CHtml::encode($data->PEAC_FECHA_INICIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PEAC_FECHA_FINAL')); ?>:</b>
	<?php echo CHtml::encode($data->PEAC_FECHA_FINAL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PEAC_ESTADO')); ?>:</b>
	<?php echo CHtml::encode($data->PEAC_ESTADO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ANAC_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ANAC_ID); ?>
	<br />


</div>