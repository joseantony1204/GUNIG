<?php
$this->breadcrumbs=array(
	'Titulostrabajosgradoses',
);

$this->menu=array(
	array('label'=>'Create Titulostrabajosgrados','url'=>array('create')),
	array('label'=>'Manage Titulostrabajosgrados','url'=>array('admin')),
);
?>

<h1>Titulostrabajosgradoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
