<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('SECU_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->SECU_ID),array('view','id'=>$data->SECU_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SECU_ESTADO')); ?>:</b>
	<?php echo CHtml::encode($data->SECU_ESTADO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SECU_FECHAINGRESO')); ?>:</b>
	<?php echo CHtml::encode($data->SECU_FECHAINGRESO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SECU_NUMORDENPAGO')); ?>:</b>
	<?php echo CHtml::encode($data->SECU_NUMORDENPAGO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SECU_VRORDENPAGO')); ?>:</b>
	<?php echo CHtml::encode($data->SECU_VRORDENPAGO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SECU_CODIGOCDP')); ?>:</b>
	<?php echo CHtml::encode($data->SECU_CODIGOCDP); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SECU_NUMCHECQUE')); ?>:</b>
	<?php echo CHtml::encode($data->SECU_NUMCHECQUE); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('SECU_VALORCHEQUE')); ?>:</b>
	<?php echo CHtml::encode($data->SECU_VALORCHEQUE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SECU_FECHAPAGO')); ?>:</b>
	<?php echo CHtml::encode($data->SECU_FECHAPAGO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SEUD_ID')); ?>:</b>
	<?php echo CHtml::encode($data->SEUD_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CUEN_ID')); ?>:</b>
	<?php echo CHtml::encode($data->CUEN_ID); ?>
	<br />

	*/ ?>

</div>