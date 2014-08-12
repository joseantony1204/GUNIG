<?php
$this->breadcrumbs=array(
	'Moduloses',
);

$this->menu=array(
	array('label'=>'Create Modulos','url'=>array('create')),
	array('label'=>'Manage Modulos','url'=>array('admin')),
);
?>

<h1>Moduloses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
