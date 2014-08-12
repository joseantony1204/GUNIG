<?php
$this->breadcrumbs=array(
	'Liqudescauditorias',
);

$this->menu=array(
	array('label'=>'Create Liqudescauditoria','url'=>array('create')),
	array('label'=>'Manage Liqudescauditoria','url'=>array('admin')),
);
?>

<h1>Liqudescauditorias</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
