<?php
$this->breadcrumbs=array(
	'Sedes',
);

$this->menu=array(
	array('label'=>'Create Sedes','url'=>array('create')),
	array('label'=>'Manage Sedes','url'=>array('admin')),
);
?>

<h1>Sedes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
