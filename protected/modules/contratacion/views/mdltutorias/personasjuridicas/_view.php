<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('PEJU_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->PEJU_ID),array('view','id'=>$data->PEJU_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PEJU_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->PEJU_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PEJU_OBJETOCOMERCIAL')); ?>:</b>
	<?php echo CHtml::encode($data->PEJU_OBJETOCOMERCIAL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_ID); ?>
	<br />


</div>