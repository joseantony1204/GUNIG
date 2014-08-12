<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CLRE_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CLRE_ID),array('view','id'=>$data->CLRE_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CLRE_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->CLRE_NOMBRE); ?>
	<br />


</div>