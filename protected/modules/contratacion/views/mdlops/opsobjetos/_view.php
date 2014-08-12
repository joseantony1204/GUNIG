<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('OBJE_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->OBJE_ID),array('view','id'=>$data->OBJE_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OPOB_FECHA_INGRESO')); ?>:</b>
	<?php echo CHtml::encode($data->OPOB_FECHA_INGRESO); ?>
	<br />


</div>