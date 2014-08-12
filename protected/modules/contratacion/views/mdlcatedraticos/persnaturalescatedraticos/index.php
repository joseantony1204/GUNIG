<?php
$this->breadcrumbs=array(
	'Persnaturalescatedraticoses',
);

$this->menu=array(
	array('label'=>'Create Persnaturalescatedraticos','url'=>array('create')),
	array('label'=>'Manage Persnaturalescatedraticos','url'=>array('admin')),
);
?>

<h1>Persnaturalescatedraticoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
