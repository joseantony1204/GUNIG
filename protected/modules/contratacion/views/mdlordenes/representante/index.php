<?php
$this->breadcrumbs=array(
	'Representantes',
);

$this->menu=array(
	array('label'=>'Create Representante','url'=>array('create')),
	array('label'=>'Manage Representante','url'=>array('admin')),
);
?>

<h1>Representantes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
