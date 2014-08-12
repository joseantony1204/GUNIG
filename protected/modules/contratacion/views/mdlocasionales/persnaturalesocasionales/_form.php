<script type="text/javascript">
$(document).ready(function(){
   
$('#Persnaturalesocasionales_PENO_PUNTOS').keyup(function() {
   var PENO_PUNTOS = $("#Persnaturalesocasionales_PENO_PUNTOS").val();
   var VALOR_PUNTOS = $("#Persnaturalesocasionales_PENO_VALORPUNTO").val();
   
   var resultado = parseInt((PENO_PUNTOS)*(VALOR_PUNTOS)) ;
   $("#Persnaturalesocasionales_PENO_SUELDO").val(resultado);
   $("#Ocasionalescontratos_OCCO_VALORMENSUAL").val(resultado); 
});   
   
   
});
</script>
 
<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'persnaturalesocasionales-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	  <?php echo $form->errorSummary($Persnaturalesocasionales); ?>
	  <?php echo $form->errorSummary($Ocasionalescontratos); ?>
	<table width="100%" border="0">
	  <tr>
	    <td>
        <h5>DATOS BASICOS DEL DOCENTE OCASIONAL</h5>
        <fieldset>
        <table width="100%" border="0">
          <tr>
            <td width="34%">
			 <?php 
			  echo $form->labelEx($Persnaturalesocasionales, 'PENA_ID'); 
		      echo $form->textField($Persnaturalesocasionales,'NOMBREPERSONA',
			  array('readonly'=>"readonly",'class'=>'span4','disabled'=>'disabled')); 
			 ?>
		    </td>
            <td width="33%"><?php echo $form->hiddenField($Persnaturalesocasionales,'PENA_ID',array('class'=>'span4')); ?></td>
            <td width="33%">
		<?php echo $form->labelEx($Persnaturalesocasionales,'FACU_ID'); ?>
        <?php 
         $criterio = new CDbCriteria; 
         $criterio->order = 'FACU_NOMBRE ASC';
        ?>
        <?php 
		 $data = CHtml::listData(Facultades::model()->findAll($criterio),'FACU_ID','FACU_NOMBRE');
         echo $form->dropDownList($Persnaturalesocasionales,'FACU_ID',$data,
              array(
                    'ajax' => array(
                    'type' => 'POST',
                    'url' => CController::createUrl('mdlocasionales/persnaturalesocasionales/loadCdp'),
                    'update' => '#'.CHtml::activeId($Ocasionalescontratos,'OCPR_ID'),
                   ),
					'prompt' => 'Seleccione una Facultad...',
					'class'=>'span4',
                 )
            );
        ?>
        <?php echo $form->error($Persnaturalesocasionales,'FACU_ID'); ?>
            </td>
          </tr>
          <tr>
            <td><?php echo $form->textFieldRow($Persnaturalesocasionales,'PENO_PUNTOS',array('class'=>'span2')); ?></td>
            <td>&nbsp;</td>
            <td><?php echo $form->textFieldRow($Persnaturalesocasionales,'PENO_SUELDO',
			    array('class'=>'span2','readonly'=>'readonly')); ?></td>
          </tr>
          <tr>
            <td><?php echo $form->textFieldRow($Persnaturalesocasionales,'PENO_VALORPUNTO',
			     array('class'=>'span2','readonly'=>'readonly')); ?></td>
            <td>&nbsp;</td>
            <td><?php $criterio = array('join'=>'WHERE t.PEAC_ESTADO = 0');  
	            echo $form->labelEx($Persnaturalesocasionales, 'PEAC_ID');
	            $data = CHtml::listData(Periodosacademicos::model()->findAll($criterio),'PEAC_ID','PEAC_NOMBRE') ?>
                <?php echo $form->dropDownList($Persnaturalesocasionales,'PEAC_ID',$data, array('class'=>'span3',)); ?> 
				<?php echo $form->error($Persnaturalesocasionales,'PEAC_ID'); ?>            
            </td>
          </tr>
          <tr>
            <td>
            <?php echo $form->labelEx($Persnaturalesocasionales,'PENO_FECHAINGRESO'); ?>
			 <?php
             if ($Persnaturalesocasionales->PENO_FECHAINGRESO=='') {
             $Persnaturalesocasionales->PENO_FECHAINGRESO = date('Y-m-d');
             }else{
                 if($Persnaturalesocasionales->PENO_FECHAINGRESO=='0000-00-00') {
                  $Persnaturalesocasionales->PENO_FECHAINGRESO = date('Y-m-d');
                  }
                  }
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
             'model'=>$Persnaturalesocasionales,
             'attribute'=>'PENO_FECHAINGRESO',
             'value'=>$Persnaturalesocasionales->PENO_FECHAINGRESO,
             'language' => 'es',
             'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
                 
             'options'=>array(
             'autoSize'=>true,
             'defaultDate'=>$Persnaturalesocasionales->PENO_FECHAINGRESO,
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
             <?php echo $form->error($Persnaturalesocasionales,'PENO_FECHAINGRESO'); ?>
            </td>
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
            <td><?php echo $form->textFieldRow($Ocasionalescontratos,'OCCO_RESOLUCION',array('class'=>'span2')); ?></td>
            <td>&nbsp;</td>
            <td><?php echo $form->textFieldRow($Ocasionalescontratos,'OCCO_VALORMENSUAL',
			    array('class'=>'span2','readonly'=>'readonly')); ?></td>
          </tr>
          <tr>
            <td><?php echo $form->textFieldRow($Ocasionalescontratos,'OCCO_MESES',array('class'=>'span2')); ?></td>
            <td>&nbsp;</td>
            <td><?php echo $form->textFieldRow($Ocasionalescontratos,'OCCO_DIAS',array('class'=>'span2',)); ?></td>
          </tr>
          <tr>
            <td>        
          <?php echo $form->labelEx($Ocasionalescontratos,'OCPR_ID'); ?>
          <?php 
                $lista_uno = array();
                if(isset($Persnaturalesocasionales->FACU_ID)){
                $filtro = intval($Persnaturalesocasionales->FACU_ID);
				$criteria = new CDbCriteria();
		        $anio = date("Y");
		        $criteria->select='t.OCPR_ID, p.PRES_NOMBRE'; 
				$criteria->condition = 't.FACU_ID = :id_uno';
				$criteria->join = '
			     INNER JOIN TBL_FACULTADES  f ON t.FACU_ID = f.FACU_ID
			     INNER JOIN TBL_PRESUPUESTOS  p ON t.PRES_ID = p.PRES_ID AND t.OCPR_FECHAINGRESO LIKE "'.$anio.'%"';
				$criteria->params = array(':id_uno' => (int) $filtro);
                $criteria->order = 't.FACU_ID ASC';
                $lista_uno = CHtml::listData(Ocasionalespresupuestos::model()->findAll($criteria),'OCPR_ID','PRES_NOMBRE');
                }
                echo $form->dropDownList($Ocasionalescontratos,'OCPR_ID',$lista_uno,
                        array('class'=>'span4','prompt'=>'Seleccione una facultad')
                        ); ?>
          <?php echo $form->error($Ocasionalescontratos,'OCPR_ID'); ?>
            </td>
            <td>&nbsp;</td>
            <td>
            <?php 
		    $criterio = new CDbCriteria;
		    $criterio ->select = 't.PECO_ID, t.PENA_ID, pn.PENA_NOMBRES, pn.PENA_APELLIDOS';
		    $criterio->join = '
            INNER JOIN TBL_PERSONASNATURALES pn ON t.PENA_ID = pn.PENA_ID
		    AND (MONTH(t.PECO_FECHAINICIO) = '.date("m").' OR t.PECO_DESCRIPCION = "Rector")';
		    $criterio->order = 'pn.PENA_NOMBRES ASC';    
            ?>
	      
	     <?php 
	     echo $form->labelEx($Ocasionalescontratos, 'PECO_ID');
	     $data = CHtml::listData(Contratantes::model()->findAll($criterio),'PECO_ID','rel_personas_naturales.nombreCompleto') ?>
	     <?php echo $form->dropDownList($Ocasionalescontratos,'PECO_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?>
	     <?php echo $form->error($Ocasionalescontratos,'PECO_ID'); ?>
            </td>
          </tr>
        </table>
        </fieldset>
          <?php echo $form->error($Ocasionalescontratos,'OCCO_FECHAPROCESO'); ?>
          <?php $fecha = date("Y-m-d")." ".date("h:i:s  A"); ?>
          <?php echo $form->hiddenField($Ocasionalescontratos,'OCCO_FECHAPROCESO',array('value'=>$fecha)); ?>
        </td>
	  </tr>
	  </table>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'icon'=>'ok white',
			'type'=>'success',
			'size'=>'small',
			'label'=>$Ocasionalescontratos->isNewRecord ? 'Crear' : 'Actualizar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</td>
      
     </tr>
    </table>