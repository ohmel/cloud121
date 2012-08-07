<?php
$this->breadcrumbs=array(
	'App Users'=>array('index'),
	$model->user_id,
);

$this->menu=array(
	array('label'=>'List AppUsers', 'url'=>array('index')),
	array('label'=>'Create AppUsers', 'url'=>array('create')),
	array('label'=>'Update AppUsers', 'url'=>array('update', 'id'=>$model->user_id)),
	array('label'=>'Delete AppUsers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->user_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AppUsers', 'url'=>array('admin')),
);
?>

<h1>View AppUsers #<?php echo $model->user_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'user_id',
		'ud_id',
		'church_id',
		'user_name',
		'user_fullname',
		'user_password',
		'user_type',
		'user_status',
	),
)); ?>
