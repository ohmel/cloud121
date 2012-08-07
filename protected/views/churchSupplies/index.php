<?php
$this->breadcrumbs=array(
	'Church Supplies',
);

$this->menu=array(
	array('label'=>'Create ChurchSupplies', 'url'=>array('create')),
	array('label'=>'Manage ChurchSupplies', 'url'=>array('admin')),
);
?>

<h1>Church Supplies</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
