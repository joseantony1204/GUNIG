<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('RECT_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->RECT_ID),array('view','id'=>$data->RECT_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PENA_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PENA_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RECT_FECHA_INICIO')); ?>:</b>
	<?php echo CHtml::encode($data->RECT_FECHA_INICIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RECT_FECHA_FIN')); ?>:</b>
	<?php echo CHtml::encode($data->RECT_FECHA_FIN); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RECT_ESTADO')); ?>:</b>
	<?php echo CHtml::encode($data->RECT_ESTADO); ?>
	<br />


</div>