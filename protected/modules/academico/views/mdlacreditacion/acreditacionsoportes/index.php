<?php
$this->breadcrumbs=array(
	'Soportes',
);

$this->menu=array(
	array('label'=>'Create Soportes','url'=>array('create')),
	array('label'=>'Manage Soportes','url'=>array('admin')),
);
?>

<h1>Acreditacionsoportes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
