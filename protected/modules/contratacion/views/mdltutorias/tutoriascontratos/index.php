<?php
$this->breadcrumbs=array(
	'Tutoriascontratoses',
);

$this->menu=array(
	array('label'=>'Create Tutoriascontratos','url'=>array('create')),
	array('label'=>'Manage Tutoriascontratos','url'=>array('admin')),
);
?>

<h1>Tutoriascontratoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
