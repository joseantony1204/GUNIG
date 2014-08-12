<?php
$this->breadcrumbs=array(
	'Objetoses',
);

$this->menu=array(
	array('label'=>'Create Objetos','url'=>array('create')),
	array('label'=>'Manage Objetos','url'=>array('admin')),
);
?>

<h1>Objetoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
