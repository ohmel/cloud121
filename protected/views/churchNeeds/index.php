<?php
$this->breadcrumbs=array(
	'Church Needs',
);

$this->menu=array(
	array('label'=>'Create ChurchNeeds', 'url'=>array('create')),
	array('label'=>'Manage ChurchNeeds', 'url'=>array('admin')),
);
?>

<h1>Church Needs</h1>
<pre>
<?//php print_r($dataProvider->need_id)?>
</pre>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
