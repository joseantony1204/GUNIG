<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('TUSP_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->TUSP_ID),array('view','id'=>$data->TUSP_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TUSP_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->TUSP_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TUPR_ID')); ?>:</b>
	<?php echo CHtml::encode($data->TUPR_ID); ?>
	<br />


</div>