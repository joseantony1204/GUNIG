<?php Yii::app()->homeUrl = array('/academico/acreditacioncpanel/index');  ?>
<?php
$this->breadcrumbs=array(
	'Acreditacionaspectoses',
);

$this->menu=array(
	array('label'=>'Create acreditacionaspectos','url'=>array('create')),
	array('label'=>'Manage acreditacionaspectos','url'=>array('admin')),
);
?>

<h1>Acreditacionaspectoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
