<?php
$this->breadcrumbs=array(
	'Descuentosatributoses',
);

$this->menu=array(
	array('label'=>'Create Descuentosatributos','url'=>array('create')),
	array('label'=>'Manage Descuentosatributos','url'=>array('admin')),
);
?>

<h1>Descuentosatributoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
