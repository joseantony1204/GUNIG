<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('RAEX_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->RAEX_ID),array('view','id'=>$data->RAEX_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RAEX_FECHARECIBIDO')); ?>:</b>
	<?php echo CHtml::encode($data->RAEX_FECHARECIBIDO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RAEX_GUIAENVIO')); ?>:</b>
	<?php echo CHtml::encode($data->RAEX_GUIAENVIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RAEX_NUMERODOCUMENTO')); ?>:</b>
	<?php echo CHtml::encode($data->RAEX_NUMERODOCUMENTO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RAEX_FECHADOCUMENTO')); ?>:</b>
	<?php echo CHtml::encode($data->RAEX_FECHADOCUMENTO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RAEX_ASUNTO')); ?>:</b>
	<?php echo CHtml::encode($data->RAEX_ASUNTO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RAEX_NUMEROANEXOS')); ?>:</b>
	<?php echo CHtml::encode($data->RAEX_NUMEROANEXOS); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('RAEX_ESCANEORUTA')); ?>:</b>
	<?php echo CHtml::encode($data->RAEX_ESCANEORUTA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RAEX_ESTADO')); ?>:</b>
	<?php echo CHtml::encode($data->RAEX_ESTADO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EMCO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->EMCO_ID); ?>
	<br />

	*/ ?>

</div>