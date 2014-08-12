<?php
$this->breadcrumbs=array(
	'Gruposinvestigacions',
);

$this->menu=array(
	array('label'=>'Create Gruposinvestigacion','url'=>array('create')),
	array('label'=>'Manage Gruposinvestigacion','url'=>array('admin')),
);
?>

<h1>Gruposinvestigacions</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
