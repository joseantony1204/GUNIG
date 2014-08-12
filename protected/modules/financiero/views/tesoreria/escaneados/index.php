<?php
$this->breadcrumbs=array(
	'Escaneados',
);

$this->menu=array(
	array('label'=>'Create escaneados','url'=>array('create')),
	array('label'=>'Manage escaneados','url'=>array('admin')),
);
?>

<h1>Escaneadoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
