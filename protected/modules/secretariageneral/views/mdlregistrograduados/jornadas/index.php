<?php
$this->breadcrumbs=array(
	'Jornadases',
);

$this->menu=array(
	array('label'=>'Create jornadas','url'=>array('create')),
	array('label'=>'Manage jornadas','url'=>array('admin')),
);
?>

<h1>Jornadases</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
