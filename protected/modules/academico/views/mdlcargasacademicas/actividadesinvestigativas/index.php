<?php
$this->breadcrumbs=array(
	'Actividadesinvestigativases',
);

$this->menu=array(
	array('label'=>'Create Actividadesinvestigativas','url'=>array('create')),
	array('label'=>'Manage Actividadesinvestigativas','url'=>array('admin')),
);
?>

<h1>Actividadesinvestigativases</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
