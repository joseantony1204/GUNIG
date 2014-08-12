<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('JORN_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->JORN_ID),array('view','id'=>$data->JORN_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('JORN_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->JORN_NOMBRE); ?>
	<br />


</div>