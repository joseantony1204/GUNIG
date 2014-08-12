<?php
$this->breadcrumbs=array(
	'Clasesresoluciones',
);

$this->menu=array(
	array('label'=>'Create Clasesresoluciones','url'=>array('create')),
	array('label'=>'Manage Clasesresoluciones','url'=>array('admin')),
);
?>

<h1>Clasesresoluciones</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
