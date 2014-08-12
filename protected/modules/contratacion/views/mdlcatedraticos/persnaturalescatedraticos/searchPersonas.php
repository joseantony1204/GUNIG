<?php
Yii::app()->homeUrl = array('/contratacion/');
$this->breadcrumbs=array(
	'Modulo Contratación'=>array('/contratacion/'),
	'Panel'=>array('/contratacion/catedraticoscpanel/'),
	'Docentes Catedraticos'=>array('mdlcatedraticos/persnaturalescatedraticos/admin'),
	'Buscar Persona a agregar contrato',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('opscontratos-grid', {
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
            <?php         
		      $imageUrl = Yii::app()->request->baseUrl . '/images/user.png';
		    ?>
              <td width="6%" align="center"><?php echo $image = CHtml::image($imageUrl); ?></td>
             <td><strong><span><em>BUSQUEDA DE REGISTROS EN LA BASE DE DATOS</em></span></strong></td>

<td width="7%" align="center">
<?php       
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcatedraticos/persnaturalescatedraticos/admin',),$htmlOptions ); 
?>
</td>

<td width="7%" align="center">
<?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcatedraticos/persnaturalescatedraticos/searchPersonas',),$htmlOptions ); 
?></td>
            </tr>
          </table>
          </fieldset>
          </td>
      </tr>
    </table></td>
  </tr>  
  <tr>
    <td>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'opscontratos-grid',
	'dataProvider'=>$Personasnaturales->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$Personasnaturales, 
	'columns'=>array(
	array('name'=>'TIID_ID', 'value'=>'$data->rel_personas->rel_tipos_identificacion->TIID_NOMBRE', 
		'filter'=>Tiposidentificacion::getTiposidentificacion()),
		'PERS_IDENTIFICACION',
		'PENA_NOMBRES',
		'PENA_APELLIDOS',				
	array(
          'class'=>'bootstrap.widgets.TbButtonColumn',
          'template'=>'{ver}',
		  'buttons' => array(
							 'ver' => array(
                                            'label' => Yii::t("int", "Crear contrato como docente ocasional"),
                                            'url' => 'Yii::app()->controller->createUrl("mdlcatedraticos/persnaturalescatedraticos/create",
											                                              array("id"=>$data->PENA_ID))',
                                            'imageUrl' => Yii::app()->baseurl.'/images/ir.png',
											'click' => 'function(data) 
											  {        
												if(!confirm('.CJavaScript::encode(Yii::t('int', 
												 '¿Seguro que quiere crear un contrato a esta persona?')) . ')) return false;
													$.ajax(
														   {
															type: "GET",
														   }
														   );
											   }',
                                            ),  
							 )			  
		 ),
		 
	),
)); ?>

    </td>
  </tr>
</table>
