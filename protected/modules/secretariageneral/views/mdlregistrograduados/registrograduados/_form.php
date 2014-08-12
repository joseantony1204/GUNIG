<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'registrograduados-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
   <?php $libros= new Libros;
   $folios= new Folios;
   $graduados=new Graduados;
    $titulostrabajosgrados=new Titulostrabajosgrados;
		  
   ?>


	<br/>
<table width="440" border="0" >
  <tr>
    <td width="42"><?php echo $form->labelEx($model,'REGR_ACTA'); ?></td>
    <td width="127"><?php echo $form->textField($model,'REGR_ACTA',array('class'=>'span1', 'value'=>$model->getNextActa(), 'disabled'=>TRUE)); ?> <?php echo $form->error($model,'REGR_ACTA'); ?></td>
        <td width="43"><?php echo $form->labelEx($model,'LIBR_ID');?></td>
    <td width="120"><?php echo $form->textField($model,'LIBR_ID',array('class'=>'span1','value'=>$libros->getLibroActivo(), 'disabled'=>TRUE)); ?> <?php echo $form->error($model,'LIBR_ID'); ?></td>
     <td width="40"><?php echo $form->labelEx($model,'FOLI_ID');?></td>
    <td width="42"><?php echo $form->textField($model,'FOLI_ID',array('class'=>'span1','value'=>$folios->getNextFolio(), 'disabled'=>TRUE)); ?> <?php echo $form->error($model,'FOLI_ID'); ?></td>
  </tr>
  </table>

<br/>




<table width="800" border="0"> 
<tr>
<td>
 <?php echo $form->labelEx($model,'FEGR_ID'); ?><?php $data=Fechasgrados::model()->listadoFechasGrados();?></td>
 <td><?php echo $form->dropDownList($model,'FEGR_ID',$data, array('class'=>'span4','prompt'=>'Selecciona...')); ?>
    <?php echo $form->error($model,'FEGR_ID'); ?></td></tr>
 <tr>
<td>
    <?php $list = Graduados::model()->listadoGraduados(); ?>
  	<?php echo $form->labelEx($model,'GRAD_ID'); ?></td>
	<td><?php echo $form->dropDownList($model,'GRAD_ID',$list, array('class'=>'span7','prompt'=>'Selecciona...'));
	
/*	$this->widget('ext.select2.ESelect2',array(
  'name'=>'GRAD_ID',
  'data'=>$list,
  'value'=>$list->GRAD_ID,
  'attribute'=>'GRAD_ID',
  'options'=>array(
    'placeholder'=>'Buscar registro en la base de datos',
    'allowClear'=>true,
	'width'=>'370px',
  ),
)); */ ?>
	  
    </td><td>
          <?php echo $form->error($model,'GRAD_ID'); ?> </td><td><?Php
    $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Agregar Graduado',
        //'type'=>'primary',
        'htmlOptions'=>array(
            'data-toggle'=>'modal',
            'data-target'=>'#myModal',
        ),
    )); ?>
    <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModal')); 
        echo $this->renderPartial('/mdlregistrograduados/graduados/_form',array(
            'model'=>$graduados,
        ));    
    
   $this->endWidget();?>
      </td></tr>
	
</table>

<table width="800" border="0">
  <tr>
    <td><?php echo $form->labelEx($model,'COIC_ID'); ?><?php $data2=Codigosicfes::model()->getListadoCodigosicfes();?>
</td>
    <td>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;   <?php echo $form->dropDownList($model,'COIC_ID',$data2, array('class'=>'span7','prompt'=>'Elije un Titulos...')); ?>
             <?php echo $form->error($model,'COIC_ID'); ?></td>
    </tr>
</table>


  <table width="800" border="0">
  <tr>
    <td width="175"><?php echo $form->labelEx($model,'TITG_ID'); ?></td>
    <td width="609">   <?php $data4=Titulostrabajosgrados::model()->listadoTitulosTrabajosGrados();?>
	<?php echo $form->dropDownList($model,'TITG_ID',$data4, array('class'=>'span7','prompt'=>'Elije un Trabajos de grado...')); 
	
/*	$this->widget('ext.select2.ESelect2',array(
  'name'=>'TITG_ID',
  'data'=>$data4,
  'value'=>$data4->TITG_ID,
  'attribute'=>'TITG_ID',
  'options'=>array(
    'placeholder'=>'Buscar registro en la base de datos',
    'allowClear'=>true,
	'width'=>'370px',
  ),
)); 
*/
?>
	
         <?php echo $form->error($model,'TITG_ID'); ?>
</td><td>
          <?php echo $form->error($model,'GRAD_ID'); ?> </td><td><?Php
    $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Agregar Titulos Trabajos de grado',
       // 'type'=>'primary',
        'htmlOptions'=>array(
            'data-toggle'=>'modal',
            'data-target'=>'#myModal2',
        ),
    )); ?>
    <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModal2')); 
        echo $this->renderPartial('/mdlregistrograduados/titulostrabajosgrados/_form',array(
            'model'=>$titulostrabajosgrados,
        ));    
    
   $this->endWidget();?>
      </td>
  </tr>
</table>

   
     

	

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'icon'=>'ok white',
			'type'=>'success',
			'size'=>'small',
			'label'=>$model->isNewRecord ? 'Crear' : 'Actualizar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</td>
      
     </tr>
    </table>




