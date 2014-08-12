<?php
$this->breadcrumbs=array(
	'Valorpuntoses',
);

$this->menu=array(
	array('label'=>'Create Valorpuntos','url'=>array('create')),
	array('label'=>'Manage Valorpuntos','url'=>array('admin')),
);
?>

<h1>Valorpuntoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
