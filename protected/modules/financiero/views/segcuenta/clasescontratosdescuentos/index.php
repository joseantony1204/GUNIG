<?php
$this->breadcrumbs=array(
	'Clasescontratosdescuentoses',
);

$this->menu=array(
	array('label'=>'Create Clasescontratosdescuentos','url'=>array('create')),
	array('label'=>'Manage Clasescontratosdescuentos','url'=>array('admin')),
);
?>

<h1>Clasescontratosdescuentoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
