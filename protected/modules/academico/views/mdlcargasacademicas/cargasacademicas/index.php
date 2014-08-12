<?php
$this->breadcrumbs=array(
	'Cargasacademicases',
);

$this->menu=array(
	array('label'=>'Create Cargasacademicas','url'=>array('create')),
	array('label'=>'Manage Cargasacademicas','url'=>array('admin')),
);
?>

<h1>Cargasacademicases</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
