<?php
$this->breadcrumbs=array(
	'Entesexternoses',
);

$this->menu=array(
	array('label'=>'Create Entesexternos','url'=>array('create')),
	array('label'=>'Manage Entesexternos','url'=>array('admin')),
);
?>

<h1>Entesexternoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
