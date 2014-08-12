<?php
$this->breadcrumbs=array(
	'Tipocontrataciondocentes',
);

$this->menu=array(
	array('label'=>'Create Tipocontrataciondocentes','url'=>array('create')),
	array('label'=>'Manage Tipocontrataciondocentes','url'=>array('admin')),
);
?>

<h1>Tipocontrataciondocentes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
