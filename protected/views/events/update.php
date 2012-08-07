<?php
$this->breadcrumbs=array(
	'Events'=>array('index'),
	$model->event_id=>array('view','id'=>$model->event_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Events', 'url'=>array('index')),
	array('label'=>'Create Events', 'url'=>array('create')),
	array('label'=>'View Events', 'url'=>array('view', 'id'=>$model->event_id)),
	array('label'=>'Manage Events', 'url'=>array('admin')),
);
?>

<h1>Update Events <?php echo $model->event_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>