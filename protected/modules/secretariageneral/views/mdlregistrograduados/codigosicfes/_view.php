<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('COIC_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->COIC_ID),array('view','id'=>$data->COIC_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COIC_CODIGO')); ?>:</b>
	<?php echo CHtml::encode($data->COIC_CODIGO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COIC_NORMA_APROBACION_UNIGUAJIRA')); ?>:</b>
	<?php echo CHtml::encode($data->COIC_NORMA_APROBACION_UNIGUAJIRA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COIC_NORMA_APROBACION_ICFES')); ?>:</b>
	<?php echo CHtml::encode($data->COIC_NORMA_APROBACION_ICFES); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COIC_FECHA_VENCIMIENTO')); ?>:</b>
	<?php echo CHtml::encode($data->COIC_FECHA_VENCIMIENTO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COIC_ESTADO')); ?>:</b>
	<?php echo CHtml::encode($data->COIC_ESTADO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('JORN_ID')); ?>:</b>
	<?php echo CHtml::encode($data->JORN_ID); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('METO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->METO_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TITU_ID')); ?>:</b>
	<?php echo CHtml::encode($data->TITU_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PROG_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PROG_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SEDE_ID')); ?>:</b>
	<?php echo CHtml::encode($data->SEDE_ID); ?>
	<br />

	*/ ?>

</div>