<?php
$this->breadcrumbs=array(
	'Actividadesextensions',
);

$this->menu=array(
	array('label'=>'Create Actividadesextension','url'=>array('create')),
	array('label'=>'Manage Actividadesextension','url'=>array('admin')),
);
?>

<h1>Actividadesextensions</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
