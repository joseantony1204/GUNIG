<?php
$this->breadcrumbs=array(
	'Tutoriassubprogramases',
);

$this->menu=array(
	array('label'=>'Create Tutoriassubprogramas','url'=>array('create')),
	array('label'=>'Manage Tutoriassubprogramas','url'=>array('admin')),
);
?>

<h1>Tutoriassubprogramases</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
