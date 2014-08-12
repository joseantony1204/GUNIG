<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'catedraticoscatedras-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($Catedraticoscatedras); ?>
    
    
    <?php 
	$criterio = new CDbCriteria;
	$criterio->order = 'PROG_NOMBRE ASC';    
    ?>
            <?php 
	        echo $form->labelEx($Catedraticoscatedras, 'PROG_ID');
	        $data = CHtml::listData(Programas::model()->findAll($criterio),'PROG_ID','PROG_NOMBRE'); 
			?>
            <?php 
			echo $form->dropDownList($Catedraticoscatedras,'PROG_ID',$data,
              array(
                    'ajax' => array(
                    'type' => 'POST',
                    'url' => CController::createUrl('mdlcatedraticos/persnaturalescatedraticos/loadCdp'),
                    'update' => '#'.CHtml::activeId($Catedraticoscatedras,'CAPR_ID'),
                   ),
					'prompt' => 'Seleccione un programa...',
					'class'=>'span4',
                 )
            );
	?> 
    <?php echo $form->error($Catedraticoscatedras,'PROG_ID'); ?>
    
    <?php echo $form->textFieldRow($Catedraticoscatedras,'CACA_INTENSIDAD',array('class'=>'span2')); ?>
    
    <?php echo $form->labelEx($Catedraticoscatedras,'CAPR_ID'); ?>
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
    <?php echo $form->error($Catedraticoscatedras,'CAPR_ID'); ?>  
    
    <?php echo $form->hiddenField($Catedraticoscatedras,'CACO_ID',array('class'=>'span2')); ?>

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




