<?php
$this->breadcrumbs=array(
	'Evamodeloscriterioses',
);

$this->menu=array(
	array('label'=>'Create Evamodeloscriterios','url'=>array('create')),
	array('label'=>'Manage Evamodeloscriterios','url'=>array('admin')),
);
?>

<h1>Evamodeloscriterioses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
