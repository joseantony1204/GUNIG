<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ASIG_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ASIG_ID),array('view','id'=>$data->ASIG_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ASIG_CODIGO')); ?>:</b>
	<?php echo CHtml::encode($data->ASIG_CODIGO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ASIG_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->ASIG_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ASIG_NUMERO_CREDITOS')); ?>:</b>
	<?php echo CHtml::encode($data->ASIG_NUMERO_CREDITOS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PROG_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PROG_ID); ?>
	<br />


</div>