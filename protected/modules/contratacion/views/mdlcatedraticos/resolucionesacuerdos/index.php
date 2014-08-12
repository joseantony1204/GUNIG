<?php
$this->breadcrumbs=array(
	'Resolucionesacuerdoses',
);

$this->menu=array(
	array('label'=>'Create Resolucionesacuerdos','url'=>array('create')),
	array('label'=>'Manage Resolucionesacuerdos','url'=>array('admin')),
);
?>

<h1>Resolucionesacuerdoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
