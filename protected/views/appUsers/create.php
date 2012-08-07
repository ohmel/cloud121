<?php
$this->breadcrumbs=array(
	'App Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AppUsers', 'url'=>array('index')),
	array('label'=>'Manage AppUsers', 'url'=>array('admin')),
);
?>

<h1>Create AppUsers</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>