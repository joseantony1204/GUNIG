<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('TITG_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->TITG_ID),array('view','id'=>$data->TITG_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TITG_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->TITG_NOMBRE); ?>
	<br />


</div>