<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('NIES_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->NIES_ID),array('view','id'=>$data->NIES_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NIES_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->NIES_NOMBRE); ?>
	<br />


</div>