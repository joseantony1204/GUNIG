<?php Yii::app()->homeUrl = array('/academico/acreditacioncpanel/index');  ?>

<?php
$this->breadcrumbs=array(
	'Programas',
);

$this->menu=array(
	array('label'=>'Create programas','url'=>array('create')),
	array('label'=>'Manage programas','url'=>array('admin')),
);
?>

<h1>Programases</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
