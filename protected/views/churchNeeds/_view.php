<div class="view">
        <pre>
        <?//php print_r($data->attributes)?>
        </pre>
	<b><?php echo CHtml::encode($data->getAttributeLabel('need_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->need_id), array('view', 'id'=>$data->need_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('church_id')); ?>:</b>
	<?php echo CHtml::encode($data->church_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('need_title')); ?>:</b>
	<?php echo CHtml::encode($data->need_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('need_desc')); ?>:</b>
	<?php echo CHtml::encode($data->need_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category')); ?>:</b>
	<?php echo CHtml::encode($data->category); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('need_date')); ?>:</b>
	<?php echo CHtml::encode($data->need_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('need_status')); ?>:</b>
	<?php echo CHtml::encode($data->need_status); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('latlng')); ?>:</b>
	<?php echo CHtml::encode($data->latlng); ?>
	<br />

	*/ ?>

</div>