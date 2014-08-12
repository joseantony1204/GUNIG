<?php
$this->breadcrumbs=array(
	'Ocasionalescontratoses',
);

$this->menu=array(
	array('label'=>'Create Ocasionalescontratos','url'=>array('create')),
	array('label'=>'Manage Ocasionalescontratos','url'=>array('admin')),
);
?>

<h1>Ocasionalescontratoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
