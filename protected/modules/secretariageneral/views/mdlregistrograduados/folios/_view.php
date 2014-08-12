<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('FOLI_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->FOLI_ID),array('view','id'=>$data->FOLI_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FOLI_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->FOLI_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LIBR_ID')); ?>:</b>
	<?php echo CHtml::encode($data->LIBR_ID); ?>
	<br />


</div>