<?php
$this->breadcrumbs=array(
	'Contratantes',
);

$this->menu=array(
	array('label'=>'Create Contratantes','url'=>array('create')),
	array('label'=>'Manage Contratantes','url'=>array('admin')),
);
?>

<h1>Contratantes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
