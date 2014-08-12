<?php
$this->breadcrumbs=array(
	'Recibidoses',
);

$this->menu=array(
	array('label'=>'Create Recibidos','url'=>array('create')),
	array('label'=>'Manage Recibidos','url'=>array('admin')),
);
?>

<h1>Recibidoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
