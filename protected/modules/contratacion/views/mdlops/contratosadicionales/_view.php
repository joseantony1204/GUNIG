<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('COAD_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->COAD_ID),array('view','id'=>$data->COAD_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COAD_NUMADICIONAL')); ?>:</b>
	<?php echo CHtml::encode($data->COAD_NUMADICIONAL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COAD_MESES')); ?>:</b>
	<?php echo CHtml::encode($data->COAD_MESES); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COAD_DIAS')); ?>:</b>
	<?php echo CHtml::encode($data->COAD_DIAS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COAD_VALOR')); ?>:</b>
	<?php echo CHtml::encode($data->COAD_VALOR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COAD_FECHAPROCESO')); ?>:</b>
	<?php echo CHtml::encode($data->COAD_FECHAPROCESO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COAD_FECHAELABORACION')); ?>:</b>
	<?php echo CHtml::encode($data->COAD_FECHAELABORACION); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('PECO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PECO_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIAD_ID')); ?>:</b>
	<?php echo CHtml::encode($data->TIAD_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CONT_ID')); ?>:</b>
	<?php echo CHtml::encode($data->CONT_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ADPR_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ADPR_ID); ?>
	<br />

	*/ ?>

</div>