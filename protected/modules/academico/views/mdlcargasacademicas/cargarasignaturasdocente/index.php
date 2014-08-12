<?php
$this->breadcrumbs=array(
	'Cargarasignaturasdocentes',
);

$this->menu=array(
	array('label'=>'Create Cargarasignaturasdocente','url'=>array('create')),
	array('label'=>'Manage Cargarasignaturasdocente','url'=>array('admin')),
);
?>

<h1>Cargarasignaturasdocentes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
