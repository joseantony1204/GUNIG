<?php
$this->breadcrumbs=array(
	'Clausulaspartes',
);

$this->menu=array(
	array('label'=>'Create Clausulaspartes','url'=>array('create')),
	array('label'=>'Manage Clausulaspartes','url'=>array('admin')),
);
?>

<h1>Clausulaspartes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
