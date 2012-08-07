<?php
$this->breadcrumbs=array(
	'Church Needs'=>array('index'),
	$model->need_id=>array('view','id'=>$model->need_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ChurchNeeds', 'url'=>array('index')),
	array('label'=>'Create ChurchNeeds', 'url'=>array('create')),
	array('label'=>'View ChurchNeeds', 'url'=>array('view', 'id'=>$model->need_id)),
	array('label'=>'Manage ChurchNeeds', 'url'=>array('admin')),
);
?>

<h1>Update ChurchNeeds <?php echo $model->need_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>