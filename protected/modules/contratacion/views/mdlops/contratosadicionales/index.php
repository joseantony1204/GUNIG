<?php
$this->breadcrumbs=array(
	'Contratosadicionales',
);

$this->menu=array(
	array('label'=>'Create Contratosadicionales','url'=>array('create')),
	array('label'=>'Manage Contratosadicionales','url'=>array('admin')),
);
?>

<h1>Contratosadicionales</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
