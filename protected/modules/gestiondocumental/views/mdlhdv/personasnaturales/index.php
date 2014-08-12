<?php
$this->breadcrumbs=array(
	'Personasnaturales',
);

$this->menu=array(
	array('label'=>'Create Personasnaturales','url'=>array('create')),
	array('label'=>'Manage Personasnaturales','url'=>array('admin')),
);
?>

<h1>Personasnaturales</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
