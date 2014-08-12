<?php
$this->breadcrumbs=array(
	'Modulo Secretaria General'=>array('/secretariageneral/'),
	'Panel Registro Graduados'=>array('registrograduadoscpanel/'),
	'Registro Graduados'=>array('admin'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Registrograduados','url'=>array('index')),
	array('label'=>'Create Registrograduados','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('registrograduados-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<table width="100%" border="0" align="center">
  <tr>
    <td><table width="100%" border="0" align="center">
      <tr>
        <td>
        <fieldset>
          <table width="100%" border="0" align="center">
            <tr>
              <td width="6%" align="center">
              <?php 			 
			 $imageUrl = Yii::app()->request->baseUrl . '/images/secretariageneral/registrograduados.png';
			  echo $image = CHtml::image($imageUrl); 
			  ?>         
			               
              </td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE REGISTROGRADUADOS</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('registrograduadoscpanel/',),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/excel.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Exportar a Excel');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlregistrograduados/registrograduados/excel',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlregistrograduados/registrograduados/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlregistrograduados/registrograduados/create',),$htmlOptions ); 
?>         
		 </td>
            </tr>
          </table>
          </fieldset>
          </td>
      </tr>
    </table></td>
  </tr>
  <tr>
   <td colspan="2">
<?php echo CHtml::link('Busqueda Avanzada','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none" >
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
   </td>
  </tr>
  <tr>
    <td>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'registrograduados-grid',
	'dataProvider'=>$model->search(),
'type'=>'striped bordered condensed',
'filter'=>$model,
	'columns'=>array(
	/*	'REGR_ID',
		'GRAD_ID',
		'FOLI_ID',
		'LIBR_ID',
		'FEGR_ID',*/
		/*
		'TITU_ID',
		'RECT_ID',
		'SEGE_ID',
		'DECA_ID',
		'PROG_ID',
		'FACU_ID',
		'TITG_ID',
		*/
		
		array(
		'name' =>'REGR_ACTA',
		'value'=>'$data->REGR_ACTA',
		'htmlOptions'=>array('width'=>'2'),
		),
		array(
		'name' =>'LIBR_ID',
		'value'=>'$data->LIBR_ID',
		'htmlOptions'=>array('width'=>'2'),
		),
		array(
		'name' =>'FOLI_ID',
		'value'=>'$data->rel_folios->FOLI_NOMBRE',
		'htmlOptions'=>array('width'=>'5'),
		 'filter'=>Folios::getListadoFolios(),
		),

		array(
		'name' =>'GRAD_CEDULA',
		'value'=>'$data->rel_graduados->GRAD_CEDULA',
		'htmlOptions'=>array('width'=>'10'),
              'filter'=>Graduados::getListadoCedulas(),

		),
		
           array(
		'name' =>'GRAD_NOMBRES',
		'value'=>'$data->rel_graduados->GRAD_NOMBRES',
		'htmlOptions'=>array('width'=>'10'),
		'filter'=>Graduados::getListadoNombres(),

		),
		array(
		'name' =>'GRAD_PRIMER_APELLIDO',
		'value'=>'$data->rel_graduados->GRAD_PRIMER_APELLIDO',
		'htmlOptions'=>array('width'=>'20'),
		'filter'=>Graduados::getListadoPrimerApellidos(),

		),
		array(
		'name' =>'GRAD_SEGUNDO_APELLIDO',
		'value'=>'$data->rel_graduados->GRAD_SEGUNDO_APELLIDO',
		'htmlOptions'=>array('width'=>'20'),
		'filter'=>Graduados::getListadoSegundoApellido(),

		),
		
		array(
		'name' =>'FACU_ID',
		'value'=>'$data->rel_facultades->FACU_NOMBRE',
		'htmlOptions'=>array('width'=>'5'),
		'filter'=>Facultades::getListadoFacultades(),
		),
		array(
		'name' =>'PROG_ID',
		'value'=>'$data->rel_programas->PROG_NOMBRE',
		'htmlOptions'=>array('width'=>'5'),
		'filter'=>Programas::getListadoProgramas(),
		),
		array(
		'name' =>'SEDE_ID',
		'value'=>'$data->rel_sedes->SEDE_NOMBRE',
		'htmlOptions'=>array('width'=>'5'),
		'filter'=>Sedes::getSedes(),
		),
		/*array(
		'name' =>'FEGR_ID',
		'value'=>'Yii::app()->dateformatter->format("dd-MM-yyyy",$data->rel_fechasgrados->FEGR_FECHA)',
		'htmlOptions'=>array('width'=>'10'),
		),
		*/
	/*	array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
			  'header'=>'Acciones',
              'template'=>'{update}',	
			  'template'=>'{pdf}&nbsp;{view}{update}',
			 'buttons'=>array(       
               'pdf' => array(
			    'label'=>'Descargar Contrato',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/cont_desc.png',
				'url'=>'Yii::app()->controller->createUrl("view", array("id"=>$data[REGR_ID], "pdf"=>"pdf"))',
				),
			   ),				  
			),
	),
)); ?> */

array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
			  'header'=>'Acciones',
              'template'=>'{update}&nbsp;',	
			  'template'=>'{pdf}&nbsp;{acta}&nbsp;{view}&nbsp;{update}',
			 'buttons'=>array(       
               'pdf' => array(
			    'label'=>'Descargar Contrato',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/cont_desc.png',
				'url'=>'Yii::app()->controller->createUrl("view", array("id"=>$data[REGR_ID], "pdf"=>"pdf"))',
				),
				'acta' => array(
                                            'label' => Yii::t('int', 'Descargar ACTAS'),
                                            'url' => 'Yii::app()->controller->createUrl("mdlregistrograduados/registrograduados/acta",array("id"=>$data[REGR_ID]))',
                                            'imageUrl' => Yii::app()->baseurl.'/images/secretariageneral/cont_desc2.png',
                                            ),
			   ),				  
			),
	),
)); ?>


    </td>
  </tr>
</table>
