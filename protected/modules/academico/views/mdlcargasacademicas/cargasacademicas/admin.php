<?php
$this->breadcrumbs=array(
	'Modulo Académico'=>array('/academico/'),
	'Panel Carga Académica'=>array('cargasacademicascpanel/'),
	'Carga Académica Semestre'=>array('admin'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Cargasacademicas','url'=>array('index')),
	array('label'=>'Create Cargasacademicas','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('cargasacademicas-grid', {
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
			 $imageUrl = Yii::app()->request->baseUrl . '/images/academico/carga.png';
			  echo $image = CHtml::image($imageUrl); 
			  ?>         
			               
              </td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE CARGA ACADÉMICA SEMESTRE</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('cargasacademicascpanel/',),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcargasacademicas/cargasacademicas/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

        
		 $imageUrl = Yii::app()->request->baseUrl . '/images/descargar_pdf.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Descargar en PDF');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcargasacademicas/cargasacademicas/download',),$htmlOptions ); 
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
<?php 

//'filter'=>$model->getPersonas(), 'htmlOptions'=>array('width'=>'300'
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'tutoriascontratos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
   'filter'=>$model,
	'columns'=>array(
    array('name'=>'PRCA_ID', 'value'=>'$data->PRCA_ID', 'htmlOptions'=>array('width'=>'2'),),
	
			
	  array('name'=>'PENA_ID',
	   'type'=>'html',
	   'filter'=>$model->getPersonas(),
	   'value'=>'$data->NOMBRE_DOCENTE."&nbsp;&nbsp;&nbsp;&nbsp;".CHtml::link(CHtml::image(Yii::app()->baseurl."/images/icon_cuentas.png"), array("mdlcargasacademicas/personasnaturalesestudios/admin","id"=>$data[PENA_ID],))',
			  'htmlOptions'=>array(
			                       'style'=>'text-align: left','width'=>'300',
								   'title' => 'Ver Estudios',
								   'alt' => 'Ver Estudios'
								  ),  ),
		 
	 array('name'=>'TICD_ID', 'value'=>'$data->rel_tipovinculaciondocente->TICD_NOMBRE', 'filter'=>$model->getTipoVinculacionDocente(), 'htmlOptions'=>array('width'=>'170'),),
	 
	 array('name'=>'HDDIRECTA',
	   'type'=>'html',
	    'filter'=>false,
	   'value'=>'"&nbsp;&nbsp;&nbsp;".CHtml::link(($data->HDDIRECTA),Yii::app()->createUrl("academico/mdlcargasacademicas/cargarasignaturasdocente/detail",
	array("id"=>$data->PENA_ID)), array("style"=>"text-align: left","width"=>"2","title" => "Total Horas SEMANA","alt" => "Total Horas SEMANA"))."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".
	CHtml::link(($data->HDDIRECTA*4),"",array("style"=>"text-align: left","width"=>"2","title" => "Total Horas MES","alt" => "Total Horas MES"))."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".
	CHtml::link(($data->HDDIRECTA*16),"",array("style"=>"text-align: left","width"=>"2","title" => "Total Horas SEMESTRE","alt" => "Total Horas SEMESTRE"))',
	 'htmlOptions'=>array('style'=>'text-align: left','width'=>'120',), ),
	 
	 
	  array('name'=>'HINVESTIGACION',
	   'type'=>'html',
	   'filter'=>false,
	   'value'=>'"&nbsp;&nbsp;&nbsp;".CHtml::link(($data->HINVESTIGACION),Yii::app()->createUrl("academico/mdlcargasacademicas/actividadesinvestigativas/detail",
	array("id"=>$data->PENA_ID)), array("style"=>"text-align: left","width"=>"2","title" => "Total Horas SEMANA","alt" => "Total Horas SEMANA"))."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".
	CHtml::link(($data->HINVESTIGACION*4),"",array("style"=>"text-align: left","width"=>"2","title" => "Total Horas MES","alt" => "Total Horas MES"))."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".
	CHtml::link(($data->HINVESTIGACION*16),"",array("style"=>"text-align: left","width"=>"2","title" => "Total Horas SEMESTRE","alt" => "Total Horas SEMESTRE"))',
	 'htmlOptions'=>array('style'=>'text-align: left','width'=>'100',), ),
	 
	  array('name'=>'HEXTENSION',
	   'type'=>'html',
	   'filter'=>false,
	   'value'=>'"&nbsp;&nbsp;&nbsp;".CHtml::link(($data->HEXTENSION),Yii::app()->createUrl("academico/mdlcargasacademicas/Actividadesinvestigativas/detail",
	array("id"=>$data->PENA_ID)), array("style"=>"text-align: left","width"=>"2","title" => "Total Horas SEMANA","alt" => "Total Horas SEMANA"))."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".
	CHtml::link(($data->HEXTENSION*4),"",array("style"=>"text-align: left","width"=>"2","title" => "Total Horas MES","alt" => "Total Horas MES"))."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".
	CHtml::link(($data->HEXTENSION*16),"",array("style"=>"text-align: left","width"=>"2","title" => "Total Horas SEMESTRE","alt" => "Total Horas SEMESTRE"))',
	 'htmlOptions'=>array('style'=>'text-align: left','width'=>'100',), ),
	 
	 array('name'=>'TH',
	   'type'=>'html',
	   'filter'=>false,
	   'value'=>'"&nbsp;&nbsp;&nbsp;".CHtml::link((($data->HDDIRECTA)+($data->HINVESTIGACION)+($data->HEXTENSION)),"", array("style"=>"text-align: left","width"=>"2","title" => "Total Horas SEMANA","alt" => "Total Horas SEMANA"))."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".
	CHtml::link((($data->HDDIRECTA*4)+($data->HINVESTIGACION*4)+($data->HEXTENSION*4)),"",array("style"=>"text-align: left","width"=>"2","title" => "Total Horas MES","alt" => "Total Horas MES"))."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".
	CHtml::link((($data->HDDIRECTA*16)+($data->HINVESTIGACION*16)+($data->HEXTENSION*16)),"",array("style"=>"text-align: left","width"=>"2","title" => "Total Horas SEMESTRE","alt" => "Total Horas SEMESTRE"))',
	 'htmlOptions'=>array('style'=>'text-align: left','width'=>'100',), ),
		 	  
		  array('name'=>'ESTADO', 'filter'=>false,
		   'value'=>'Cargasacademicas::model()->Controlhoras($data->HEXTENSION + $data->HINVESTIGACION + $data->HDDIRECTA, $data->TICD_ID)', ),
	
	
	),
)); ?>

    </td>
  </tr>
</table>
