<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('USPE_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->USPE_ID),array('view','id'=>$data->USPE_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USPE_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->USPE_NOMBRE); ?>
	<br />


</div>