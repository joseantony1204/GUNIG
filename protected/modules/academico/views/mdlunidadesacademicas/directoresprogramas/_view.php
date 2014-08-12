<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('DIPR_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->DIPR_ID),array('view','id'=>$data->DIPR_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PROG_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PROG_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SEDE_ID')); ?>:</b>
	<?php echo CHtml::encode($data->SEDE_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PENA_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PENA_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DIRP_FECHA_INICIO')); ?>:</b>
	<?php echo CHtml::encode($data->DIRP_FECHA_INICIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DIRP_FECHA_FIN')); ?>:</b>
	<?php echo CHtml::encode($data->DIRP_FECHA_FIN); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DIPR_ESTADO')); ?>:</b>
	<?php echo CHtml::encode($data->DIPR_ESTADO); ?>
	<br />


</div>