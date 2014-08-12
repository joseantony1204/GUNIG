<?php
$this->breadcrumbs=array(
	'Formaspagoses',
);

$this->menu=array(
	array('label'=>'Create Formaspagos','url'=>array('create')),
	array('label'=>'Manage Formaspagos','url'=>array('admin')),
);
?>

<h1>Formaspagoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
