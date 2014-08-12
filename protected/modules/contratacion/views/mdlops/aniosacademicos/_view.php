<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ANAC_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ANAC_ID),array('view','id'=>$data->ANAC_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ANAC_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->ANAC_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ANAC_FECHA_INICIO')); ?>:</b>
	<?php echo CHtml::encode($data->ANAC_FECHA_INICIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ANAC_FECHA_FINAL')); ?>:</b>
	<?php echo CHtml::encode($data->ANAC_FECHA_FINAL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ANAC_ESTADO')); ?>:</b>
	<?php echo CHtml::encode($data->ANAC_ESTADO); ?>
	<br />


</div>