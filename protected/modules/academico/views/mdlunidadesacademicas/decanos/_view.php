<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('DECA_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->DECA_ID),array('view','id'=>$data->DECA_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FACU_ID')); ?>:</b>
	<?php echo CHtml::encode($data->FACU_ID); ?>
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


</div>