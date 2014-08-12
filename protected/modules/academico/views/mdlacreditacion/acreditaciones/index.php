<?php
$this->breadcrumbs=array(
	'Acreditacion',
);

$this->menu=array(
	array('label'=>'Create acreditacion','url'=>array('create')),
	array('label'=>'Manage acreditacion','url'=>array('admin')),
);
?>

<h1>Acreditacions</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
