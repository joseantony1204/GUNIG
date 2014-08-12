<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIDV_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->TIDV_ID),array('view','id'=>$data->TIDV_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIDO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->TIDO_ID); ?>
	<br />


</div>