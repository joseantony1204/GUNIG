<?php
$this->breadcrumbs=array(
	'Programases',
);

$this->menu=array(
	array('label'=>'Create Programas','url'=>array('create')),
	array('label'=>'Manage Programas','url'=>array('admin')),
);
?>

<h1>Programases</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
