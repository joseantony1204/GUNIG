<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CONT_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CONT_ID),array('view','id'=>$data->CONT_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CONT_NUMORDEN')); ?>:</b>
	<?php echo CHtml::encode($data->CONT_NUMORDEN); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CONT_ANIO')); ?>:</b>
	<?php echo CHtml::encode($data->CONT_ANIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CONT_FECHAINICIO')); ?>:</b>
	<?php echo CHtml::encode($data->CONT_FECHAINICIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CONT_FECHAFINAL')); ?>:</b>
	<?php echo CHtml::encode($data->CONT_FECHAFINAL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CONT_FECHAPROCESO')); ?>:</b>
	<?php echo CHtml::encode($data->CONT_FECHAPROCESO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_ID); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('PECO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PECO_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TICO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->TICO_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CLCO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->CLCO_ID); ?>
	<br />

	*/ ?>

</div>