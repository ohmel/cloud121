<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('event_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->event_id), array('view', 'id'=>$data->event_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('event_name')); ?>:</b>
	<?php echo CHtml::encode($data->event_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('event_desc')); ?>:</b>
	<?php echo CHtml::encode($data->event_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('church_id')); ?>:</b>
	<?php echo CHtml::encode($data->church_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_from')); ?>:</b>
	<?php echo CHtml::encode($data->date_from); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_to')); ?>:</b>
	<?php echo CHtml::encode($data->date_to); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('event_type')); ?>:</b>
	<?php echo CHtml::encode($data->event_type); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('latlng')); ?>:</b>
	<?php echo CHtml::encode($data->latlng); ?>
	<br />

	*/ ?>

</div>