<?php
$this->breadcrumbs=array(
	'Radicadosexternoses',
);

$this->menu=array(
	array('label'=>'Create Radicadosexternos','url'=>array('create')),
	array('label'=>'Manage Radicadosexternos','url'=>array('admin')),
);
?>

<h1>Radicadosexternoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
