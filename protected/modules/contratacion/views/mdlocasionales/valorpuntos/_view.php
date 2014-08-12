<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('VAPU_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->VAPU_ID),array('view','id'=>$data->VAPU_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('VAPU_VALOR')); ?>:</b>
	<?php echo CHtml::encode($data->VAPU_VALOR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('VAPU_VALORENLETRAS')); ?>:</b>
	<?php echo CHtml::encode($data->VAPU_VALORENLETRAS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('VAPU_ANIO')); ?>:</b>
	<?php echo CHtml::encode($data->VAPU_ANIO); ?>
	<br />


</div>