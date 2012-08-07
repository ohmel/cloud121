<?php
$this->breadcrumbs=array(
	'Churches'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Church', 'url'=>array('index')),
	array('label'=>'Manage Church', 'url'=>array('admin')),
);
?>

<h1>Create Church</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>