<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('LIBR_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->LIBR_ID),array('view','id'=>$data->LIBR_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LIBR_ESTADO')); ?>:</b>
	<?php echo CHtml::encode($data->LIBR_ESTADO); ?>
	<br />


</div>