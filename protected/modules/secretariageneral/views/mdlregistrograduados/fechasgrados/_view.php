<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('FEGR_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->FEGR_ID),array('view','id'=>$data->FEGR_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FEGR_FECHA')); ?>:</b>
	<?php echo CHtml::encode($data->FEGR_FECHA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FEGR_ESTADO')); ?>:</b>
	<?php echo CHtml::encode($data->FEGR_ESTADO); ?>
	<br />


</div>