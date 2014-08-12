<?php
$this->breadcrumbs=array(
	'Secretariosgenerales',
);

$this->menu=array(
	array('label'=>'Create Secretariosgenerales','url'=>array('create')),
	array('label'=>'Manage Secretariosgenerales','url'=>array('admin')),
);
?>

<h1>Secretariosgenerales</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
