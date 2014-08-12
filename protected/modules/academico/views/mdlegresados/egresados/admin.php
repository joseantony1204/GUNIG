<?php
$this->breadcrumbs=array(
	'Egresados'=>array('index'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Egresados','url'=>array('index')),
	array('label'=>'Create Egresados','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('egresados-grid', {
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
			 $imageUrl = Yii::app()->request->baseUrl . '/images/user.png';
			  echo $image = CHtml::image($imageUrl); 
			  ?>         
			               
              </td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE EGRESADOS</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('egresadoscpanel/index',),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlegresados/egresados/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlegresados/egresados/create',),$htmlOptions ); 
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
	'id'=>'egresados-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
	    array('name'=>'EGRE_ID', 'value'=>'$data->EGRE_ID', 'htmlOptions'=>array('width'=>'20'),),
	    array('name'=>'EGRE_LIBRO', 'value'=>'$data->EGRE_LIBRO', 'htmlOptions'=>array('width'=>'20'),),
	    array('name'=>'EGRE_FOLIO', 'value'=>'$data->EGRE_FOLIO', 'htmlOptions'=>array('width'=>'20'),),
	    array('name'=>'EGRE_PRIMERNOMBRE', 'value'=>'$data->EGRE_PRIMERNOMBRE', 'htmlOptions'=>array('width'=>'100'),),
	    array('name'=>'EGRE_SEGUNDONOMBRE', 'value'=>'$data->EGRE_SEGUNDONOMBRE', 'htmlOptions'=>array('width'=>'100'),),
        array('name'=>'EGRE_PRIMERAPELLIDO', 'value'=>'$data->EGRE_PRIMERAPELLIDO', 'htmlOptions'=>array('width'=>'100'),),
		array('name'=>'EGRE_SEGUNDOAPELLIDO', 'value'=>'$data->EGRE_SEGUNDOAPELLIDO', 'htmlOptions'=>array('width'=>'100'),),
		//'EGRE_DIRECCION',
		//'DEPA_IDPROGRAMA',
		//'MUNI_IDPROGRAMA',
		array('name'=>'EGRE_ACTAGRADO', 'value'=>'$data->EGRE_ACTAGRADO', 'htmlOptions'=>array('width'=>'20'),),
		array('name'=>'TIID_ID', 'value'=>'$data->tIID->TIID_NOMBRE','htmlOptions'=>array('width'=>'300'),),
		'EGRE_NUMEROIDENTIFICACION',		
		array('name'=>'MUNI_IDCEDULA', 'value'=>'$data->mUNI->MUNI_NOMBRE','htmlOptions'=>array('width'=>'300'),),
		array('name'=>'FEGR_ID', 'value'=>'$data->fEGR->FEGR_FECHA','htmlOptions'=>array('width'=>'400'),),
		//array('name'=>'EGRE_TRABAJOGRADO', 'value'=>'$data->EGRE_TRABAJOGRADO', 'htmlOptions'=>array('width'=>'700'),),
		//'EGRE_CODIGOIES',
		//array('name'=>'ANAC_ID', 'value'=>'$data->aNAC->ANAC_NOMBRE','htmlOptions'=>array('width'=>'300'),),
		//'EGRE_SEMESTREINGRESO',
		//'EGRE_TRANSFERENCIA',
		//'EGRE_ANIOREPORTE',
		//'EGRE_SEMESTREREPORTE',
		//'EGRE_ECAES',
		//'EGRE_RESULTADOECAES',
		//'EGRE_OBSERVACIONESECAES',
		//'EGRE_FECHANACIMIENTO',
		//'EGRE_TELEFONO',
		//'EGRE_EMAIL',
		//'EGRE_LABORA',
		//array('name'=>'DEPA_ID', 'value'=>'$data->dEPA->DEPA_NOMBRE','htmlOptions'=>array('width'=>'300'),),
		//array('name'=>'MUNI_ID', 'value'=>'$data->mUNI->MUNI_NOMBRE','htmlOptions'=>array('width'=>'300'),),
		//'EGRE_EMPRESALABORA',
		//array('name'=>'PAIS_ID', 'value'=>'$data->pAIS->PAIS_NOMBRE','htmlOptions'=>array('width'=>'300'),),
		//array('name'=>'PRSE_ID', 'value'=>'$data->pRSE->PRSE_NOMBRE','htmlOptions'=>array('width'=>'300'),),
		//array('name'=>'SELA_ID', 'value'=>'$data->sELA->SELA_NOMBRE','htmlOptions'=>array('width'=>'300'),),
		array('name'=>'SEXO_ID', 'value'=>'$data->sEXO->SEXO_NOMBRE','htmlOptions'=>array('width'=>'300'),),
		array('name'=>'PROG_ID', 'value'=>'$data->pROG->PROG_NOMBRE','htmlOptions'=>array('width'=>'300'),),
		//array('name'=>'ESCI_ID', 'value'=>'$data->eSCI->ESCI_NOMBRE','htmlOptions'=>array('width'=>'300'),),
		        
        array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{view}{update}{delete}',			  
			),
	),
)); ?>

    </td>
  </tr>
</table>
