<?php
$this->breadcrumbs=array(
	'Personasexperiencialaborals',
);

$this->menu=array(
	array('label'=>'Create Personasexperiencialaboral','url'=>array('create')),
	array('label'=>'Manage Personasexperiencialaboral','url'=>array('admin')),
);
?>

<h1>Personasexperiencialaborals</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
