<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('RELI_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->RELI_ID),array('view','id'=>$data->RELI_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RELI_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->RELI_NOMBRE); ?>
	<br />


</div>