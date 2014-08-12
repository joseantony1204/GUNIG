<?php
$this->breadcrumbs=array(
	'Categruposinvestigacions',
);

$this->menu=array(
	array('label'=>'Create Categruposinvestigacion','url'=>array('create')),
	array('label'=>'Manage Categruposinvestigacion','url'=>array('admin')),
);
?>

<h1>Categruposinvestigacions</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
