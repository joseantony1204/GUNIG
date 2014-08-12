<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('RAIN_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->RAIN_ID),array('view','id'=>$data->RAIN_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RAIN_FECHA')); ?>:</b>
	<?php echo CHtml::encode($data->RAIN_FECHA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RAIN_ASUNTO')); ?>:</b>
	<?php echo CHtml::encode($data->RAIN_ASUNTO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RAIN_ESCANEORUTA')); ?>:</b>
	<?php echo CHtml::encode($data->RAIN_ESCANEORUTA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RAIN_NUMEROANEXOS')); ?>:</b>
	<?php echo CHtml::encode($data->RAIN_NUMEROANEXOS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RAIN_ESTADO')); ?>:</b>
	<?php echo CHtml::encode($data->RAIN_ESTADO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RAIN_TIPO')); ?>:</b>
	<?php echo CHtml::encode($data->RAIN_TIPO); ?>
	<br />


</div>