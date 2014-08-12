<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('TICO_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->TICO_ID),array('view','id'=>$data->TICO_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TICO_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->TICO_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TICO_DESCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->TICO_DESCRIPCION); ?>
	<br />


</div>