<?php
$this->breadcrumbs=array(
	'Formatocontratoses',
);

$this->menu=array(
	array('label'=>'Create Formatocontratos','url'=>array('create')),
	array('label'=>'Manage Formatocontratos','url'=>array('admin')),
);
?>

<h1>Formatocontratoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
