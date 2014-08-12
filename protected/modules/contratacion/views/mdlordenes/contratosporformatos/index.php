<?php
$this->breadcrumbs=array(
	'Contratosporformatoses',
);

$this->menu=array(
	array('label'=>'Create Contratosporformatos','url'=>array('create')),
	array('label'=>'Manage Contratosporformatos','url'=>array('admin')),
);
?>

<h1>Contratosporformatoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
