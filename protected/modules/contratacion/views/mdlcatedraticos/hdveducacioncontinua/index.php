<?php
$this->breadcrumbs=array(
	'Hdveducacioncontinuas',
);

$this->menu=array(
	array('label'=>'Create Hdveducacioncontinua','url'=>array('create')),
	array('label'=>'Manage Hdveducacioncontinua','url'=>array('admin')),
);
?>

<h1>Hdveducacioncontinuas</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
