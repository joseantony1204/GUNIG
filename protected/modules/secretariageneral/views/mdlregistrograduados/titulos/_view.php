<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('TITU_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->TITU_ID),array('view','id'=>$data->TITU_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TITU_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->TITU_NOMBRE); ?>
	<br />


</div>