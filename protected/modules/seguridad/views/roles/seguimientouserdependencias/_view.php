<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('SEUD_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->SEUD_ID),array('view','id'=>$data->SEUD_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USUA_ID')); ?>:</b>
	<?php echo CHtml::encode($data->USUA_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DEPE_ID')); ?>:</b>
	<?php echo CHtml::encode($data->DEPE_ID); ?>
	<br />


</div>