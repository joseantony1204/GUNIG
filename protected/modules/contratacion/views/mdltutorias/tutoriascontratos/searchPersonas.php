<?php
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'cpanel Tutorias'=>array('tutoriascpanel/'),
	'Contratos Tutorias',
);

/*
$this->menu=array(
	array('label'=>'List Opscontratos','url'=>array('index')),
	array('label'=>'Create Opscontratos','url'=>array('create')),
);
*/

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
             <td><strong><span><em>BUSQUEDA DE REGISTROS</em></span></strong></td>

<td width="7%" align="center">
<?php       
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltutorias/tutoriascontratos/admin',),$htmlOptions ); 
?>
</td>

<td width="7%" align="center">
<?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltutorias/tutoriascontratos/searchPersonas',),$htmlOptions ); 
?></td>
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
   <?php $this->renderPartial('_searchPersonas',array(
	'Personas'=>$Personas,
    )); ?> 
  </div><!-- search-form -->
   </td>
  </tr>  
   
  <tr>
    <td>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'opscontratos-grid',
	'dataProvider'=>$Personas->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$Personas, 
	'columns'=>array(
	array('name'=>'PERS_ID', 'filter'=>false, 'value'=>'$data->PERS_ID','htmlOptions'=>array('width'=>'20'),),
	array('name'=>'TIID_ID', 'filter'=>false, 'value'=>'$data->rel_tipos_identificacion->TIID_NOMBRE',
	'filter'=>Personas::getTiposidentificacion(),'htmlOptions'=>array('width'=>'120'),),	
	array('name'=>'PERS_IDENTIFICACION', 'value'=>'$data->PERS_IDENTIFICACION','htmlOptions'=>array('width'=>'100'),),
	array('name'=>'NOMBRE', 'filter'=>false, 'value'=>'$data->nombrePersona','htmlOptions'=>array('width'=>'230'),),
	array('name'=>'PERS_DIRECCION', 'filter'=>false, 'value'=>'$data->PERS_DIRECCION','htmlOptions'=>array('width'=>'150'),),
				
	array(
          'class'=>'bootstrap.widgets.TbButtonColumn',
          'template'=>'{ver}',
		  'buttons' => array(
							 'ver' => array(
                                            'label' => Yii::t("int", "Crear contrato"),
                                            'url' => 'Yii::app()->controller->createUrl("mdltutorias/tutoriascontratos/create",array(
											                                                                        "id"=>$data->PERS_ID))',
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
