<?php
$this->breadcrumbs=array(
	'Fechasgradoses',
);

$this->menu=array(
	array('label'=>'Create Fechasgrados','url'=>array('create')),
	array('label'=>'Manage Fechasgrados','url'=>array('admin')),
);
?>

<h1>Fechasgradoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
