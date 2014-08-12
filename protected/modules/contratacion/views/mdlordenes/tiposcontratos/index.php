<?php
$this->breadcrumbs=array(
	'Tiposcontratoses',
);

$this->menu=array(
	array('label'=>'Create Tiposcontratos','url'=>array('create')),
	array('label'=>'Manage Tiposcontratos','url'=>array('admin')),
);
?>

<h1>Tiposcontratoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
