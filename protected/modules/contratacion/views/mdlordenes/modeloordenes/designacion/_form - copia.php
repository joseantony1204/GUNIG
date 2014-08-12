<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'modeloordenes-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>
    
	<table width="100%" border="0">
	  <tr>
	    <td colspan="9"><h5>GENERALIDADES DE LA ORDEN</h5></td>
      
	    </tr>
          
	  <tr>
	    <td colspan="3">&nbsp;</td>
	    <td>&nbsp;</td>
	    <td colspan="5">&nbsp;</td>
	    </tr>
	  <tr>
	    <td colspan="3">
          <div align="left"><?php echo $form->labelEx($Contratos,'TICO_ID'); ?>
            <?php 
              $criterio = new CDbCriteria; 
              $criterio->order = 'TICO_NOMBRE ASC';
           ?>
            <?php 
		      $data = CHtml::listData(Contratostipo::model()->findAll($criterio),'TICO_ID','TICO_NOMBRE');
              echo $form->dropDownList($Contratos,'TICO_ID',$data,
                        array(
                            'ajax' => array(
                             'type' => 'POST',
                             'url' => CController::createUrl('mdlordenes/modeloordenes/clasesc'),
                             'update' => '#'.CHtml::activeId($Contratos,'CLCO_ID'),
                            ),
							'prompt' => 'Seleccione el tipo de contrato',
							'class'=>'span4',
                  )
              );
        ?>
            <?php echo $form->error($Contratos,'TICO_ID'); ?>
            
          </div></td>
	    <td width="47">&nbsp;</td>
	    <td colspan="5">
          <div align="left"><?php echo $form->labelEx($Contratos,'CLCO_ID'); ?>
            <?php 
                $lista_uno = array();
                if(isset($Contratostp->TICO_ID)){
                $id_uno = intval($Contratostp->TICO_ID); 
                $lista_uno = CHtml::listData(Contratosclase::model()->findAll("TICO_ID = '$id_uno'"),'CLCO_ID','CLCO_NOMBRE');
                }
                echo $form->dropDownList($Contratos,'CLCO_ID',$lista_uno,
                        array('class'=>'span4','prompt'=>'Seleccione tipo de contrato')
                        ); ?>
            <?php echo $form->error($Contratos,'CLCO_ID'); ?>    
            
          </div></td>
	    </tr>
	  <tr>
	    <td colspan="3"><div align="left">
	      <?php 
		$data=$Personas->nombrePersonas();   
		$list = CHtml::listData($data,'PERS_ID', 'NOMBRE');  
		echo $form->labelEx($Contratos, 'PERS_ID');
		$this->widget('ext.select2.ESelect2',array(
		  'name'=>'PERS_ID',
		  'data'=>$list,
		  'value'=>$list->PERS_ID,
		  'attribute'=>'PERS_ID',
		  'options'=>array(
			'placeholder'=>'Buscar registro en la base de datos',
			'allowClear'=>true,
			'width'=>'370px',
		  ),
		)); 
		?>
	  <?php //echo $form->error($Contratos,'PERS_ID'); ?>    
	      </div></td>
	    <td>&nbsp;</td>
	    <td colspan="5"><div align="left">
	      <?php 
		$criterio = new CDbCriteria;
		$criterio ->select = 't.PECO_ID, t.PENA_ID, pn.PENA_NOMBRES, pn.PENA_APELLIDOS';
		$criterio->join = '
        INNER JOIN TBL_PERSONASNATURALES pn ON t.PENA_ID = pn.PENA_ID
		AND (MONTH(t.PECO_FECHA_INICIO) = '.date("m").' OR t.PECO_DESCRIPCION = "Rector")';
		$criterio->order = 'pn.PENA_NOMBRES ASC';    
       ?>
	      <?php 
	   echo $form->labelEx($Contratos, 'PECO_ID');
	   $data = CHtml::listData(Contratantes::model()->findAll($criterio),'PECO_ID','rel_personas_naturales.nombreCompleto') ?>
	      <?php echo $form->dropDownList($Contratos,'PECO_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?> <?php echo $form->error($Contratos,'PECO_ID'); ?></div></td>
	    </tr>
	  <tr>
	    <td colspan="3"><div align="left"><?php echo $form->textFieldRow($Modeloordenes,'MOOR_VALOR',array('class'=>'span4')); ?></div></td>
	    <td>&nbsp;</td>
	    <td colspan="2"><div align="left"><h5>DURACION</h5></div></td>
	    <td width="28"><?php echo $form->textFieldRow($Modeloordenes,'MOOR_ANIOS',array('class'=>'span1')); ?></td>
	    <td width="35"><div align="left"><?php echo $form->textFieldRow($Modeloordenes,'MOOR_MESES',array('class'=>'span1')); ?></div></td>
	    <td width="103"><div align="left"><?php echo $form->textFieldRow($Modeloordenes,'MOOR_DIAS',array('class'=>'span1')); ?></div></td>
	    </tr>
	  <tr>
	    <td colspan="3">&nbsp;</td>
	    <td>&nbsp;</td>
	    <td colspan="3"><div align="left">
	      <?php /*echo $form->labelEx($Contratos,'CONT_FECHA_INICIO'); ?>
          <?php
     if ($Contratos->CONT_FECHA_INICIO=='') {
     $Contratos->CONT_FECHA_INICIO = date('Y-m-d');
     }else{
		 if ($Contratos->CONT_FECHA_INICIO=='0000-00-00') {
		  $Contratos->CONT_FECHA_INICIO = date('Y-m-d');
		  }
		  }
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$Contratos,
     'attribute'=>'CONT_FECHA_INICIO',
     'value'=>$Contratos->CONT_FECHA_INICIO,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$Contratos->CONT_FECHA_INICIO,
     'dateFormat'=>'yy-mm-dd',
     'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
     'buttonImageOnly'=>true,
     'buttonText'=>'Fecha Ingreso',
     'selectOtherMonths'=>true,
     'showAnim'=>'slide',
     'showButtonPanel'=>true,
     'showOn'=>'button',
     'showOtherMonths'=>true,
     'changeMonth' => 'true',
     'changeYear' => 'true',
     ),
     )); ?>
          <?php echo $form->error($Contratos,'CONT_FECHA_INICIO'); */?>
	      </div></td>
          <?php echo $form->hiddenField($Contratos,'CONT_FECHA_PROCESO',array('value'=>date("Y-m-d").' '.date("h:i:s"),));?>
          
           <?php echo $form->hiddenField($Contratos,'CONT_ANIO',array('value'=>date("Y"),));?>
        
          
	    <td colspan="2"><div align="left">
	      <?php /*echo*/  $form->textFieldRow($Contratos,'CONT_FECHA_FINAL',array('class'=>'span2')); ?>
	      </div></td>
	    </tr>
	  <tr>
	    <td colspan="3"><div align="left">
         
        <?php echo $form->textFieldRow($Formcontratosformatos,'FCCO_ID',array('class'=>'span4')); ?>
         <?php //echo $form->hiddenField($Modeloordenes,'FCCO_ID',array('class'=>'span4')); ?>
         
         
         </div></td>
	    <td>&nbsp;</td>
	    <td colspan="5"><div align="left">
		
        
		<?php echo $form->labelEx($Modeloordenes,'TIVI_ID'); ?>
            <?php 
              $criterio = new CDbCriteria; 
              $criterio->order = 'TIVI_NOMBRE ASC';
           ?>
            <?php 
		      $data = CHtml::listData(Tiposvigencias::model()->findAll($criterio),'TIVI_ID','TIVI_NOMBRE');
              echo $form->dropDownList($Modeloordenes,'TIVI_ID',$data,
                        array(
                            'ajax' => array(
                             'type' => 'POST',
                             'url' => CController::createUrl('mdlordenes/modeloordenes/clasesc'), 
                            
                            ),
							'prompt' => 'Seleccionar vigencia de la Orden u Contrato',
							'class'=>'span4',
                  )
              );
        ?>
          <?php echo $form->error($Modeloordenes,'TIVI_ID'); ?> 
          
          
          
          </div></td>
	    </tr>
	  <tr>
	    <td colspan="9"><?php echo $form->textAreaRow($Modeloordenes,'MOOR_OBJETO',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
        </td>
	    </tr>
	  <tr>
	    <td colspan="9">&nbsp;</td>
	    </tr>
	  <tr>
	    <td colspan="9"><h5>DISPONIBILIDAD PRESUPUESTAL</h5></td>
	    </tr>
	  <tr>
	    <td colspan="2">&nbsp;</td>
	    <td width="26">&nbsp;</td>
	    <td>&nbsp;</td>
	    <td width="116">&nbsp;</td>
	    <td colspan="3">&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td width="36"><?php echo $form->textFieldRow($Presupuestos,'PRES_NUM_CERTIFICADO',array('class'=>'span2')); ?></td>
	    <td width="14">&nbsp;</td>
        <td colspan="2"><?php echo $form->textFieldRow($Presupuestos,'PRES_SECCION',array('class'=>'span2')); ?></td>
	    <td colspan="5"><?php echo $form->textFieldRow($Presupuestos,'PRES_CODIGO',array('class'=>'span2')); ?></td>
	    
        
        </tr>
	  <tr>
	    <td colspan="2"><?php echo $form->textFieldRow($Presupuestos,'PRES_MONTO',array('class'=>'span2')); ?></td>
	    <td colspan="2">
	      <?php echo $form->textFieldRow($Presupuestos,'PRES_DESCRIPCION',array('class'=>'span2')); ?></td>
	    <td colspan="3">
	      <?php echo $form->labelEx($Presupuestos,'PRES_FECHA_VIGENCIA'); ?>
	      <?php 
     if ($Presupuestos->PRES_FECHA_VIGENCIA=='') {
     $Presupuestos->PRES_FECHA_VIGENCIA = date('Y-m-d');
     }else{
		 if ($Presupuestos->PRES_FECHA_VIGENCIA=='0000-00-00') {
		  $Presupuestos->PRES_FECHA_VIGENCIA = date('Y-m-d');
		  }
		  }
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$Presupuestos,
     'attribute'=>'PRES_FECHA_VIGENCIA',
     'value'=>$Presupuestos->PRES_FECHA_VIGENCIA,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$Presupuestos->PRES_FECHA_VIGENCIA,
     'dateFormat'=>'yy-mm-dd',
     'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
     'buttonImageOnly'=>true,
     'buttonText'=>'Fecha de Vigencia del CDP',
     'selectOtherMonths'=>true,
     'showAnim'=>'slide',
     'showButtonPanel'=>true,
     'showOn'=>'button',
     'showOtherMonths'=>true,
     'changeMonth' => 'true',
     'changeYear' => 'true',
     ),
     )); ?>
	      <?php echo $form->error($Presupuestos,'PRES_FECHA_VIGENCIA'); ?>
	      
	      
	      </td>
	    </tr>
	  <tr>
	    <td colspan="3">  
        </td>
	    <td></td>
	    <td colspan="5"></td>
	    </tr>
	  <tr>
	    <td colspan="9"><h5>SUPERVISIÓN Y CONTROL</h5></td>
	    </tr>
	  <tr>
	    <td colspan="3">&nbsp;</td>
	    <td>&nbsp;</td>
	    <td colspan="5">&nbsp;</td>
	    </tr>
	  <tr>
	    <td colspan="3"> 
         <?php 
		$data=$Personas->nombrePersonas();   
		$list = CHtml::listData($data,'PERS_ID', 'NOMBRE');  
		echo $form->labelEx($Supervisores, 'PERS_ID');
		$this->widget('ext.select2.ESelect2',array(
		  'name'=>'PERSU_ID',
		  'data'=>$list,
		  'value'=>$list->PERSU_ID,
		  'attribute'=>'PERSU_ID',
		  'options'=>array(
			'placeholder'=>'Elegir supervisor',
			'allowClear'=>true,
			'width'=>'370px',
		  ),
		)); 
		?>
       <?php //echo $form->error($Supervisores,'PERS_ID'); ?> 
        </td>
	    <td>&nbsp;</td>
	    <td colspan="5">
         <?php 
		/*$data=$Supervisores->cargos();   
		$list = CHtml::listData($data,'CARG_ID', 'CARG_NOMBRE');  
		echo $form->labelEx($Supervisores, 'CARG_ID');
		$this->widget('ext.select2.ESelect2',array(
		  'name'=>'CARG_ID',
		  'data'=>$list,
		  'value'=>$list->CARG_ID,
		  'attribute'=>'CARG_ID',
		  'options'=>array(
			'placeholder'=>'Elegir el cargo del supervisor',
			'allowClear'=>true,
			'width'=>'370px',
		  ),
		)); */
		?>
        <?php echo $form->labelEx($Supervisores,'CARG_ID'); ?>
            <?php 
              $criterio = new CDbCriteria; 
              $criterio->order = 'CARG_NOMBRE ASC';
           ?>
            <?php 
		      $data = CHtml::listData(Cargos::model()->findAll($criterio),'CARG_ID','CARG_NOMBRE');
              echo $form->dropDownList($Supervisores,'CARG_ID',$data,
                        array(
                            'ajax' => array(
                             'type' => 'POST',
                             'url' => CController::createUrl('mdlordenes/modeloordenes/clasesc'), 
                            
                            ),
							'prompt' => 'Elegir el cargo del supervisor',
							'class'=>'span4',
                  )
              );
        ?> 
       <?php echo $form->error($Supervisores,'CARG_ID'); ?> 
         <?php //echo $form->textFieldRow($Presupuestos,'PRES_NOMBRE',array('class'=>'span2')); ?>    
		 <?php echo $form->hiddenField($Presupuestosordenes,'PRES_ID',array('class'=>'span2')); ?>
        <?php echo $form->hiddenField($Presupuestos,'PRES_FECHA_INGRESO',array('value'=>date("Y-m-d").' '.date("h:i:s"),));?>
        </td>
	    </tr>
	  <tr>
	 
	    <td>&nbsp;</td>
	    <td colspan="5">&nbsp;</td>
	    </tr>
	  </table>
	<p class="note">
	<?php echo $form->errorSummary($Contratos); ?>
	<?php echo $form->errorSummary($Modeloordenes); ?>
    
    <?php echo $form->errorSummary($Formcontratosformatos); ?>
    
    <?php echo $form->errorSummary($Supervisores); ?>    
    <?php echo $form->errorSummary($Presupuestos); ?>
    <?php echo $form->errorSummary($Presupuestosordenes); ?>
	</p>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'icon'=>'ok white',
			'type'=>'success',
			'size'=>'small',
			'label'=>$Modeloordenes->isNewRecord ? 'Crear' : 'Actualizar',
		)); ?>
	</div>
<?php $this->endWidget(); ?>
</td>
     </tr>
    </table>