<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'persnaturalescatedraticos-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	  <?php echo $form->errorSummary($Persnaturalescatedraticos); ?>
      <?php echo $form->errorSummary($Catedraticoscontratos); ?>
      <?php echo $form->errorSummary($Catedraticoscatedras); ?> 
      
	<table width="100%" border="0">
	  <tr>
	    <td>
        <h5>DATOS BASICOS DEL DOCENTE CATEDRÁTICO</h5>
        <fieldset>
        <table width="100%" border="0">
          <tr>
            <td>
			 <?php 
	          echo $form->labelEx($Persnaturalescatedraticos, 'PENA_ID'); 
	          echo $form->textField($Persnaturalescatedraticos,'NOMBREPERSONA',
	          array('readonly'=>"readonly",'class'=>'span4','disabled'=>'disabled')); 
	         ?>
		    </td>
            <td><?php echo $form->hiddenField($Persnaturalescatedraticos,'PENA_ID',array('class'=>'span3')); ?></td>
            <td>
			<?php 
			     $data = CHtml::listData(Categorias::model()->findAll(),'CATE_ID','CATE_NOMBRE');
				 echo $form->labelEx($Persnaturalescatedraticos, 'CATE_ID');
			?>
            <?php echo $form->dropDownList($Persnaturalescatedraticos,'CATE_ID',$data, array('class'=>'span3','prompt'=>'Elige...')); ?> 
			<?php echo $form->error($Persnaturalescatedraticos,'CATE_ID'); ?></td>
          </tr>
          <tr>
            <td>
			<?php echo $form->error($Persnaturalescatedraticos,'PENC_FECHAINGRESO'); ?>
			<?php echo $form->labelEx($Persnaturalescatedraticos,'PENC_FECHAINGRESO'); ?>
              <?php
             if ($Persnaturalescatedraticos->PENC_FECHAINGRESO=='') {
             $Persnaturalescatedraticos->PENC_FECHAINGRESO = date('Y-m-d');
             }else{
                 if($Persnaturalescatedraticos->PENC_FECHAINGRESO=='0000-00-00') {
                  $Persnaturalescatedraticos->PENC_FECHAINGRESO = date('Y-m-d');
                  }
                  }
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
             'model'=>$Persnaturalescatedraticos,
             'attribute'=>'PENC_FECHAINGRESO',
             'value'=>$Persnaturalescatedraticos->PENC_FECHAINGRESO,
             'language' => 'es',
             'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
                 
             'options'=>array(
             'autoSize'=>true,
             'defaultDate'=>$Persnaturalescatedraticos->PENC_FECHAINGRESO,
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
             )); ?></td>
            <td>&nbsp;</td>
            <td>
			<?php $criterio = array('join'=>'WHERE t.PEAC_ESTADO = 0');  
	        echo $form->labelEx($Persnaturalescatedraticos, 'PEAC_ID');
	        $data = CHtml::listData(Periodosacademicos::model()->findAll($criterio),'PEAC_ID','PEAC_NOMBRE') ?>
            <?php echo $form->dropDownList($Persnaturalescatedraticos,'PEAC_ID',$data, array('class'=>'span3','prompt'=>'Elige...')); ?> 
			<?php echo $form->error($Persnaturalescatedraticos,'PEAC_ID'); ?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        </fieldset>
        </td>
	  </tr>
	  <tr>
	    <td>&nbsp;</td>
	  </tr>
	  <tr>
	    <td>
        
        <h5>DATOS BASICOS PARA CREAR EL CONTRATO</h5>
        <fieldset>
        <table width="100%" border="0">
          <tr>
            <td width="33%">
			
			<?php 
		    $criterio = new CDbCriteria;
		    $criterio ->select = 't.PECO_ID, t.PENA_ID, pn.PENA_NOMBRES, pn.PENA_APELLIDOS';
		    $criterio->join = '
            INNER JOIN TBL_PERSONASNATURALES pn ON t.PENA_ID = pn.PENA_ID
		    AND (MONTH(t.PECO_FECHAINICIO) = '.date("m").' OR t.PECO_DESCRIPCION = "Rector")';
		    $criterio->order = 'pn.PENA_NOMBRES ASC';  
            ?>
            <?php 
	        echo $form->labelEx($Catedraticoscontratos, 'PECO_ID');
	        $data = CHtml::listData(Contratantes::model()->findAll($criterio),'PECO_ID','rel_personas_naturales.nombreCompleto');
			?>
            <?php echo $form->dropDownList($Catedraticoscontratos,'PECO_ID',$data, array('class'=>'span4','prompt'=>'Elige...')); ?> 
		    <?php echo $form->error($Catedraticoscontratos,'PECO_ID'); ?>
            
            </td>
            <td width="25%">&nbsp;</td>
            <td width="42%"><?php echo $form->textFieldRow($Catedraticoscontratos,'CACO_NUMORDEN',array('class'=>'span2')); ?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>
			<?php 
		    $criterio = new CDbCriteria;
		    $criterio->order = 'CATC_NOMBRE ASC';    
            ?>
            <?php 
	        echo $form->labelEx($Catedraticoscontratos, 'CATC_ID');
	        $data = CHtml::listData(Catedraticostiposcontratos::model()->findAll($criterio),'CATC_ID','CATC_NOMBRE'); 
			?>
              <?php 
			echo $form->dropDownList($Catedraticoscontratos,'CATC_ID',$data,
              array(
                    'prompt' => 'Seleccione un tipo de contrato...',
					'class'=>'span4',
                 )
            );
			 ?>
              <?php echo $form->error($Catedraticoscontratos,'CATC_ID'); ?></td>
            <td>
            <?php echo $form->error($Catedraticoscontratos,'CACO_FECHAPROCESO'); ?>
            <?php $fecha = date("Y-m-d")." ".date("h:i:s  A"); ?>
            <?php echo $form->hiddenField($Catedraticoscontratos,'CACO_FECHAPROCESO',array('value'=>$fecha)); ?>
            </td>
            <td>&nbsp;</td>
          </tr>
        </table>
        </fieldset>
         
        </td>
	  </tr>
      
      <tr>
       <td>
       
       <h5>DATOS BASICOS PARA CREAR CATEDRA</h5>
        <fieldset>
        <table width="100%" border="0">
          <tr>
            <td width="33%">
           <?php echo $form->labelEx($Facultades,'FACU_ID'); ?>
           <?php 
              $criterio = new CDbCriteria; 
              $criterio->order = 'FACU_NOMBRE ASC';
           ?>
           <?php 
		      $data = CHtml::listData(Facultades::model()->findAll($criterio),'FACU_ID','FACU_NOMBRE');
              echo $form->dropDownList($Facultades,'FACU_ID',$data,
                        array(
                            'ajax' => array(
                             'type' => 'POST',
                             'url' => CController::createUrl('mdlcatedraticos/persnaturalescatedraticos/cargarProgramas'),
                             'update' => '#'.CHtml::activeId($Catedraticoscatedras,'PROG_ID'),
                            ),
							'prompt' => 'Elige...',
							'class'=>'span4',
                  )
              );
        ?>
        <?php echo $form->error($Facultades,'FACU_ID'); ?>
            
            </td>            
            <td width="25%">&nbsp;</td>
            <td width="42%">
            <?php echo $form->labelEx($Catedraticoscatedras,'PROG_ID'); ?>
		    <?php 
            $lista_uno = array();
            if(isset($Facultades->FACU_ID)){
            $id_uno = intval($Facultades->FACU_ID); 
            $lista_uno = CHtml::listData(Programas::model()->findAll("FACU_ID = '$id_uno'","order = 'PROG_NOMBRE ASC'"),'PROG_ID','PROG_NOMBRE');
            }
            echo $form->dropDownList($Catedraticoscatedras,'PROG_ID',$lista_uno,
                        array(
                              'ajax' => array(
                              'type' => 'POST',
                              'url' => CController::createUrl('mdlcatedraticos/persnaturalescatedraticos/loadCdp'),
                              'update' => '#'.CHtml::activeId($Catedraticoscatedras,'CAPR_ID'),
                              ),
					    'prompt' => 'Seleccione una facultad...',
					    'class'=>'span4',
                        )
            ); 
		    ?>
            <?php echo $form->error($Catedraticoscatedras,'PROG_ID'); ?> 
          </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><?php echo $form->labelEx($Catedraticoscatedras,'CAPR_ID'); ?>
              <?php 
                $lista_uno = array();
                if(isset($Catedraticoscatedras->PROG_ID)){
                $filtro = intval($Catedraticoscatedras->PROG_ID);
				$criteria = new CDbCriteria();
		        $anio = date("Y");
		        $criteria->select='t.CAPR_ID, p.PRES_NOMBRE';
                $criteria->condition = 'pr.PROG_ID = :id_uno';
		        $criteria->join = '
			                       INNER JOIN TBL_FACULTADES  f ON t.FACU_ID = f.FACU_ID
			                       INNER JOIN TBL_PROGRAMAS  pr ON f.FACU_ID = pr.FACU_ID
			                       INNER JOIN TBL_PRESUPUESTOS  p ON t.PRES_ID = p.PRES_ID AND t.CAPR_FECHAINGRESO LIKE "'.$anio.'%"';
                $criteria->params = array(':id_uno' => (int) $filtro);
                $criteria->order = 't.FACU_ID ASC';
                $lista_uno = CHtml::listData(Catedraticospresupuestos::model()->findAll($criteria),'CAPR_ID','PRES_NOMBRE');
                }
                echo $form->dropDownList($Catedraticoscatedras,'CAPR_ID',$lista_uno,
                        array('class'=>'span4','prompt'=>'Seleccione un programa...')
                        ); 
		  ?>
              <?php echo $form->error($Catedraticoscatedras,'CAPR_ID'); ?></td>
            <td>&nbsp;</td>
            <td><?php echo $form->textFieldRow($Catedraticoscatedras,'CACA_INTENSIDAD',array('class'=>'span2')); ?></td>
          </tr>
        </table>
        </fieldset>
       
       </td>
       </tr>
      
      
	  </table>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'icon'=>'ok white',
			'type'=>'success',
			'size'=>'small',
			'label'=>$Catedraticoscatedras->isNewRecord ? 'Crear' : 'Actualizar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</td>
      
     </tr>
    </table>

