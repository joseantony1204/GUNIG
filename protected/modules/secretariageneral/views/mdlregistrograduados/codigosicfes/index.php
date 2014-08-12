<?php
$this->breadcrumbs=array(
	'Codigosicfes',
);

$this->menu=array(
	array('label'=>'Create Codigosicfes','url'=>array('create')),
	array('label'=>'Manage Codigosicfes','url'=>array('admin')),
);
?>

<h1>Codigosicfes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
