<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'acreditacionponderaciones-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
	'rowCssClass'=>array('odd', 'even'),    
    'rowCssClassExpression' =>  'acreditacionponderaciones::visto_bueno($data) < 20 ? $this->rowCssClass[1] : $this->rowCssClass[0]',	
    'filter'=>$model,
	'columns'=>array(
		//'ACPO_ID',
		/*  array( 	'name'=>'ACPO_GRUPO1',
		  			'type'=>'raw',    
		  			'value'=>'CHtml::link($data["ACPO_GRUPO1"], array("mdlacreditacion/acreditacionponderaciones/update", "id"=>$data["ACPO_GRUPO1"]),array("width"=>"10"))',
				), */

		'ACPO_GRUPO1',
		'ACPO_GRUPO2',
		'ACPO_GRUPO3',
		'ACPO_GRUPO4',
		'ACPO_GRUPO5',
	

		array( 'header'=>'PROMEDIO', 'value'=>'acreditacionponderaciones::promedio($data)', 'filter'=>false,'htmlOptions'=>array('width'=>'10'),),
		array( 'header'=>'DESVIACIÓN ESTD.', 'value'=>'acreditacionponderaciones::standard_deviation($data,false)', 'filter'=>false,'htmlOptions'=>array('width'=>'10'),),
		array( 'header'=>'COEF. VARIACIÓN', 'value'=>'acreditacionponderaciones::coeficiente_variacion($data)', 'filter'=>false,'htmlOptions'=>array('width'=>'10'),),
		array( 'header'=>'Vo.Bo.', 'value'=>'acreditacionponderaciones::visto_bueno($data)', 'filter'=>false,'htmlOptions'=>array('width'=>'10'),),
	//	array( 'header'=>'SUMATORIA', 'value'=>'acreditacionponderaciones::sumatoria($data)', 'filter'=>false,'htmlOptions'=>array('width'=>'10'),),
				
		/*
		'ACCA_ID',
		'ACPO_FECHA',
		'USUA_ID',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
