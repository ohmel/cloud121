<?php
$this->breadcrumbs=array(
	'Church Supplies'=>array('index'),
	$model->supplies_id=>array('view','id'=>$model->supplies_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ChurchSupplies', 'url'=>array('index')),
	array('label'=>'Create ChurchSupplies', 'url'=>array('create')),
	array('label'=>'View ChurchSupplies', 'url'=>array('view', 'id'=>$model->supplies_id)),
	array('label'=>'Manage ChurchSupplies', 'url'=>array('admin')),
);
?>

<h1>Update ChurchSupplies <?php echo $model->supplies_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>