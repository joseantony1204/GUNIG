<?php
$this->breadcrumbs=array(
	'Personasjuridicases',
);

$this->menu=array(
	array('label'=>'Create Personasjuridicas','url'=>array('create')),
	array('label'=>'Manage Personasjuridicas','url'=>array('admin')),
);
?>

<h1>Personasjuridicases</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
