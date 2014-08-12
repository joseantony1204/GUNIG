<?php
$this->breadcrumbs=array(
	'Asignaturases',
);

$this->menu=array(
	array('label'=>'Create Asignaturas','url'=>array('create')),
	array('label'=>'Manage Asignaturas','url'=>array('admin')),
);
?>

<h1>Asignaturases</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
