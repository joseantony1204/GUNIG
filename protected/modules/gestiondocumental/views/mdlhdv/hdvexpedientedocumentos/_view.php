<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('HEXD_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->HEXD_ID),array('view','id'=>$data->HEXD_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HEXD_RUTA')); ?>:</b>
	<?php echo CHtml::encode($data->HEXD_RUTA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HEXD_FECHAINGRESO')); ?>:</b>
	<?php echo CHtml::encode($data->HEXD_FECHAINGRESO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HTDO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->HTDO_ID); ?>
	<br />


</div>