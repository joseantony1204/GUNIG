<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CACO_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CACO_ID),array('view','id'=>$data->CACO_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CACO_ANIO')); ?>:</b>
	<?php echo CHtml::encode($data->CACO_ANIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CACO_VALORHORA')); ?>:</b>
	<?php echo CHtml::encode($data->CACO_VALORHORA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CACO_FECHAPROCESO')); ?>:</b>
	<?php echo CHtml::encode($data->CACO_FECHAPROCESO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CACO_NUMORDEN')); ?>:</b>
	<?php echo CHtml::encode($data->CACO_NUMORDEN); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PECO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PECO_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PENC_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PENC_ID); ?>
	<br />


</div>