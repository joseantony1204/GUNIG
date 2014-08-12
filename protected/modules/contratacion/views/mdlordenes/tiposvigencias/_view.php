<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIVI_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->TIVI_ID),array('view','id'=>$data->TIVI_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIVI_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->TIVI_NOMBRE); ?>
	<br />


</div>