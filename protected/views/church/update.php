<?php
$this->breadcrumbs=array(
	'Churches'=>array('index'),
	$model->church_id=>array('view','id'=>$model->church_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Church', 'url'=>array('index')),
	array('label'=>'Create Church', 'url'=>array('create')),
	array('label'=>'View Church', 'url'=>array('view', 'id'=>$model->church_id)),
	array('label'=>'Manage Church', 'url'=>array('admin')),
);
?>

<h1>Update Church <?php echo $model->church_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>