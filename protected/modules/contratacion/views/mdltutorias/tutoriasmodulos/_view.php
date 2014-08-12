<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('TUMT_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->TUMT_ID),array('view','id'=>$data->TUMT_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TUTO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->TUTO_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TUMO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->TUMO_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TUMT_GRUPO')); ?>:</b>
	<?php echo CHtml::encode($data->TUMT_GRUPO); ?>
	<br />


</div>