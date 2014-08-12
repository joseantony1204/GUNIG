<?php Yii::app()->homeUrl = array('/academico/acreditacioncpanel/index');  ?>
<?php
$this->breadcrumbs=array(
	'Ponderaciones',
);

$this->menu=array(
	array('label'=>'Create Ponderacion','url'=>array('create')),
	array('label'=>'Manage Ponderacion','url'=>array('admin')),
);
?>

<h1>PONDERACIONES</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
