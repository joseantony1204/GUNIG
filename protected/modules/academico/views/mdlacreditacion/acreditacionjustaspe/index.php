<?php
$this->breadcrumbs=array(
	'Acreditacionjustaspes',
);

$this->menu=array(
	array('label'=>'Create acreditacionjustaspe','url'=>array('create')),
	array('label'=>'Manage acreditacionjustaspe','url'=>array('admin')),
);
?>

<h1>Acreditacionjustaspes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
