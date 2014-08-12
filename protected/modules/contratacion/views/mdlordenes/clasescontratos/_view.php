<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CLCO_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CLCO_ID),array('view','id'=>$data->CLCO_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CLCO_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->CLCO_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CLCO_DESCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->CLCO_DESCRIPCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TICO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->TICO_ID); ?>
	<br />


</div>