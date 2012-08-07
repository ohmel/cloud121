<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('supplies_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->supplies_id), array('view', 'id'=>$data->supplies_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('church_id')); ?>:</b>
	<?php echo CHtml::encode($data->church_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('supplies_title')); ?>:</b>
	<?php echo CHtml::encode($data->supplies_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('supplies_desc')); ?>:</b>
	<?php echo CHtml::encode($data->supplies_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category')); ?>:</b>
	<?php echo CHtml::encode($data->category); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('supplies_date')); ?>:</b>
	<?php echo CHtml::encode($data->supplies_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('supplies_status')); ?>:</b>
	<?php echo CHtml::encode($data->supplies_status); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('latlng')); ?>:</b>
	<?php echo CHtml::encode($data->latlng); ?>
	<br />

	*/ ?>

</div>