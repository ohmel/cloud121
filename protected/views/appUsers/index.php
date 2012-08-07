<?php
$this->breadcrumbs=array(
	'App Users',
);

$this->menu=array(
	array('label'=>'Create AppUsers', 'url'=>array('create')),
	array('label'=>'Manage AppUsers', 'url'=>array('admin')),
);
?>

<h1>App Users</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
