<?php
$this->breadcrumbs=array(
	'Modulo Académico'=>array('/academico/'),
	'Menú Carga Académica'=>array('cargasacademicascpanel/'),
	'Estudios'=>array('admin'),
);

$this->menu=array(
	array('label'=>'Create Estudios','url'=>array('create')),
	array('label'=>'Manage Estudios','url'=>array('admin')),
);
?>

<h1>Estudioses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
