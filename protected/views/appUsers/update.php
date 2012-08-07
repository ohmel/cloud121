<?php
$this->breadcrumbs=array(
	'App Users'=>array('index'),
	$model->user_id=>array('view','id'=>$model->user_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AppUsers', 'url'=>array('index')),
	array('label'=>'Create AppUsers', 'url'=>array('create')),
	array('label'=>'View AppUsers', 'url'=>array('view', 'id'=>$model->user_id)),
	array('label'=>'Manage AppUsers', 'url'=>array('admin')),
);
?>

<h1>Update AppUsers <?php echo $model->user_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>