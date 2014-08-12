<?php
$this->breadcrumbs=array(
	'Modulo Académico'=>array('/academico/'),
	'Panel Carga Académica'=>array('cargasacademicascpanel/'),
	'Tipo Estudios'=>array('admin'),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Create Tiposestudios','url'=>array('create')),
	array('label'=>'Manage Tiposestudios','url'=>array('admin')),
);
?>

<h1>Tiposestudioses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
