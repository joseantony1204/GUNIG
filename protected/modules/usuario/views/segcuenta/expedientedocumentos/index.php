<?php
$this->breadcrumbs=array(
	'Expedientedocumentoses',
);

$this->menu=array(
	array('label'=>'Create Expedientedocumentos','url'=>array('create')),
	array('label'=>'Manage Expedientedocumentos','url'=>array('admin')),
);
?>

<h1>Expedientedocumentoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
