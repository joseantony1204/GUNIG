<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CACA_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CACA_ID),array('view','id'=>$data->CACA_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CACA_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->CACA_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CACA_INTENSIDAD')); ?>:</b>
	<?php echo CHtml::encode($data->CACA_INTENSIDAD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CACA_INTENSIDADENLETRAS')); ?>:</b>
	<?php echo CHtml::encode($data->CACA_INTENSIDADENLETRAS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CACA_ESTADO')); ?>:</b>
	<?php echo CHtml::encode($data->CACA_ESTADO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PROG_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PROG_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CAPR_ID')); ?>:</b>
	<?php echo CHtml::encode($data->CAPR_ID); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('CACO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->CACO_ID); ?>
	<br />

	*/ ?>

</div>