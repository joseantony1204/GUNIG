<table border="0" width="100%">
     <tr>
      <td width="90%">         
	  	
				<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
					'id'=>'escaneados-form',
					'enableAjaxValidation'=>false,
					'type'=>'vertical',
					'htmlOptions'=>array('class'=>'well','enctype'=>'multipart/form-data'),
					'enableClientValidation'=>false,
					'clientOptions'=>array(
						'validateOnSubmit'=>false,),
				)); ?>
			
				<p class="note">Seleccione el archivo a cargar.</p>
				<?php echo $form->errorSummary($model); ?>
			
				<?php
					echo $form->fileField($model,'ARCHIVO',array('class'=>'span5'));
					echo $form->error($model, 'ARCHIVO');
				?>
				<?php echo $form->hiddenField($model,'LIRE_ID',array('class'=>'span5')); ?>				 					
			
				<div class="form-actions">
					<?php $this->widget('bootstrap.widgets.TbButton', array(
						'buttonType'=>'submit',
						'icon'=>'ok white',
						'type'=>'success',
						'size'=>'small',
						'label'=>'Cargar',
					)); ?>
				</div>
				
			<?php $this->endWidget(); ?>

		</td>      
     </tr>
</table>




