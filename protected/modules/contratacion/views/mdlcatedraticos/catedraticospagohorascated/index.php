<?php
$this->breadcrumbs=array(
	'Catedraticospagohorascateds',
);

$this->menu=array(
	array('label'=>'Create Catedraticospagohorascated','url'=>array('create')),
	array('label'=>'Manage Catedraticospagohorascated','url'=>array('admin')),
);
?>

<h1>Catedraticospagohorascateds</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
