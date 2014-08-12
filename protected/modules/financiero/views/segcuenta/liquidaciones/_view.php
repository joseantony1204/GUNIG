<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('LIQU_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->LIQU_ID),array('view','id'=>$data->LIQU_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LIQU_FECHA')); ?>:</b>
	<?php echo CHtml::encode($data->LIQU_FECHA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CUEN_ID')); ?>:</b>
	<?php echo CHtml::encode($data->CUEN_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ANAC_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ANAC_ID); ?>
	<br />


</div>