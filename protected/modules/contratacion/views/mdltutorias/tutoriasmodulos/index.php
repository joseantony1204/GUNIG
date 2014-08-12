<?php
$this->breadcrumbs=array(
	'Tutoriasmoduloses',
);

$this->menu=array(
	array('label'=>'Create Tutoriasmodulos','url'=>array('create')),
	array('label'=>'Manage Tutoriasmodulos','url'=>array('admin')),
);
?>

<h1>Tutoriasmoduloses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
