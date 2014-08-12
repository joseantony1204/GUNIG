<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CRDE_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CRDE_ID),array('view','id'=>$data->CRDE_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CLRE_ID')); ?>:</b>
	<?php echo CHtml::encode($data->CLRE_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DESC_ID')); ?>:</b>
	<?php echo CHtml::encode($data->DESC_ID); ?>
	<br />


</div>