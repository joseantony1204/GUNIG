<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('DEPE_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->DEPE_ID),array('view','id'=>$data->DEPE_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DEPE_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->DEPE_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SEDE_ID')); ?>:</b>
	<?php echo CHtml::encode($data->SEDE_ID); ?>
	<br />


</div>