<?php
$this->breadcrumbs=array(
	'Acreditacionpondfacts',
);

$this->menu=array(
	array('label'=>'Create acreditacionpondfact','url'=>array('create')),
	array('label'=>'Manage acreditacionpondfact','url'=>array('admin')),
);
?>

<h1>Acreditacionpondfacts</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
