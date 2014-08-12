<?php
$this->breadcrumbs=array(
	'Persnaturalesocasionales',
);

$this->menu=array(
	array('label'=>'Create Persnaturalesocasionales','url'=>array('create')),
	array('label'=>'Manage Persnaturalesocasionales','url'=>array('admin')),
);
?>

<h1>Persnaturalesocasionales</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
