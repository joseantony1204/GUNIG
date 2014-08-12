<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('COPRO_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->COPRO_ID),array('view','id'=>$data->COPRO_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SEDE_ID')); ?>:</b>
	<?php echo CHtml::encode($data->SEDE_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PENA_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PENA_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DECA_FECHA_INICIO')); ?>:</b>
	<?php echo CHtml::encode($data->DECA_FECHA_INICIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DECA_FECHA_FIN')); ?>:</b>
	<?php echo CHtml::encode($data->DECA_FECHA_FIN); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COPRO_ESTADO')); ?>:</b>
	<?php echo CHtml::encode($data->COPRO_ESTADO); ?>
	<br />


</div>