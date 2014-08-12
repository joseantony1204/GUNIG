<?php
$this->breadcrumbs=array(
	'Penarainenvias',
);

$this->menu=array(
	array('label'=>'Create Penarainenvia','url'=>array('create')),
	array('label'=>'Manage Penarainenvia','url'=>array('admin')),
);
?>

<h1>Penarainenvias</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
