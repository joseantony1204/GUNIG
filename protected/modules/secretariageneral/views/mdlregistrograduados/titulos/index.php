<?php
$this->breadcrumbs=array(
	'Tituloses',
);

$this->menu=array(
	array('label'=>'Create Titulos','url'=>array('create')),
	array('label'=>'Manage Titulos','url'=>array('admin')),
);
?>

<h1>Tituloses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
