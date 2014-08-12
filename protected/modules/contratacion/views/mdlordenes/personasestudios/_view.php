<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('PEES_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->PEES_ID),array('view','id'=>$data->PEES_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ESTU_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ESTU_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_IDENTIFICACION')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_IDENTIFICACION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PEES_LUGAR')); ?>:</b>
	<?php echo CHtml::encode($data->PEES_LUGAR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PEES_FECHA')); ?>:</b>
	<?php echo CHtml::encode($data->PEES_FECHA); ?>
	<br />


</div>