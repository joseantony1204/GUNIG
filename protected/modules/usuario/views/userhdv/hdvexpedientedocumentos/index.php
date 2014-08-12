<?php
$this->breadcrumbs=array(
	'Hdvexpedientedocumentoses',
);

$this->menu=array(
	array('label'=>'Create Hdvexpedientedocumentos','url'=>array('create')),
	array('label'=>'Manage Hdvexpedientedocumentos','url'=>array('admin')),
);
?>

<h1>Hdvexpedientedocumentoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
