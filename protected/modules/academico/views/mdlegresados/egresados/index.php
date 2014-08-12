<?php
$this->breadcrumbs=array(
	'Egresadoses',
);

$this->menu=array(
	array('label'=>'Create Egresados','url'=>array('create')),
	array('label'=>'Manage Egresados','url'=>array('admin')),
);
?>

<h1>Egresadoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
