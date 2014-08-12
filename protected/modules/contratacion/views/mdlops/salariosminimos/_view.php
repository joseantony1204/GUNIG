<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('SAMI_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->SAMI_ID),array('view','id'=>$data->SAMI_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SAMI_VALOR')); ?>:</b>
	<?php echo CHtml::encode($data->SAMI_VALOR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SAMI_ANIO')); ?>:</b>
	<?php echo CHtml::encode($data->SAMI_ANIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SAMI_VALORX30')); ?>:</b>
	<?php echo CHtml::encode($data->SAMI_VALORX30); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SAMI_FECGA_INGRESO')); ?>:</b>
	<?php echo CHtml::encode($data->SAMI_FECGA_INGRESO); ?>
	<br />


</div>