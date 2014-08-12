<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CLAU_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CLAU_ID),array('view','id'=>$data->CLAU_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CLAU_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->CLAU_NOMBRE); ?>
	<br />


</div>