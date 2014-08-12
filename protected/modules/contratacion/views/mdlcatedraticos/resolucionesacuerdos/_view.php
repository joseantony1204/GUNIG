<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('REAC_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->REAC_ID),array('view','id'=>$data->REAC_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('REAC_NUMERO')); ?>:</b>
	<?php echo CHtml::encode($data->REAC_NUMERO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('REAC_FECHA')); ?>:</b>
	<?php echo CHtml::encode($data->REAC_FECHA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('REAC_DESCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->REAC_DESCRIPCION); ?>
	<br />


</div>