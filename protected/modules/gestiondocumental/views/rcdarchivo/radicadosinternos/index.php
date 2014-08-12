<?php
$this->breadcrumbs=array(
	'Radicadosinternoses',
);

$this->menu=array(
	array('label'=>'Create Radicadosinternos','url'=>array('create')),
	array('label'=>'Manage Radicadosinternos','url'=>array('admin')),
);
?>

<h1>Radicadosinternoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
