<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('RELE_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->RELE_ID),array('view','id'=>$data->RELE_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PEJU_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PEJU_ID); ?>
	<br />


</div>