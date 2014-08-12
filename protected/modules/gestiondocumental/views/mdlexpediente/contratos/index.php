<?php
$this->breadcrumbs=array(
	'Contratoses',
);

$this->menu=array(
	array('label'=>'Create Contratos','url'=>array('create')),
	array('label'=>'Manage Contratos','url'=>array('admin')),
);
?>

<h1>Contratoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
