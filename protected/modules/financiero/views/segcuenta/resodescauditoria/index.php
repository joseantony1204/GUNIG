<?php
$this->breadcrumbs=array(
	'Resodescauditorias',
);

$this->menu=array(
	array('label'=>'Create Resodescauditoria','url'=>array('create')),
	array('label'=>'Manage Resodescauditoria','url'=>array('admin')),
);
?>

<h1>Resodescauditorias</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
