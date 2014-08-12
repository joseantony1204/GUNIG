<?php
$this->breadcrumbs=array(
	'Acreditacionpondaspes',
);

$this->menu=array(
	array('label'=>'Create acreditacionpondaspe','url'=>array('create')),
	array('label'=>'Manage acreditacionpondaspe','url'=>array('admin')),
);
?>

<h1>Acreditacionpondaspes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
