<?php
$this->breadcrumbs=array(
	'Hdvtiposdocumentoses',
);

$this->menu=array(
	array('label'=>'Create Hdvtiposdocumentos','url'=>array('create')),
	array('label'=>'Manage Hdvtiposdocumentos','url'=>array('admin')),
);
?>

<h1>Hdvtiposdocumentoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
