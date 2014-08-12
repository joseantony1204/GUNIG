<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('METO_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->METO_ID),array('view','id'=>$data->METO_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('METO_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->METO_NOMBRE); ?>
	<br />


</div>